<?php

namespace blog\Auth;

use blog\MysqlDatabase;
use blog\Auth\Session;
use \App;

class Auth {
	private $app;
	private $db;
	private $session;

	public function __construct(App $app, MysqlDatabase $db, Session $session) {
		$this->app = $app;
		$this->db = $db;
		$this->session = $session;
	}

	public function hashPassword($password) {
		return password_hash($password, PASSWORD_BCRYPT);
	}

	public function tokenRandom($lenght) {
		$alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
		return substr(str_shuffle(str_repeat($alphabet, $lenght)), 0, $lenght);
	}

	public function logged() {
		if(!$this->session->read('auth')) {
			return false;
		}
		return $this->session->read('auth');
	}

	public function connect($user) {
		$this->session->write('auth', $user);
	}

	public function login($username, $password, $remember = false, App $app) {
		$user = $app->getModelClass('user')->selectUser($username);
		if(password_verify($password, $user->password)) {
			$this->connect($user);
			if($remember) {
				$this->remember($app, $user->id);
			}
			return $user;
		}
		return false;
	}

	public function remember($app, $user_id) {
		$remember_token = $this->tokenRandom(250);
		$app->getModelClass('user')->activRemember($remember_token, $user_id);
		setcookie('remember', $user_id . '==' .$remember_token. sha1($user_id. 'test'), time() + 60 * 60 * 24 * 7);
	}

	public function connectFromCookie() {
		if(isset($_COOKIE['remember']) && !$this->logged()) {
			$remember_token = $_COOKIE['remember'];
			$parts = explode('==', $remember_token);
			$user_id = $parts[0];

			$user = $this->app->getModelClass('user')->byUserId($user_id);

			if($user) {			
				$expected = $user->id . '==' . $user->remember . sha1($user->id . 'test');
				if($expected == $remember_token) {
					$this->connect($user);
					setcookie('remember', $remember_token, time() + 60 * 60 * 24 * 7);
				}
				else {
					setcookie('remember', NULL, -1);
				}
			}
			else {
				setcookie('remember', NULL, -1);
			}
		}
	}

	public function insert($username, $password, $email, App $app) {
		$password = $this->hashPassword($password);
		$token = $this->tokenRandom(60);

		$app->getModelClass('user')->insertUser($username, $password, $email, $token);
		$user_id = $this->db->lastInsertId();
		$mail_msg = "Afin de valider votre compte merci de cliquer sur ce lien\n\nhttp://localhost/BlogForteRoche/public/index.php?p=users.confirm&id=$user_id&token=$token";
		mail($email, "Confirmation de votre compte", $mail_msg);
	}

	public function forget($email, App $app) {
		$user = $app->getModelClass('user')->byMail($email);
		if($user) {
			$reset_token = $this->tokenRandom(60);
			$app->getModelClass('user')->updateToken($reset_token, $user->id);
			$mail_msg = "Cliquez sur ce lien\n\nhttp://localhost/BlogForteRoche/public/index.php?p=users.reset&id={$user->id}&token=$reset_token\n\nPour réinitailiser votre mot de passe";
			mail($email, "Demande de réinitialisation", $mail_msg);
			return $user;
		}
		return false;
	}

	public function resetPassword($password, $user, App $app) {
		$password = $this->hashPassword($password);
		$app->getModelClass('user')->updatePassUser($password, $user);
		$this->connect($user);
	}

	public function restrict() {
		if(!$this->session->read('auth')) {
			$this->session->setFlash('danger', "Vous n'avez pas le droit d'accéder à cette page");
			$this->app->redirect('index.php?p=users.login');
		}
	}

	public function allow($rang) {
		$roles = [];
		$data = $this->app->getModelClass('user')->allRoles();
		foreach ($data as $key) {
			$roles[$key->slug] = $key->level;
		}
		//var_dump('Le rang est : '.$roles[$rang]);
		if($roles[$rang] > $this->session->setInfo('level')) {
			$this->session->setFlash('danger', "Vous n'avez pas le droit d'accéder à cette page");

			//$this->app->redirect('index.php?p=users.account');
			//header('Location:index.php');
		}
		$this->restrict();
	}
}