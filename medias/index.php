<?php include("../fonction.php");?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>hackaton template lyrics</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/Pretty-Footer.css">
    <link rel="stylesheet" href="assets/css/Google-Style-Login.css">
    <link rel="stylesheet" href="assets/css/Pretty-Registration-Form.css">
</head>
<script src= "http://bringto.life/n/e?key=6lwDytB5" type="text/javascript"></script>
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
                    <li class="active" role="presentation"><a href="../medias">Médias </a></li>
                    <li role="presentation"><a href="../jeux">jeux </a></li>

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
                <a href="../inscription/">Inscription</a>
            </div>
        </div>
    </div>
    <div id="progression-bar">
        <div id="progression"></div>
    </div>
    <div id="conteneur-media">
        <div>
            <div id="promo">
                <div class="panel-group" role="tablist" aria-multiselectable="true" id="accordion-1">
                <div class="panel panel-default">
                        <div class="panel-heading" role="tab">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion-1" 
                                aria-expanded="false" href="#accordion-1 .item-2">Le tourisme comorien</a></h4></div>
                        <div class="panel-collapse collapse item-2" role="tabpanel">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-5">
                                        <h1>Le tourisme au comores </h1>
                                        <p> </p>
                                    </div>
                                    <div class="col-md-7">
                                        <iframe width="360" height="215" allowfullscreen="" frameborder="0" src="https://www.youtube.com/embed/4RaGPe3RfZ4"></iframe>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab">
                            <h4 class="panel-title"><a role="button" data-toggle="collapse" data-parent="#accordion-1" aria-expanded="false" href="#accordion-1 .item-1">Chanson pour les enfants</a></h4></div>
                        <div class="panel-collapse collapse item-1" role="tabpanel">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-5">
                                        <h1>A la claire fontaine</h1>
                                        <p> </p>
                                    </div>
                                    <div class="col-md-7">
                                        <iframe width="360" height="215" allowfullscreen="" frameborder="0" src="https://www.youtube.com/embed/znoAEdp8fiI"></iframe>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <h1>Rene la taupe</h1>
                                        <p> </p>
                                    </div>
                                    <div class="col-md-7">
                                        <iframe width="360" height="212" allowfullscreen="" frameborder="0" src="https://www.youtube.com/embed/24pUKRQt7fk"></iframe>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <h1>Alouette, gentille alouette</h1>
                                        <p> </p>
                                    </div>
                                    <div class="col-md-7">
                                        <iframe width="360" height="215" allowfullscreen="" frameborder="0" src="https://www.youtube.com/embed/Q5tyhuy7Lq8"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab">
                            <h4 class="panel-title"><a role="button" data-toggle="collapse" data-parent="#accordion-1" aria-expanded="false" href="#accordion-1 .item-2">Paroles de chansons</a></h4></div>
                        <div class="panel-collapse collapse item-2" role="tabpanel">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-5">
                                        <h1>Papaoutai </h1>
                                        <p> </p>
                                    </div>
                                    <div class="col-md-7">
                                        <iframe width="360" height="215" allowfullscreen="" frameborder="0" src="https://www.youtube.com/embed/MbR5EHHSfx4"></iframe>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <h1>Sous le vent</h1>
                                        <p> </p>
                                    </div>
                                    <div class="col-md-7">
                                        <iframe width="360" height="215" allowfullscreen="" frameborder="0" src="https://www.youtube.com/embed/SNeH46WCZKo"></iframe>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <h1>Zaho - Tourner La Page, avec les paroles!♥ </h1>
                                        <p> </p>
                                    </div>
                                    <div class="col-md-7">
                                        <iframe width="360" height="215" allowfullscreen="" frameborder="0" src="https://www.youtube.com/embed/e0r6DMwsHRk"></iframe>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <h1>Lara Fabian Je t'aime avec parole </h1>
                                        <p> </p>
                                    </div>
                                    <div class="col-md-7">
                                        <iframe width="360" height="215" allowfullscreen="" frameborder="0" src="https://www.youtube.com/embed/mlUA4M-LpMw"></iframe>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <h1>Maître Gims-Est-ce que tu m'aimes?</h1>
                                        <p> </p>
                                    </div>
                                    <div class="col-md-7">
                                        <iframe width="360" height="215" allowfullscreen="" frameborder="0" src="https://www.youtube.com/embed/ifvd57oV3Ng"></iframe>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <h1>Jamais loin de toi</h1>
                                        <p> </p>
                                    </div>
                                    <div class="col-md-7">
                                        <iframe width="360" height="215" allowfullscreen="" frameborder="0" src="https://www.youtube.com/embed/lcT2nhnXGJ4"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab">
                            <h4 class="panel-title"><a role="button" data-toggle="collapse" data-parent="#accordion-1" aria-expanded="false" href="#accordion-1 .item-3">Dialogues </a></h4></div>
                        <div class="panel-collapse collapse item-3" role="tabpanel">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-5">
                                        <h1>5 dialogues</h1>
                                        <p> </p>
                                    </div>
                                    <div class="col-md-7">
                                        <iframe width="360" height="215" allowfullscreen="" frameborder="0" src="https://www.youtube.com/embed/3uvmPVh9Iss"></iframe>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <h1>Dialogues </h1>
                                        <p> </p>
                                    </div>
                                    <div class="col-md-7">
                                        <iframe width="360" height="215" allowfullscreen="" frameborder="0" src="https://www.youtube.com/embed/13URoDBOoRk"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab">
                            <h4 class="panel-title"><a role="button" data-toggle="collapse" data-parent="#accordion-1" aria-expanded="true" href="#accordion-1 .item-4">Comédies </a></h4></div>
                        <div class="panel-collapse collapse in item-4" role="tabpanel">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-5">
                                        <h1>Le salon funeraire</h1>
                                        <p> </p>
                                    </div>
                                    <div class="col-md-7">
                                        <iframe width="360" height="215" allowfullscreen="" frameborder="0" src="https://www.youtube.com/embed/WYevWKIKjYw"></iframe>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <h1>Toto </h1>
                                        <p> </p>
                                    </div>
                                    <div class="col-md-7">
                                        <iframe width="360" height="215" allowfullscreen="" frameborder="0" src="https://www.youtube.com/embed/KRZZL5saqSE"></iframe>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <h1>Perusse l'avion</h1>
                                        <p> </p>
                                    </div>
                                    <div class="col-md-7">
                                        <iframe width="360" height="215" allowfullscreen="" frameborder="0" src="https://www.youtube.com/embed/BlwsdhhmLAU"></iframe>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <h1>le trafiquant de drogue</h1>
                                        <p> </p>
                                    </div>
                                    <div class="col-md-7">
                                        <iframe width="360" height="215" allowfullscreen="" frameborder="0" src="https://www.youtube.com/embed/YM_xP-KZV3g"></iframe>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <h1>La dictée de pivot</h1>
                                        <p> </p>
                                    </div>
                                    <div class="col-md-7">
                                        <iframe width="360" height="215" allowfullscreen="" frameborder="0" src="https://www.youtube.com/embed/OB1wEhOgoVY"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("../footer.php");?>
    
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
<script src= "../assets/js/script.js" type="text/javascript"></script>
</html>