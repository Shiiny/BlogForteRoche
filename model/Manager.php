<?php

namespace blog\model;

use blog\MysqlDatabase;

class Manager {

	protected $table;
	protected $db;

	/**
	 * [__construct description] Injection de dépendance de la Database
	 * @param MysqlDatabase $db
	 */
	public function __construct(MysqlDatabase $db) {
		$this->db = $db;
		if(is_null($this->table)) {
			$parts = explode('\\', get_class($this));
			$class_name = end($parts);
			$this->table = strtolower($class_name). 's';
		}
	}

	public function getClassEntity() {
		$parts = str_replace('blog\model\\', 'blog\entity\\', get_class($this));
		$classname = $parts. 'Entity';
		return $classname;
	}

	public function requete($statement, $attributes = null, $one = false) {
		if($attributes) {
			return $this->db->prepare($statement, $attributes, $this->getClassEntity(), $one);
		}
		else {
			return $this->db->query($statement, $this->getClassEntity(), $one);
		}
	}

	public function all() {
		return $this->requete("SELECT * FROM {$this->table}");
	}

	public function find($id) {
		return $this->requete("SELECT * FROM {$this->table} WHERE id = ?", [$id], true);
	}

	public function update($id, $fields) {
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

	public function create($fields) {
		$sql_fields = [];
		$attributes = [];
		foreach ($fields as $key => $value) {
			$sql_fields[] = "$key = ?";
			$attributes[] = $value;
		}
		$sql_field = implode(', ', $sql_fields);
		return $this->requete("INSERT INTO {$this->table} SET $sql_field", $attributes, true);
	}

	public function delete($id) {
		var_dump($id);
		die();
		return $this->requete("DELETE FROM {$this->table} WHERE id = ?", [$id], true);
	}

	public function extract($key, $value) {
		$records = $this->all();
		$result = [];
		foreach ($records as $record) {
			$result[$record->$key] = $record->$value;
		}
		return $result;
	}
}