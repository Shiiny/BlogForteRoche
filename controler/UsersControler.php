<?php

namespace blog\controler;

use blog\controler\Controler;
use \App;
use blog\Auth\Auth;
use blog\html\BootstrapForm;

class UsersControler extends Controler {
	private $errors = [];

	public function __construct() {
		parent::__construct();
		$this->loadModel('user');
		$this->loadModel('book');
		$this->loadModel('chapter');
		$this->loadModel('comment');		
	}

	public function isValid() {
		return empty($this->errors);
	}

	public function getErrors() {
		return $this->errors;
	}
	
	public function login($app) {
		$app->getAuth()->connectFromCookie();
		if($app->getAuth()->logged()) {
			$app->redirect('index.php?p=users.account');
		}
		if(!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])) {
			$user = $app->getAuth()->login($_POST['username'], $_POST['password'], isset($_POST['remember']), $app);
			if($user && $user->slug !== 'ban') {
				$app->getSession()->setFlash('success', "Vous êtes connecté");
				$app->redirect('index.php?p=users.account');
			}
			else {
				$app->getSession()->setFlash('danger', "Identifiant ou mot de passe incorrecte");
			}
		}
			
		$form = new BootstrapForm($_POST);
		$this->render('users.login', compact('form'));
	}

	public function register($app) {
		if(!empty($_POST)) {
			$errors = [];

			if(!preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username']) || !isset($_POST['username'])) {
				$this->errors['username'] = "Votre pseudo n'est pas valide !";
			}
			if($this->isValid()) {
				$user = $this->user->isUniq('username', $_POST['username']);
				if($user) {
					$this->errors['username'] = "Ce pseudo est déjà utilisé";
				}
			}
			if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
				$this->errors['email'] = "Votre email n'est pas valide !";
			}
			if($this->isValid()) {
				$user = $this->user->isUniq('email', $_POST['email']);
				if($user) {
					$this->errors['email'] = "Cet adresse e-mail est déjà utilisé";
				}
			}
			if(empty($_POST['password']) || $_POST['password'] !== $_POST['password_confirm']) {
				$this->errors['password'] = "Vous devez rentrer un mot de passe valide";
			}
			if($this->isValid()) {
				$app->getAuth()->insert($_POST['username'], $_POST['password'], $_POST['email'], $app);
				$app->getSession()->setFlash('success', "Un email de confirmation vous a été envoyé.");
				$app->redirect('index.php?p=users.login');
			}
			else {
				$errors = $this->getErrors();
			}
		}
		$form = new BootstrapForm($_POST);
		$this->render('users.register', compact('form', 'errors'));
	}

	public function confirm($app) {
		if(isset($_GET['id']) && isset($_GET['token'])) {
			$user = $this->user->byUserId($_GET['id']);
			if($user && $user->confirmation_token == $_GET['token']){
				$this->user->validateAccount($user->id);
				$app->getSession()->setFlash('success', "Votre compte a bien été activé");
				$app->getSession()->write('auth', $user);
				$app->redirect('index.php?p=users.account');
			}
			else {
				$app->getSession()->setFlash('danger', "Ce compte à déjà été activé");
				$app->redirect('index.php?p=users.login');
			}
		}
	}

	public function account($app) {
		$app->getAuth()->allow('member');
		$user = $app->getSession()->read('auth');
		var_dump($user);
		$comments = $this->comment->allCommentByUser($user->username);
		$chapter = $this->chapter->find();

		var_dump($comments);
		$this->render('users.account', compact('comments'));
	}

	public function logout($app) {
		setcookie('remember', NULL, -1);
		$app->getSession()->destroy('auth');
		$app->getSession()->setFlash('success', "Vous êtes déconnecté");
		$app->redirect('index.php?p=users.login');
	}

	public function forget($app) {
		if(!empty($_POST) && !empty($_POST['email'])) {
			if($app->getAuth()->forget($_POST['email'], $app)) {
				$app->getSession()->setFlash('success', "Un email vous a été envoyé pour réinitialiser votre mot de passe");
				$app->redirect('index.php?p=users.login');
			}
			else {
				$app->getSession()->setFlash('danger', "Aucun compte ne correspond à cette adresse");
			}
		}
		$form = new BootstrapForm($_POST);
		$this->render('users.forget', compact('form'));
	}

	public function reset($app) {
		if(isset($_GET['id']) && isset($_GET['token'])) {
			$user = $this->user->checkResetToken($_GET['id'], $_GET['token']);
			if($user) {
				if(!empty($_POST)) {
					if(!empty($_POST['password']) && $_POST['password'] === $_POST['password_confirm']) {
						$app->getAuth()->resetPassword($_POST['password'], $user, $app);
						$app->getSession()->setFlash('success', "Votre mot de passe a bien été modifié");
						$app->redirect('account.php');
					}
					else {
						$app->getSession()->setFlash('danger', "Les mots de passe ne sont pas identique");
					}
				}
			}
			else {
				$app->getSession()->setFlash('danger', "Ce token n'est pas valide");
				$app->redirect('login.php');
			}
		}
		else {
			$app->redirect('login.php');
		}
		$form = new BootstrapForm($_POST);
		$this->render('users.reset', compact('form'));
	}
}