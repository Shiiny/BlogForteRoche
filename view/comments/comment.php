<div class="row">
	<div class="col-sm-12 edit">
		<form method="post" action="">
			<?= $form->input('comment', 'Commentaire', ['type' => 'textarea']); ?>
			<button class="btn btn-primary">Modifier</button>
		</form>	
		<div class="return">
			<a href="?p=chapters.single&id=<?= $comment->chapter_id; ?>"><i class="fas fa-long-arrow-alt-left"></i> Retour au chapitre</a>
		</div>	
	</div>
</div>
