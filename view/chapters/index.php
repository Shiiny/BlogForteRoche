<h1>Home Page</h1>
<div class="row">
	<div class="col-sm-8">
		<?php
		foreach($chapters as $chapter): ?>
		<?php// var_dump($chapters); ?>
		<h2><a href="<?= $chapter->getUrl(); ?>"><?= $chapter->title; ?></a></h2>
		<p><em class="col-sm-6"><?= $chapter->category; ?></em><em class="col-sm-6" style="text-align: right"><?= $chapter->dateAdd; ?></em></p>

		<p><?= $chapter->getExtrait(); ?></p>

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

