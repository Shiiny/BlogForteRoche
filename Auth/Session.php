<?php

namespace blog\Auth;

class Session {

	public function __construct() {
		session_start();
	}

	public function read($key) {
		return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
	}

	public function setFlash($key, $msg) {
		$_SESSION['flash'][$key] = $msg;
	}

	public function hasFlashes() {
		return isset($_SESSION['flash']);
	}

	public function getFlashes() {
		$flash = $_SESSION['flash'];
		unset($_SESSION['flash']);
		return $flash;
	}
}