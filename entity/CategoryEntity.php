<?php

namespace blog\entity;

use blog\entity\Entity;

class CategoryEntity extends Entity {
	private $id;
	private $title;

	public function getUrl() {
		return 'index.php?p=posts.category&id=' . $this->getId();
	}

	public function getId() {
		return $this->id;
	}

	public function getTitle() {
		return $this->title;
	}

}