<?php require('../view/admin/menu.php'); ?>

	<h1>Administrer les livres</h1>

	<p>
		<a href="?p=admin.books.add" class="btn btn-success">Ajouter</a>
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
			<?php foreach ($books as $book): ?>
				<tr>
					<td><?= $book->id; ?></td>
					<td><?= $book->title; ?></td>
					<td class="item"><?= $book->release_date; ?></td>
					<td>
						<a href="<?= $book->getUrl(); ?>" class="btn-default"><i class="fas fa-eye" aria-hidden="true"></i></a>
						<a href="?p=admin.books.edit&id=<?= $book->id; ?>" class="btn btn-primary"><i class="fas fa-edit" aria-hidden="true"></i></a>
						<form action="?p=admin.books.delete" method="post" style="display: inline;">
							<input type="hidden" name="id" value="<?= $book->id; ?>">
							<button type="submit" class="btn btn-danger"><i class="fas fa-trash" aria-hidden="true"></i></button>
						</form>
					</td>			
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div><!-- /adminbody -->