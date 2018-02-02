<?php
define('ROOT', dirname(__DIR__));

require ROOT . '/App.php';

App::load();

if(isset($_GET['p']) && !empty($_GET['p'])) {
	$page = $_GET['p'];
}
else {
	$page = 'books.index';
}

$page = explode('.', $page);
$controler = 'blog\controler\\' . ucfirst($page[0]) . 'Controler';
$action = $page[1];

if(isset($page[2])) {
	$action = $page[2];
}


var_dump($controler, $action);
$controler = new $controler();
$controler->$action(App::getInstance());
