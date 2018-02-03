<?php

namespace blog\entity;

use blog\entity\Entity;

class CategoryEntity extends Entity {
	public function getUrl() {
		return 'index.php?p=books.category&id=' . $this->id;
	}
}