<?php

namespace blog\model;

use blog\App;
use blog\model\Manager;

class Post extends Manager {
	private $id;
	private $content;
	private $title;
	private $category;
	private $dateAdd;

	protected static $table = 'Posts';

	/*public function __construct($data = []) {
		if(!empty($data)) {
			foreach ($data as $key => $value) {
				$methode = 'set' . ucfirst($key);
				if(is_callable([$this, $methode])) {
					$this->$methode($value);
				}
			}
		}
	}

	public function __get($key) {
		$method = 'get' . ucfirst($key);
		$this->$key = $this->$method();
		return $this->$key;
	}*/

	public static function find($id) {
		return self::requete('SELECT posts.id, posts.title, posts.content, categories.title as category FROM posts LEFT JOIN categories ON category_id = categories.id WHERE posts.id = ?', [$id], true);
	}

	public static function byCategory($id) {
		return self::requete('SELECT posts.id, posts.title, posts.content, categories.title as category FROM posts LEFT JOIN categories ON category_id = categories.id WHERE category_id = ? ORDER BY posts.dateAdd DESC', [$id]);
	}

	public static function getList() {
		return self::requete('SELECT posts.id, posts.title, posts.content, posts.dateAdd, categories.title as category FROM posts LEFT JOIN categories ON category_id = categories.id ORDER BY posts.dateAdd DESC');
	}

	public function getUrl() {
		return 'index.php?p=article&id=' . $this->getId();
	}

	public function getExtrait() {
		$html = '<p>' . substr($this->getContent(), 0, 300) . '...</p>';
		$html .= '<p><a href="'. $this->getUrl()  .'">Lire la suite</a></p>';
		return $html;
	}

	public function setId($id) {
		$this->id = (int) $id;
	}

	public function getId() {
		return $this->id;
	}

	public function getTitle() {
		return $this->title;
	}

	public function getContent() {
		return $this->content;
	}

	public function getCategory() {
		return $this->category;
	}

	public function getDateAdd() {
		return $this->dateAdd;
	}
}