<?php
define('ROOT', dirname(__DIR__));

require ROOT . '/App.php';

App::load();

if(isset($_GET['p']) && !empty($_GET['p'])) {
	$page = $_GET['p'];
	//var_dump($page);
}
else {
	$page = 'posts.index';
	//var_dump($page);
}

$page = explode('.', $page);
$action = $page[1];

$controler = 'blog\controler\\' . ucfirst($page[0]) . 'Controler';

if($page[0] === 'admin') {
	$action = $page[2];
} 
/*else{
	$controler = 'blog\controler\\' . ucfirst($page[0]) . 'Controler';
}*/
//var_dump($controler, $action);
$controler = new $controler();
$controler->$action(App::getInstance());
