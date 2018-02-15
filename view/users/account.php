<div class="row">
	<div class="col-sm-12">
		<h1>Bienvenue <?= $_SESSION['auth']->username; ?></h1>
		<p>Ceci est un utilisateur de type <strong><?= $_SESSION['auth']->rang; ?></strong></p>
	</div>
</div>

<div class="row">
	<?php foreach ($comments as $comment): ?>
	<div class="col-sm-4">
		<header>
			<h3>Chapitre : <a href=""><?= $comment->chapter_title; ?></a></h3>
		</header>
		<p><?= $comment->comment; ?></p>
	</div>
	<?php endforeach; ?>
</div>


