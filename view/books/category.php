<div class="content">
	<h2><?= $categorie->title; ?></h2>
	<div class="row">
		<div class="col-sm-8">
			<?php

			foreach($books as $book): ?>
			<?php //var_dump($book->getUrl()); ?>
			<h2><a href="<?= $book->getUrl(); ?>"><?= $book->title; ?></a></h2>
			<p><em><?= $book->category; ?></em></p>

			<p><?= $book->content; ?></p>

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
</div>

