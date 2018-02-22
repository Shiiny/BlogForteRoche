<div class="row">
	<div class="col-sm-8">
		<h1>Réinitialiser mon mot de passe</h1>

		<form action="" method="post">
			<?= $form->input('password', 'Mot de passe', ['type' => 'password']); ?>
			<?= $form->input('password_confirm', 'Confirmation du mot de passe', ['type' => 'password']); ?>
			<button type="submit" class="btn btn-primary">Réinitialiser mon mot de passe</button>
		</form>		
	</div>
</div>
