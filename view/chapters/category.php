<h1><?= $categorie->title; ?></h1>
<div class="row">
	<div class="col-sm-8">
		<?php

		foreach($chapters as $chapter): ?>
		<?php //var_dump($chapters); ?>
		<h2><a href="<?= $chapter->getUrl(); ?>"><?= $chapter->title; ?></a></h2>
		<p><em><?= $chapter->category; ?></em></p>

		<p><?= $chapter->getExtrait(); ?></p>

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

