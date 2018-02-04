<?php require('../view/admin/menu.php'); ?>

	<form method="post" action="">
		<?= $form->input('comment', 'Commentaire', ['type' => 'textarea']); ?>
		<?= $form->select('chapter_id', 'Chapitre', $chapters); ?>
		<button class="btn btn-primary">Sauvegarder</button>
	</form>
</div><!-- /adminbody -->