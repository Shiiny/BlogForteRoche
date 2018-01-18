<?php

namespace blog\model;

use blog\App;

class Manager {


	public static function requete($statement, $attributes = null, $one = false) {
		if($attributes) {
			return App::getDb()->prepare($statement, $attributes, get_called_class(), $one);
		}
		else {
			return App::getDb()->query($statement, get_called_class(), $one);
		}
	}

	public static function all() {
		return self::requete('SELECT * FROM '. static::$table .'');
	}

	public static function find($id) {
		return static::requete("SELECT * FROM " .static::$table. " WHERE id = ?", [$id], true);
	}

}