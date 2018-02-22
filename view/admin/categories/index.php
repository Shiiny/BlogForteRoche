<?php require('../view/admin/menu.php'); ?>
	
	<div class="row">
		<div class="col-sm-12">
			<div><a href="?p=admin.categories.add" class="btn btn-success">Ajouter</a></div>
			<div class="list-group">
				<h2 class="list-group-item item-title">Administrer les catégories</h2>
				<div class="list-group-item">
					<table class="table table-striped">
						<thead>
							<tr>
								<td class="id">ID</td>
								<td class="title">Titre de la catégorie</td>
								<td class="action">Actions</td>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($categories as $category): ?>
								<tr>
									<td class="id_item"><?= $category->id; ?></td>
									<td class="title_item"><?= $category->title; ?></td>
									<td class="action_item">
										<a href="?p=admin.categories.edit&id=<?= $category->id; ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a>
										<form action="?p=admin.categories.delete" method="post" style="display: inline;">
											<input type="hidden" name="id" value="<?= $category->id; ?>">
											<button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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