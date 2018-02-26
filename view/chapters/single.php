<p class="fil"><a href="<?= $book->getUrl(); ?>">\ <?= $book->title; ?></a></p>

<div class="row">
	<div class="col-sm-8">

		<div>
			<h1><?= $chapter->chapter_title; ?></h1>
			<p class="info"><em><?= $chapter->chapter_release; ?></em></p>
			<div class="item"><?= $chapter->chapter_content; ?></div>
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
				<div class="list-group-item list-group-item-comment author">
					<span class="author-name"><?= $comment->author ?></span><span><?= $comment->comment_date ?></span>
				</div>
				<div class="list-group-item"><?= $comment->comment ?></div>

				<?php if($app->getAuth()->logged()): ?>
				<div class="list-group-item command">
					<?php if($app->getSession()->getAllow('username', $comment->author)): ?>
					<a href="?p=comments.editComment&id=<?= $comment->id; ?>" class="btn btn-info"><i class="fas fa-edit" aria-hidden="true"></i> Editer</a>
					<?php endif;?>
					<a class="report" href="?p=comments.reportComment&id=<?= $comment->id; ?>">Signaler ce commentaire</a>
				</div>
					<?php endif; ?>
			</div>
			<?php endforeach; ?>
			<div class="paginate">
			<?php if($nbPage > 1): ?>
				<?php for($i = 1; $i <= $nbPage; $i++): ?>
					<?php if(isset($_GET['page']) && $i == $_GET['page']): ?>
						<a class="active" href="index.php?p=chapters.single&id=<?= $chapter->id; ?>&page=<?= $i; ?>"><?= $i; ?></a>
					<?php else: ?>
						<a href="index.php?p=chapters.single&id=<?= $chapter->id; ?>&page=<?= $i; ?>"><?= $i; ?></a>
					<?php endif; ?>
			<?php endfor; endif; ?>
			</div>
	</div>
	
	<div class="col-sm-3 col-sm-offset-1">
		<div class="row">
			<div class="col-sm-12">
				<div class="principal">
					<div class="title_chap">
						<h3>Les chapitres :</h3>					
					</div>
					<table class="table table-cat">
						<?php foreach($listChapters as $listChapter): ?>
						<tr>
							<td><a href="<?= $listChapter->getUrl(); ?>"><?= $listChapter->chapter_title; ?></a></td>	
						</tr>
						<?php endforeach; ?>
					</table>
				</div>
			</div>
			<div class="col-sm-12">
				<div class="principal">
					<div class="title_book">
						<h3>Les Oeuvres :</h3>
					</div>
					<table class="table table-cat">
						<?php foreach($listbooks as $listbook): ?>
						<tr>
							<td><a href="<?= $listbook->getUrl(); ?>"><?= $listbook->title; ?></a></td>
						</tr>
					<?php endforeach; ?>
					</table>
				</div>			
			</div>
		</div>
	</div>

</div>
