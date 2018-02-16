<div class="row">
	<div class="col-sm-12">
		<h1>Bienvenue <?= $_SESSION['auth']->username; ?></h1>
		<p>Ceci est un utilisateur de type <strong><?= $_SESSION['auth']->rang; ?></strong></p>
	</div>
</div>

<div class="row">
	<?php foreach ($comments as $comment): ?>
	<div class="col-sm-4">
		<div class="all_comment_title">
			<h4><a href="<?= $comment->getUrl($comment->ChapitreId); ?>"><?= $comment->chapter_title; ?></a></h4>
		</div>
		<div class="all_comment_content">
			<div class="all_comment_item">
				<div class="all_comment_book">
					<p><em>Commenté depuis </em><strong><?= $comment->title?></strong></p>
				</div>			
				<div><?= $comment->comment; ?></div>
				<div class="all_comment_date"><?= $comment->getDate($dateFormat); ?></div>		
			</div>
		</div>
	</div>
	<?php endforeach; ?>
</div>


