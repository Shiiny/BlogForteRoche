<h1>Home Page</h1>
<div class="row">
	<div class="col-sm-8">
		<?php
		foreach(App::getInstance()->getModelClass('Post')->getList() as $posts): ?>
		<?php// var_dump($posts); ?>
		<h2><a href="<?= $posts->getUrl(); ?>"><?= $posts->title; ?></a></h2>
		<p><em class="col-sm-6"><?= $posts->category; ?></em><em class="col-sm-6" style="text-align: right"><?= $posts->dateAdd; ?></em></p>

		<p><?= $posts->getExtrait(); ?></p>

		<?php endforeach; ?>

	</div>
	<div class="col-sm-4">
		<h3>Les catégories</h3>
		<ul>
			<?php foreach(App::getInstance()->getModelClass('Category')->all() as $categories): ?>
			<li><a href="<?= $categories->getUrl(); ?>"><?= $categories->getTitle(); ?></a></li>
		<?php endforeach; ?>
		</ul>
	</div>
</div>

