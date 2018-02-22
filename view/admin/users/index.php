<?php require('../view/admin/menu.php'); ?>
	<div class="row">
		<div class="col-sm-12">
			<div class="list-group">
				<h2 class="list-group-item item-title">Administrer les utilisateurs</h2>
				<div class="list-group-item">
					<table class="table table-striped">
						<thead>
							<tr>
								<td class="user_id">ID</td>
								<td class="user_name">Username</td>
								<td class="user_rang">Rang</td>
								<td class="user_email">E-mail</td>
								<td class="user_date">Date d'inscription</td>
								<td class="user_action">action</td>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($users as $user): ?>
								<tr>
									<td class="id_item"><?= $user->id; ?></td>
									<td class="user_item"><?= $user->username; ?></td>
									<td class="rang_item"><a class="btn btn-warning" href="?p=admin.users.rang&id=<?= $user->id; ?>"><?= $user->rang; ?></a>
									<td class="email_item"><a href="mailto:<?= $user->email; ?>"><?= $user->email; ?></a></td>
									<td class="date_item"><?= $user->date_at; ?></td>
									<td class="action_item">
										<form action="?p=admin.users.delete" method="post" style="display: inline;">
											<input type="hidden" name="id" value="<?= $user->id; ?>">
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
								<?php if(isset($_GET['userPage']) && $i == $_GET['userPage']): ?>
									<a class="active" href="index.php?p=admin.users.index&userPage=<?= $i; ?>"><?= $i; ?></a>
								<?php else: ?>
									<a href="index.php?p=admin.users.index&userPage=<?= $i; ?>"><?= $i; ?></a>
								<?php endif; ?>
						<?php endfor; endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div><!-- /adminbody -->
</div><!-- /row -->