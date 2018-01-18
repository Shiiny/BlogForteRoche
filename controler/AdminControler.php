<?php

namespace blog\controler;

use blog\controler\Controler;
use \App;
use blog\Auth\DBAuth;
use blog\BootstrapForm;

class AdminControler extends Controler {

	public function __construct() {
		parent::__construct();

		// Auth
		$app = App::getInstance();
		$auth = new DBAuth($app->getDb());
		if(!$auth->logged()) {
			$this->forbidden();
		}
		$this->loadModel('post');
		$this->loadModel('category');
	}

	public function index() {
		$posts = $this->post->all();
		$categories = $this->category->all();
		$this->render('admin.index', compact('posts', 'categories'));
	}

	public function add() {
		if(!empty($_POST)) {
			$result = $this->post->create([
				'title' => $_POST['title'],
				'content' => $_POST['content'],
				'category_id' => $_POST['category_id']
			]);
			if($result) {
				header('Location: index.php?p=admin.posts.edit&id=' . App::getInstance()->getDb()->lastInsertId());
			}
		}
		// Récupération des catégories
		$categories = $this->category->extract('id', 'title');
		$form = new BootstrapForm($_POST);
		$this->render('admin.posts.add', compact('categories', 'form'));
	}

	public function delete() {

	}

	public function edit() {
		if(!empty($_POST)) {
			$result = $this->post->update($_GET['id'], [
				'title' => $_POST['title'],
				'content' => $_POST['content'],
				'category_id' => $_POST['category_id']
			]);
			if($result) {
				return $this->index();
			}
		}
		$post = $this->post->find($_GET['id']);

		// Récupération des catégories
		$categories = $this->category->extract('id', 'title');

		$form = new BootstrapForm($post);
		$this->render('admin.posts.add', compact('post', 'categories', 'form'));
	}
}