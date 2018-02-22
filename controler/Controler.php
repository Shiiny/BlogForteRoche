<?php

namespace blog\controler;

use \App;
use \IntlDateFormatter;

class Controler {
	protected $perPage;
	protected $dateFormat;
	protected $viewPath;
	protected $template = 'default';


	public function __construct($format = 'dd MMMM yyyy') {
		$this->viewPath = ROOT . '/view/';
		$this->dateFormat = new IntlDateFormatter('fr_FR', NULL, NULL, NULL, NULL, $format);
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

	protected function pager($model_name, $field, $id = null, $perPage = 5) {
		$this->perPage = $perPage;

		$data = $this->$model_name->count($field, $id);

		$nbArt = (int) $data[0]->$field;
		$nbPage = ceil($nbArt/$this->perPage);

		return $nbPage;
	}

	public function notFound() {
		header('HTTP/1.0 404 Not Found');
		header('Location: 404.php');
		die();
	}

	protected function forbidden() {
		header('HTTP/1.0 403 Forbiden');
		die('Acces interdit');
	}
}