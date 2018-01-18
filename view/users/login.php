<?php

if(!empty($_POST)) {
	$auth = new blog\Auth\DBAuth(App::getInstance()->getDb());
	if($auth->login($_POST['username'], $_POST['password'])) {
		header('Location: admin.php');
	}
	else{
		?>
		<div class="alert alert-danger">Identifiant incorrect</div>
		<?php
	}

}

$form = new blog\BootstrapForm($_POST);
?>

<form method="post" action="">
	<?= $form->input('username', 'Pseudo'); ?>
	<?= $form->input('password', 'Mot de passe', ['type' => 'password']); ?>
	<?= $form->submit(); ?>


</form>