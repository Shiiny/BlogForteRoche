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


if($page === 'home') {
	$controler = new blog\controler\PostsControler();
	$controler->index();
}
elseif($page === 'posts.single') {
	$controler = new blog\controler\PostsControler();
	$controler->single();
}
elseif($page === 'posts.category') {
	$controler = new blog\controler\PostsControler();
	$controler->categories();
}
elseif($page === 'login') {
	$controler = new blog\controler\UsersControler();
	$controler->login();
}
elseif($page === 'admin.index') {
	$controler = new blog\controler\AdminControler();
	$controler->index();
}
elseif($page === 'admin.posts.add') {
	$controler = new blog\controler\AdminControler();
	$controler->add();
}
elseif($page === 'admin.posts.edit') {
	$controler = new blog\controler\AdminControler();
	$controler->edit();
}