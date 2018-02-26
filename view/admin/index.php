<?php require('../view/admin/menu.php'); ?>
	<div class="row user">
		<div class="col-sm-12">
			<div class="list-group">
				<h2 class="list-group-item item-title">Dernier utilisateur inscrit</h2>
				<div class="list-group-item">
					<table class="table table-striped user">
						<thead>
							<tr>
								<td class="id">ID</td>
								<td class="user">Username</td>
								<td class="email">E-mail</td>
								<td class="date">Date d'inscription</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="id_item"><?= $users->id; ?></td>
								<td class="user_item"><?= $users->username; ?></td>
								<td class="email_item"><?= $users->email; ?></td>
								<td class="date_item"><?= $users->date_at; ?></td>		
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
					<table class="table table-striped comment">
						<thead>
							<tr>
								<td class="id">ID</td>
								<td class="author">Auteur</td>
								<td class="comment">Commentaire</td>
								<td class="chapter">Chapitre associé</td>
								<td class="date">Date d'ajout</td>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($comments as $comment): ?>
							<tr>
								<td class="id_item"><?= $comment->id; ?></td>
								<td class="author_item"><?= $comment->author; ?></td>
								<td class="comment_item"><?= $comment->comment; ?></td>
								<td class="chapter_item"><?= $comment->chapter_title; ?></td>
								<td class="date_item"><?= $comment->release_comment; ?></td>		
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