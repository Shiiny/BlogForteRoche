<?php

namespace blog\model;

use blog\model\Manager;

class Book extends Manager {
	protected $table;

	/**	
	*	Récupère le dernier book en date.
	*	@return array
	*/
	public function lastBook() {
		return $this->requete("SELECT * FROM {$this->table} ORDER BY release_date DESC", null, true);
	}

	
}