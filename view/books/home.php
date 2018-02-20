<div class="content">
	<h2>Le dernier roman :</h2>
	<div class="row">
		<?php if($photo): ?>
			<div class="col-sm-3">
				<a href="<?= $book->getUrl(); ?>"><img src="<?= $photo; ?>" class="thumbnail cover" alt=""></a>
			</div>
		<?php endif; ?>

		<div class="col-sm-9">
			<h1 class="title"><a href="<?= $book->getUrl(); ?>"><?= $book->title; ?></a></h1>
			<p class="info"><em><?= $book->category; ?></em> | <em><?= $book->getDate($dateFormat); ?></em></p>
			<div class="item"><?= $book->content; ?></div>	
		</div>
	</div>
</div>
