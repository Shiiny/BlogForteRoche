<p><a href="<?= $book->getUrl(); ?>">\ <?= $book->title; ?></a></p>

<div class="row">
	<div class="col-sm-8">

		<div>
		<h1><?= $chapter->chapter_title; ?></h1>
		<p><em><?= $chapter->chapter_release; ?></em></p>
		<p><?= $chapter->chapter_content; ?></p>
	</div>

	<?php if($app->getAuth()->logged()): ?>
	<div class="group-container">
		<button id="addComment" class="btn btn-success"><i class="fas fa-comment" aria-hidden="true"></i> Commentaire</button>
		<button id="closeComment" class="btn"><i class="fas fa-times" aria-hidden="true"></i></button>
		<form id="formComment" method="post" action="?p=comments.addComment&id=<?= $chapter->id; ?>">
			<?= $form->input('comment', 'Commentaire', ['type' => 'textarea']); ?>
			<button class="btn btn-primary">Envoyer</button>
		</form>
	</div>
	<?php endif; ?>

	<?php foreach($comments as $comment): ?>

	<div class="list-group">
		<div class="list-group-item list-group-item-info">
			<p><em><?= $comment->author ?></em> | <em><?= $comment->comment_date ?></em></p>
		</div>
		<div class="list-group-item"><?= $comment->comment ?></div>

		<?php if($app->getAuth()->logged()): ?>
		<div class="list-group-item">
			<?php if($app->getSession()->getAllow('username', $comment->author)): ?>
			<a href="?p=comments.editComment&id=<?= $comment->id; ?>" class="btn btn-info"><i class="fas fa-edit" aria-hidden="true"></i> Editer</a>
			<?php endif;?>
			<?php if($comment->report == 0): ?>
			<a href="?p=comments.reportComment&id=<?= $comment->id; ?>&chapter=<?= $comment->chapter_id; ?>">Signaler ce commentaire</a>
			<?php endif; ?>
		</div>		
		<?php endif; ?>

	</div>
	<?php endforeach; ?>
	</div>
	
	<div class="col-sm-4">
		<h3>Les chapitres :</h3>
		<ul>
			<?php foreach($listChapters as $listChapter): ?>
			<li><a href="<?= $listChapter->getUrl(); ?>"><?= $listChapter->chapter_title; ?></a></li>
			<?php endforeach; ?>
		</ul>
	</div>

	<div class="col-sm-4">
		<h3>Les Oeuvres :</h3>
		<ul>
			<?php foreach($listbooks as $listbook): ?>
			<li><a href="<?= $listbook->getUrl(); ?>"><?= $listbook->title; ?></a></li>
		<?php endforeach; ?>
		</ul>
	</div>
</div>
