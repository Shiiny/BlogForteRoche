<h1>S'inscrire</h1>
<?php if(!empty($errors)): ?>
<div class="alert alert-danger" role="alert">
	<p>Vous n'avez pas rempli le formulaire correctement</p>
	<ul class="error">
	<?php foreach ($errors as $error): ?>
		<li><?= $error; ?></li>
	<?php endforeach; ?>
	</ul>

</div>
<?php endif; ?>

<form method="post" action="">
	<?= $form->input('username', 'Pseudo'); ?>
	<?= $form->input('email', 'Email'); ?>
	<?= $form->input('password', 'Mot de passe', ['type' => 'password']); ?>
	<?= $form->input('password_confirm', 'Confirmez votre mot de passe', ['type' => 'password']); ?>
	<button type="submit" class="btn btn-primary">M'inscrire</button>
</form>