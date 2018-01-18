<h1><?= $categorie->title; ?></h1>
<div class="row">
	<div class="col-sm-8">
		<?php

		foreach($posts as $post): ?>
		<?php //var_dump($posts); ?>
		<h2><a href="<?= $post->getUrl(); ?>"><?= $post->title; ?></a></h2>
		<p><em><?= $post->category; ?></em></p>

		<p><?= $post->getExtrait(); ?></p>

		<?php endforeach; ?>

	</div>
	<div class="col-sm-4">
		<h3>Les catégories</h3>
		<ul>
			<?php foreach($listCategories as $listCategorie): ?>
			<li><a href="<?= $listCategorie->getUrl(); ?>"><?= $listCategorie->title; ?></a></li>
		<?php endforeach; ?>
		</ul>
	</div>
</div>

