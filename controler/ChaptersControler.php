<?php 

namespace blog\controler;

use blog\controler\Controler;
use blog\html\BootstrapForm;
use \App;

class ChaptersControler extends Controler {


	public function __construct() {
		parent::__construct();
		$this->loadModel('book');
		$this->loadModel('chapter');
		$this->loadModel('comment');
		$this->loadModel('report');
	}

	public function single($app) {
		if(!isset($_GET['id'])) {
			$this->notFound();
		}
		$chapter = $this->chapter->find($_GET['id']);	
		if ($chapter === false) {
			$this->notFound();
		}
		$book = $this->book->find($chapter->book_id);
		$listbooks = $this->book->allBooks();
		$listChapters = $this->chapter->allChapters($chapter->book_id);

		$nbPage = $this->pager('chapter_id', $chapter->id);
				
		if(isset($_GET['commentPage']) && $_GET['commentPage'] > 0 && $_GET['commentPage'] <= $nbPage) {
			$currentPage = $_GET['commentPage'];
		}
		else {
			$currentPage = 1;
		}

		$comments = $this->comment->byComment($chapter->id, $currentPage, $this->perPage);
		
		$app->title = $chapter->chapter_title;
		
		$form = new BootstrapForm($_POST);
		$this->render('chapters.single', compact('chapter', 'app', 'listChapters', 'comments', 'book', 'listbooks', 'form', 'nbPage'));
	}
}
