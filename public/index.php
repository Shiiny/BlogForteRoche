<?php
define('ROOT', dirname(__DIR__));


require ROOT . '/App.php';

App::load();

if(isset($_GET['p'])) {
	$page = $_GET['p'];
}
else {
	$page = 'home';
}

ob_start();
if($page === 'home') {
	require ROOT . '/view/home.php';
}
elseif($page === 'posts.single') {
	require ROOT . '/view/single.php';
}
elseif($page === 'posts.category') {
	require ROOT . '/view/category.php';
}
elseif($page === 'login') {
	require ROOT . '/view/users/login.php';
}
$content = ob_get_clean();
require ROOT . '/view/template/default.php';