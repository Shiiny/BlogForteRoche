<?php require('../view/admin/menu.php'); ?>
	<div class="row">
		<div class="col-sm-12">
			<form method="post" action="">
				<?= $form->input('comment', 'Commentaire', ['type' => 'textarea']); ?>
				<?= $form->select('chapter_id', 'Chapitre', $chapters); ?>
				<button class="btn btn-primary">Sauvegarder</button>
			</form>
			<div class="return">
				<a href="?p=admin.comments.index"><i class="fas fa-long-arrow-alt-left"></i> Retour aux commentaires</a>
			</div>	
		</div>	
	</div>
	</div><!-- /adminbody -->
</div><!-- /row -->