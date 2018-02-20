<div class="content">
	<div class="row book">
		
		<div class="col-sm-3">
			<?php if($photo): ?>
			<div class="book-cover">
				<a href="<?= $photo; ?>"><img src="<?= $photo; ?>" class="thumbnail cover" alt=""></a>
			</div>
			<?php endif; ?>
			<div class="principal">
				<div class="title_cat">
					<h3>Les categories :</h3>
				</div>
				<table class="table table-cat">
					<?php foreach($categories as $category): ?>
					<tr>
						<td><a href="<?= $category->getUrl(); ?>"><?= $category->title; ?></a></td>		
					</tr>
					<?php endforeach; ?>
				</table>
			</div>
		</div>


		<div class="col-sm-9">
			<div class="content-book">
				<h1 class="title"><?= $book->title; ?></h1>
				<p class="info"><em><?= $book->category; ?></em> | <em><?= $book->getDate($dateFormat); ?></em></p>

				<div class="item"><?= $book->content; ?></div>		
			</div>
			<div class="chapters">
				<h3>Les chapitres</h3>
				<table class="table table-striped">
					<tbody>							
						<?php $num = 1; foreach($chapters as $chapter): ?>
						<tr>
							<td>Chapitre <?= $num ++; ?> :</td>
							<td><a href="<?= $chapter->getUrl(); ?>"><?= $chapter->chapter_title; ?></a></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>