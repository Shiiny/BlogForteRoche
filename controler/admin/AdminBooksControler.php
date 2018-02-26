<?php

namespace blog\controler\admin;

use blog\controler\admin\AdminControler;
use blog\html\BootstrapForm;
use blog\html\Image;

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

	public function add($app) {
		$error;

		if(!empty($_POST)) {
			if (!empty($_POST['title']) && !empty($_POST['content'])) {
				if(isset($_FILES)) {
					$import = Image::addImage($_FILES['img_name']);
					var_dump($import);
					if($import == false) {
						$error = "Votre fichier n'est pas une image";
					}
				}
				
				$result = $this->book->create([
					'title' => $_POST['title'],
					'content' => $_POST['content'],
					'category_id' => $_POST['category_id'],
					'img_name' => $import
				], 'release_date');

				
				
				if($result) {
					return $this->index();
				}
			}
			else {
				$error = "Vous n'avez pas rempli tous les champs";
			}
		}

		
		$categories = $this->category->extract('id', 'title');
		$form = new BootstrapForm();
		$this->render('admin.books.add', compact('categories', 'form', 'error', 'files'));		
	}

	public function edit() {
		$book = $this->book->find($_GET['id']);

		if(!empty($_POST)) {
			if (!empty($_POST['title'])) {
				if($_FILES['img_name']['error'] === 0) {
					$import = Image::addImage($_FILES['img_name']);
					if($import == false) {
						$error = "Votre fichier n'est pas une image";
					}
					$result = $this->book->update($_GET['id'], [
					'title' => $_POST['title'],
					'content' => $_POST['content'],
					'category_id' => $_POST['category_id'],
					'img_name' => $import
					], 'release_date');
				}
				else {
					$result = $this->book->update($_GET['id'], [
					'title' => $_POST['title'],
					'content' => $_POST['content'],
					'category_id' => $_POST['category_id'],
					], 'release_date');
				}
				if($result) {
					return $this->index();
				}						
			}
			else {
				$error = "La modification doit comporter au moins un titre";
			}
		}

		$categories = $this->category->extract('id', 'title');
		$form = new BootstrapForm($book);
		$this->render('admin.books.add', compact('book', 'categories', 'error', 'form'));
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