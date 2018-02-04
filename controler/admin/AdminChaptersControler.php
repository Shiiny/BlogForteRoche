<?php

namespace blog\controler\admin;

use blog\controler\admin\AdminControler;
use blog\html\BootstrapForm;

class AdminChaptersControler extends AdminControler {

	public function __construct() {
		parent::__construct();

		$this->loadModel('book');
		$this->loadModel('chapter');
		$this->loadModel('comment');
	}

	public function index() {
		$chapters = $this->chapter->all();

		$this->render('admin.chapters.index', compact('chapters'));
	}

	public function add() {
		if(!empty($_POST)) {
			$result = $this->chapter->create([
				'chapter_author' => $_SESSION['auth']->username,
				'chapter_title' => $_POST['chapter_title'],
				'chapter_content' => $_POST['chapter_content'],
				'book_id' => $_POST['book_id']
			]);
			if($result) {
				return $this->index();
			}
		}
		$books = $this->book->extract('id', 'title');
		$form = new BootstrapForm($_POST);
		$this->render('admin.chapters.add', compact('books', 'form'));		
	}

	public function edit() {
		if(!empty($_POST)) {
			$result = $this->chapter->update($_GET['id'], [
				'chapter_title' => $_POST['chapter_title'],
				'chapter_content' => $_POST['chapter_content'],
				'book_id' => $_POST['book_id']
			]);
			if($result) {
				return $this->index();
			}
		}
		$chapter = $this->chapter->find($_GET['id']);

		$books = $this->book->extract('id', 'title');
		$form = new BootstrapForm($chapter);
		$this->render('admin.chapters.add', compact('books', 'chapter', 'form'));
	}

	public function delete() {
		if(!empty($_POST)) {
			$chapter = $this->chapter->find($_POST['id']);

			$sup = $this->comment->deleteComment($chapter->id);
			$sup = $this->chapter->delete($_POST['id']);
		}
		header('Location: ?p=admin.chapters.index');
	}
}