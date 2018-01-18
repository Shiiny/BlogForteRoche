<?php

$app = App::getInstance();
$post = $app->getModelClass('Post')->find($_GET['id']);
if ($post === false) {
	$app->notFound();
}

$app->title = $post->title;
?>

<h1><?= $post->title; ?></h1>
<p><em><?= $post->category; ?></em></p>
<p><?= $post->content; ?></p>