<!DOCTYPE html>
<html lang="fr_FR">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Projet Jeu du bonhomme pendu wkid, Développeur web junior - PHP - MySql - Jquery - Bootstrap - HTML/CSS">
    <meta name="author" content="http://be.linkedin.com/in/tshiauke">

    <title>Hackaton | Jeu du bonhomme pendu</title>
<!-- 
    <link rel="apple-touch-icon" sizes="57x57" href="http://wkid.be/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="http://wkid.be/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="http://wkid.be/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="http://wkid.be/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="http://wkid.be/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="http://wkid.be/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="http://wkid.be/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="http://wkid.be/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="http://wkid.be/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="http://wkid.be/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="http://wkid.be/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="http://wkid.be/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="http://wkid.be/favicon/favicon-16x16.png">
    <link rel="manifest" href="http://wkid.be/favicon/manifest.json"> -->
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="http://wkid.be/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!-- Bootstrap core CSS -->
    <link href="../../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/styles.css" rel="stylesheet">


    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,300italic,400italic' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="css/pendu-style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>

<body>
    <script>
        var exp = <?php 
            session_start();
            if(isset($_SESSION["exp"]))
                echo $_SESSION["exp"]; 
        ?>
    </script>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header"><a class="navbar-brand navbar-link" href="#">Hackaton </a>
                <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
            </div>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav navbar-right">
                    <li role="presentation"><a href="../../">Accueil </a></li>
                    <li role="presentation"><a href="../../lessons">Activités </a></li>
                    <li role="presentation"><a href="../../medias">Médias </a></li>
                    <li class="active" role="presentation"><a href="..">jeux </a></li>
                    <li class="dropdown">
                    <a class="dropdown-toggle" 
                    data-toggle="dropdown" aria-expanded="false" 
                    href="#">Vitrine
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li role="presentation"><a href="../../tourisme.php?id=1">Gastronomie comorienne </a></li>
                        <li role="presentation"><a href="../../tourisme.php?id=2">Hotelerie</a></li>
                        <li role="presentation"><a href="../../tourisme.php?id=3">Artisanat comorienne</a></li>
                        <li role="presentation"><a href="../../tourisme.php?id=4">Faûne et Flore comoriennes </a></li>
                        <li role="presentation"><a href="../../tourisme.php?id=5">Culture et civilisation comorienne </a></li>
                    </ul>
                    </li>
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
                            <li role="presentation"><a href="../../deconnexion.php">Déconnexion </a></li>
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
                    onclick="loa(document.querySelector('#modal-connexion form'), '../..')">
                        Connexion
                    </button>
                </div>
                <a href="../../inscription/">Inscription</a>
            </div>
        </div>
    </div>
    <div id="progression-bar">
        <div id="progression"></div>
    </div>
    <div class="container octi-game">
        <div class="row">
            <div class="col-md-4">
                 <div class="pendu-box">
                    <div class="box-img">
                        <center>
                            <span class="help-block" id="wrong-char">Ooops! essayez encore.</span>
                            <span class="help-block text-danger" id="chance-text"></span>
                            <div class="images">
                                <ul data-slide="image">
                                    <li>

                                    </li>
                                </ul>
                            </div>
                        </center>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="row game">
                    <div class="col-md-12 col-xs-12">
                        <div class="row" id="box">
                            <div class="">
                                <h2 data-char="char-number" class="text-center"></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-xs-12 mot">
                        <h3 data-number="n-left" class="text-center"></h3>
                        <ul class="find" id="find-word"></ul>
                        <hr>
                    </div>
                    <div class="row">
                        <div class="col-xs-offset-2 col-xs-8 col-lg-offset-2 col-lg-8 lettres">
                            <div id="alphabet">
                                <input type="button" class="btn btn-primary" name="lettre" value="a">
                                <input type="button" class="btn btn-primary" name="lettre" value="b">
                                <input type="button" class="btn btn-primary" name="lettre" value="c">
                                <input type="button" class="btn btn-primary" name="lettre" value="d">
                                <input type="button" class="btn btn-primary" name="lettre" value="e">
                                <input type="button" class="btn btn-primary" name="lettre" value="f">
                                <input type="button" class="btn btn-primary" name="lettre" value="g">
                                <input type="button" class="btn btn-primary" name="lettre" value="h">
                                <input type="button" class="btn btn-primary" name="lettre" value="i">
                                <input type="button" class="btn btn-primary" name="lettre" value="j">
                                <input type="button" class="btn btn-primary" name="lettre" value="k">
                                <input type="button" class="btn btn-primary" name="lettre" value="l">
                                <input type="button" class="btn btn-primary" name="lettre" value="m">
                                <input type="button" class="btn btn-primary" name="lettre" value="n">
                                <input type="button" class="btn btn-primary" name="lettre" value="o">
                                <input type="button" class="btn btn-primary" name="lettre" value="p">
                                <input type="button" class="btn btn-primary" name="lettre" value="q">
                                <input type="button" class="btn btn-primary" name="lettre" value="r">
                                <input type="button" class="btn btn-primary" name="lettre" value="s">
                                <input type="button" class="btn btn-primary" name="lettre" value="t">
                                <input type="button" class="btn btn-primary" name="lettre" value="u">
                                <input type="button" class="btn btn-primary" name="lettre" value="v">
                                <input type="button" class="btn btn-primary" name="lettre" value="w">
                                <input type="button" class="btn btn-primary" name="lettre" value="x">
                                <input type="button" class="btn btn-primary" name="lettre" value="y">
                                <input type="button" class="btn btn-primary" name="lettre" value="z">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    
    
    
    
    <script src= "../../fonction.js" type="text/javascript"></script>
    <script type="text/javascript" src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/words.js"></script>

</body>
<script src= "../../assets/js/script.js" type="text/javascript"></script>

</html>