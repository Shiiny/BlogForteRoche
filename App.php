<?php

use blog\Autoloader;
use blog\MysqlDatabase;
use blog\Auth\Session;
use blog\Auth\Auth;

class App {

	private $settings = [];
	private $db_instance;
	private $session;
	private static $_instance;

	public $title = 'Blog ForteRoche';

	/**
	 * [__construct description] Appel du fichier de config pour la DB
	 */
	public function __construct() {
		$this->settings = require ROOT . '/config/config.php';
	}

	/**
	 * [load description] Charge la session et l'autoloader
	 */
	public static function load() {
		require ROOT . '/Autoloader.php';
		Autoloader::register();
		self::getInstance()->getSession();
	}

	/**
	 * [getInstance description] Permet d'avoir toujour la même instance d'App
	 * @return [objet] App
	 */
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

	/**
	 * [getModelClass description] Factory qui gère l'appel aux models
	 * @param  [string] $classname
	 * @return [objet] une instance de $classname
	 */
	public function getModelClass($classname) {
		$class_name = 'blog\model\\' .ucfirst($classname);
		return new $class_name($this->getDb());
	}

	/**
	 * [getDb description] Factory donnant toujour à la même instance de MysqlDatabase
	 * @return [objet] toujour la même instance de MysqlDatabase
	 */
	public function getDb() {
		$config = App::getInstance();
		if(is_null($this->db_instance)) {
			$this->db_instance = new MysqlDatabase($config->get('db_name'), $config->get('db_user'), $config->get('db_pass'), $config->get('db_host'));
		}
		return $this->db_instance;
	}

	public function getSession() {
		if(is_null($this->session)) {
			$this->session = new Session();
		}
		return $this->session;
	}

	public function getAuth() {
		return new Auth(self::getInstance(), $this->getDb(), $this->getSession());
	}

	public function getTitle() {
		return $this->title;
	}

	public function setTitle($title) {
		$this->title = $this->title . ' | ' .$title;
	}

	public function redirect($page) {
		header('Location:'.$page);
		exit();
	}
}