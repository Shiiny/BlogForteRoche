<?php

namespace blog\controler;

use blog\controler\Controler;
use \App;
use blog\Auth\DBAuth;
use blog\html\BootstrapForm;

class AdminControler extends Controler {

	public function __construct() {
		parent::__construct();

		$this->loadModel('user');
		$this->loadModel('post');
		$this->loadModel('category');
		$this->loadModel('comment');
		$this->loadModel('report');
		// Auth
		App::getInstance()->getAuth()->allow('admin');
	}

	public function index($app) {
		$users = $this->user->userRecent();

		$this->render('admin.index', compact('users'));
	}

	public function posts() {
		$posts = $this->post->all();

		$this->render('admin.posts.index', compact('posts'));
	}

	public function categories() {
		$categories = $this->category->all();

		$this->render('admin.categories.index', compact('categories'));
	}

	public function comments() {
		$comments = $this->comment->allByPost();

		$this->render('admin.comments.index', compact('comments'));
	}

	public function users() {
		$users = $this->user->allUsers();

		$this->render('admin.users.index', compact('users'));
	}

	public function add() {
		if(!empty($_POST)) {
			$result = $this->post->create([
				'title' => $_POST['title'],
				'content' => $_POST['content'],
				'category_id' => $_POST['category_id']
			]);
			if($result) {
				return $this->index();
			}
		}
		$categories = $this->category->extract('id', 'title');
		$form = new BootstrapForm($_POST);
		$this->render('admin.posts.add', compact('categories', 'form'));		
	}

	public function addCategory() {
		if(!empty($_POST)) {
				$result = $this->category->create([
					'title' => $_POST['title']
				]);
				if($result) {
					return $this->index();
				}
			}
			$form = new BootstrapForm($_POST);
			$this->render('admin.categories.add', compact('form'));
	}

	public function addComment() {
		$user = $this->user->getUser($_SESSION['auth']);
		var_dump($user);
		if(!empty($_POST)) {
			$result = $this->comment->create([
				'author' => $user->username,
				'comment' => $_POST['comment'],
				'post_id' => $_POST['post_id']
			]);
			if($result) {
				return $this->index();
			}
		}
		$posts = $this->post->extract('id', 'title');
		$form = new BootstrapForm($_POST);
		$this->render('admin.comments.add', compact('posts', 'form'));
	}

	public function delete() {
		if($_GET['p'] === 'admin.users.delete') {
			if(!empty($_POST)) {
				var_dump($_POST);
				die();
				$user = $this->user->delete($_POST['id']);
				$comment = $this->comment;
			}
		}
		if($_GET['p'] === 'admin.comments.delete') {
			if(!empty($_POST)) {
				$result = $this->comment->delete($_POST['id']);
			}
		}
		if($_GET['p'] === 'admin.categories.delete') {
			if(!empty($_POST)) {
				$result = $this->category->delete($_POST['id']);
			}
		}
		else {
			if(!empty($_POST)) {
				$result = $this->post->delete($_POST['id']);
				$resComment = $this->comment->deleteComment($_POST['id']);
			}
		}
		header('Location: index.php?p=admin.posts.index');		
	}

	public function edit() {
		if($_GET['p'] === 'admin.categories.edit') {
			if(!empty($_POST)) {
				$result = $this->category->update($_GET['id'], [
					'title' => $_POST['title']
				]);
				if($result) {
					return $this->index();
				}
			}
			$category = $this->category->find($_GET['id']);

			$form = new BootstrapForm($category);
			$this->render('admin.categories.add', compact('category', 'form'));
		}
		else {
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

			$categories = $this->category->extract('id', 'title');
			$form = new BootstrapForm($post);
			$this->render('admin.posts.add', compact('post', 'categories', 'form'));
		}
	}

	public function editComment() {
		if(!empty($_POST)) {
			$result = $this->comment->update($_GET['id'], [
				'comment' => $_POST['comment']
			]);
			if($result) {
				return $this->index();
			}
		}
		$comment = $this->comment->find($_GET['id']);
		$posts = $this->post->extract('id', 'title');			
		$form = new BootstrapForm($comment);
		$this->render('admin.comments.add', compact('comment', 'posts', 'form'));
	}
}