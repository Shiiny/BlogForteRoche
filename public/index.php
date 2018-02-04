<?php
define('ROOT', dirname(__DIR__));

require ROOT . '/App.php';

App::load();

if(isset($_GET['p']) && !empty($_GET['p'])) {
	$page = $_GET['p'];
}
else {
	$page = 'books.home';
}

$parts = explode('.', $page);

if($page === 'admin.index') {
	$controler = 'blog\controler\admin\\' . ucfirst($parts[0]) . 'Controler';
	$action = $parts[1];
}
elseif($parts[0] === 'admin') {
	$controler = 'blog\controler\admin\\' . ucfirst($parts[0]) . ucfirst($parts[1]) . 'Controler';
	$action = $parts[2];
}
else {
	$controler = 'blog\controler\\' . ucfirst($parts[0]) . 'Controler';
	$action = $parts[1];
}



$controler = new $controler();
$controler->$action(App::getInstance());
