	<h1>Administrer les utilisateurs</h1>

	
		<table class="table">
			<thead>
				<tr>
					<td>ID</td>
					<td>Rôle</td>
					<td>Username</td>
					<td>E-mail</td>
					<td>Date d'inscription</td>
					<td>action</td>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($users as $user): ?>
					<tr>
						<td><?= $user->id; ?></td>
						<td><?= $user->rang; ?></td>
						<td><?= $user->username; ?></td>
						<td><?= $user->email; ?></td>
						<td><?= $user->confirmed_at; ?></td>
						<td>
							<form action="?p=admin.users.delete" method="post" style="display: inline;">
								<input type="hidden" name="id" value="<?= $user->id; ?>">
								<button type="submit" class="btn btn-danger">Supprimer</button>
							</form>
						</td>		
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div><!-- /adminbody -->