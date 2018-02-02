<?php require('../view/admin/menu.php'); ?>

	<h1>Administrer les articles</h1>

	<p>
		<a href="?p=admin.posts.add" class="btn btn-success">Ajouter</a>
	</p>

	<table class="table">
		<thead>
			<tr>
				<td>ID</td>
				<td>Titre</td>
				<td>Dernière modification</td>
				<td>Actions</td>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($posts as $post): ?>
				<tr>
					<td><?= $post->id; ?></td>
					<td><?= $post->title; ?></td>
					<td class="item"><?= $post->dateAdd; ?></td>
					<td>
						<a href="<?= $post->getUrl(); ?>" class="btn-default"><i class="fas fa-eye" aria-hidden="true"></i></a>
						<a href="?p=admin.posts.edit&id=<?= $post->id; ?>" class="btn btn-primary"><i class="fas fa-edit" aria-hidden="true"></i></a>
						<form action="?p=admin.posts.delete" method="post" style="display: inline;">
							<input type="hidden" name="id" value="<?= $post->id; ?>">
							<button type="submit" class="btn btn-danger"><i class="fas fa-trash" aria-hidden="true"></i></button>
						</form>
					</td>			
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div><!-- /adminbody -->