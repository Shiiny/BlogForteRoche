<?php

namespace blog\controler;

use blog\controler\Controler;
use \App;
use blog\Auth\DBAuth;
use blog\html\BootstrapForm;

class UsersControler extends Controler {

	public function __construct() {
		parent::__construct();
		$this->loadModel('user');
	}

	public function login() {
		$errors = false;

		if(!empty($_POST)) {
		$membre = $this->user->byRang($_POST['username']);
		var_dump($membre);
			//$auth = new DBAuth(App::getInstance()->getDb());

			$user = $this->user->login($_POST['username'], $_POST['password']);
			var_dump($user);

			if($user AND $membre->rang === "administrateur") {
							var_dump($user);

				header('Location: index.php?p=admin.posts.index');
			}
			elseif($user AND ($membre->rang === "membre")) {
				header('Location: index.php');
			}
			else{
				$errors = true;
			}
		}
		$form = new BootstrapForm($_POST);
		$this->render('users.login', compact('form', 'errors'));
	}
}