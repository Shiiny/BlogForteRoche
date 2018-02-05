<?php require('../view/admin/menu.php'); ?>

	<h1>Administrer les utilisateurs</h1>
	
		<table class="table">
			<thead>
				<tr>
					<td>ID</td>
					<td>Username</td>
					<td>Rang</td>
					<td>E-mail</td>
					<td>Date d'inscription</td>
					<td>action</td>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($users as $user): ?>
					<tr>
						<td><?= $user->id; ?></td>
						<td><?= $user->username; ?></td>
						<td><a id="tag" href="?p=admin.users.rang&id=<?= $user->id; ?>"><?= $user->rang; ?></a>
						<td><?= $user->email; ?></td>
						<td><?= $user->date_at; ?></td>
						<td>
							<form action="?p=admin.users.delete" method="post" style="display: inline;">
								<input type="hidden" name="id" value="<?= $user->id; ?>">
								<button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
							</form>
						</td>		
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div><!-- /adminbody -->