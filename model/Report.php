<?php

namespace blog\model;

use blog\model\Manager;

class Report extends Manager{
	protected $table;

	/**	
	*	Récupère le report du commentaire et de l'utilisateur demandé.
	*	@param [int] $comment_id, $username
	*	@return boolean
	*/
	public function verify($comment_id, $username) {
		return $this->requete("SELECT id, author_report, DATE_FORMAT(report_release, '%d/%m/%Y %H:%i:%s') AS report_release, comment_id FROM {$this->table} WHERE comment_id = ? AND author_report = ? ", [$comment_id, $username], true);
	}

	/**	
	*	Récupère les report du commentaire demandé.
	*	@param [int] $comment_id
	*	@return boolean
	*/
	public function findComment($comment_id) {
		return $this->requete("SELECT id, author_report, DATE_FORMAT(report_release, '%d/%m/%Y %H:%i:%s') AS report_release, comment_id FROM {$this->table} WHERE comment_id = ?", [$comment_id]);
	}

	/**	
	*	Récupère les report du commentaire demandé.
	*	@param [int] $comment_id
	*	@return boolean
	*/
	public function deleteReport($comment_id) {
		return $this->requete("DELETE FROM {$this->table} WHERE comment_id = ?", [$comment_id]);
	}

}