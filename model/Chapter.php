<?php

namespace blog\model;

use blog\model\Manager;

class Chapter extends Manager {
	protected $table;

	/**	
	*	Récupère les derniers articles.
	*	@return array
	*/
	public function getList() {
		return $this->requete("SELECT chapter_id, chapter_title, chapter_content, chapter_release, categories.title as category FROM {$this->table} LEFT JOIN categories ON category_id = categories.id ORDER BY chapter_release DESC");
	}

	/**
	 * Récupère tous les articles
	 * @return array
	 */
	public function all() {
		return $this->requete("SELECT * FROM {$this->table} ORDER BY chapter_release DESC");
	}

	/**	
	*	Récupère un article en liant la catégorie associée.
	*	@param  int $id
	*	@return entity\PostEntity
	*/
	public function findWithCategory($id) {
		return $this->requete("SELECT chapter_id, chapter_title, chapter_content, categories.title as category FROM {$this->table} LEFT JOIN categories ON category_id = categories.id WHERE chapter_id = ?", [$id], true);
	}

	/**	
	*	Récupère les derniers articles de la catégorie demandée.
	*	@param int $category_id
	*	@return array
	*/
	public function byCategory($category_id) {
		return $this->requete("SELECT chapter_id, chapter_title, chapter_content, categories.title as category FROM {$this->table} LEFT JOIN categories ON category_id = categories.id WHERE category_id = ? ORDER BY chapter_release DESC", [$category_id]);
	}

	/**	
	*	Récupère les chapitres du book demandée.
	*	@param int $book_id
	*	@return array
	*/
	public function allChapters($book_id) {
		return $this->requete("SELECT chapter_id, chapter_title, chapter_content, chapter_release FROM {$this->table} LEFT JOIN books ON book_id = books.id WHERE books.id = ? ORDER BY chapter_release DESC", [$book_id]);
	}
}