<?php 

namespace blog\controler;

use \App;
use blog\controler\Controler;
use blog\html\BootstrapForm;

class CommentsControler extends Controler {

	public function __construct() {
		parent::__construct();
		$this->loadModel('comment');
		$this->loadModel('report');
	}

	public function addComment() {
		if(!empty($_POST)) {
			$result = $this->comment->create([
				'author' => $_SESSION['auth']->username,
				'comment' => $_POST['comment'],
				'post_id' => $_GET['id']
			]);
			if($result) {
				header('Location: index.php?p=posts.single&id='. $_GET['id']);
			}
		}
	}

	public function editComment() {
		$comment = $this->comment->find($_GET['id']);
		if(!empty($_POST)) {
			$result = $this->comment->update($_GET['id'], [
				'comment' => $_POST['comment']
			]);
			if($result) {
				header('Location: index.php?p=posts.single&id='. $comment->post_id);
			}	
		}
		$form = new BootstrapForm($comment);
		$this->render('comments.comment', compact('comment', 'form'));
	}

	public function reportComment($app) {
		$comment = $this->comment->find($_GET['id']);
		var_dump($comment);
		if(!empty($_POST)) {
			$result = $this->report->create([
				'author_report' => $_SESSION['auth']->username,
				'content_report' => $_POST['report'],
				'comment_id' => $comment->id
			]);
			if($result) {
				$app->getSession()->setFlash('warning', "Vous venez de reporter ce message");
				header('Location: index.php?p=posts.single&id='. $comment->post_id);
			}
		}


		$form = new BootstrapForm();
		$this->render('comments.report', compact('form'));
	}
}