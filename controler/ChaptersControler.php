<?php 

namespace blog\controler;

use blog\controler\Controler;
use blog\html\BootstrapForm;
use \App;

class ChaptersControler extends Controler {

	public function __construct() {
		parent::__construct();
		$this->loadModel('chapter');
		$this->loadModel('category');
		$this->loadModel('comment');
	}

	public function index() {
		$chapters = $this->chapter->getList();
		$categories = $this->category->all();
		$this->render('chapters.index', compact('chapters', 'categories'));
	}

	public function category() {
		$categorie = $this->category->find($_GET['id']);
		if($categorie === false) {
			$this->notFound();
		}
		$chapters = $this->chapter->byCategory($_GET['id']);
		$listCategories = $this->category->all();
		$this->render('chapters.category', compact('categorie', 'chapters', 'listCategories'));
	}

	public function single($app) {
		$chapter = $this->chapter->findWithCategory($_GET['id']);
		$comments = $this->comment->byComment($_GET['id']);
		if ($chapter === false) {
			$this->notFound();
		}

		$app->title = $chapter->title;
		$form = new BootstrapForm($_chapter);
		$this->render('chapters.single', compact('chapter', 'app', 'comments', 'form'));
	}
}
