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
		return $this->requete("SELECT chapters.id, chapter_title, chapter_content, chapter_release, categories.title as category FROM {$this->table} LEFT JOIN categories ON category_id = categories.id ORDER BY chapter_release DESC");
	}

	/**
	 * Récupère tous les chapitres en liant le titre du livre
	 * @return array
	 **/
	public function all() {
		return $this->requete("SELECT chapters.id, chapter_title, chapter_content, chapter_release, books.title FROM {$this->table} LEFT JOIN books ON chapters.book_id = books.id ORDER BY books.title DESC");
	}

	/**	
	*	Récupère un article en liant la catégorie associée.
	*	@param  int $id
	*	@return entity\PostEntity
	*
	public function findWithCategory($id) {
		return $this->requete("SELECT chapters.id, chapter_title, chapter_content, categories.title as category FROM {$this->table} LEFT JOIN categories ON category_id = categories.id WHERE chapters.id = ?", [$id], true);
	}*/

	/**	
	*	Récupère les derniers articles de la catégorie demandée.
	*	@param int $category_id
	*	@return array
	*
	public function byCategory($category_id) {
		return $this->requete("SELECT chapters.id, chapter_title, chapter_content, categories.title as category FROM {$this->table} LEFT JOIN categories ON category_id = categories.id WHERE category_id = ? ORDER BY chapter_release DESC", [$category_id]);
	}*/

	/**	
	*	Récupère les chapitres du book demandée.
	*	@param int $book_id
	*	@return array
	*/
	public function allChapters($book_id) {
		return $this->requete("SELECT chapters.id, chapter_title, chapter_content, chapter_release FROM {$this->table} LEFT JOIN books ON book_id = books.id WHERE books.id = ? ORDER BY chapter_release", [$book_id]);
	}

	/**	
	*	Supprime les chapitre identifiés par l'id du book
	*	@param [int] $chapter_id
	*	@return array
	*/
	public function deleteChapter($book_id) {
		return $this->requete("DELETE FROM {$this->table} WHERE book_id = ?", [$book_id]);
	}
}