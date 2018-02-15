<div class="row">
	<nav class="navbar navbar-inverse">
      <div class="container">
        	<ul class="nav navbar-nav">
        		<?php foreach($listCategories as $listCategorie): ?>
				<li><a href="<?= $listCategorie->getUrl(); ?>"><?= $listCategorie->title; ?></a></li>
				<?php endforeach; ?>
        	</ul>
      </div>
    </nav>
</div>
	<div class="row">
		<div class="col-sm-12">
			<h2><?= $categorie->title; ?></h2>
			<?php foreach($books as $book): ?>
				<div class="row content-book book-<?= $book->id; ?>">
					<div class="col-sm-3">
						<?php if($book->img_name != null): ?>
							<img src="../public/images/upload/<?= $book->img_name; ?>" class="thumbnail cover" alt="">
						<?php else: ?>
							<img src="../public/images/empty.png" class="thumbnail cover" alt="empty">
						<?php endif; ?>
					</div>
					<div class="col-sm-9">
						<h2><a href="<?= $book->getUrl(); ?>"><?= $book->title; ?></a></h2>
						<p><em><?= $book->category; ?></em></p>
						<p><?= $book->getExtrait(500); ?></p>
					</div>	
				</div>
			<?php endforeach; ?>
		</div>
	</div>