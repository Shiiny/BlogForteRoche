<?php require('../view/admin/menu.php'); ?>

	<form method="post" action="">
		<?= $form->select('rang_id', 'Changer le rang', $roles); ?>
		<button class="btn btn-primary">Sauvegarder</button>
	</form>
</div><!-- /adminbody -->