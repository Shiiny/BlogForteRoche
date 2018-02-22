<?php require('../view/admin/menu.php'); ?>
	<div class="row">
		<div class="col-sm-12">
			<div><a href="?p=admin.chapters.add" class="btn btn-success">Ajouter</a></div>
			<div class="list-group">
				<h2 class="list-group-item item-title">Administrer les chapitres</h2>
				
				<div class="list-group-item">
					<table class="table table-striped">
						<thead>
							<tr>
								<td class="id">ID</td>
								<td class="title">Titre</td>
								<td class="book">Livre</td>
								<td class="date">Dernière modification</td>
								<td class="action">Actions</td>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($chapters as $chapter): ?>
								<tr>
									<td class="id_item"><?= $chapter->id; ?></td>
									<td class="title_item"><?= $chapter->chapter_title; ?></td>
									<td class="book_item"><?= $chapter->title; ?></td>
									<td class="date_item"><?= $chapter->chapter_release; ?></td>
									<td class="action_item">
										<a href="<?= $chapter->getUrl(); ?>" class="btn-default"><i class="fas fa-eye" aria-hidden="true"></i></a>
										<a href="?p=admin.chapters.edit&id=<?= $chapter->id; ?>" class="btn btn-primary"><i class="fas fa-edit" aria-hidden="true"></i></a>
										<form action="?p=admin.chapters.delete" method="post" style="display: inline;">
											<input type="hidden" name="id" value="<?= $chapter->id; ?>">
											<button type="submit" class="btn btn-danger"><i class="fas fa-trash" aria-hidden="true"></i></button>
										</form>
									</td>			
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					<div class="paginate">
						<?php if($nbPage > 1): ?>
							<?php for($i = 1; $i <= $nbPage; $i++): ?>
								<?php if(isset($_GET['page']) && $i == $_GET['page']): ?>
									<a class="active" href="index.php?p=admin.chapters.index&page=<?= $i; ?>"><?= $i; ?></a>
								<?php else: ?>
									<a href="index.php?p=admin.chapters.index&page=<?= $i; ?>"><?= $i; ?></a>
								<?php endif; ?>
						<?php endfor; endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div><!-- /adminbody -->
</div><!-- /row -->