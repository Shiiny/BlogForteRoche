<?php require('../view/admin/menu.php'); ?>
	<h1>Dernier utilisateur inscrit</h1>

		<table class="table">
			<thead>
				<tr>
					<td>ID</td>
					<td>Username</td>
					<td>E-mail</td>
					<td>Date d'inscription</td>
				</tr>
			</thead>
			<tbody>
					<tr>
						<td><?= $users->id; ?></td>
						<td><?= $users->username; ?></td>
						<td><?= $users->email; ?></td>
						<td><?= $users->confirmed_at; ?></td>		
					</tr>
			</tbody>
		</table>
	</div><!-- /adminbody -->