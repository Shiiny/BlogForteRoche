<h1>Se connecter</h1>

<form method="post" action="">
	<?= $form->input('username', 'Pseudo ou Email'); ?>
	<?= $form->input('password', 'Mot de passe', ['type' => 'password'], 'index.php?p=users.forget'); ?>
	<?= $form->input('remember', 'Se souvenir de moi', ['type' => 'checkbox', 'value' => '1']); ?>

	<button type="submit" class="btn btn-primary">Connexion</button>
</form>