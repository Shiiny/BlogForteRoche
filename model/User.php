<?php

namespace blog\model;

use blog\model\Manager;

class User extends Manager {
	protected $table;


	public function updateUser($id, $fields) {
		$sql_fields = [];
		$attributes = [];
		foreach ($fields as $key => $value) {
			$sql_fields[] = "$key = ?";
			$attributes[] = $value;
		}
		$attributes[] = $id;
		$sql_field = implode(', ', $sql_fields);
		return $this->requete("UPDATE {$this->table} SET $sql_field WHERE id = ?", $attributes, true);
	}

	public function allUsers() {
		return $this->requete("SELECT users.id, users.username, users.role_id, users.password, users.email, users.confirmation_token, DATE_FORMAT(confirmed_at, '%d/%m/%Y %H:%i:%s') AS date_at, users.reset_token, users.reset_at, users.remember, roles.rang FROM {$this->table} LEFT JOIN roles ON users.role_id = roles.role_id WHERE confirmed_at IS NOT NULL");
	}

	public function userRecent() {
		return $this->requete("SELECT users.id, users.username, users.role_id, users.password, users.email, users.confirmation_token, DATE_FORMAT(confirmed_at, '%d/%m/%Y %H:%i:%s') AS date_at, users.reset_token, users.reset_at, users.remember FROM {$this->table} WHERE confirmed_at IS NOT NULL ORDER BY confirmed_at DESC", null, true);
	}

	public function isUniq($field, $value) {
		return $this->requete("SELECT id FROM {$this->table} WHERE $field = ?", [$value], true);
	}

	public function selectUser($username) {
		return $this->requete("SELECT * FROM {$this->table} LEFT JOIN roles ON users.role_id = roles.role_id WHERE username = :username OR email = :username AND confirmed_at IS NOT NULL", ['username' => $username], true);
	}

	public function insertUser($username, $password, $email, $token) {
		$role_id = 2;
		return $this->requete("INSERT INTO {$this->table} SET username = ?, role_id = ?, password = ?, email = ?, confirmation_token = ?", [$username, $role_id, $password, $email, $token], true);
	}

	public function byUserId($user_id) {
		return $this->requete("SELECT * FROM {$this->table} LEFT JOIN roles ON users.role_id = roles.role_id WHERE users.id = ?", [$user_id], true);
	}

	public function validateAccount($user_id) {
		return $this->requete("UPDATE {$this->table} SET confirmation_token = NULL, confirmed_at = NOW() WHERE id = ?", [$user_id], true);
	}

	public function activRemember($remember_token, $user_id) {
		return $this->requete("UPDATE {$this->table} SET remember = ? WHERE id = ?", [$remember_token, $user_id], true);
	}

	public function byMail($email) {
		return $this->requete("SELECT * FROM {$this->table} WHERE email = ? AND confirmed_at IS NOT NULL", [$email], true);
	}

	public function updateToken($reset_token, $user_id) {
		return $this->requete("UPDATE {$this->table} SET reset_token = ?, reset_at = NOW() WHERE id = ?", [$reset_token, $user_id], true);
	}

	public function checkResetToken($user_id, $token) {
		return $this->requete ("SELECT * FROM {$this->table} WHERE id = ? AND reset_token = ? AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)", [$user_id, $token], true);
	}

	public function updatePassUser($password, $user) {
		return $this->requete("UPDATE {$this->table} SET password = ?, reset_token = NULL, reset_at = NULL WHERE id = ?", [$password, $user->id], true);
	}

	public function allRoles() {
		return $this->requete("SELECT slug, level FROM roles");
	}

	public function pagerUser($currentPage, $perPage) {
		return $this->requete("SELECT users.id, users.username, users.role_id, users.password, users.email, users.confirmation_token, DATE_FORMAT(confirmed_at, '%d/%m/%Y %H:%i:%s') AS date_at, users.reset_token, users.reset_at, users.remember, roles.rang FROM {$this->table} LEFT JOIN roles ON users.role_id = roles.role_id WHERE confirmed_at IS NOT NULL LIMIT ".(($currentPage-1)*$perPage)." , $perPage");
	}
}