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
$params = $parts[0];

if($page === 'admin.index') {
	$controler = 'blog\controler\admin\\' . ucfirst($params) . 'Controler';
	$action = isset($parts[1]) ? $parts[1] : 'index';
}
elseif($parts[0] === 'admin' && isset($parts[1])) {
	$controler = 'blog\controler\admin\\' . ucfirst($parts[0]) . ucfirst($parts[1]) . 'Controler';
	$action = isset($parts[2]) ? $parts[2] : 'index';;
}
elseif(isset($parts[0]) && !isset($parts[1])) {
	$controler = 'blog\controler\Controler';
	$action = 'notFound';
}
else {
	$controler = 'blog\controler\\' . ucfirst($parts[0]) . 'Controler';
	$action = $parts[1];
}



$controler = new $controler();
if(method_exists($controler, $action)) {
	$controler->$action(App::getInstance());
}
else {
	$controler->notFound();
}
