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
elseif($page === 'posts.edit') {
	require ROOT . '/view/admin/edit.php';
}
elseif($page === 'posts.add') {
	require ROOT . '/view/admin/add.php';
}
elseif($page === 'posts.delete') {
	require ROOT . '/view/admin/delete.php';
}
elseif($page === 'categories.edit') {
	require ROOT . '/view/admin/categories/edit.php';
}
elseif($page === 'categories.add') {
	require ROOT . '/view/admin/categories/add.php';
}
elseif($page === 'categories.delete') {
	require ROOT . '/view/admin/categories/delete.php';
}
$content = ob_get_clean();
require ROOT . '/view/template/default.php';