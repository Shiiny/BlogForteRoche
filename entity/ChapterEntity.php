<?php

namespace blog\entity;

use blog\entity\Entity;

class ChapterEntity extends Entity {
	
	public function getUrl() {
		return 'index.php?p=chapters.single&id=' . $this->id;
	}

	public function getExtrait() {
		$html = '<p>' . substr($this->content, 0, 300) . '...</p>';
		$html .= '<p><a href="'. $this->getUrl()  .'">Lire la suite</a></p>';
		return $html;
	}
}