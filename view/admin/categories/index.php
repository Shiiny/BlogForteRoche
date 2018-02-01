	<h1>Administrer les catégories</h1>

	<p>
		<a href="?p=admin.categories.addCategory" class="btn btn-success">Ajouter</a>
	</p>

	<table class="table">
		<thead>
			<tr>
				<td>ID</td>
				<td>Titre de la catégorie</td>
				<td>Actions</td>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($categories as $category): ?>
				<tr>
					<td><?= $category->id; ?></td>
					<td class="content"><?= $category->title; ?></td>
					<td>
						<a href="?p=admin.categories.edit&id=<?= $category->id; ?>" class="btn btn-primary">Editer</a>
						<form action="?p=admin.categories.delete" method="post" style="display: inline;">
							<input type="hidden" name="id" value="<?= $category->id; ?>">
							<button type="submit" class="btn btn-danger">Supprimer</button>
						</form>
					</td>			
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div><!-- /adminbody -->