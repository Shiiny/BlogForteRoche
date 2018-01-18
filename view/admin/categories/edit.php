<?php
$categoryTable = App::getInstance()->getModelClass('category');
if(!empty($_POST)) {
	$result = $categoryTable->update($_GET['id'], [
		'title' => $_POST['title']
	]);
	if($result) {
		?>
		<div class="alert alert-success">La catégorie a bien été modifié !</div>
		<?php
	}
}
$category = $categoryTable->find($_GET['id']);


$form = new blog\BootstrapForm($category);
?>

<form method="post" action="">
	<?= $form->input('title', 'Titre de l\'article'); ?>
	<button class="btn btn-primary">Sauvegarder</button>


</form>