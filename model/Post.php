<?php

namespace blog\model;

use blog\model\Manager;

class Post extends Manager {
	protected $table;

	/**	
	*	Récupère les derniers articles.
	*	@return array
	*/
	public function getList() {
		return $this->requete("SELECT posts.id, posts.title, posts.content, posts.dateAdd, categories.title as category FROM posts LEFT JOIN categories ON category_id = categories.id ORDER BY posts.dateAdd DESC");
	}

	/**	
	*	Récupère un article en liant la catégorie associée.
	*	@param  int $id
	*	@return entity\PostEntity
	*/
	public function find($id) {
		return $this->requete("SELECT posts.id, posts.title, posts.content, categories.title as category FROM posts LEFT JOIN categories ON category_id = categories.id WHERE posts.id = ?", [$id], true);
	}

	/**	
	*	Récupère les derniers articles de la catégorie demandée.
	*	@param int $category_id
	*	@return array
	*/
	public function byCategory($category_id) {
		return $this->requete("SELECT posts.id, posts.title, posts.content, categories.title as category FROM posts LEFT JOIN categories ON category_id = categories.id WHERE category_id = ? ORDER BY posts.dateAdd DESC", [$category_id]);
	}
}