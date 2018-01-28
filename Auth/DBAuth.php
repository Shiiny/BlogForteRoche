<?php

namespace blog\Auth;

use blog\MysqlDatabase;
use \App;

class DBAuth {
	private $db;

	public function __construct(MysqlDatabase $db) {
		$this->db = $db;
	}

	public function hashPassword($password) {
		return password_hash($password, PASSWORD_BCRYPT);
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
		$token = App::str_random(60);

		$this->db->prepare("INSERT INTO users SET username = ?, password = ?, email = ?, confirmation_token = ?", [$username, $password, $email, $token]);
		$user_id = $this->db->lastInsertId();
		/*$mail_msg = "Afin de valider votre compte merci de cliquer sur ce lien\n\nhttp://localhost/Gestion-membres/confirm.php?id=$user_id&token=$token";
		mail($email, "Confirmation de votre compte", $mail_msg);*/
	}

	
}