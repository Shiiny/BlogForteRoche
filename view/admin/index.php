<?php

$posts = App::getInstance()->getModelClass('Post')->all();
//var_dump($posts);
?>


<h1>Administrer les articles</h1>

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
				<td><a href="?p=post.edit&id=<?= $post->id; ?>" class="btn btn-primary">Editer</a></td>			
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>