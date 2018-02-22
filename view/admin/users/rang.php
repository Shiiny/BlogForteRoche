<?php require('../view/admin/menu.php'); ?>
	
	<div class="row">
		<div class="col-sm-6">
			<form method="post" action="">
				<?= $form->select('rang_id', 'Changer le rang', $roles); ?>
				<button class="btn btn-primary">Sauvegarder</button>
			</form>
			<div class="return">
				<a href="?p=admin.users.index"><i class="fas fa-long-arrow-alt-left"></i> Retour aux utilisateurs</a>
			</div>
		</div>
	</div>
	</div><!-- /adminbody -->
</div><!-- /row -->