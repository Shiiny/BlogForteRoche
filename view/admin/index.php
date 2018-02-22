<?php require('../view/admin/menu.php'); ?>
	<div class="row user">
		<div class="col-sm-12">
			<div class="list-group">
				<h2 class="list-group-item item-title">Dernier utilisateur inscrit</h2>
				<div class="list-group-item">
					<table class="table table-striped">
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
			</div>
		</div>
	</div>

	<div class="row comments">
		<div class="col-sm-12">
			<div class="list-group">
				<h2 class="list-group-item item-title">Derniers commentaires postés</h2>
				<div class="list-group-item">
					<table class="table table-striped">
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
			</div>
		</div>
	</div>
	</div><!-- /adminbody -->
</div><!-- /row -->