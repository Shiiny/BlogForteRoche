<?php
use blog\Auth\DBAuth;

define('ROOT', dirname(__DIR__));


require ROOT . '/App.php';

App::load();

if(isset($_GET['p'])) {
	$page = $_GET['p'];
}
else {
	$page = 'home';
}

// Auth
$app = App::getInstance();
$auth = new DBAuth($app->getDb());
if(!$auth->logged()) {
	$app->forbidden();
}

ob_start();
if($page === 'home') {
	require ROOT . '/view/admin/index.php';
}
elseif($page === 'post.edit') {
	require ROOT . '/view/admin/edit.php';
}
elseif($page === 'post.single') {
	require ROOT . '/view/admin/single.php';
}
$content = ob_get_clean();
require ROOT . '/view/template/default.php';