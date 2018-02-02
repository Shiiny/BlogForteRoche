<h1>Le dernier roman :</h1>
<div class="row">
	<div class="col-sm-8">
		<?php var_dump($book); ?>

		<h2><a href=""><?= $book->title; ?></a></h2>
		<p><em><?= $book->release_date; ?></em></p>

		<p><?= $book->content; ?></p>
	</div>
	<div class="col-sm-4">
		<h3>Les chapitres :</h3>
		<ul>
			<?php foreach($chapters as $chapter): ?>
			<li><a href=""><?= $chapter->title; ?></a></li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>

