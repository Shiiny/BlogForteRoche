<?php require('../view/admin/menu.php'); ?>
	<h1>Administrer les reports</h1>
	

	<table class="table">
		<thead>
			<tr>
				<td>Utilisateur</td>
				<td>Date du report</td>
				<td>Actions</td>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($reports as $report): ?>
			<tr class="report">
				<td><?= $report->author_report; ?></td>
				<td class="item-info"><?= $report->report_release; ?></td>
				<td>
					<a href="?p=admin.comments.edit&id=<?= $report->comment_id; ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a>
					<form action="?p=admin.reports.delete" method="post" style="display: inline;">
						<input type="hidden" name="id" value="<?= $report->id; ?>">
						<button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
					</form>
				</td>			
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div><!-- /adminbody -->