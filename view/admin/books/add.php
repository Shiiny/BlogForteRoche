<?php require('../view/admin/menu.php'); ?>

	<?php if(isset($error)): ?>
		<div class="alert alert-danger" role="alert">
			<p><?= $error; ?></p>
		</div>
	<?php endif; ?>

		<form method="post" action="" enctype="multipart/form-data">
			<?= $form->input('title', 'Titre du roman'); ?>
			<?= $form->input('content', 'Préface', ['type' => 'textarea']); ?>
			<?= $form->select('category_id', 'Catégorie du roman', $categories); ?>
			<?= $form->input('img_name', 'Couverture', ['type' => 'file']); ?>
			<button class="btn btn-primary">Sauvegarder</button>
		</form>


	</div><!-- /adminbody -->
</div><!-- /row -->