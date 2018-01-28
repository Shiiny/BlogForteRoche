<?php

namespace blog\model;

use blog\App;
use blog\model\Manager;

class User extends Manager {
	protected $table;

	public function isUniq($field, $value) {
		return $this->requete("SELECT id FROM {$this->table} WHERE $field = ?", [$value], true);
	}
}