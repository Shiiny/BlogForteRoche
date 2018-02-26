<?php require('../view/admin/menu.php'); ?>
	<div class="row">
		<div class="col-sm-12">
			<div><a href="?p=admin.comments.add" class="btn btn-success">Ajouter</a></div>
			<div class="list-group">
				<h2 class="list-group-item item-title">Administrer les commentaires</h2>

				<div class="list-group-item">
					<table class="table table-striped">
						<thead>
							<tr>
								<td class="author">Auteur</td>
								<td class="comment">Commentaire</td>
								<td class="date">Dernière modification</td>
								<td class="report">Report</td>
								<td class="chapter">Chapitre associé</td>
								<td class="action">Actions</td>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($comments as $comment): ?>
								<?php if($comment->report > 0): ?>
								<tr class="danger report comment">
								<?php else: ?>
								<tr class="comment">
								<?php endif; ?>
									<td class="author_item"><?= $comment->author; ?></td>
									<td class="comment_item"><?= $comment->getExtrait(50); ?></td>
									<td class="date_item"><?= $comment->comment_date; ?></td>
									<td class="report_item">
										<?php if($comment->report > 0): ?>
										<a class="btn btn-warning" href="?p=admin.reports.index&id=<?= $comment->id; ?>"><?= $comment->report; ?></a>
										<?php endif; ?>
									</td>
									<td class="chapter_item"><?= $comment->chapter_title; ?></td>
									<td class="action_item_comment">
										<a href="?p=admin.comments.edit&id=<?= $comment->id; ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a>
										<form action="?p=admin.comments.delete" method="post" style="display: inline;">
											<input type="hidden" name="id" value="<?= $comment->id; ?>">
											<button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
									<a class="active" href="index.php?p=admin.comments.index&page=<?= $i; ?>"><?= $i; ?></a>
								<?php else: ?>
									<a href="index.php?p=admin.comments.index&page=<?= $i; ?>"><?= $i; ?></a>
								<?php endif; ?>
						<?php endfor; endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div><!-- /adminbody -->
</div><!-- /row -->