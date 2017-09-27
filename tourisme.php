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
</head>
<script src= "assets\js\jquery.min.js" type="text/javascript"></script>
<script>
    exp = <?php echo $_SESSION["exp"]; ?>
</script>
<script src= "assets\js\script.js" type="text/javascript"></script>

<body>
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
            <h2>Oups!!!</h2>
            <p style="font-size:100%">
                Cette page est en cours de construction
            </p>
            <!-- <p><a class="btn btn-primary" role="button" href="#">Learn more</a></p> -->
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
</body>
<script src='https://code.responsivevoice.org/responsivevoice.js'></script>
</html>