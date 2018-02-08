<?php

namespace blog\controler\admin;

use blog\controler\admin\AdminControler;
use blog\html\BootstrapForm;

class AdminCommentsControler extends AdminControler {

	public function __construct() {
		parent::__construct();

		$this->loadModel('book');
		$this->loadModel('chapter');
		$this->loadModel('comment');
		$this->loadModel('report');
	}

	public function index() {
		$comments = $this->comment->all();

		$this->render('admin.comments.index', compact('comments'));
	}

	public function add() {
		if(!empty($_POST)) {
			$result = $this->comment->create([
				'author' => $_SESSION['auth']->username,
				'comment' => $_POST['comment'],
				'chapter_id' => $_POST['chapter_id']
			], 'comment_date');
			if($result) {
				return $this->index();
			}
		}
		$chapters = $this->chapter->extract('id', 'chapter_title');
		$form = new BootstrapForm($_POST);
		$this->render('admin.comments.add', compact('chapters', 'form'));		
	}

	public function edit() {
		if(!empty($_POST)) {
			$result = $this->comment->update($_GET['id'], [
				'comment' => $_POST['comment'],
				'chapter_id' => $_POST['chapter_id']
			], 'comment_date');
			if($result) {
				return $this->index();
			}
		}
		$comment = $this->comment->find($_GET['id']);

		$chapters = $this->chapter->extract('id', 'chapter_title');
		$form = new BootstrapForm($comment);
		$this->render('admin.comments.add', compact('comment', 'chapters', 'form'));
	}

	public function delete() {
		if(!empty($_POST)) {
			$sup = $this->report->deleteReport($_POST['id']);
			$sup = $this->comment->delete($_POST['id']);
		}
		header('Location: ?p=admin.comments.index');
	}
}