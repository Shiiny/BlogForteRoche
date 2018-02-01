<?php

namespace blog\Auth;

class Session {

	public function __construct() {
		session_start();
	}

	public function write($key, $value) {
		$_SESSION[$key] = $value;
	}

	public function read($key) {
		return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
	}

	public function setInfo($field) {
		if(isset($_SESSION['auth']->$field)) {
			return $_SESSION['auth']->$field;
		}
		return false;
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

	public function destroy($key) {
		unset($_SESSION[$key]);
	}

	public function getAllow($field, $key) {
		if(isset($_SESSION['auth'])){
			return $_SESSION['auth']->$field === $key;
		}
		return false;
	}
}