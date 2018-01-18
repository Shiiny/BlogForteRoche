<?php
$categoryTable = App::getInstance()->getModelClass('category');
if(!empty($_POST)) {
	$result = $categoryTable->create([
		'title' => $_POST['title']
	]);
	if($result) {
		header('Location: admin.php');
	}
}

$form = new blog\BootstrapForm($_POST);
?>

<form method="post" action="">
	<?= $form->input('title', 'Titre de la catégorie'); ?>
	<button class="btn btn-primary">Sauvegarder</button>


</form>