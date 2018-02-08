<?php

namespace blog\controler\admin;

use blog\controler\admin\AdminControler;
use blog\html\BootstrapForm;

class AdminBooksControler extends AdminControler {

	public function __construct() {
		parent::__construct();

		$this->loadModel('book');
		$this->loadModel('chapter');
		$this->loadModel('category');
		$this->loadModel('comment');
	}

	public function index() {
		$books = $this->book->all();

		$this->render('admin.books.index', compact('books'));
	}

	public function add() {
		if(!empty($_POST)) {
			var_dump($_POST);
			$result = $this->book->create([
				'title' => $_POST['title'],
				'content' => $_POST['content'],
				'category_id' => $_POST['category_id']
			], 'release_date');
			if($result) {
				return $this->index();
			}
		}
		$categories = $this->category->extract('id', 'title');
		$form = new BootstrapForm($_POST);
		$this->render('admin.books.add', compact('categories', 'form'));		
	}

	public function edit() {
		if(!empty($_POST)) {
			$result = $this->book->update($_GET['id'], [
				'title' => $_POST['title'],
				'content' => $_POST['content'],
				'category_id' => $_POST['category_id']
			], 'release_date');
			if($result) {
				return $this->index();
			}
		}
		$book = $this->book->find($_GET['id']);

		$categories = $this->category->extract('id', 'title');
		$form = new BootstrapForm($book);
		$this->render('admin.books.add', compact('book', 'categories', 'form'));
	}

	public function delete() {
		if(!empty($_POST)) {
			$book = $this->book->find($_POST['id']);
			$chapters = $this->chapter->allChapters($book->id);

			foreach ($chapters as $chapter) {
				$sup = $this->comment->deleteComment($chapter->id);
			}
			$sup = $this->chapter->deleteChapter($_POST['id']);
			$sup = $this->book->delete($_POST['id']);
		}
		header('Location: ?p=admin.books.index');
	}
}