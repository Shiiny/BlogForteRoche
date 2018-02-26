<?php require('../view/admin/menu.php'); ?>
	<?php if(isset($error)): ?>
		<div class="alert alert-danger" role="alert">
			<p><?= $error; ?></p>
		</div>
	<?php endif; ?>

		<form method="post" action="">
			<?= $form->input('chapter_title', 'Titre du chapitre'); ?>
			<?= $form->input('chapter_content', 'Contenu', ['type' => 'textarea']); ?>
			<?= $form->select('book_id', 'Roman', $books); ?>
			<button class="btn btn-primary">Sauvegarder</button>
		</form>
	</div><!-- /adminbody -->
</div><!-- /row -->