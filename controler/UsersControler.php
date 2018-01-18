<?php

namespace blog\controler;

use blog\controler\Controler;
use \App;
use blog\Auth\DBAuth;
use blog\BootstrapForm;

class UsersControler extends Controler {

	public function login() {
		$errors = false;
		if(!empty($_POST)) {
			$auth = new DBAuth(App::getInstance()->getDb());
			if($auth->login($_POST['username'], $_POST['password'])) {
				header('Location: index.php?p=admin.index');
			}
			else{
				$errors = true;
			}
		}
		$form = new BootstrapForm($_POST);
		$this->render('users.login', compact('form', 'errors'));
	}
}