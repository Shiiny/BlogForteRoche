<?php

namespace blog\controler\admin;

use blog\controler\admin\AdminControler;
use blog\html\BootstrapForm;

class AdminUsersControler extends AdminControler {

	public function __construct() {
		parent::__construct();

		$this->loadModel('user');
		$this->loadModel('role');
	}

	public function index() {
		$users = $this->user->allUsers();

		$this->render('admin.users.index', compact('users'));
	}

	public function rang() {
		if(!empty($_POST)) {
			$result = $this->user->updateUser($_GET['id'], [
				'role_id' => $_POST['rang_id']
			]);
			if($result) {
				return $this->index();
			}
		}

		$roles = $this->role->extract('role_id', 'rang');

		$form = new BootstrapForm();
		$this->render('admin.users.rang', compact('roles', 'form'));
	}

	public function delete() {
		if(!empty($_POST)) {
			$sup = $this->user->delete($_POST['id']);
		}
		header('Location: ?p=admin.users.index');
	}
}