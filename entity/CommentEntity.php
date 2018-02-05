<?php

namespace blog\entity;

use blog\entity\Entity;

class CommentEntity extends Entity {

		
	public function getExtrait() {
		return '<p>' . substr($this->comment, 0, 300) . '...</p>';
	}
}