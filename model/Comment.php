<?php

namespace blog\model;

use blog\model\Manager;

class Comment extends Manager{
	protected $table;

	/**	
	*	Récupère les derniers commentaires du post demandée.
	*	@param [int] $post_id
	*	@return array
	*/
	public function byComment($post_id) {
		return $this->requete("SELECT comments.id, comments.author, comments.comment, comments.comment_date FROM {$this->table} LEFT JOIN posts ON posts.id = post_id WHERE posts.id = ? ", [$post_id]);
	}

	/**	
	*	Récupère les derniers commentaires et le titre du post qui leur est associé.
	*	@return array
	*/
	public function allByPost() {
		return $this->requete("SELECT comments.id, comments.author, comments.comment, comments.comment_date, posts.title FROM {$this->table} LEFT JOIN posts ON posts.id = post_id ORDER BY posts.title");
	}

	/**	
	*	Supprime le commentaire identifié
	*	@param [int] $post_id
	*	@return array
	*/
	public function deleteComment($post_id) {
		return $this->requete("DELETE FROM {$this->table} WHERE post_id = ?", [$post_id], true);
	}
}