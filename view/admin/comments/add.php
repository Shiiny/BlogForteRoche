<form method="post" action="">
	<?= $form->input('comment', 'Commentaire', ['type' => 'textarea']); ?>
	<?= $form->select('post_id', 'Article', $posts); ?>
	<button class="btn btn-primary">Sauvegarder</button>
</form>