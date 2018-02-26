<?php require('../view/admin/menu.php'); ?>
	<div class="row">
		<div class="col-sm-12">
			<div>
				<a href="?p=admin.books.add" class="btn btn-success">Ajouter</a>
			</div>
			<div class="list-group">
				<h2 class="list-group-item item-title">Administrer les livres</h2>

				
				<div class="list-group-item">
					<table class="table table-striped book">
						<thead>
							<tr>
								<td class="id">ID</td>
								<td class="title">Titre</td>
								<td class="date">Dernière modification</td>
								<td class="action">Actions</td>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($books as $book): ?>
								<tr class="item">
									<td class="id_item"><?= $book->id; ?></td>
									<td class="title_item"><?= $book->title; ?></td>
									<td class="date_item"><?= $book->release_date; ?></td>
									<td class="action_item">
										<a href="<?= $book->getUrl(); ?>" class="btn-default preview"><i class="fas fa-eye" aria-hidden="true"></i></a>
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
				</div>
			</div>
		</div>
	</div>
	</div><!-- /adminbody -->
</div><!-- /row -->