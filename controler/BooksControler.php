<?php 

namespace blog\controler;

use blog\controler\Controler;
use blog\html\BootstrapForm;
use blog\html\Image;
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
		$photo = Image::getImage($book->img_name);
		$dateFormat = $this->dateFormat;
;
		
		$this->render('books.home', compact('book', 'photo', 'chapters', 'dateFormat'));
	}

	public function index() {
		$books = $this->book->allBooks();
		$dateFormat = $this->dateFormat;

		$this->render('books.index', compact('books', 'dateFormat'));
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

		$photo = Image::getImage($book->img_name);
		$dateFormat = $this->dateFormat;

		$this->render('books.single', compact('chapters', 'book', 'photo', 'categories', 'dateFormat'));
	}
}
