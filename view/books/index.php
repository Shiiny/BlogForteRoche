<div class="content">
	<h2>Tous les romans</h2>
	<?php foreach($books as $book): ?>

	<div class="row content-book">
		<div class="col-sm-3">
			<?php if($book->img_name != null): ?>
				<img src="../public/images/upload/<?= $book->img_name; ?>" class="thumbnail cover" alt="">
			<?php else: ?>
				<img src="../public/images/empty.png" class="thumbnail cover" alt="empty">
			<?php endif; ?>
		</div>
		
		<div class="col-sm-9">
			<h1 class="title"><a href="<?= $book->getUrl(); ?>"><?= $book->title; ?></a></h1>
			<p class="info"><em><?= $book->category; ?></em> | <em><?= $book->getDate($dateFormat); ?></em></p>

			<div class="item"><?= $book->content; ?></div>
		</div>
	</div>
	<?php endforeach ?>
</div>