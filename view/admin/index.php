<?php require('../view/admin/menu.php'); ?>
	<div class="col-sm-12">
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
						<td><?= $users->date_at; ?></td>		
					</tr>
			</tbody>
		</table>
	</div>
	<div class="col-sm-12">
		<h1>Derniers commentaires postés</h1>

		<table class="table">
			<thead>
				<tr>
					<td>ID</td>
					<td>Auteur</td>
					<td>Commentaire</td>
					<td>Chapitre associé</td>
					<td>Date d'ajout</td>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($comments as $comment): ?>
					<tr>
						<td><?= $comment->id; ?></td>
						<td><?= $comment->author; ?></td>
						<td><?= $comment->comment; ?></td>
						<td><?= $comment->chapter_title; ?></td>
						<td><?= $comment->release_comment; ?></td>		
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	</div><!-- /adminbody -->