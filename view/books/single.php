<div class="content">
	<div class="row">
		<div class="col-sm-8">
			<h2><?= $book->title; ?></h2>
			<p><em><?= $book->category; ?></em> | <em><?= $book->release_date; ?></em></p>

			<p><?= $book->content; ?></p>
		</div>
		
		<div class="col-sm-4">
			<h3>Les chapitres :</h3>
			<ul>
				<?php foreach($chapters as $chapter): ?>
				<li><a href="<?= $chapter->getUrl(); ?>"><?= $chapter->chapter_title; ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div class="col-sm-4">
			<h3>Les categories :</h3>
			<ul>
				<?php foreach($categories as $category): ?>
				<li><a href="<?= $category->getUrl(); ?>"><?= $category->title; ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</div>