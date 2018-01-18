<?php
$postTable = App::getInstance()->getModelClass('Post');
if(!empty($_POST)) {
	$result = $postTable->update($_GET['id'], [
		'title' => $_POST['title'],
		'content' => $_POST['content']
	]);
	if($result) {
		?>
		<div class="alert alert-success">L'article a bien été modifié !</div>
		<?php
	}
}
$post = $postTable->find($_GET['id']);

// Récupération des catégories
$categories = App::getInstance()->getModelClass('category')->all();
//var_dump($categories);

$form = new blog\BootstrapForm($post);
?>

<form method="post" action="">
	<?= $form->input('title', 'Titre de l\'article'); ?>
	<?= $form->input('content', 'Contenu', ['type' => 'textarea']); ?>
	<button class="btn btn-primary">Sauvegarder</button>


</form>