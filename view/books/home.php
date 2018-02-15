<div class="content">
	<h2>Le dernier roman :</h2>
	<div class="row">
		<?php if($photo): ?>
			<div class="col-sm-3">
				<img src="<?= $photo; ?>" class="thumbnail cover" alt="">
			</div>
		<?php endif; ?>

		<div class="col-sm-9">
			<h2><a href="<?= $book->getUrl(); ?>"><?= $book->title; ?></a></h2>
			<p><em><?= $book->category; ?></em> | <em><?= $book->release_date; ?></em></p>
			<p><?= $book->content; ?></p>	
		</div>
	</div>
</div>
