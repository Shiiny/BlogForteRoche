<?php require('../view/admin/menu.php'); ?>

	<h1>Administrer les commentaires</h1>
	<p>
		<a href="?p=admin.comments.addComment" class="btn btn-success">Ajouter</a>
	</p>

	<table class="table">
		<thead>
			<tr>
				<td>Auteur</td>
				<td>Commentaire</td>
				<td>Dernière modification</td>
				<td>Article associé</td>
				<td>Actions</td>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($comments as $comment): ?>
				<tr>
					<td><?= $comment->author; ?></td>
					<td class="content"><?= $comment->getExtrait(); ?></td>
					<td><?= $comment->comment_date; ?></td>
					<td><?= $comment->title; ?></td>
					<td>
						<a href="?p=admin.comments.editComment&id=<?= $comment->id; ?>" class="btn btn-primary">Editer</a>
						<form action="?p=admin.comments.delete" method="post" style="display: inline;">
							<input type="hidden" name="id" value="<?= $comment->id; ?>">
							<button type="submit" class="btn btn-danger">Supprimer</button>
						</form>
					</td>			
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div><!-- /adminbody -->