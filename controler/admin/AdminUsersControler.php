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
		$nbPage = $this->pager('user', 'id', null, 10);

		if(isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nbPage) {
			$currentPage = $_GET['page'];
		}
		else {
			$currentPage = 1;
		}

		$users = $this->user->pagerUser($currentPage, $this->perPage);		

		$this->render('admin.users.index', compact('users', 'nbPage'));
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