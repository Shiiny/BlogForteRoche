<?php

namespace blog\model;

use blog\model\Manager;

class Chapter extends Manager {
	protected $table;

	/**
	 * Récupère tous les chapitres en liant le titre du livre
	 * @return array
	 **/
	public function all() {
		return $this->requete("SELECT chapters.id, chapter_title, chapter_content, DATE_FORMAT(chapter_release, '%d/%m/%Y %H:%i:%s') AS chapter_release, books.title FROM {$this->table} LEFT JOIN books ON chapters.book_id = books.id ORDER BY books.title DESC");
	}

	/**
	 * Récupère tous les chapitres en liant le titre du livre avec pagination
	 * @return array
	 **/
	public function pagerAll($currentPage, $perPage) {
		return $this->requete("SELECT chapters.id, chapter_title, chapter_content, DATE_FORMAT(chapter_release, '%d/%m/%Y %H:%i:%s') AS chapter_release, books.title FROM {$this->table} LEFT JOIN books ON chapters.book_id = books.id ORDER BY books.title DESC LIMIT ".(($currentPage-1)*$perPage)." , $perPage");
	}

	/**	
	*	Récupère les chapitres du book demandée.
	*	@param int $book_id
	*	@return array
	*/
	public function allChapters($book_id) {
		return $this->requete("SELECT chapters.id, chapter_title, chapter_content, DATE_FORMAT(chapter_release, '%d/%m/%Y %H:%i:%s') AS chapter_release FROM {$this->table} LEFT JOIN books ON book_id = books.id WHERE books.id = ? ORDER BY chapter_release", [$book_id]);
	}

	/**	
	*	Supprime les chapitre identifiés par l'id du book
	*	@param [int] $chapter_id
	*	@return array
	*/
	public function deleteChapter($book_id) {
		return $this->requete("DELETE FROM {$this->table} WHERE book_id = ?", [$book_id]);
	}

	/**	
	*	Récupère le chapitre identifé par son id
	*	@param [int] $id
	*	@return boolean
	*/
	public function find($id) {
		return $this->requete("SELECT chapters.id, chapter_title, chapter_content, DATE_FORMAT(chapter_release, '%d/%m/%Y %H:%i:%s') AS chapter_release, book_id FROM {$this->table} WHERE id = ?", [$id], true);
	}
}