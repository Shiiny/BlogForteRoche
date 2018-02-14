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
		$this->loadModel('category');
	}

	public function home() {
		$book = $this->book->lastBook();
		$chapters = $this->chapter->allChapters($book->id);
		$categories = $this->category->all();
		
		$this->render('books.home', compact('book', 'chapters', 'categories'));
	}

	public function index() {
		$books = $this->book->allBooks();

		$this->render('books.index', compact('books'));
	}

	public function category() {
		$categorie = $this->category->find($_GET['id']);
		if($categorie === false) {
			$this->notFound();
		}
		$books = $this->book->byCategory($_GET['id']);
		$listCategories = $this->category->all();
		$this->render('books.category', compact('categorie', 'books', 'listCategories'));
	}

	public function single() {
		$book = $this->book->find($_GET['id']);
		$chapters = $this->chapter->allChapters($book->id);
		$categories = $this->category->all();
		if ($book === false) {
			$this->notFound();
		}
		//var_dump($book);
		$rep = "../public/images/";
		$dir = opendir($rep);
		while($file = readdir($dir)) {
			if($book->img_name){}
			//var_dump($file);
		}

		$this->render('books.single', compact('chapters', 'book', 'categories'));
	}
}
