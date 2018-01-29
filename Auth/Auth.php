<?php

namespace blog\Auth;

use blog\MysqlDatabase;
use blog\Auth\Session;

class Auth {
	private $db;
	private $session;

	public function __construct(MysqlDatabase $db, Session $session) {
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

	/**
	 * @param  [string] $username 
	 * @param  [string] $password 
	 * @return [boolean]
	 */
	/*public function login($username, $password) {
		$user = $this->db->prepare('SELECT * FROM users WHERE username = ?', [$username], null, true);
		var_dump($user);
		if($user) {
			if($user->password === sha1($password)) {
				$_SESSION['auth'] = $user->id;
				$_SESSION['perm'] = $user->perm_id;
				return true;
			}
		} 
		return false;
	}*/

	public function register($username, $password, $email) {
		$password = $this->hashPassword($password);
		$token = $this->tokenRandom(60);

		$this->db->prepare("INSERT INTO users SET username = ?, password = ?, email = ?, confirmation_token = ?", [$username, $password, $email, $token]);
		$user_id = $this->db->lastInsertId();
		$mail_msg = "Afin de valider votre compte merci de cliquer sur ce lien\n\nhttp://localhost/BlogForteRoche/public/index.php?p=users.confirm&id=$user_id&token=$token";
		mail($email, "Confirmation de votre compte", $mail_msg);
	}

	
}