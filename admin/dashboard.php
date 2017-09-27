<?php 
	session_start();
    
	if(!isset($_SESSION["id_admin"]))
	{
        // header("Location:index.php");
    }
    include("../fonction.php");
    $bdd = connexion();
?>


<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Hackafrench | Admin</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet" />

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet" />


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

</head>

<body>
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>    
    <script src="assets/js/script.js"></script>    
    <div class="wrapper hidden-print">
        <div class="sidebar" data-color="red" data-image="assets/img/sidebar-5.jpg">

            <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="#" class="simple-text">
                    Super A
                </a>
                </div>

                <ul class="nav">
                    <li class="active">
                        <a onclick="affiche('accueil', this);">
                            <i class="pe-7s-graph"></i>
                            <p>Accueil</p>
                        </a>
                    </li>
                    <li>
                        <a onclick="affiche('cours', this);">
                            <i class="pe-7s-diamond"></i>
                            <p>cours</p>
                        </a>
                    </li>
                    <li>
                        <a onclick="affiche('exercices', this);">
                            <i class="pe-7s-way"></i>
                            <p>Quiz</p>
                        </a>
                    </li>
                    <li>
                        <a onclick="affiche('questions', this);">
                            <i class="pe-7s-cash"></i>
                            <p>Questions</p>
                        </a>
                    </li>
                    <li class="active-pro">
                        <a onclick="affiche('membres', this);">
                            <i class="pe-7s-user"></i>
                            <p>Membre</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="main-panel">
            <nav class="navbar navbar-default navbar-fixed">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                        <a class="navbar-brand" href="#" id="page_title">Accueil</a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-left">
                            <li>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-dashboard"></i>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <span>Réclamations</span>
                                    <b class="caret"></b>
                                    <span class="notification" id="compte_reclamation">0</span>
                                </a>
                                <ul class="dropdown-menu" id="reclamation_container">
                                    
                                </ul>
                            </li>
                            <li>
                                <a href="">
                                    <i class="fa fa-search"></i>
                                </a>
                            </li>
                        </ul>

                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="../deconnexion.php">
                                    Déconnexion
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div id="contenu">
                <div class="content" id="accueil">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="header">
                                        <h4 class="title">Statistiques</h4>
                                        <p class="category">Ventes et rétraits</p>
                                    </div>
                                    <div class="content">
                                        <div id="chartPreferences" class="ct-chart ct-perfect-fourth"></div>

                                        <div class="footer">
                                            <div class="legend">
                                                <label style="color:white"class="label label-danger">rétrait</label>
                                                <label style="color:black"class="label label-warning">non payé</label>
                                                <label style="color:white;"class="label label-info">payé</label>
                                            </div>
                                            <hr>
                                            <div class="stats">
                                                <i class="fa fa-clock-o"></i> Campaign sent 2 days ago
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="card">
                                    <div class="header">
                                        <h4 class="title">Niveau de concentration des élèves(en %)</h4>
                                        <p class="category">Performance par jour</p>
                                    </div>
                                    <div class="content">
                                        <div id="chartHours" class="ct-chart"></div>
                                        <div class="footer">
                                            <div class="legend">
                                                <span class="label label-info"> Sexe feminin</span>
                                                <span class="label label-danger"></i> Sexe masculin</span>
                                            </div>
                                            <hr>
                                            <div class="stats">
                                                <i class="fa fa-history"></i> Updated 3 minutes ago
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="bilan">
                    </div>
                    
                </div>
                <div class="content" style="height:auto;" id="exercices">
                    <div class="row">
                        <div class="col-md-6" id="ajout_dep">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="header">
                                                <h4 class="title">Ajouter un Quiz</h4>
                                            </div>
                                            <div class="content">
                                                <form action="action.php" onsubmit="return false;">
                                                    <input type="hidden" name="action" value="insertion_exercice" />
                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label>Titre du Quiz</label>
                                                                <input type="text" class="form-control" 
                                                                required placeholder="Nom du Commune" value="" name="dep">
                                                                <span class="help-block"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label>Description</label>
                                                                <input type="number" max=8 min=1 class="form-control" 
                                                                placeholder="Dérnier niveau" value="" name="nv_max" required>
                                                                <span class="help-block"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="btn btn-info btn-fill pull-right"
                                                    onclick="inserer(this, function(){load('exercices','#exercices table tbody');})">
                                                        Ajouter le Quiz
                                                    </button>
                                                    <div class="clearfix"></div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="table-responsive col-md-12">
                                <table class=" card table table-bordered table-condensed table-striped">
                                    <caption>
                                        <h4>Les Communes</h4>
                                    </caption>
                                    <thead>
                                        <tr>
                                            <th>Numero</th>
                                            <th>Nom</th>
                                            <th>Prix de livraison</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="content" id="questions">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="table-responsive col-md-12">
                                <table class=" card table table-bordered table-condensed table-striped">
                                    <caption>
                                        <h4>Les dernieres questions saisies</h4>
                                    </caption>
                                    <thead>
                                        <tr>
                                            <th>Question</th>
                                            <th>Exercice</th>
                                            <th>Cours</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="content " id="cours">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="table-responsive col-md-12">
                                <table class=" card table table-bordered table-condensed table-striped">
                                    <caption class="container form-horizontal">
                                        <h4 class="row">
                                            Liste des cours
                                        </h4>
                                        <a href="#ajout_cours" class="btn btn-default">Ajouter un cours</a>
                                        
                                        <div class="form-group">
                                            <label for="inputTrouveProduit" class="col-sm-2 control-label">Recherche:</label>
                                            <div class="col-sm-8">
                                                <input type="search" name="" id="inputTrouveProduit" class="form-control"
                                                 value="" required="required" title="" placeholder="Rechercher un cours"
                                                 onkeyup="loadAvecParams({action:'recherche', 
                                                 nom:this.value, champ:'cours'}, '#cours table tbody', false)">
                                            </div>
                                        </div>
                                        
                                        
                                    </caption>
                                    <thead>
                                        <tr>
                                            <th>Photo</th>
                                            <th>Titre</th>
                                            <th>Description</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid" id="ajout_cours">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="header">
                                        <h4 class="title">Ajout d'un cours</h4>
                                    </div>
                                    <div class="content">
                                        <form onsubmit="return false;" enctype="multipart/form-data"method="post">
                                            <input type="hidden" name="action" value="insertion_cours" />
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group has-feedback">
                                                        <label class="control-label" >Catégories</label>
                                                        
                                                        <select name="categorie" class="form-control" 
                                                        required="required">
                                                            <?php affiche_categories_select(); ?>
                                                        </select>
                                                        
                                                        <span class="help-block"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group has-feedback">
                                                        <label class="control-label" >Titre</label>
                                                        <input type="text" class="form-control" 
                                                        placeholder="Titre du cours" required value="" name="titre">
                                                        <span class="help-block"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group has-feedback">
                                                        <label for="exampleInputEmail1">Contenu du cours</label>
                                                        <textarea class="form-control" name="contenu" 
                                                        placeholder="Veuillez décrire le nouveau cours"></textarea>
                                                        <span class="help-block"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group has-feedback">
                                                        <label>Photo</label>
                                                        <input type="file" class="form-control" 
                                                        name="photo">
                                                        <span class="help-block"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" 
                                            onclick="inserer(this, function(){load('cours','#cours table tbody');});"
                                            class="btn btn-info btn-fill pull-right">Enregistrer</button>
                                            <div class="clearfix"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content " id="membres">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="header">
                                        <h4 class="title">Ajout d'un membre</h4>
                                    </div>
                                    <div class="content">
                                        <form onsubmit="return false;" method="post">
                                            <input type="hidden" name="action" value="insertion_membre" />
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group has-feedback">
                                                        <label class="control-label" >Nom</label>
                                                        <input type="text" class="form-control" 
                                                        placeholder="Nom" required value="" name="nom">
                                                        <span class="help-block"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group has-feedback">
                                                        <label>Prenom</label>
                                                        <input type="text" class="form-control"
                                                        name="prenom" required placeholder="Prénom" value="">
                                                        <span class="help-block"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group has-feedback">
                                                        <label for="exampleInputEmail1">Addresse email</label>
                                                        <input type="email" class="form-control" name="email" placeholder="Email">
                                                        <span class="help-block"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group has-feedback">
                                                        <label>Ville d'origine</label>
                                                        <input type="text" class="form-control" 
                                                        name="ville" placeholder="Ville" value="">
                                                        <span class="help-block"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group has-feedback">
                                                        <label>Date de recrutement</label>
                                                        <input type="date" class="form-control"
                                                         name="date_recrutement" required>
                                                        <span class="help-block"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group has-feedback">
                                                        <label>Numéro de téléphone</label>
                                                        <input type="tel" class="form-control"
                                                         name="telephone" required placeholder="Numéro de telephone">
                                                        <span class="help-block"></span>
                                                    </div>
                                                </div>
                                           </div>
                                           <div class="row">
                                               <div class="col-md-6">
                                                    <div class="form-group has-feedback">
                                                        <label>Statut</label>
                                                        <select class="form-control" name="statut" required>
                                                            <option value="actif">Actif</option>
                                                            <option value="innactif">Innactif</option>
                                                            <option value="viree">Virée</option>
                                                        </select>
                                                        <span class="help-block"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group has-feedback">
                                                        <label>Niveau</label>
                                                        <input type="number" required class="form-control" 
                                                        name="niveau" placeholder="Niveau" 
                                                        value=1>
                                                        <span class="help-block"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="button" 
                                            onclick="inserer(this, function(){load('membres','#membres table tbody');});"
                                            class="btn btn-info btn-fill pull-right">Enregistrer</button>
                                            <div class="clearfix"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="table-responsive col-md-12">
                                <table class=" card table table-bordered table-condensed table-striped">
                                    <caption class="container form-horizontal">
                                        <h4 class="row">
                                            Listes des clients
                                        </h4>
                                        <div class="form-group">
                                            <label for="inputTrouveProduit" class="col-sm-2 control-label">Recherche:</label>
                                            <div class="col-sm-8">
                                                <input type="search" name="" id="inputTrouveProduit" class="form-control"
                                                 value="" required="required" title="" placeholder="Rechercher un client"
                                                 onkeyup="loadAvecParams({action:'recherche_membre', 
                                                 nom:this.value, champ:'membre'}, '#membres table tbody', false)">
                                            </div>
                                        </div>
                                    </caption>
                                    <thead>
                                        <tr>
                                            <th>Nom et prénom</th>
                                            <th>Email</th>
                                            <th>Date de naissance</th>
                                            <th>Domicile</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content " id="factures">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="table-responsive col-md-12">
                                <table class=" card table table-bordered table-condensed table-striped">
                                    <caption>
                                        <h4>Listes des factures</h4>
                                    </caption>
                                    <thead>
                                        <tr>
                                            <th>Nom du client</th>
                                            <th>etat</th>
                                            <th>date</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
            



            <footer class="footer">
                <div class="container-fluid">
                    <nav class="pull-left">
                        <ul>
                            <li>
                                <a href="#">
                                Home
                            </a>
                            </li>
                            <li>
                                <a href="#">
                                Company
                            </a>
                            </li>
                            <li>
                                <a href="#">
                                Portfolio
                            </a>
                            </li>
                            <li>
                                <a href="#">
                               Blog
                            </a>
                            </li>
                        </ul>
                    </nav>
                    <p class="copyright pull-right">
                        &copy; 2017 <a href="#">Octimouny</a>
                    </p>
                </div>
            </footer>

        </div>
        <!-- <div id="animation" class="animation">
            <img src="assets/img/php.jpg"/>
            <span class="contenu"><img src="assets/img/udc.png"/></span>
        </div> -->
        
    </div>
    <div class="modal fade hidden-print" id="produit_modif_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel1">Connexion</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" id="logForm" class="form-horizontal" >
                        <div class="form-group">
                            <label for="email"   class="col-sm-4 control-label">Email ou téléphone</label>
                            <div class="col-sm-8">
                            <input type="text" onblur="verifieTel(this)" class="form-control" name="telephone" id="email" placeholder="Email ou téléphone" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Password" class="col-sm-4 control-label">Mot de passe</label>
                            <div class="col-sm-8">
                            <input type="password" name="pass" class="form-control" id="password" placeholder="Mot de passe" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8">
                            <div>
                                <span id="reponseConnexion" style="color:red"></span>
                            </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8">
                            <div>
                                <input type="hidden" value='logging' name="action" /><br/>
                            </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-8 col-sm-4 text-right">
                            <button type="button" class="btn btn-primary" id="conLog" onclick="verification(this);">Se connecter</button>
                            </div>
                        </div>
                        <a href="#" onclick="debutRecuperation()" class="recovery_link">mot de passe oublié?</a>
                    </form>
                </div>
            </div>
        </div>
    </div><!--fin modal connexion-->

    <!-- debut modal modification facture -->
    <div class="modal fade" id="modal-facture">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header hidden-print">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Facture</h4>
                </div>
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer hidden-print">
                    <button type="button" class="btn btn-primary">Enregistrer</button>
                    <button type="button" class="btn btn-default" onclick="print()">Imprimer</button>
                </div>
            </div>
        </div>
    </div>
    <!--fin modal facture-->
    <div class="modal fade" id="modal-cours" class="modal-grand">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header hidden-print">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">cours</h4>
                </div>
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer hidden-print">
                    <button type="button" class="btn btn-primary">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>
</body>

<!--Debut des Script JavaScript -->
    <!--   Core JS Files   -->
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!--  Checkbox, Radio & Switch Plugins -->
    <script src="assets/js/bootstrap-checkbox-radio-switch.js"></script>

    <!--  Charts Plugin -->
    <script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
    <script src="assets/js/light-bootstrap-dashboard.js"></script>

    <!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
    <script src="assets/js/demo.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            demo.initChartist();

            
            
        });
    
    </script>
<!-- Fin des Script JavaScript -->

</html>