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
		return $this->requete("SELECT books.id, books.title, books.content, DATE_FORMAT(books.release_date, '%d/%m/%Y %H:%i:%s') AS release_date, categories.title as category FROM {$this->table} LEFT JOIN categories ON category_id = categories.id ORDER BY release_date DESC", null, true);
	}

	/**	
	*	Récupère tous les books avec leur catégorie associé.
	*	@return array
	*/
	public function allBooks() {
		return $this->requete("SELECT books.id, books.title, books.content, DATE_FORMAT(books.release_date, '%d/%m/%Y %H:%i:%s') AS release_date, categories.title as category FROM {$this->table} LEFT JOIN categories ON category_id = categories.id ORDER BY release_date DESC");
	}

	/**	
	*	Récupère les books de la catégorie demandée.
	*	@param int $category_id
	*	@return array
	*/
	public function byCategory($category_id) {
		return $this->requete("SELECT books.id, books.title, books.content, DATE_FORMAT(books.release_date, '%d/%m/%Y %H:%i:%s') AS release_date, categories.title as category FROM {$this->table} LEFT JOIN categories ON category_id = categories.id WHERE category_id = ? ORDER BY release_date DESC", [$category_id]);
	}

	/**	
	*	Récupère les books de la catégorie demandée.
	*	@param int $category_id
	*	@return array
	*/
	public function find($id) {
		return $this->requete("SELECT books.id, books.title, books.content, DATE_FORMAT(books.release_date, '%d/%m/%Y %H:%i:%s') AS release_date, books.category_id, categories.title as category, books.img_name FROM {$this->table} LEFT JOIN categories ON category_id = categories.id WHERE books.id = ? ORDER BY release_date DESC", [$id], true);
	}
}