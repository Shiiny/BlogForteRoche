<?php

namespace blog\model;

use blog\model\Manager;

class User extends Manager {
	protected $table;

	public function isUniq($field, $value) {
		return $this->requete("SELECT id FROM {$this->table} WHERE $field = ?", [$value], true);
	}

	public function byUserId($user_id) {
		return $this->requete("SELECT * FROM {$this->table} WHERE id = ?", [$user_id], true);
	}

	public function validateAccount($user_id) {
		return $this->requete("UPDATE {$this->table} SET confirmation_token = NULL, confirmed_at = NOW() WHERE id = ?", [$user_id], true);
	}
}