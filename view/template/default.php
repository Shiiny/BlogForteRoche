<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?= App::getInstance()->getTitle() ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"
    integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
    crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>


    <!-- Le styles -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="../public/css/style.css" type="text/css">
  <!--<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>-->
  <script src="../public/js/tinymce/tinymce.min.js"></script>
  <script src="../public/js/langs/fr_FR.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
  
  </head>

  <body>
    <header>
    <?php if(empty($_GET)): ?>
      <img src="../public/images/alaska.jpg" alt="alaska">
      <div class="intro">
        <div class="container">
          <h1>Bienvenue sur le blog de Jean Forteroche</h1>
          <p>Vous pourrez consulter ses derniers romans chapitre par chapitre mais aussi échanger ou juste laisser un message via les commentaires</p>
        </div>
      </div>
    <?php else: ?>
      <img src="../public/images/banner_alaska.jpg" alt="alaska">   
    <?php endif; ?>
    </header>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">          
        <div class="burger"></div>
        <div class="navbar-header">
          <a class="navbar-brand" href="index.php">Blog Jean Forteroche</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="?p=books.index">Les romans</a></li>
          </ul>
          <ul class="nav auth navbar-nav">
            <?php if(App::getInstance()->getAuth()->logged()): ?>
              <?php if(App::getInstance()->getSession()->getAllow('slug', 'admin')): ?>
                <li><a href="?p=admin.index">Admin</a></li>
              <?php endif; ?>
              <li><a href="?p=users.account">Mon compte</a></li>
              <li><a href="?p=users.logout"><i class="fas fa-sign-out-alt"></i> Déconnexion</a></li>  
            <?php else: ?>
            <li class="active"><a href="index.php?p=users.register">S'inscrire</a></li>  
            <li><a href="?p=users.login"><i class="fas fa-sign-out-alt"></i> Connexion</a></li>
            <?php endif; ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
      <?php if(App::getInstance()->getSession()->read('flash')): ?>
        <?php foreach (App::getInstance()->getSession()->getFlashes() as $type => $msg): ?>
          <div class="alert alert-<?= $type; ?>">
            <?= $msg; ?>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
        <?= $content; ?>
    </div> <!-- /container -->

    <?php if(empty($_GET) || strpos($_GET['p'], 'admin') !== 0): ?>
      <?php require('../view/template/footer.php'); ?>
    <?php endif; ?>
    
    <script src="../public/js/app.js"></script>
  </body>
</html>
