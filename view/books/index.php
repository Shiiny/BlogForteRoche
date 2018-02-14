<div class="content">
	<h2>Tous les romans</h2>
	<div class="row">
		<?php foreach($books as $book): ?>
		<div class="col-sm-4">
			<h3>Images</h3>
			
		</div>
		<div class="col-sm-8">
			<h2><a href="<?= $book->getUrl(); ?>"><?= $book->title; ?></a></h2>
			<p><em><?= $book->category; ?></em> | <em><?= $book->release_date; ?></em></p>

			<p><?= $book->content; ?></p>
		</div>
		<?php endforeach ?>
	</div>
</div>