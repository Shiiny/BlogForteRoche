<h1>Administrer les articles</h1>

<!--<div class="col-sm-3">
	<ul>
		<li><a href="index.php?p=admin.posts.index">Articles</a></li>
		<li><a href="">Catégories</a></li>
		<li><a href="">Commentaires</a></li>
	</ul>
</div>-->
<div class="col-sm-12">
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
					<td class="content"><?= $post->title; ?></td>
					<td><?= $post->dateAdd; ?></td>
					<td>
						<a href="?p=admin.posts.edit&id=<?= $post->id; ?>" class="btn btn-primary">Editer</a>
						<form action="?p=admin.posts.delete" method="post" style="display: inline;">
							<input type="hidden" name="id" value="<?= $post->id; ?>">
							<button type="submit" class="btn btn-danger">Supprimer</button>
						</form>
					</td>			
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

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
					<td class="content"><?= $comment->comment; ?></td>
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

</div>
