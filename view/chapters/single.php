<div>
	<h1><?= $chapter->title; ?></h1>
	<p><em><?= $chapter->category; ?></em></p>
	<p><?= $chapter->content; ?></p>
</div>
<div class="group-container">
	<button id="addComment" class="btn btn-success"><i class="fas fa-comment" aria-hidden="true"></i> Commentaire</button>
	<button id="closeComment" class="btn"><i class="fas fa-times" aria-hidden="true"></i></button>

	<form id="formComment" method="chapter" action="?p=comments.addComment&id=<?= $chapter->id; ?>">
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
		<a href="?p=comments.editComment&id=<?= $comment->id; ?>" class="btn btn-info"><i class="fas fa-edit" aria-hidden="true"></i> Editer</a>
		<?php endif;?>
		<a href="?p=comments.reportComment&id=<?= $comment->id; ?>">Signaler ce commentaire</a>
	</div>
</div>
<?php endforeach; ?>
