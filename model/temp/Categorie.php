<?php

namespace blog\model;

use blog\App;
use blog\model\Manager;

class Categorie extends Manager{
	private $id;
	private $title;

	protected static $table = 'categories';

	public function getUrl() {
		return 'index.php?p=categorie&id=' . $this->getId();
	}

	public function getId() {
		return $this->id;
	}

	public function getTitle() {
		return $this->title;
	}
}