<html>

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<title>Grille</title>
	
    <link rel="stylesheet" type="text/css" href="dialogues/jquery.alerts.css" />
    <link rel="stylesheet" type="text/css" href="css/commun/apropos.css" />
	<link rel="stylesheet" type="text/css" href="./JCE/css/base.css" />	
	<!-- Bootstrap core CSS -->
	<link href="../../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/styles.css" rel="stylesheet">
	<style>
		body a.oyMenuAction
		{
			padding:8px;
			border-radius:12px;
			background:dodgerblue;
			color:white;
			margin-top:5px;
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
	<div id="oygContext" align="center" style="width:100%;">
		<table class="oyOuterFrame" border="0" cellpadding="0" cellspacing="0">
			<tr><td align="center">
				<table class="oyFrame" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td colspan="5">
							<table class="oyFrame" border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr class="oyHeader">
									<td class="oyHeader">
										<div id="oygHeader"></div>
									</td>
									<td align="right">
										<!-- Je rends invisible cette div pour éviter une sortie intempestive 
											en modifiant le style dans base.css -->	
										<div id="oygHeaderMenu"></div>
										<!-- fin commentaire Patrick C. -->							
									</td> 
								</tr>					
							</table>
						</td>  
					</tr>
					<tr style="height: 4px;">
						<td colspan="5"></td>
					</tr>
					<tr>  
						<td rowspan="3" class="oyPuzzleCell" align="center" valign="top"> 
							<div id="oygState"></div>
							<div class="oyPuzzle" id="oygPuzzle"></div>
							<div class="oyPuzzleFooter" id="oygPuzzleFooter"></div>			
						</td>  
						<td class="oyListCellDot">.</td>    
						<td class="oyListCell" valign="top" id="oygListH"></td>
					</tr>
					<tr style="height: 4px;">
						<td colspan="4"></td>
					</tr>		
					<tr>  
						<td class="oyListCellDot">.</td>   
						<td class="oyListCell" valign="top" id="oygListV"></td>					
					</tr>
					<tr style="height: 4px;">
						<td colspan="5"></td>
					</tr>			
					<tr>
						<td colspan="5" class="oyFooter"> 
							<div id="oygFooter"></div>
						</td>
					</tr>			
				</table>
			</td></tr>
		</table>
		
	</div>  

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<!--
		Le modèle de grille reçoit maintenant les données nécessaires...
	-->
	<script src="dialogues/jquery.alerts.js"></script>
   <script src="js/commun/apropos.js"></script>
	
	<!-- 
		Respectez l'odre de chargement de ces scripts
	-->
	
	<script type="text/javascript" src="./JCE/js/oyPrologue.js"></script>	
	<script type="text/javascript" src="./JCE/js/oyJsrAjax.js"></script>
	<script type="text/javascript" src="./JCE/js/oyClue.js"></script>	
	<script type="text/javascript" src="./JCE/js/oyMenu.js"></script>	
	<script type="text/javascript" src="./JCE/js/oyPuzzle.js"></script>	
	<script type="text/javascript" src="./JCE/js/oyServer.js"></script>	
	<script type="text/javascript" src="./JCE/js/oySign.js"></script>	
	<script type="text/javascript" src="./JCE/js/oyMisc.js"></script>	
 
 	<!-- Données de la grille -->
 	<script type="text/javascript" src="./data.js"></script>
	
	
	<script type="text/javascript" src="./JCE/js/oyEpilogue.js"></script>
	<script type="text/javascript" src="../../fonction.js"></script>
		
	<!-- Pied de page -->
  	<?php include("../../footer.php");?>
</body>  

</html>
