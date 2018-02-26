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
		$nbPage = $this->pager('chapter', 'id', null, 10);

		if(isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nbPage) {
			$currentPage = $_GET['page'];
		}
		else {
			$currentPage = 1;
		}

		$chapters = $this->chapter->pagerAll($currentPage, $this->perPage);


		$this->render('admin.chapters.index', compact('chapters', 'nbPage'));
	}

	public function add() {
		if(!empty($_POST)) {
			if (!empty($_POST['chapter_title']) && !empty($_POST['chapter_content'])) {
				$result = $this->chapter->create([
					'chapter_author' => $_SESSION['auth']->username,
					'chapter_title' => $_POST['chapter_title'],
					'chapter_content' => $_POST['chapter_content'],
					'book_id' => $_POST['book_id']
				], 'chapter_release');
				if($result) {
					return $this->index();
				}
			}
			else {
				$error = "Vous n'avez pas rempli tous les champs";
			}
		}
		$books = $this->book->extract('id', 'title');
		$form = new BootstrapForm($_POST);
		$this->render('admin.chapters.add', compact('books', 'form', 'error'));		
	}

	public function edit() {
		if(!empty($_POST)) {
			if (!empty($_POST['chapter_title'])) {
				$result = $this->chapter->update($_GET['id'], [
					'chapter_title' => $_POST['chapter_title'],
					'chapter_content' => $_POST['chapter_content'],
					'book_id' => $_POST['book_id']
				], 'chapter_release');
				if($result) {
					return $this->index();
				}
			}
			else {
				$error = "La modification doit comporter au moins un titre";
			}
		}
		$chapter = $this->chapter->find($_GET['id']);

		$books = $this->book->extract('id', 'title');
		$form = new BootstrapForm($chapter);
		$this->render('admin.chapters.add', compact('books', 'chapter', 'form', 'error'));
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