<?php

namespace blog\controler;

use \App;

class Controler {

	protected $viewPath;
	protected $template = 'default';

	public function __construct() {
		$this->viewPath = ROOT . '/view/';
	}

	protected function render($view, $variables = []) {
		ob_start();
		extract($variables);
		require($this->viewPath . str_replace('.', '/', $view) . '.php');
		$content = ob_get_clean();
		require($this->viewPath . 'template/' . $this->template . '.php');
	}

	protected function loadModel($model_name) {
		$this->$model_name = App::getInstance()->getModelClass($model_name);
	}

	protected function notFound() {
		header('HTTP/1.0 404 Not Found');
		die('Page introuvable');;
	}

	protected function forbidden() {
		header('HTTP/1.0 403 Forbiden');
		die('Acces interdit');
	}
}