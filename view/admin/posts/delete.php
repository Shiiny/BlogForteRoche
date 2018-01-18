<?php
$postTable = App::getInstance()->getModelClass('Post');
if(!empty($_POST)) {
	$result = $postTable->delete($_POST['id']);
		header('Location: admin.php');
}