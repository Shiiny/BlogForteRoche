<?php

use blog\Autoloader;
use blog\MysqlDatabase;

class App {

	private $settings = [];
	private $db_instance;
	private static $_instance;

	public $title = 'Blog ForteRoche';

	// Appel du fichier de config de la DB
	public function __construct() {
		$this->settings = require ROOT . '/config/config.php';
	}

	public static function load() {
		session_start();
		require ROOT . '/Autoloader.php';
		Autoloader::register();
	}

	// Permet d'avoir toujour la même instance 
	public static function getInstance() {
		// Partie gérant le singleton
		if (is_null(self::$_instance)) {
			self::$_instance = new App();
		}
		return self::$_instance;
	}

	public function get($key) {
		if(!isset($this->settings[$key])) {
			return null;
		}
		return $this->settings[$key];
	}

	// Methode permettant l'utilisation d'une factory pour les models
	public function getModelClass($classname) {
		$class_name = '\\blog\\model\\' .ucfirst($classname);
		return new $class_name($this->getDb());
	}

	// Factory faisant appel toujour à la même instance de Database
	public function getDb() {
		$config = App::getInstance();
		if (is_null($this->db_instance)) {
			$this->db_instance = new MysqlDatabase($config->get('db_name'), $config->get('db_user'), $config->get('db_pass'), $config->get('db_host'));
		}
		return $this->db_instance;
	}

	public function notFound() {
		header('HTTP/1.0 404 Not Found');
		die('Page introuvable');;
	}

	public function forbidden() {
		header('HTTP/1.0 403 Forbiden');
		die('Acces interdit');
	}

	public function getTitle() {
		return $this->title;
	}

	public function setTitle($title) {
		$this->title = $this->title . ' | ' .$title;
	}
}