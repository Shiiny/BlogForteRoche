<?php

namespace blog\Auth;

/*use blog\MysqlDatabase;

class DBAuth {
	private $db;

	public function __construct(MysqlDatabase $db) {
		$this->db = $db;
	}

	/*public function getUserId() {
		if($this->logged()) {
			return $_SESSION['auth'];
		}
		return false;
	}*/

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
	}

	public function logged() {
		return isset($_SESSION['auth']);
	}

	public function permission() {
		var_dump($_SESSION);
		if($_SESSION['perm'] == 1) {
			return true;
		}
		return false;
	}
}*/