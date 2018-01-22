<?php

namespace blog\model;

use blog\App;
use blog\model\Manager;

class User extends Manager {
	protected $table;

	/**
	 * @param  [string] $username 
	 * @param  [string] $password 
	 * @return [boolean]
	 */
	public function login($username, $password) {
		$user = $this->requete("SELECT users.id, users.username, users.password, users.perm_id, permission.rang as rang FROM {$this->table} LEFT JOIN permission ON perm_id = permission.id WHERE users.username = ? ", [$username], true);
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

	/*public function permission() {
		var_dump($_SESSION);
		if($_SESSION['perm'] == 1) {
			return true;
		}
		return false;
	}*/



	public function getUser($user_id) {
		return $this->requete("SELECT users.username FROM {$this->table} WHERE id = ?", [$user_id], true);
	}

	public function byRang($username) {
		return $this->requete("SELECT users.id, users.username, users.perm_id, permission.rang as rang FROM {$this->table} LEFT JOIN permission ON perm_id = permission.id WHERE users.username = ? ", [$username], true);
	}
}