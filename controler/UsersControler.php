<?php

namespace blog\controler;

use blog\controler\Controler;
use \App;
use blog\Auth\DBAuth;
use blog\html\BootstrapForm;

class UsersControler extends Controler {
	private $errors = [];

	public function __construct() {
		parent::__construct();
		$this->loadModel('user');
	}

	public function isValid() {
		return empty($this->errors);
	}

	public function getErrors() {
		return $this->errors;
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

	public function register() {
		if(!empty($_POST)) {
			
			if(!preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username']) || !isset($_POST['username'])) {
				$this->errors['username'] = "Votre pseudo n'est pas valide !";
			}
			if($this->isValid()) {
				$user = $this->user->isUniq('username', $_POST['username']);
				if($user) {
					$this->errors['username'] = "Ce pseudo est déjà utilisé";
				}
			}
			if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
				$this->errors['email'] = "Votre email n'est pas valide !";
			}
			if($this->isValid()) {
				$user = $this->user->isUniq('email', $_POST['email']);
				if($user) {
					$this->errors['email'] = "Cet adresse e-mail est déjà utilisé";
				}
			}
			if(empty($_POST['password']) || $_POST['password'] !== $_POST['password_confirm']) {
				$this->errors['password'] = "Vous devez rentrer un mot de passe valide";
			}
			if($this->isValid()) {
				$auth = new DBAuth(App::getInstance()->getDb());
				$auth->register($_POST['username'], $_POST['password'], $_POST['email']);
				//Session::getInstance()->setFlash('success', "Un email de confirmation vous a été envoyé.");
				//App::redirect('login.php');
			}
			else {
				$errors = $this->getErrors();
			}
		var_dump($this->getErrors());
		}
		$form = new BootstrapForm($_POST);
		$this->render('users.register', compact('form', 'errors'));
	}
}