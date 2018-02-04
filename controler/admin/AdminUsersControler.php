<?php

namespace blog\controler\admin;

use blog\controler\admin\AdminControler;
use blog\html\BootstrapForm;

class AdminUsersControler extends AdminControler {

	public function __construct() {
		parent::__construct();

		$this->loadModel('user');
	}

	public function index() {
		$users = $this->user->allUsers();

		$this->render('admin.users.index', compact('users'));
	}

	public function delete() {
		if(!empty($_POST)) {
			$sup = $this->user->delete($_POST['id']);
		}
		header('Location: ?p=admin.users.index');
	}
}