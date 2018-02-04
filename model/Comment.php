<?php

namespace blog\model;

use blog\model\Manager;

class Comment extends Manager{
	protected $table;

	/**	
	*	Récupère les derniers commentaires du chapter demandée.
	*	@param [int] $chapter_id
	*	@return array
	*/
	public function byComment($chapter_id) {
		return $this->requete("SELECT comments.id, comments.author, comments.comment, comments.comment_date FROM {$this->table} LEFT JOIN chapters ON chapters.id = chapter_id WHERE chapters.id = ? ", [$chapter_id]);
	}

	/**	
	*	Récupère les derniers commentaires et le titre du chapter qui leur est associé.
	*	@return array
	*/
	public function allBychapter() {
		return $this->requete("SELECT comments.id, comments.author, comments.comment, comments.comment_date, chapters.title FROM {$this->table} LEFT JOIN chapters ON chapters.id = chapter_id ORDER BY chapters.title");
	}

	/**	
	*	Supprime les commentaires identifiés par l'id du chapter
	*	@param [int] $chapter_id
	*	@return array
	*/
	public function deleteComment($chapter_id) {
		return $this->requete("DELETE FROM {$this->table} WHERE chapter_id = ?", [$chapter_id]);
	}

	/**
	 * Récupère tous les commentaires en liant le titre du chapitre
	 * @return array
	 **/
	public function all() {
		return $this->requete("SELECT comments.id, comments.author, comments.comment, comments.comment_date, chapters.chapter_title FROM {$this->table} LEFT JOIN chapters ON chapters.id = chapter_id ORDER BY chapters.chapter_title DESC");
	}
}