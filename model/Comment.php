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
	public function byComment($chapter_id, $currentPage, $perPage) {
		return $this->requete("SELECT comments.id, comments.author, comments.comment, comments.chapter_id, comments.report, DATE_FORMAT(comment_date, '%d/%m/%Y %H:%i:%s') AS comment_date FROM {$this->table} LEFT JOIN chapters ON chapters.id = chapter_id WHERE chapters.id = ? ORDER BY comment_date DESC LIMIT ".(($currentPage-1)*$perPage)." , $perPage", [$chapter_id]);
	}

	/**	
	*	Récupère le commentaires identifié par le report associé.
	*	@param [int] $comment_id
	*	@return boolean
	*/
	public function byReport($report_id) {
		return $this->requete("SELECT comments.id, comments.author, comments.comment, comments.chapter_id, comments.report, DATE_FORMAT(comment_date, '%d/%m/%Y %H:%i:%s') AS comment_date, reports.comment_id FROM {$this->table} LEFT JOIN reports ON reports.comment_id = comments.id WHERE reports.id = ? ", [$report_id], true);
	}

	/**	
	*	Récupère les derniers commentaires et le titre du chapter qui leur est associé.
	*	@return array
	*/
	public function allBychapter() {
		return $this->requete("SELECT comments.id, comments.author, comments.comment, DATE_FORMAT(comment_date, '%d/%m/%Y %H:%i:%s') AS comment_date, chapters.title FROM {$this->table} LEFT JOIN chapters ON chapters.id = chapter_id ORDER BY chapters.title");
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
	public function pagerAll($currentPage, $perPage) {
		return $this->requete("SELECT comments.id, comments.author, comments.comment, DATE_FORMAT(comment_date, '%d/%m/%Y %H:%i:%s') AS comment_date, comments.report, chapters.chapter_title FROM {$this->table} LEFT JOIN chapters ON chapters.id = chapter_id ORDER BY chapters.chapter_title DESC LIMIT ".(($currentPage-1)*$perPage)." , $perPage");
	}

	/**
	 * Récupère les 3 derniers commentaires en liant le titre du chapitre
	 * @return array
	 **/
	public function threeLast() {
		return $this->requete("SELECT comments.id, comments.author, comments.comment, DATE_FORMAT(comment_date, '%d/%m/%Y %H:%i:%s') AS release_comment, comments.report, chapters.chapter_title FROM {$this->table} LEFT JOIN chapters ON chapters.id = chapter_id ORDER BY comment_date DESC LIMIT 0,3");
	}

	/**
	 * Récupère tous les commentaires de l'utilisateur demandé en liant le titre du chapitre selectionné ainsi que celui du book
	 * @param [string] $username
	 * @return array
	 **/
	public function allCommentByUser($username) {
		return $this->requete("SELECT comments.id, comments.chapter_id, comments.author, comments.comment, comment_date, comments.report, chapters.id AS ChapitreId, chapters.chapter_title, chapters.book_id, books.title FROM {$this->table} LEFT JOIN chapters ON chapters.id = chapter_id LEFT JOIN books ON books.id = chapters.book_id WHERE comments.author = ? ORDER BY comment_date DESC", [$username]);
	}
}