<h1>Home Page</h1>
<div class="row">
	<div class="col-sm-8">
		<?php
		foreach($posts as $post): ?>
		<?php// var_dump($posts); ?>
		<h2><a href="<?= $post->getUrl(); ?>"><?= $post->title; ?></a></h2>
		<p><em class="col-sm-6"><?= $post->category; ?></em><em class="col-sm-6" style="text-align: right"><?= $post->dateAdd; ?></em></p>

		<p><?= $post->getExtrait(); ?></p>

		<?php endforeach; ?>

	</div>
	<div class="col-sm-4">
		<h3>Les catégories</h3>
		<ul>
			<?php foreach($categories as $category): ?>
			<li><a href="<?= $category->getUrl(); ?>"><?= $category->title; ?></a></li>
		<?php endforeach; ?>
		</ul>
	</div>
</div>

