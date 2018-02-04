<?php require('../view/admin/menu.php'); ?>
	<h1>Administrer les commentaires</h1>
	<p>
		<a href="?p=admin.comments.add" class="btn btn-success">Ajouter</a>
	</p>

	<table class="table">
		<thead>
			<tr>
				<td>Auteur</td>
				<td>Commentaire</td>
				<td>Dernière modification</td>
				<td>Report</td>
				<td>Chapitre associé</td>
				<td>Actions</td>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($comments as $comment): ?>
				<tr>
					<td><?= $comment->author; ?></td>
					<td class="content"><?= $comment->getExtrait(); ?></td>
					<td class="item-info"><?= $comment->comment_date; ?></td>
					<td><?= $comment->report; ?></td>
					<td class="item-info"><?= $comment->chapter_title; ?></td>
					<td>
						<a href="?p=admin.comments.edit&id=<?= $comment->id; ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a>
						<form action="?p=admin.comments.delete" method="post" style="display: inline;">
							<input type="hidden" name="id" value="<?= $comment->id; ?>">
							<button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
						</form>
					</td>			
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div><!-- /adminbody -->