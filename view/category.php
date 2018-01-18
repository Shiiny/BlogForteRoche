<?php
$app = App::getInstance();

$categorie = $app->getModelClass('category')->find($_GET['id']);
if($categorie === false) {
	$app->notFound();
}
$post = $app->getModelClass('Post')->byCategory($_GET['id']);
$listCategorie = $app->getModelClass('category')->all();
?>

<h1><?= $categorie->getTitle(); ?></h1>
<div class="row">
	<div class="col-sm-8">
		<?php

		foreach($post as $posts): ?>
		<?php //var_dump($posts); ?>
		<h2><a href="<?= $posts->getUrl(); ?>"><?= $posts->title; ?></a></h2>
		<p><em><?= $posts->category; ?></em></p>

		<p><?= $posts->getExtrait(); ?></p>

		<?php endforeach; ?>

	</div>
	<div class="col-sm-4">
		<h3>Les catégories</h3>
		<ul>
			<?php foreach($listCategorie as $listCategories): ?>
			<li><a href="<?= $listCategories->getUrl(); ?>"><?= $listCategories->getTitle(); ?></a></li>
		<?php endforeach; ?>
		</ul>
	</div>
</div>

