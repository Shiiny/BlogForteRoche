<?php

$posts = App::getInstance()->getModelClass('Post')->all();
$categories = App::getInstance()->getModelClass('category')->all();
//var_dump($posts);
?>


<h1>Administrer les articles</h1>

<p>
	<a href="?p=posts.add" class="btn btn-success">Ajouter</a>
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
				<td><?= $post->dateAdd; ?></td>
				<td>
					<a href="?p=posts.edit&id=<?= $post->id; ?>" class="btn btn-primary">Editer</a>
					<form action="?p=posts.delete" method="post" style="display: inline;">
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
	<a href="?p=categories.add" class="btn btn-success">Ajouter</a>
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
				<td><?= $category->title; ?></td>
				<td>
					<a href="?p=categories.edit&id=<?= $category->id; ?>" class="btn btn-primary">Editer</a>
					<form action="?p=categories.delete" method="post" style="display: inline;">
						<input type="hidden" name="id" value="<?= $category->id; ?>">
						<button type="submit" class="btn btn-danger">Supprimer</button>
					</form>
				</td>			
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>