<?php 

namespace blog\controler;

use blog\controler\Controler;
use blog\html\BootstrapForm;
use \App;

class BooksControler extends Controler {

	public function __construct() {
		parent::__construct();
		$this->loadModel('book');
		$this->loadModel('chapter');
	}

	public function index() {
		$book = $this->book->lastBook();
		$chapters = $this->chapter->allChapters($book->id);
		var_dump($chapters);
		
		$this->render('books.index', compact('book', 'chapters'));
	}
/*
	public function category() {
		$categorie = $this->category->find($_GET['id']);
		if($categorie === false) {
			$this->notFound();
		}
		$posts = $this->post->byCategory($_GET['id']);
		$listCategories = $this->category->all();
		$this->render('posts.category', compact('categorie', 'posts', 'listCategories'));
	}

	public function single($app) {
		$post = $this->post->findWithCategory($_GET['id']);
		$comments = $this->comment->byComment($_GET['id']);
		if ($post === false) {
			$this->notFound();
		}

		$app->title = $post->title;
		$form = new BootstrapForm($_POST);
		$this->render('posts.single', compact('post', 'app', 'comments', 'form'));
	}*/
}
