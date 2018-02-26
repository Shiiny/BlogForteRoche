<?php require('../view/admin/menu.php'); ?>
	<?php if(isset($error)): ?>
		<div class="alert alert-danger" role="alert">
			<p><?= $error; ?></p>
		</div>
	<?php endif; ?>

		<form method="post" action="">
			<?= $form->input('title', 'Titre de la catégorie'); ?>
			<button class="btn btn-primary">Sauvegarder</button>
		</form>
	</div><!-- /adminbody -->
</div><!-- /row -->