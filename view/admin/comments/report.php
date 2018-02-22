<?php require('../view/admin/menu.php'); ?>
	<div class="row">
		<div class="col-sm-12">
			<div class="list-group">
				<h2 class="list-group-item item-title">Administrer les reports</h2>
				<div class="list-group-item">
					<table class="table table-striped">
						<thead>
							<tr>
								<td class="user">Utilisateur</td>
								<td class="date">Date du report</td>
								<td class="action">Actions</td>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($reports as $report): ?>
							<tr class="report">
								<td class="author_item"><?= $report->author_report; ?></td>
								<td class="date_item"><?= $report->report_release; ?></td>
								<td class="action_item">
									<a href="?p=admin.comments.edit&id=<?= $report->comment_id; ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a>
									<form action="?p=admin.reports.valide" method="post" style="display: inline;">
										<input type="hidden" name="id" value="<?= $report->id; ?>">
										<button type="submit" class="btn btn-success"><i class="fas fa-check"></i></button>
									</form>

									<form action="?p=admin.reports.delete" method="post" style="display: inline;">
										<input type="hidden" name="id" value="<?= $report->id; ?>">
										<button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
									</form>
								</td>			
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
			<div>
				<a href="?p=admin.comments.index"><i class="fas fa-long-arrow-alt-left"></i> Retour aux commentaires</a>
			</div>
		</div>
	</div>
	</div><!-- /adminbody -->
</div><!-- /row -->