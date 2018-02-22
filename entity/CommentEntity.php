<?php

namespace blog\entity;

use blog\entity\Entity;
use \DateTime;

class CommentEntity extends Entity {

	public function getUrl($id) {
		return 'index.php?p=chapters.single&id=' . $id;
	}

	public function getExtrait($length) {
		return substr($this->comment, 0, $length);
	}

	public function getDate($datefmt) {
		return '<i class="far fa-clock"></i> ' .$datefmt->format(new DateTime($this->comment_date));
	}
}