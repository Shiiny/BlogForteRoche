<?php

namespace blog\controler;

use blog\controler\Controler;
use \App;
use blog\Auth\Auth;
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

		
		$form = new BootstrapForm($_POST);
		$this->render('users.login', compact('form', 'errors'));
	}

	public function register($app) {
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
				$app->getAuth()->register($_POST['username'], $_POST['password'], $_POST['email']);
				$app->getSession()->setFlash('success', "Un email de confirmation vous a été envoyé.");
				$app->redirect('index.php?p=users.login');
			}
			else {
				$errors = $this->getErrors();
			}
		}
		$form = new BootstrapForm($_POST);
		$this->render('users.register', compact('form', 'errors'));
	}

	public function confirm($app) {
		$user = $this->user->byUserId($_GET['id']);
		var_dump($user);
		var_dump($user->confirmation_token == $_GET['token']);
		die();
		if($user && $user->confirmation_token == $_GET['token']){
			$this->user->validateAccount($_GET['id']);
			$app->getSession()->setFlash('success', "Votre compte a bien été activé");
			$app->getSession()->write('auth', $user);
			$app->redirect('index.php?p=users.account');
		}
		else {
			$app->getSession()->setFlash('success', "Votre compte a bien été activé");
			$app->redirect('index.php?p=users.login');
		}
	}
}