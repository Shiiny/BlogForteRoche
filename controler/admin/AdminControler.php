<?php

namespace blog\controler\admin;

use blog\controler\Controler;
use \App;
use blog\Auth\DBAuth;
use blog\html\BootstrapForm;

class AdminControler extends Controler {

	public function __construct() {
		parent::__construct();

		$this->loadModel('user');
		$this->loadModel('comment');
		// Auth
		App::getInstance()->getAuth()->allow('admin');
	}

	public function index() {
		$users = $this->user->userRecent();
		$comments = $this->comment->threeLast();

		$this->render('admin.index', compact('users', 'comments'));
	}

	
}