<?php

namespace blog\entity;

use blog\entity\Entity;

class BookEntity extends Entity {
	public function getUrl() {
		return 'index.php?p=books.single&id=' . $this->id;
	}

	public function getExtrait($length) {
		$html = '<p>' . substr($this->content, 0, $length) . '...</p>';
		$html .= '<p><a href="'. $this->getUrl()  .'">Lire la suite</a></p>';
		return $html;
	}
}