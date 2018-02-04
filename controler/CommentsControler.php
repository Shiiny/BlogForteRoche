<?php 

namespace blog\controler;

use \App;
use blog\controler\Controler;
use blog\html\BootstrapForm;

class CommentsControler extends Controler {
	private $token_report;

	public function __construct() {
		parent::__construct();
		$this->loadModel('comment');
		$this->loadModel('report');
	}

	public function addComment($app) {
		if(!empty($_POST['comment'])) {
			$result = $this->comment->create([
				'author' => $_SESSION['auth']->username,
				'comment' => $_POST['comment'],
				'chapter_id' => $_GET['id']
			]);
			if($result) {
				header('Location: ?p=chapters.single&id='. $_GET['id']);
			}
		}
		$app->getSession()->setFlash('warning', "Vous n'avez pas saisie de commentaire");
		header('Location: ?p=chapters.single&id='. $_GET['id']);
	}

	public function editComment() {
		$comment = $this->comment->find($_GET['id']);
		if(!empty($_POST)) {
			$result = $this->comment->update($_GET['id'], [
				'comment' => $_POST['comment']
			]);
			if($result) {
				header('Location: ?p=chapters.single&id='. $comment->chapter_id);
			}	
		}
		$form = new BootstrapForm($comment);
		$this->render('comments.comment', compact('comment', 'form'));
	}

	public function reportComment($app) {
		$this->token_report++;

		$report = $this->report->create([
			'author_report' => $_SESSION['auth']->username,
			'comment_id' => $_GET['id']
		]);

		$result = $this->comment->update($_GET['id'], ['report' => $this->token_report]);
		if($result) {
			$app->getSession()->setFlash('warning', "Vous venez de reporter ce message");
			header('Location: ?p=chapters.single&id='. $_GET['chapter']);
		}
	}
}