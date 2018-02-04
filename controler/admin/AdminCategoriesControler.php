<?php

namespace blog\controler\admin;

use blog\controler\admin\AdminControler;
use blog\html\BootstrapForm;

class AdminCategoriesControler extends AdminControler {

	public function __construct() {
		parent::__construct();
		$this->loadModel('category');
	}

	public function index() {
		$categories = $this->category->all();

		$this->render('admin.categories.index', compact('categories'));
	}

	public function add() {
		if(!empty($_POST)) {
			$result = $this->category->create(['title' => $_POST['title']]);
			if($result) {
				return $this->index();
			}
		}
		$form = new BootstrapForm($_POST);
		$this->render('admin.categories.add', compact('form'));		
	}

	public function edit() {
		if(!empty($_POST)) {
			$result = $this->category->update($_GET['id'], ['title' => $_POST['title']]);
			if($result) {
				return $this->index();
			}
		}
		$category = $this->category->find($_GET['id']);

		$form = new BootstrapForm($category);
		$this->render('admin.categories.add', compact('form'));
	}

	public function delete() {
		if(!empty($_POST)) {
			$sup = $this->category->delete($_POST['id']);
		}
		header('Location: ?p=admin.categories.index');
	}
}