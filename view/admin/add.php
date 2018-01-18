<?php
$postTable = App::getInstance()->getModelClass('Post');
if(!empty($_POST)) {
	$result = $postTable->create([
		'title' => $_POST['title'],
		'content' => $_POST['content'],
		'category_id' => $_POST['category_id']
	]);
	if($result) {
		header('Location: admin.php?p=posts.edit&id=' .App::getInstance()->getDb()->lastInsertId());
	}
}
// Récupération des catégories
$categories = App::getInstance()->getModelClass('category')->extract('id', 'title');
//var_dump($categories);

$form = new blog\BootstrapForm($_POST);
?>

<form method="post" action="">
	<?= $form->input('title', 'Titre de l\'article'); ?>
	<?= $form->input('content', 'Contenu', ['type' => 'textarea']); ?>
	<?= $form->select('category_id', 'Catégorie', $categories); ?>
	<button class="btn btn-primary">Sauvegarder</button>


</form>