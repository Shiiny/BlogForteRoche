<?php

namespace blog;

use \PDO;

class MysqlDatabase{
	private $db_name;
	private $db_user;
	private $db_pass;
	private $db_host;

	private $pdo;

	public function __construct($db_name, $db_user = 'root', $db_pass = '', $db_host = 'localhost') {
		$this->db_name = $db_name;
		$this->db_user = $db_user;
		$this->db_pass = $db_pass;
		$this->db_host = $db_host;

	}

	private function getPDO() {
		if($this->pdo === null) {
			try {
				$pdo = new PDO('mysql:dbname='.$this->db_name.';host='.$this->db_host.';charset=utf8', ''.$this->db_user.'', ''.$this->db_pass.'');
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->pdo = $pdo;
			}
			catch(Exception $e) {
				die('Erreur : '.$e->getMessage());
			}
		}
		return $this->pdo;
	}

	public function query($statement, $class_name = null, $one = false) {
		$req = $this->getPDO()->query($statement);
		if(
			strpos($statement, 'UPDATE') === 0 ||
			strpos($statement, 'INSERT') === 0 ||
			strpos($statement, 'DELETE') === 0
		) {
			return $req;
		}
		if($class_name === null) {
			$req->setFetchMode(PDO::FETCH_OBJ);
		}
		else {
			$req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, $class_name);
		}
		if($one) {
			$data = $req->fetch();
		}
		else {
			$data = $req->fetchAll();
		}
		return $data;
	}

	public function prepare($statement, $attributes, $class_name = null,  $one = false) {
		$req = $this->getPDO()->prepare($statement);
		$res = $req->execute($attributes);
		if(
			strpos($statement, 'UPDATE') === 0 ||
			strpos($statement, 'INSERT') === 0 ||
			strpos($statement, 'DELETE') === 0
		) {
			return $res;
		}
		if($class_name === null) {
			$req->setFetchMode(PDO::FETCH_OBJ);
		}
		else {
			$req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, $class_name);
		}
		if($one) {
			$data = $req->fetch();
		}
		else {
			$data = $req->fetchAll();
		}
		return $data;
	}

	/**
	 * Retourne l'id de la dernière insertion 
	 * @return [int]
	 */
	public function lastInsertId() {
		return $this->getPDO()->lastInsertId();
	}
}