<div class="content">
	<div class="row book">
		
		<?php if($photo): ?>
		<div class="col-sm-3">
			<img src="<?= $photo; ?>" class="thumbnail cover" alt="">
		</div>
		<?php endif; ?>
		<div class="col-sm-7">
			<div class="content-book">
				<h2><?= $book->title; ?></h2>
				<p><em><?= $book->category; ?></em> | <em><?= $book->release_date; ?></em></p>

				<p><?= $book->content; ?></p>		
			</div>
			<div class="chapters">
				<h3>Les chapitres</h3>
				<nav class="navbar navbar-inverse">
					<ul class="nav navbar-nav">
						<?php foreach($chapters as $chapter): ?>
						<li><a href="<?= $chapter->getUrl(); ?>"><?= $chapter->chapter_title; ?></a></li>
						<?php endforeach; ?>
					</ul>
				</nav>
			</div>
		</div>

		<?php if($photo): ?>
			<div class="col-sm-2">
		<?php else: ?>
			<div class="col-sm-2 col-sm-offset-1">
		<?php endif; ?>
				<h3>Les categories :</h3>
				<ul>
					<?php foreach($categories as $category): ?>
					<li><a href="<?= $category->getUrl(); ?>"><?= $category->title; ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>

	</div>
</div>