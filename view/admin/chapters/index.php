<?php require('../view/admin/menu.php'); ?>
	<h1>Administrer les chapitres</h1>
	<p>
		<a href="?p=admin.chapters.add" class="btn btn-success">Ajouter</a>
	</p>

	<table class="table">
		<thead>
			<tr>
				<td>ID</td>
				<td>Titre</td>
				<td>Livre</td>
				<td>Dernière modification</td>
				<td>Actions</td>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($chapters as $chapter): ?>
				<tr>
					<td><?= $chapter->id; ?></td>
					<td><?= $chapter->chapter_title; ?></td>
					<td><?= $chapter->title; ?></td>
					<td class="item"><?= $chapter->chapter_release; ?></td>
					<td>
						<a href="<?= $chapter->getUrl(); ?>" class="btn-default"><i class="fas fa-eye" aria-hidden="true"></i></a>
						<a href="?p=admin.chapters.edit&id=<?= $chapter->id; ?>" class="btn btn-primary"><i class="fas fa-edit" aria-hidden="true"></i></a>
						<form action="?p=admin.chapters.delete" method="post" style="display: inline;">
							<input type="hidden" name="id" value="<?= $chapter->id; ?>">
							<button type="submit" class="btn btn-danger"><i class="fas fa-trash" aria-hidden="true"></i></button>
						</form>
					</td>			
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div><!-- /adminbody -->