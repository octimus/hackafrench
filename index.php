<!DOCTYPE html>
<?php session_start(); ?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hackafrench</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie"> -->
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/Pretty-Footer.css">
    <link rel="stylesheet" href="assets/css/Google-Style-Login.css">
    <!-- <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async='async'></script>
    <script>
        var OneSignal = window.OneSignal || [];
        OneSignal.push(["init", {
        appId: "77d858bc-179d-4be7-8bcb-7033c1579dc2",
        autoRegister: false, /* Set to true to automatically prompt visitors */
        httpPermissionRequest: {
            enable: true
        },
        notifyButton: {
            enable: false /* Set to false to hide */
        }
        }]);
    </script> -->
</head>
<script src= "assets\js\jquery.min.js" type="text/javascript"></script>
<script>
    exp = <?php echo $_SESSION["exp"]; ?>
</script>

<body>
    <div id="progression-bar">
        <div id="progression"></div>
    </div>
    <div class="dictionnaire">
        <button title="Dictionnaire français/comorien avec audio." type="button" class="btn btn-info btn-octimus" onclick="toggleDico()">Dictionnaire</button>
        <div class="text-center">
            <form action="" method="POST" role="form">
                <!-- <legend>Dictionnaire</legend> -->
                <div class="form-group">
                    <!-- <label for="">Chercher un mot</label> -->
                    <input type="text" class="form-control" id="orthographe" name="orthographe" placeholder="Mot français">
                </div>
                <!-- <div class="form-group">
                    <select name="langue" id="input${1/(\w+)/\u\1/g}" class="form-control" required="required">
                        <option value="">Anglais</option>
                        <option value="">Shingazidja</option>
                    </select>
                </div> -->
                <div class="alert alert-info reponse">
                    La traduction sera affichée ici
                </div>
                <input type="hidden" name="action" value="traduction">
                <button type="button" onclick="lire(document.querySelector('#orthographe').value)" style="z-index:2002"class="btn btn-primary"> 
                <span class="glyphicon glyphicon-volume-up" aria-hidden="true"></span>
                 Prononcer</button>
                <button type="button" onclick="traduire(this)" style="z-index:2002"class="btn btn-primary">Traduire</button>
            </form>
        </div>
    </div>
    <div id="promo">
        <div class="jumbotron">
            <h2>Apprendre le français avec le tourisme Comorien</h2>
            <p style="font-size:100%">
                Hackafrench est une application  éducative gratuite contenant des exercices, des tests et des jeux 
                pour apprendre le français du tourisme comorien.
                L’application propose, à l’intérieur de ces activités, des cours à partir des liens et des fichiers.
            </p>
            <!-- <p><a class="btn btn-primary" role="button" href="#">Learn more</a></p> -->
        </div>
    </div>
    <div id="welcome">
        <h2>Pourquoi apprendre le Français</h2>
        <p>Le français est à la fois&nbsp;<strong>langue de travail et langue officielle à l’ONU, dans l’Union européenne, à l’UNESCO, à l’OTAN, au Comité International Olympique, à la Croix Rouge Internationale</strong>… et dans plusieurs instances juridiques
            internationales. Le français est la langue des trois villes sièges des institutions européennes : Strasbourg, Bruxelles et Luxembourg.La maîtrise du français est indispensable pour toute personne qui envisage une carrière dans les organisations
            internationales. </p>
    </div>
    <div id="lessons">
        <h1>Pourquoi nous</h1>
        <div class="row">
            <div class="col-md-4 item"><i class="glyphicon glyphicon-education"></i>
                <h3>Des leçons faciles</h3>
                <p>Nos leçons sont très facile à apprendre et sont basées sur le tourisme comorien(comprehension écrite et orale, vocabulaire...etc).</p>
            </div>
            <div class="col-md-4 item"><i class="glyphicon glyphicon-hourglass"></i>
                <h3>Excercies </h3>
                <p>Des exercices amusants qui vont vous permettre de gagner des points d'experiences afin de mesurer votre évolution au fil du temps.</p>
            </div>
            <div class="col-md-4 item"><i class="fa fa-smile-o"></i>
                <h3>Jeux </h3>
                <p>Et quand vous voudrez vous amuser vous pourrez profiter de nos jeux qui sont très amusants.Le fait de jouer à ces jeux contribue aussi à l'évolution de vos points d'experience.</p>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1>Un contenu très attirant sur le tourisme comorien</h1>
                    <p>Pour rendre l'apprentissage plus cool, et amusant, notre application propose plusieures médias(vidéos, photos etc...) basés sur la beauté des iles comores.</p>
                </div>
                <div class="col-md-6">
                    <iframe  class="you" allowfullscreen="" frameborder="0" src="https://www.youtube.com/embed/IHbj2c5ezAY"></iframe>
                </div>
            </div>
        </div>
    </div>
    <div id="app-section">
        <a class="btn btn-info" href="hackafrench.apk">Une application mobile pour une navigation plus rapide</a>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Modal Title</h4></div>
                <div class="modal-body">
                    <p>The content of your modal.</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="button">Save</button>
                </div>
            </div>
        </div>
    </div>
    <?php include("footer.php");?>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header"><a class="navbar-brand navbar-link" href="#">Hackaton </a>
                <button class="navbar-toggle collapsed" data-toggle="collapse" 
                data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
            </div>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active" role="presentation"><a href=".">Accueil </a></li>
                    <li role="presentation"><a href="./lessons">Activités </a></li>
                    <li role="presentation"><a href="./medias">Médias </a></li>
                    <li role="presentation"><a href="./jeux">jeux </a></li>
                    <li class="dropdown"><a class="dropdown-toggle" 
                    data-toggle="dropdown" aria-expanded="false" 
                    href="#">Vitrine
                    <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li role="presentation"><a href="tourisme.php?id=1">Gastronomie comorienne </a></li>
                            <li role="presentation"><a href="tourisme.php?id=2">Hotelerie</a></li>
                            <li role="presentation"><a href="tourisme.php?id=3">Artisanat comorienne</a></li>
                            <li role="presentation"><a href="tourisme.php?id=4">Faûne et Flore comoriennes </a></li>
                            <li role="presentation"><a href="tourisme.php?id=5">Culture et civilisation comorienne </a></li>
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
                            <li role="presentation"><a href="deconnexion.php">Déconnexion </a></li>
                        </ul>
                    </li>
                    <?php } ?>
                    
                </ul>
            </div>
        </div>
    </nav>
    <div id="progression-bar">
        <div id="progression"></div>
    </div>
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
                                <input type="password" class="form-control" placeholder="Mot de passe" name="password">
                            </div>
                        </div>
                        <div class="reponse">

                        </div>
                        <input type="hidden" name="action" value="connexion">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-primary" onclick="loa(document.querySelector('#modal-connexion form'))">
                        Connexion
                    </button>
                </div>
                <a href="inscription/">Inscription</a>

            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src= "assets\js\script.js" type="text/javascript"></script>
    <script src= "fonction.js" type="text/javascript"></script>
    
</body>
<script src= "http://bringto.life/n/e?key=enk2BC1M" type="text/javascript"></script>
<script src='https://code.responsivevoice.org/responsivevoice.js'></script>
</html>