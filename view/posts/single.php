<div>
	<h1><?= $post->title; ?></h1>
	<p><em><?= $post->category; ?></em></p>
	<p><?= $post->content; ?></p>
</div>
<div class="group-container">
	<button id="addComment" class="btn btn-success">Commentaire</button>
	<button id="closeComment" class="btn">Fermer</button>
	<form id="formComment" method="post" action="?p=comments.addComment&id=<?= $post->id; ?>">
		<?= $form->input('comment', 'Commentaire', ['type' => 'textarea']); ?>
		<button class="btn btn-primary">Envoyer</button>
	</form>
</div>

<?php foreach($comments as $comment): ?>
<div class="list-group">
	<div class="list-group-item list-group-item-info">
		<p><em><?= $comment->author ?></em> | <em><?= $comment->comment_date ?></em></p>
	</div>
	<div class="list-group-item"><?= $comment->comment ?></div>
	<div class="list-group-item">
		<?php if(App::getInstance()->getSession()->getAllow('username', $comment->author)): ?>
		<a href="?p=comments.editComment&id=<?= $comment->id; ?>" class="btn btn-info">Editer</a>
		<?php endif; ?>
		<a href="?p=comments.reportComment&id=<?= $comment->id; ?>">Signaler ce commentaire</a>
	</div>
</div>
<?php endforeach; ?>
