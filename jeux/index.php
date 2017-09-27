<!DOCTYPE html>
<html>

<?php session_start(); ?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>hackaton template niveaux 2</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/Pretty-Footer.css">
    <link rel="stylesheet" href="assets/css/Google-Style-Login.css">
    <link rel="stylesheet" href="assets/css/Pretty-Registration-Form.css">
    <style>
        html body{
            background:url(../assets/img/bastille_resized.png);
        }
        body div#formulaire
        {
            margin-top:50px;
        }
    </style>
</head>

<body>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header"><a class="navbar-brand navbar-link" href="#">Hackaton </a>
            <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
        </div>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="nav navbar-nav navbar-right">
                <li role="presentation"><a href="..">Accueil </a></li>
                <li role="presentation"><a href="../lessons">Activités </a></li>
                <li role="presentation"><a href="../medias">Médias </a></li>
                <li class="active" role="presentation"><a href=".">jeux </a></li>

                <?php 
                    if(!isset($_SESSION["octram_id_visiteur"])){
                ?>
                <li role="presentation">
                    <a class="btn btn-primary" data-toggle="modal" href='#modal-connexion'>Connexion</a>
                </li>
                <?php } else {?>
                
                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#"><?php echo $_SESSION["nom"]; ?><span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li role="presentation"><a href="#">Mon Profile </a></li>
                        <li role="presentation"><a href="../deconnexion.php">Déconnexion </a></li>
                    </ul>
                </li>
                <?php } ?>
                
            </ul>
        </div>
    </div>
</nav>
<div class="modal fade" id="modal-connexion">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Connexion</h4>
        </div>
        <div class="modal-body">
            <form action="" method="POST" class="form-horizontal" role="form">
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="text" class="form-control" placeholder="Addresse email" name="login">
                    </div>
                </div>
                <div class="form-group">       
                    <div class="col-md-12">
                        <input type="password" class="form-control" 
                        placeholder="Mot de passe" name="password">
                    </div>
                </div>
                <div class="reponse">

                </div>
                <input type="hidden" name="action" value="connexion">
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
            <button type="button" class="btn btn-primary" 
            onclick="loa(document.querySelector('#modal-connexion form'), '..')">
                Connexion
            </button>
        </div>
        <a href="../inscription/" class="btn btn-info">Inscription</a>
    </div>
</div>
</div>
    <div id="background"></div>
    <div id="promo">
        <div id="formulaire" class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="hidden-xs hidden-sm niveau-title"> </h1></div>
            </div>
            <div class="row">
                <a href="pendu" class="col-md-5 niveau"><img src="assets/img/baby-1724295_1280.png">
                    <h2 class="niveau-title">Le jeu du pendu</h2>
                </a>
                <div class="col-md-2"></div>
                <a href="grille">
                    <div class="col-md-5 niveau"><img src="assets/img/chat.png">
                    <h2 class="niveau-title">Jeu de mot croisé</h2></div>
                </a>
            </div>
        </div>
    </div>
    <?php include("../footer.php");?>
    
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
<script src= "../assets/js/script.js" type="text/javascript"></script>
</html>