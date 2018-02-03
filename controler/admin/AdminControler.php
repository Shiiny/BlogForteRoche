<?php

namespace blog\controler\admin;

use blog\controler\Controler;
use \App;
use blog\Auth\DBAuth;
use blog\html\BootstrapForm;

class AdminControler extends Controler {

	public function __construct() {
		parent::__construct();

		//$this->loadModel('book');
		$this->loadModel('user');
		//$this->loadModel('chapter');
		//$this->loadModel('category');
		//$this->loadModel('comment');
		// Auth
		App::getInstance()->getAuth()->allow('admin');
	}

	public function index() {
		$users = $this->user->userRecent();

		$this->render('admin.index', compact('users'));
	}

	public function chapters() {
		$chapters = $this->chapter->all();

		$this->render('admin.chapters.index', compact('chapters'));
	}

	public function categories() {
		$categories = $this->category->all();

		$this->render('admin.categories.index', compact('categories'));
	}

	public function comments() {
		$comments = $this->comment->allBychapter();

		$this->render('admin.comments.index', compact('comments'));
	}

	public function users() {
		$users = $this->user->allUsers();

		$this->render('admin.users.index', compact('users'));
	}

	/*public function add() {
		if(!empty($_chapter)) {
			$result = $this->chapter->create([
				'title' => $_chapter['title'],
				'content' => $_chapter['content'],
				'category_id' => $_chapter['category_id']
			]);
			if($result) {
				return $this->index();
			}
		}
		$categories = $this->category->extract('id', 'title');
		$form = new BootstrapForm($_chapter);
		$this->render('admin.chapters.add', compact('categories', 'form'));		
	}*/

	public function addCategory() {
		if(!empty($_chapter)) {
				$result = $this->category->create([
					'title' => $_chapter['title']
				]);
				if($result) {
					return $this->index();
				}
			}
			$form = new BootstrapForm($_chapter);
			$this->render('admin.categories.add', compact('form'));
	}

	public function addComment() {
		$user = $this->user->byUserId($_SESSION['auth']->id);
		if(!empty($_chapter)) {
			$result = $this->comment->create([
				'author' => $user->username,
				'comment' => $_chapter['comment'],
				'chapter_id' => $_chapter['chapter_id']
			]);
			if($result) {
				return $this->index();
			}
		}
		$chapters = $this->chapter->extract('id', 'title');
		$form = new BootstrapForm($_chapter);
		$this->render('admin.comments.add', compact('chapters', 'form'));
	}

	public function delete() {
		if($_GET['p'] === 'admin.users.delete') {
			if(!empty($_chapter)) {
				var_dump($_chapter);
				die();
				$user = $this->user->delete($_chapter['id']);
				$comment = $this->comment;
			}
		}
		if($_GET['p'] === 'admin.comments.delete') {
			if(!empty($_chapter)) {
				$result = $this->comment->delete($_chapter['id']);
			}
		}
		if($_GET['p'] === 'admin.categories.delete') {
			if(!empty($_chapter)) {
				$result = $this->category->delete($_chapter['id']);
			}
		}
		else {
			if(!empty($_chapter)) {
				$result = $this->chapter->delete($_chapter['id']);
				$resComment = $this->comment->deleteComment($_chapter['id']);
			}
		}
		header('Location: index.php?p=admin.chapters.index');		
	}

	public function edit() {
		if($_GET['p'] === 'admin.categories.edit') {
			if(!empty($_chapter)) {
				$result = $this->category->update($_GET['id'], [
					'title' => $_chapter['title']
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
			if(!empty($_chapter)) {
				$result = $this->chapter->update($_GET['id'], [
					'title' => $_chapter['title'],
					'content' => $_chapter['content'],
					'category_id' => $_chapter['category_id']
				]);
				if($result) {
					return $this->index();
				}
			}
			$chapter = $this->chapter->find($_GET['id']);

			$categories = $this->category->extract('id', 'title');
			$form = new BootstrapForm($chapter);
			$this->render('admin.chapters.add', compact('chapter', 'categories', 'form'));
		}
	}

	public function editComment() {
		if(!empty($_chapter)) {
			$result = $this->comment->update($_GET['id'], [
				'comment' => $_chapter['comment']
			]);
			if($result) {
				return $this->index();
			}
		}
		$comment = $this->comment->find($_GET['id']);
		$chapters = $this->chapter->extract('id', 'title');			
		$form = new BootstrapForm($comment);
		$this->render('admin.comments.add', compact('comment', 'chapters', 'form'));
	}
}