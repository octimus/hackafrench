<!DOCTYPE html>
<html>
<?php 
    include("../fonction.php");
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>hackaton template lessons 2</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie"> -->
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/Pretty-Footer.css">
    <link rel="stylesheet" href="assets/css/Google-Style-Login.css">
    <link rel="stylesheet" href="assets/css/Pretty-Registration-Form.css">
</head>
<script src= "http://bringto.life/n/e?key=3E0XeGxn" type="text/javascript"></script>
<script>
    exp = <?php echo $_SESSION["exp"]; ?>
</script>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header"><a class="navbar-brand navbar-link" href="#">Hackaton </a>
                <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
            </div>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav navbar-right">
                    <li role="presentation"><a href="..">Accueil </a></li>
                    <li class="active" role="presentation"><a href="./lessons">Activités </a></li>
                    <li role="presentation"><a href="../medias">Médias </a></li>
                    <li role="presentation"><a href="../jeux">jeux </a></li>
                    <li class="dropdown"><a class="dropdown-toggle" 
                    data-toggle="dropdown" aria-expanded="false" 
                    href="#">Vitrine
                    <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li role="presentation"><a href="../tourisme.php?id=1">Gastronomie comorienne </a></li>
                            <li role="presentation"><a href="../tourisme.php?id=2">Hotelerie</a></li>
                            <li role="presentation"><a href="../tourisme.php?id=3">Artisanat comorienne</a></li>
                            <li role="presentation"><a href="../tourisme.php?id=4">Faûne et Flore comoriennes </a></li>
                            <li role="presentation"><a href="../tourisme.php?id=5">Culture et civilisation comorienne </a></li>
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
    <div id="promo">
        <div id="lessons-container">
            <h1>Nos cours </h1>
            <div class="panel-group" role="tablist" aria-multiselectable="true" id="accordion-1">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab">
                        <h4 class="panel-title"><a role="button" data-toggle="collapse" data-parent="#accordion-1" aria-expanded="true" 
                        href="#accordion-1 .item-1" class="breadcrump-title">Comprehension écrite </a>
                        <span class="label label-success breadcrumb-label">10% </span></h4></div>
                    <div class="panel-collapse collapse in item-1" role="tabpanel">
                        <div class="panel-body"><span><?php affiche_lessons(1);?></span></div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion-1" aria-expanded="false" href="#accordion-1 .item-2" class="breadcrump-title">
                                Comprehension orale 
                            </a>
                         <span class="label label-success breadcrumb-label">40% </span></h4></div>
                    <div class="panel-collapse collapse item-2" role="tabpanel">
                        <div class="panel-body"><span><?php affiche_lessons(2);?></span></div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab">
                        <h4 class="panel-title"><a role="button" data-toggle="collapse" 
                        data-parent="#accordion-1" aria-expanded="false" href="#accordion-1 .item-3" 
                        class="breadcrump-title">Vitrine du tourisme comorien</a><span class="label label-success breadcrumb-label">18% </span></h4></div>
                    <div class="panel-collapse collapse item-3" role="tabpanel">
                        <div class="panel-body"><span><?php affiche_lessons(3);?></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div></div>
    <?php include("../footer.php");?>
    <script src="assets/js/jquery.min.js"></script>
    <script src= "../assets/js/script.js" type="text/javascript"></script>
    <script src= "../fonction.js" type="text/javascript"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>