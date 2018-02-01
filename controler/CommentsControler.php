<?php 

namespace blog\controler;

use \App;
use blog\controler\Controler;
use blog\html\BootstrapForm;

class CommentsControler extends Controler {

	public function __construct() {
		parent::__construct();
		$this->loadModel('comment');
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
		$this->render('posts.comment', compact('comment', 'form'));
	}
}