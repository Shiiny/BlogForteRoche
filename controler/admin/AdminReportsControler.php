<?php

namespace blog\controler\admin;

use blog\controler\admin\AdminControler;
use blog\html\BootstrapForm;

class AdminReportsControler extends AdminControler {

	public function __construct() {
		parent::__construct();

		$this->loadModel('comment');
		$this->loadModel('report');
	}

	public function index() {
		$reports = $this->report->findComment($_GET['id']);

		$this->render('admin.comments.report', compact('reports'));
	}

	public function valide() {
		$report = $this->report->find($_POST['id']);
		$comment = $this->comment->byReport($_POST['id']);

		if(!empty($_POST)) {
			$result = $this->comment->update($comment->id, ['report' => $comment->report = $comment->report -1],'release_report');
			if($result) {
				$sup = $this->report->delete($_POST['id']);
			}
		}
		header('Location: ?p=admin.reports.index&id='.$comment->id);
	}

	public function delete() {
		$report = $this->report->find($_POST['id']);
		$comment = $this->comment->byReport($_POST['id']);

		if(!empty($_POST)) {
			$sup = $this->report->delete($report->id);
			$sup = $this->comment->delete($comment->id);
		}
		header('Location: ?p=admin.reports.index&id='.$comment->id);
	}
}