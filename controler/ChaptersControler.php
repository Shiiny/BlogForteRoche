<?php 

namespace blog\controler;

use blog\controler\Controler;
use blog\html\BootstrapForm;
use \App;

class ChaptersControler extends Controler {

	public function __construct() {
		parent::__construct();
		$this->loadModel('chapter');
		$this->loadModel('comment');
	}

	public function single($app) {
		if(!isset($_GET['id'])) {
			$this->notFound();
		}
		$chapter = $this->chapter->find($_GET['id']);	
		if ($chapter === false) {
			$this->notFound();
		}
		$listChapters = $this->chapter->allChapters($chapter->book_id);
		$comments = $this->comment->byComment($chapter->id);
		$app->title = $chapter->chapter_title;
		$form = new BootstrapForm($_POST);
		$this->render('chapters.single', compact('chapter', 'app', 'listChapters', 'comments', 'form'));
	}
}
