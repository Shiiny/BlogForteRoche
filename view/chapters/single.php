<p><a href="<?= $book->getUrl(); ?>">\ <?= $book->title; ?></a></p>

<div class="row">
	<div class="col-sm-9">

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
				<a href="?p=comments.reportComment&id=<?= $comment->id; ?>">Signaler ce commentaire</a>
			</div>
				<?php endif; ?>
		</div>
		<?php endforeach; ?>
		<?php if($nbPage > 1): ?>
		<?php for($i = 1; $i <= $nbPage; $i++): ?>
				<a href="index.php?p=chapters.single&id=<?= $chapter->id; ?>&commentPage=<?= $i; ?>"><?= $i; ?></a> /
		<?php endfor; endif; ?>
	</div>
	
	<div class="col-sm-3">
		<div class="row">
			<div id="chapers">
				<h3>Les chapitres :</h3>
				<ul>
					<?php foreach($listChapters as $listChapter): ?>
					<li><a href="<?= $listChapter->getUrl(); ?>"><?= $listChapter->chapter_title; ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<div id="oeuvres">
				<h3>Les Oeuvres :</h3>
				<ul>
					<?php foreach($listbooks as $listbook): ?>
					<li><a href="<?= $listbook->getUrl(); ?>"><?= $listbook->title; ?></a></li>
				<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>

</div>
