<?php
$categoryTable = App::getInstance()->getModelClass('category');
if(!empty($_POST)) {
	$result = $categoryTable->delete($_POST['id']);
		header('Location: admin.php');
}