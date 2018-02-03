<?php

namespace blog\entity;

use blog\entity\Entity;

class BookEntity extends Entity {
	public function getUrl() {
		return 'index.php?p=books.single&id=' . $this->id;
	}
}