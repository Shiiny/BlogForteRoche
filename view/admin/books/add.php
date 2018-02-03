<form method="post" action="">
	<?= $form->input('title', 'Titre du roman'); ?>
	<?= $form->input('content', 'Préface', ['type' => 'textarea']); ?>
	<?= $form->select('category_id', 'Catégorie du roman', $categories); ?>
	<button class="btn btn-primary">Sauvegarder</button>
</form>