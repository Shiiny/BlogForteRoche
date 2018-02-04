<?php require('../view/admin/menu.php'); ?>

	<form method="post" action="">
		<?= $form->input('chapter_title', 'Titre du chapitre'); ?>
		<?= $form->input('chapter_content', 'Contenu', ['type' => 'textarea']); ?>
		<?= $form->select('book_id', 'Roman', $books); ?>
		<button class="btn btn-primary">Sauvegarder</button>
	</form>
</div><!-- /adminbody -->