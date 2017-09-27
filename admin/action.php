<?php 
	//connection a la base de donnee 
    $bdd = new PDO("mysql:host=localhost; dbname=hackaton", "root", "");
	session_start();
	include("../fonction.php");
	function retarder($retard=7000000)
	{
		for($i=0; $i<$retard; $i++)
		{}
	}
	// retarder(3000000);
	if(!isset($_POST['action']))
		$_POST['action']="";


	if($_POST["action"]=="affiche_questions")
	{
		$existance = $bdd->query("SELECT question.id id_question, question.contenu contenu_question, exercice.titre titre_exercice
		, cours.titre titre_cours FROM question INNER JOIN exercice ON exercice.id=question.exercice
			INNER JOIN cours ON exercice.cours=cours.id ORDER BY question.date DESC")
		or die(print_r($bdd->errorInfo()));

		while($existance_cont = $existance->fetch())
		{
			?>
			<tr>
				<td>
					<?php echo $existance_cont["contenu_question"]; ?>
				</td>
				<td>
					<?php echo $existance_cont["titre_exercice"]?>
				</td>
				<td>
					<?php echo $existance_cont["titre_cours"]?>
				</td>
				
				<td>
			<a href="#" class='btn btn-success' 
			data-toggle='modal' data-target='#produit_modif_modal'
			onclick="loadAvecParams({id:<?php echo $existance_cont['id_question'];?>, action:'affiche_question_modif'},
			'#produit_modif_modal .modal-content')">
						OUVRIR
					</a>
					
					<button class="btn btn-danger" onclick="supprimer('supprimer_question', 
					<?php echo $existance_cont["id_question"]?>, function(){load('questions', '#questions table tbody');});">
						SUPPRIMER
					</button>
				</td>
			</tr>
			<?php
		}
	}
	if($_POST["action"]=="supprimer_exercice")
	{
		$preparation = $bdd->prepare("DELETE FROM exercice WHERE id=?");
		$preparation->execute(array($_POST["id"]))or die(print_r($bdd->errorInfo()));
	}
	if($_POST["action"]=="recherche_membre")
	{
		$trouve=0;
		//recherche dans Cours
		$updateur=$bdd->query('SELECT * FROM membre WHERE (nom REGEXP \'^'.$_POST['nom'].'\')
			ORDER BY nom')or die(print_r($bdd->errorInfo()));;
		
		while($produits=$updateur->fetch())
		{
			affiche_membre($produits);
			$trouve++;
		}
		if($trouve==0)
		{
			$updateur=$bdd->query('SELECT * FROM Cours WHERE Cours.nom="inconnu"');
			while($produits=$updateur->fetch())
			{
				echo '<div class="Cours" id="Cours'.$produits['id'].
				'" ><div><strong>Cours </strong> : '.$produits['nom'];
				
					if(!empty($produits["description"]))
						echo '<br/><strong>description :</strong> '.$produits["description"];
					// else
						// echo "-----<br/>";
				echo '<br/><strong>prix</strong> : '.$produits['prix']
				.' kmf<br/><strong>stock</strong> : '
				.$produits['quantite'].' </button></div><img src="'
				.$produits["photo"].'" alt="photo" class="photoDuProduit" />';
				
				if(1)
				{
					echo '<div><button class="danger supprimer" onclick="supprimerProduit('.$produits['id'].',20);
					return false;">supprimer
					</button>';
					echo '<button class="supprimer" 
						onclick="modifierProduit('.$produits['id'].',20)">modifier</button>';
						
					if($_SESSION["id"]!=2)
					{
						echo '<button onclick="demanderQuantite('.$produits["id"].', '.$produits["prix"].')">vendu</button>';
					}
					echo "</div></div>";
				}
			}
		}
	}
	if($_POST["action"]=="recherche")
	{
		$trouve=0;
		//recherche dans Cours
		$updateur=$bdd->prepare('SELECT * FROM '.$_POST["champ"].' WHERE (nom REGEXP "'.$_POST['nom'].'"
			OR categorie REGEXP "'.$_POST['nom'].'"
			OR code_barre REGEXP "'.$_POST['nom'].'") ORDER BY nom')or die(print_r($bdd->errorInfo()));
			$updateur->execute(array())or die(print_r($bdd->errorInfo()));
		
		while($produits=$updateur->fetch())
		{
			affiche_lesson($produits);
			$trouve++;
		}
		if($trouve==0)
		{
			$updateur=$bdd->query('SELECT * FROM Cours WHERE Cours.nom="inconnu"');
			while($produits=$updateur->fetch())
			{
				echo '<div class="Cours" id="Cours'.$produits['id'].
				'" ><div><strong>Cours </strong> : '.$produits['nom'];
				
					if(!empty($produits["description"]))
						echo '<br/><strong>description :</strong> '.$produits["description"];
					// else
						// echo "-----<br/>";
				echo '<br/><strong>prix</strong> : '.$produits['prix']
				.' kmf<br/><strong>stock</strong> : '
				.$produits['quantite'].' </button></div><img src="'
				.$produits["photo"].'" alt="photo" class="photoDuProduit" />';
				
				if(1)
				{
					echo '<div><button class="danger supprimer" onclick="supprimerProduit('.$produits['id'].',20);
					return false;">supprimer
					</button>';
					echo '<button class="supprimer" 
						onclick="modifierProduit('.$produits['id'].',20)">modifier</button>';
						
					if($_SESSION["id"]!=2)
					{
						echo '<button onclick="demanderQuantite('.$produits["id"].', '.$produits["prix"].')">vendu</button>';
					}
					echo "</div></div>";
				}
			}
		}
	}
	if($_POST["action"]=="affiche_exercice_select")
	{
		$existance = $bdd->query("SELECT * from exercice ORDER BY id ASC")
		or die(print_r($bdd->errorInfo()));

		while($existance_cont = $existance->fetch())
		{
			?>
				<option value="<?php echo $existance_cont["id"];?>">
					<?php echo $existance_cont["nom"];?>
				</option>
			<?php
		}
	}
	if($_POST["action"]=="affiche_exercices")
	{
		$existance = $bdd->query("SELECT exercice.id, exercice.titre exo_titre, exercice.contenu exo_contenu, 
		cours.titre cours_titre from exercice INNER JOIN cours ON exercice.cours = cours.id ORDER BY id ASC")
		or die(print_r($bdd->errorInfo()));

		while($existance_cont = $existance->fetch())
		{
			?>
			<tr>
				<td>
					<?php echo $existance_cont["id"];?>
				</td>
				<td>
					<?php echo $existance_cont["exo_titre"];?>
				</td>
				<td>
					
					<div class="input-group">
						<?php 
							echo $existance_cont["cours_titre"];
						?>
				</td>
				<td>
					<button class="btn btn-danger" onclick="supprimer('supprimer_exercice', 
					<?php echo $existance_cont["id"]?>, function(){load('exercices', '#exercices table tbody');});">
						SUPPRIMER
					</button>
				</td>
			</tr>
			<?php
		}
	}
	if($_POST["action"]=="supprimer_cours")
	{
		$preparation = $bdd->prepare("DELETE FROM Cours WHERE id=?");
		$preparation->execute(array($_POST["id"]))or die(print_r($bdd->errorInfo()));
	}
	if($_POST["action"]=="supprimer_membre")
	{
		$preparation = $bdd->prepare("DELETE FROM membre WHERE id=?");
		$preparation->execute(array($_POST["id"]))or die(print_r($bdd->errorInfo()));
	}
	if($_POST["action"]=="affiche_membres")
	{
		$existance = $bdd->query("SELECT * from membre ORDER BY id DESC")
		or die(print_r($bdd->errorInfo()));
		
		while($existance_cont = $existance->fetch())
		{
			affiche_membre($existance_cont);
		}
	}
	if($_POST["action"]=="affiche_cours")
	{
		$existance = $bdd->prepare("SELECT * from cours ORDER BY date DESC LIMIT 15")
		or die(print_r($bdd->errorInfo()));
		$existance->execute(array());
		while($existance_cont = $existance->fetch())
		{
			?>
			<tr>
				<td class="col-sm-1">
					<img class="img-responsive thumbnail" 
					src="../images/cours/thumbnail/<?php echo $existance_cont["photo"];?>"/>
				</td>
				<td>
					<?php echo $existance_cont["titre"]; ?>
				</td>
				<td>
					<?php echo $existance_cont["description"]?>
				</td>
				
				<td>
					<button class="btn btn-danger" onclick="supprimer('supprimer_cours', 
					<?php echo $existance_cont["id"]?>, function(){load('questions', '#produits table tbody');});">
						SUPPRIMER
					</button>
					
					<a class="btn btn-primary" data-toggle="modal" href='#modal-cours'
					onclick="loadAvecParams({action:'affiche_lesson_admin', id:<?php echo $existance_cont["id"];?>}, '#modal-cours .modal-body');" 
					class="btn btn-warning">
						ouvrire
					</a>
					
				</td>
				
			</tr>
			
			<?php
		}
	}
	if($_POST["action"]=="affiche_exercices")
	{
		$existance = $bdd->prepare("SELECT exercice.titre titre_exercice, 
		exercice.contenu contenu_exercice, cours.titre titre_cours  from exercice 
		INNER JOIN cours ON exercice.cours = cours.id ORDER BY date DESC LIMIT 15")
		or die(print_r($bdd->errorInfo()));

		$existance->execute(array());
		while($existance_cont = $existance->fetch())
		{
			?>
			<tr>
				<td>
					<?php echo $existance_cont["titre_exercice"]; ?>
				</td>
				<td>
					<?php echo $existance_cont["contenu"]?>
				</td>
				<td>
					<?php echo $existance_cont["titre_cours"]?>
				</td>
				
				<td>
					<button class="btn btn-danger" onclick="supprimer('supprimer_cours', 
					<?php echo $existance_cont["id"]?>, function(){load('questions', '#produits table tbody');});">
						SUPPRIMER
					</button>
					
					<a class="btn btn-primary" data-toggle="modal" href='#modal-cours'
					onclick="loadAvecParams({action:'affiche_lesson_admin', id:<?php echo $existance_cont["id"];?>}, '#modal-cours .modal-body');" 
					class="btn btn-warning">
						ouvrire
					</a>
					
				</td>
				
			</tr>
			
			<?php
		}
	}
	if($_POST["action"]=="affiche_lesson_admin")
	{
		affiche_lesson_admin($_POST["id"]);
	}
	if($_POST["action"]=="affiche_facture_admin")
	{
		affiche_facture_admin($_POST["id"]);
	}
	if($_POST["action"]=="affiche_factures")
	{
		$existance = $bdd->prepare("SELECT facture.*, membre.nom from facture
		 INNER JOIN membre ON facture.acheteur=membre.id ORDER BY date DESC")
		or die(print_r($bdd->errorInfo()));
		
		$existance->execute(array($_SESSION["id_boutique"]));
		while($existance_cont = $existance->fetch())
		{
			?>
			<tr>
				<td>
					<?php echo $existance_cont["nom"]; ?>
				</td>
				<td>
					<?php echo $existance_cont["etat"]?>
				</td>
				<td>
					<?php echo $existance_cont["date"]?>
				</td>
				<td>
					<button class="btn btn-danger" onclick="supprimer('supprimer_facture', 
					<?php echo $existance_cont["id"]?>, function(){load('factures', '#factures table tbody');});">
						SUPPRIMER
					</button>
					
					<a class="btn btn-primary" data-toggle="modal" href='#modal-facture'
					onclick="loadAvecParams({action:'affiche_facture_admin', id:<?php echo $existance_cont["id"];?>}, '#modal-facture .modal-body');" 
					class="btn btn-warning">
						ouvrire
					</a>
					
					
					
				</td>
			</tr>
			
			<?php
		}
	}
	if($_POST["action"]=="affiche_lesson_modif")
	{
		//recuperation du nom de l'étudiants
		if(isset($_POST["id"]))
			$champ="id";
		else
			$champ="matricule";

		$existance = $bdd->prepare("SELECT * from Cours WHERE ".$champ."=?")
		or die(print_r($bdd->errorInfo()));
		
		if(isset($_POST["id"]))
		{
			$existance->execute(array($_POST["id"]));
		}
		else
			$existance->execute(array($_POST["matricule"]));


		while($donne = $existance->fetch())
		{
			$_POST["id"]=$donne["id"];
			?>
				
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<h4 class="modal-title">Modification de Cours</h4>
							</div>
							<div class="modal-body">
								<form method="POST" id="logForm" class="form-horizontal" 
								target="iPhoto" enctype="multipart/form-data" >
									<div class="form-group row">
										<div class="col-md-3">
											<label>Nom</label>
										</div>
										<div class="col-md-9">
											<input onblur="updateAvecParams({action:'modification_cours', nom:this.value, 
											id:<?php echo $donne['id'];?>}, this.parentNode.querySelector('span'))" 
											class="col-md-8 form-control"type="text" name="nom" id="inputNomModif" 
											value="<?php echo $donne['nom'];?>" pattern="" title="">
											<span></span>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-md-3">
											<label>Prix</label>
										</div>
										<div class="col-md-9">
											<input onblur="updateAvecParams({action:'modification_cours', prix:this.value, 
											id:<?php echo $donne['id'];?>}, this.parentNode.querySelector('span'))" 
											class="col-md-8 form-control"type="number" step=25 min=25 name="prix" id="inputPrixModif" 
											value="<?php echo $donne['prix'];?>" pattern="" title="">
											<span></span>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-md-3">
											<label>Déscription</label>
										</div>
										<div class="col-md-9">
											<input onblur="updateAvecParams({action:'modification_cours', description:this.value, 
											id:<?php echo $donne['id'];?>}, this.parentNode.querySelector('span'))" 
											class="col-md-8 form-control"type="text" name="description" id="inputDescriptionModif" 
											value="<?php echo $donne['description'];?>" pattern="" title="">
											<span></span>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-md-3">
											<label>Code barre</label>
										</div>
										<div class="col-md-9">
											<input onblur="updateAvecParams({action:'modification_cours', code_barre:this.value, 
											id:<?php echo $donne['id'];?>}, this.parentNode.querySelector('span'))" 
											class="col-md-8 form-control"type="text" name="code_barre" id="inputCodeModif" 
											value="<?php echo $donne['code_barre'];?>" pattern="" title="">
											<span></span>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-md-3">
											<label>Taille</label>
										</div>
										<div class="col-md-9">
											<input onblur="updateAvecParams({action:'modification_cours', taille:this.value, 
											id:<?php echo $donne['id'];?>}, this.parentNode.querySelector('span'))" 
											class="col-md-8 form-control"type="number" name="taille" id="inputTailleModif" 
											value="<?php echo $donne['taille'];?>" pattern="" title="">
											<span></span>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-md-3">
											<label>Poids</label>
										</div>
										<div class="col-md-9">
											<input onblur="updateAvecParams({action:'modification_cours', poids:this.value, 
											id:<?php echo $donne['id'];?>}, this.parentNode.querySelector('span'))" 
											class="col-md-8 form-control"type="number" name="poids" id="inputPoidsModif" 
											value="<?php echo $donne['poids'];?>" pattern="" title="">
											<span></span>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-md-3">
											<label>Couleur</label>
										</div>
										<div class="col-md-9">
											<input onblur="updateAvecParams({action:'modification_cours', couleur:this.value, 
											id:<?php echo $donne['id'];?>}, this.parentNode.querySelector('span'))" 
											class="col-md-8 form-control"type="color" name="couleur" id="inputCouleurModif" 
											value="<?php echo $donne['couleur'];?>" pattern="" title="">
											<span></span>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-offset-5 col-md-2">
											<img name="iPhoto" class="img-responsive"id="iPhoto" class="media"
											src="../images/cours/thumbnail/<?php echo $donne['photo'];?>">
										</div>
									</div>
									<div class="form-group row">
										<div class="col-md-3">
											<label>Photo</label>
										</div>
										<div class="col-md-9">
											<input onchange="updatePhoto(this, 'modification_cours', 
											<?php echo $donne['id'];?>)" 
											class="col-md-8 form-control"type="file" name="photo" id="inputPhotoModif" 
											value="" pattern="" title="">
											<span></span>
											
											
											<input type="hidden" value="modification_cours" name="action"/>
										</div>
									</div>
									<div class="progress progress-striped active">
										<div class="progress-bar"></div>
									</div>

								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<button type="button" class="btn btn-primary">Save changes</button>
							</div>
		<?php
		}
	}
	if($_POST["action"]=="insertion_cours")
	{
		$existance = $bdd->prepare("SELECT * from Cours WHERE titre=?");
		$existance->execute(array($_POST["titre"]));

		if(!isset($_POST["description"]))
			$_POST["description"]="";

		if($existance_cont = $existance->fetch())
		{
			echo "Ce Cours existe déjà.";
		}
		else
		{
			//traitement de la photo
			$chemin="./images/cours/default.png";
            if(isset($_FILES["photo"]))
            {
                if($_FILES["photo"]["error"]==0)
                {
                    $extension_permis=array("jpg","jpeg","png","gif");
                    $info=pathinfo($_FILES["photo"]["name"]);
                    $extension=$info["extension"];

                    if(in_array(strtolower($extension), $extension_permis))
                    {
						$r = mt_rand();
                        $chem="../images/cours/full/".$r;
                        $chem2="../images/cours/thumbnail/".$r;
                        $chemin=$chem.".".$extension;
                        $chemin2=$chem2.".".$extension;
						$nom_fichier = $r.".".$extension;

                        move_uploaded_file($_FILES["photo"]["tmp_name"], $chemin);
                        $dimension=getimagesize($chemin);

                        if($dimension[1]>460)
                        {
                            darkroom($chemin, $chemin2, 0, 460);
                        }
                        if($dimension[0]>716)
                        {
                            darkroom($chemin, $chemin2, 716, 0);
                        }
						else
                            darkroom($chemin, $chemin2, 0, 0);							
                    }
                    else
                    {
                        echo "Type de fichier non autorisé";
                    }
                }
            }
			
			if(!$nom_fichier)
				$nom_fichier = "default.png";

			$inserer = $bdd -> prepare("INSERT INTO cours(titre, categorie, contenu, photo, date)
			values(?,?,?,?,NOW())")	or die(print_r($bdd->errorInfo()));
		
			$inserer->execute (array($_POST['titre'], $_POST['categorie'],
			$_POST['contenu'], $nom_fichier))
			or die(print_r($bdd->errorInfo()));
			echo "ok";
		}
	}
	if($_POST["action"]=="affiche_question_modif")
	{
		//recuperation du nom de l'étudiants
		if(isset($_POST["id"]))
			$champ="id";

		$existance = $bdd->query("SELECT question.id, question.contenu contenu_question, exercice.titre titre_exercice
		, cours.titre titre_cours FROM question INNER JOIN exercice ON exercice.id=question.exercice
			INNER JOIN cours ON exercice.cours=cours.id WHERE question.id=".$_POST['id']."
			 ORDER BY question.date DESC")
		or die(print_r($bdd->errorInfo()));

		
		
		if(isset($_POST["id"]))
		{
			$existance->execute(array($_POST["id"]));
		}
		
		while($donne = $existance->fetch())
		{
			?>
				
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title">Modification de la Question</h4>
				</div>
				<div class="modal-body">
					<form method="POST" id="logForm" class="form-horizontal" target="iPhoto" enctype="multipart/form-data" >
						<div class="form-group row">
							<div class="col-md-3">
								<label>Question</label>
							</div>
							<div class="col-md-9">
								<input onblur="updateAvecParams({action:'modification_question', contenu:this.value, 
								id:<?php echo $donne['id'];?>}, this.parentNode.querySelector('span'))" 
								class="col-md-8 form-control"type="text" name="nom" id="inputNomModif" 
								value="<?php echo $donne['contenu_question'];?>" pattern="" title="">
								<span></span>
							</div>
						</div>
						<div class="progress progress-striped active">
							<div class="progress-bar"></div>
						</div>

					</form>
					<div class="col-md-3">
						<label>Réponses</label>
					</div>
					<?php
						$existance = $bdd->query("SELECT * FROM reponse WHERE question=".$_POST['id']."")
						or die(print_r($bdd->errorInfo()));

						while($existance_cont = $existance->fetch())
						{
							
					?>
						<form method="POST" id="logForm" class="form-horizontal" target="iPhoto" enctype="multipart/form-data" >
							<div class="form-group row">
								<div class="col-md-9">
									<input onblur="updateAvecParams({action:'modification_reponse', contenu:this.value, 
									id:<?php echo $existance_cont['id'];?>}, this.parentNode.querySelector('span'))" 
									class="col-md-8 form-control"type="text" name="nom" id="inputNomModif" 
									value="<?php echo $existance_cont['contenu'];?>" pattern="" title="">
									<span></span>
								</div>
								
								<div class="col-md-3">
									<select onblur="updateAvecParams({action:'modification_reponse', verite:this.value, 
									id:<?php echo $existance_cont['id'];?>}, this.parentNode.querySelector('span'))" class="form-control" name="verite" id="">
										<option <?php if($existance_cont["verite"]) echo "selected='true'"; ?> value="1">Vrai</option>
										<option <?php if(!$existance_cont["verite"]) echo "selected='true'"; ?> value="0">Faux</option>
									</select>
								</div>
								
							</div>
						</form>
					<?php } ?>

				
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>
		<?php
		}
	}
	if($_POST["action"]=="insertion_question")
	{
		$existance = $bdd->prepare("SELECT * from Cours WHERE nom=?");
		$existance->execute(array($_POST["nom"]));

		if(!isset($_POST["code_barre"]))
			$_POST["code_barre"]="";

		if($existance_cont = $existance->fetch())
		{
			echo "Ce Cours existe déjà.";
		}
		else
		{
			//traitement de la photo
			$chemin="./images/cours/default.png";
            if(isset($_FILES["photo"]))
            {
                if($_FILES["photo"]["error"]==0)
                {
                    $extension_permis=array("jpg","jpeg","png","gif");
                    $info=pathinfo($_FILES["photo"]["name"]);
                    $extension=$info["extension"];

                    if(in_array(strtolower($extension), $extension_permis))
                    {
						$r = mt_rand();
                        $chem="../images/cours/full/".$r;
                        $chem2="../images/cours/thumbnail/".$r;
                        $chemin=$chem.".".$extension;
                        $chemin2=$chem2.".".$extension;
						$nom_fichier = $r.".".$extension;

                        move_uploaded_file($_FILES["photo"]["tmp_name"], $chemin);
                        $dimension=getimagesize($chemin);

                        if($dimension[1]>460)
                        {
                            darkroom($chemin, $chemin2, 0, 460);
                        }
                        if($dimension[0]>716)
                        {
                            darkroom($chemin, $chemin2, 716, 0);
                        }
						else
                            darkroom($chemin, $chemin2, 0, 0);							
                    }
                    else
                    {
                        echo "Type de fichier non autorisé";
                    }
                }
            }
			if($_POST["taille"]=="")
				$_POST["taille"]=0;
			if($_POST["poids"]=="")
				$_POST["poids"]=0;
			$inserer = $bdd -> prepare("INSERT INTO Cours(nom, prix, description, photo, grand_photo, date, code_barre
			,id_boutique, couleur, taille, poids)
			values(?,?,?,?,?,NOW(),?,?,?, ?, ?)")	or die(print_r($bdd->errorInfo()));
		
			$inserer->execute (array($_POST['nom'], $_POST['prix'],
			$_POST['description'], $nom_fichier, $nom_fichier, $_POST["code_barre"],$_SESSION["id_boutique"], 
			$_POST["couleur"], $_POST["taille"], $_POST["poids"]))
			or die(print_r($bdd->errorInfo()));
			echo "ok";
		}
	}
	else if($_POST["action"]=="insertion_exercice")
	{
		$existance = $bdd->prepare("SELECT * from exercice WHERE nom=?");
		$existance->execute(array($_POST["dep"]));

		if($existance_cont = $existance->fetch())
		{
			echo "Ce exercice existe deja.";
		}
		else
		{
			$inser_dep=$bdd -> exec("INSERT INTO exercice(titre)
			values('".$_POST['dep']."')")	or die(print_r($bdd->errorInfo()));

			// $inser_dep->execute (array($_POST['dep']))or die(print_r($bdd->errorInfo()));
			// header("location:inser_dep.html");
			echo "ok";
		}
	
	}
	else if($_POST["action"]=="insertion_membre")
	{
		$existance = $bdd->prepare("SELECT * from membre WHERE telephone=?");
		$existance->execute(array($_POST["telephone"]));

		if($existance_cont = $existance->fetch())
		{
			echo "Cette membre existe deja.";
		}
		else
		{
			$inser_ensei=$bdd -> prepare("INSERT INTO membre(nom,prenom,date_recrutement,statut,telephone)
			values(?,?,?,?,?)")	or die(print_r($bdd->errorInfo()));
		
			$inser_ensei->execute(array($_POST['nom'], $_POST['prenom'], $_POST['date_recrutement'],
			$_POST['statut'], $_POST['telephone']))
			or die(print_r($bdd->errorInfo()));
			echo "ok";
		}
			
	}
	else if($_POST["action"]=="insertion_matiere")
	{
		if(empty($_POST['matiere']))
		{
			echo "Veuillez specifier un nom";
			die();
		}

		$commentaire = $bdd -> prepare("SELECT * FROM matiere WHERE nom=?")
		or die(print_r($bdd->errorInfo()));
		$commentaire -> execute(array($_POST["matiere"]));		
		if($donne = $commentaire->fetch())
		{
			echo "Cette matière existe déjà";
			die();
		}
		$inser_matiere=$bdd -> prepare("INSERT INTO matiere(nom)
		values(?)")	or die(print_r($bdd->errorInfo()));
	
		$inser_matiere->execute (array($_POST['matiere']))
		or die(print_r($bdd->errorInfo()));
		echo "ok";
		
	}
	else if($_POST["action"]=="login")
	{
		
		// $selection = $bdd->prepare("INSERT INTO chef_exercice (nom, password)VALUES(?,?)");
		// $selection -> execute(array($_POST["tel"], sha1($_POST["pass"])))or die(print_r($bdd->errorInfo()));
		
		//verification de l'existance
		$selection = $bdd->prepare("SELECT * FROM chef_exercice WHERE nom = ?");
		$selection -> execute(array($_POST["tel"]));

		
		if($data = $selection -> fetch())
		{
			//verification de l'existance
			$selection2 = $bdd->prepare("SELECT * FROM chef_exercice WHERE nom = ? 
			AND password = ?");
			$selection2 -> execute(array($_POST["tel"],$_POST["pass"]));
			//authentification sur la page admin
			if($data2 = $selection2 -> fetch())
			{
				$_SESSION["id"]=$data2["id"];
				$_SESSION["nom"]=$data2["nom"];
				print_r($data2);
				$_SESSION["exercice"]=$data2["exercice"];
				header("Location:admin/dashboard.php");
			}
			else
			{
				echo "Le mot de passe est incorrecte";
			}
		}
		else
		{
			echo "Le chef de exercice n'a pas été trouvé ";
		}
		// header("Location:index.php");
	}
	else if($_POST["action"]=="inscription")
	{
		//verification de l'existance
		$selection = $bdd->prepare("SELECT nom FROM personne WHERE telephone = ?");
		$selection -> execute(array($_POST["tel"]));
		
		if($data = $selection -> fetch())
		{
			echo "le numero saisie est deja utilisé par l'utilisateur ".$data["nom"];
		}
		else
		{
			//preparation de la requete
			$donne = $bdd -> prepare("INSERT INTO personne(nom, email, password, telephone, naissance, domicile, date)
			values(?, ?, ?, ?, ?, ? ,NOW())");
			
			//execution de la requete
			$donne -> execute (array($_POST['nom'], $_POST['email'], sha1($_POST["pass"]), $_POST["tel"], 
			$_POST["naissance"], $_POST["domicile"]))
			or die(print_r($bdd->errorInfo()));
			
			
			echo "Bienvenu dans le site mao";
		}
	}
	
	else if($_POST["action"]=="modification_reponse")
	{
		if(isset($_POST["verite"]))
		{
			$preparation = $bdd->prepare("UPDATE reponse SET verite=?");
			$preparation->execute(array($_POST["verite"]));
		}
		if(isset($_POST["contenu"]))
		{
			$preparation = $bdd->prepare("UPDATE reponse SET contenu=?");
			$preparation->execute(array($_POST["contenu"]));
		}
	}
	else if($_POST["action"]=="modification_exercice")
	{
		$preparation = $bdd->prepare("UPDATE exercice SET nom=?");
		$preparation->execute(array($_POST["nom"]));
	}
	else if($_POST["action"]=="modification_cours")
	{
		if(isset($_POST["nom"]))
		{
			$preparation = $bdd->prepare("UPDATE Cours SET nom=? WHERE id=?");
			$preparation->execute(array($_POST["nom"], $_POST["id"]));
			echo "sucess";			
		}
		if(isset($_POST["prix"]))
		{
			$preparation = $bdd->prepare("UPDATE Cours SET prix=? WHERE id=?");
			$preparation->execute(array($_POST["prix"], $_POST["id"]));
			echo "sucess";
		}
		if(isset($_POST["description"]))
		{
			$preparation = $bdd->prepare("UPDATE Cours SET description=? WHERE id=?");
			$preparation->execute(array($_POST["description"], $_POST["id"]));
			echo "sucess";
		}
		if(isset($_POST["code_barre"]))
		{
			$preparation = $bdd->prepare("UPDATE Cours SET code_barre=? WHERE id=?");
			$preparation->execute(array($_POST["code_barre"], $_POST["id"]));
			echo "sucess";
		}
		if(isset($_POST["poids"]))
		{
			$preparation = $bdd->prepare("UPDATE Cours SET poids=? WHERE id=?");
			$preparation->execute(array($_POST["poids"], $_POST["id"]));
			echo "sucess";			
		}
		if(isset($_POST["taille"]))
		{
			$preparation = $bdd->prepare("UPDATE Cours SET taille=? WHERE id=?");
			$preparation->execute(array($_POST["taille"], $_POST["id"]));
			echo "sucess";
		}
		if(isset($_FILES["photo"]))
		{
			//traitement de la photo
			$chemin="./images/cours/default.png";
			if($_FILES["photo"]["error"]==0)
			{
				$extension_permis=array("jpg","jpeg","png","gif");
				$info=pathinfo($_FILES["photo"]["name"]);
				$extension=$info["extension"];

				if(in_array(strtolower($extension), $extension_permis))
				{
					$r = mt_rand();
					$chem="../images/cours/full/".$r;
					$chem2="../images/cours/thumbnail/".$r;
					$chemin=$chem.".".$extension;
					$chemin2=$chem2.".".$extension;
					$nom_fichier = $r.".".$extension;

					move_uploaded_file($_FILES["photo"]["tmp_name"], $chemin);
					$dimension=getimagesize($chemin);

					if($dimension[1]>460)
					{
						darkroom($chemin, $chemin2, 0, 460);
					}
					if($dimension[0]>716)
					{
						darkroom($chemin, $chemin2, 716, 0);
					}
					else
						darkroom($chemin, $chemin2, 0, 0);							
				}
				else
				{
					echo "Type de fichier non autorisé";
				}
			}
			$preparation = $bdd->prepare("UPDATE Cours SET photo=?, grand_photo=? WHERE id=?");
			$preparation->execute(array($nom_fichier, $nom_fichier, $_POST["id"]));
			echo $chemin;
		}
	}
	if($_POST["action"]=="affiche_matieres")
	{
		$existance = $bdd->query("SELECT * from matiere ORDER BY id ASC")
		or die(print_r($bdd->errorInfo()));

		while($existance_cont = $existance->fetch())
		{
			?>
			<tr>
				<td>
					<?php echo $existance_cont["id"];?>
				</td>
				<td>
					<?php echo $existance_cont["nom"];?>
				</td>
				<td>
					<button class="btn btn-danger" onclick="supprimer('supprimer_matiere', 
					<?php echo $existance_cont["id"]?>, function(){load('matieres', '#matieres table tbody');});">
						SUPPRIMER
					</button>
				</td>
			</tr>
			<?php
		}
	}
	else if($_POST["action"]=="update_membre")
	{
		if(isset($_POST["statut"]))
		{
			$preparation = $bdd->prepare("UPDATE membre SET statut=? WHERE id=?");
			$preparation->execute(array($_POST["statut"], $_POST["id"]));
		}	
	}
	else if($_POST["action"]=="update_question")
	{
		if(isset($_POST["prix"]))
		{
			$preparation = $bdd->prepare("UPDATE question SET prix=? WHERE id=?");
			$preparation->execute(array($_POST["prix"], $_POST["id"]));
		}	
	}
	else if($_POST["action"]=="update_livraison")
	{
		if(isset($_POST["prix"]))
		{
			if($_POST["prix"]%25==0)
			{
				$preparation = $bdd->prepare("UPDATE livraison SET prix=? WHERE exercice=?");
				$preparation->execute(array($_POST["prix"], $_POST["id"]));
			}
			else
			{
				echo "<span class='bg-danger'>Veuillez saisir un nombre correct</span>";
				die();
			}
		}
		echo "<span class='bg-success'>changé</span>";
	}
	else if($_POST["action"]=="update_cours")
	{
		if(isset($_POST["prix"]))
		{
			$preparation = $bdd->prepare("UPDATE Cours SET prix=? WHERE id=?");
			$preparation->execute(array($_POST["prix"], $_POST["id"]));
		}	
		if(isset($_POST["nom"]))
		{
			$preparation = $bdd->prepare("UPDATE Cours SET nom=? WHERE id=?");
			$preparation->execute(array($_POST["nom"], $_POST["id"]));
		}	
		if(isset($_POST["description"]))
		{
			$preparation = $bdd->prepare("UPDATE Cours SET description=? WHERE id=?");
			$preparation->execute(array($_POST["description"], $_POST["id"]));
		}
		if(isset($_FILES["photo"]))
		{
			//traitement de la photo
			$chemin="./images/cours/default.png";
			if($_FILES["photo"]["error"]==0)
			{
				$extension_permis=array("jpg","jpeg","png","gif");
				$info=pathinfo($_FILES["photo"]["name"]);
				$extension=$info["extension"];

				if(in_array(strtolower($extension), $extension_permis))
				{
					$r = mt_rand();
					$chem="../images/cours/full/".$r;
					$chem2="../images/cours/thumbnail/".$r;
					$chemin=$chem.".".$extension;
					$chemin2=$chem2.".".$extension;
					$nom_fichier = $r.".".$extension;

					move_uploaded_file($_FILES["photo"]["tmp_name"], $chemin);
					$dimension=getimagesize($chemin);

					if($dimension[1]>460)
					{
						darkroom($chemin, $chemin2, 0, 460);
					}
					if($dimension[0]>716)
					{
						darkroom($chemin, $chemin2, 716, 0);
					}
					else
						darkroom($chemin, $chemin2, 0, 0);							
				}
				else
				{
					echo "Type de fichier non autorisé";
				}
			}
			$preparation = $bdd->prepare("UPDATE Cours SET photo=?, grand_photo=? WHERE id=?");
			$preparation->execute(array($nom_fichier, $nom_fichier, $_POST["id"]));
			echo $chemin;
		}
	}

	else if($_POST["action"]=="insertion_question")
	{
		//on recupere les unite un a un
		$les_uni = $bdd -> prepare("SELECT * FROM question WHERE type=? AND cour=? AND Cours=? AND semestre=?");
		$les_uni->execute(array($_POST["type"], $_POST["matiere"], $_POST["Cours"], $_POST["semestre"]))
		or die(print_r($bdd->errorInfo()));

		if($donne = $les_uni->fetch())
		{
			echo "Cette question a déjà été renseigné";
			die();
		}

		$commentaire = $bdd -> prepare("INSERT INTO question(type, cour, Cours, valeur, semestre,date)
		values(?, ?, ?, ?,?, NOW())")or die(print_r($bdd->errorInfo()));
		//execution de la requete
		$commentaire -> execute(array($_POST["type"], $_POST["matiere"]
		, $_POST["Cours"], $_POST["valeur"], $_POST["semestre"]));
		echo "ok";
	}
	if($_POST["action"]=="calcul_moyen")
	{
		//on recupere les unite un a un
		$les_uni = $bdd -> query("SELECT * FROM unite WHERE exercice=".$_SESSION["exercice"])
		or die(print_r($bdd->errorInfo()));

		$unite_tab;
		while($donne_general = $les_uni->fetch())
		{
			$unite;
			while($donne_unite = $unite->fetch())
			{
				//on recupere les matieres un a un
				$les_mati = $bdd -> prepare("SELECT * FROM cour WHERE cour.unite=?
				AND (cour.semestre=? OR cour.semestre=3)")
				or die(print_r($bdd->errorInfo()));
				$les_mati->execute(array($donne_unite["id"], $_POST["semestre"]));

				while($les_matieres = $les_mat->fetch())				
				{
					//apres avoir recuperer une matiere on calcule sa moyenne									
					$laMoyenneMatiere = 0;
						
				}
			}
		}			
	}
	function calcul_moyen_matiere($Cours, $matiere, $semestre=0)
	{
		$bdd = new PDO("mysql:host=localhost; dbname=mao", "root", "");
		$laMoyenneMatiere=0;

		if($semestre!=0)
			$condition1=" question.semestre=".$semestre;
		else
			$condition1="1";
			
		$moyen = $bdd -> prepare("SELECT question.valeur, question.type FROM question INNER JOIN 
		cour ON question.cour=cour.id 
		WHERE question.Cours=? AND cour.matiere=? AND ".$condition1)
		or die(print_r($bdd->errorInfo()));
		$moyen->execute(array($Cours, $matiere));

		/*on declare une variable qui va contenir l objet 
		avec les infos d une matiere, ainsi que sa moyenne*/
		while($donne = $moyen->fetch())
		{
			if($donne["type"]=="controle")
				$laMoyenneMatiere+=$donne['valeur']*0.25;
			else
				$laMoyenneMatiere+=$donne['valeur']*0.75;
		}
		// echo "matiere N°".$matiere." : ".$laMoyenneMatiere;
		return round($laMoyenneMatiere, 2);
	}
	function calcul_moyen_unite($Cours, $unite, $semestre=0)
	{
		if($semestre!=0)
			$condition1=" question.semestre=".$semestre;
		else
			$condition1="1";
		
		$bdd = new PDO("mysql:host=localhost; dbname=mao", "root", "");
		$la_moyenne_unite=0;
		$moyen = $bdd -> prepare("SELECT cour.matiere, cour.coefficient FROM cour 
		INNER JOIN unite 
		ON cour.unite=unite.id 
		WHERE cour.unite=? AND (cour.semestre=? OR cour.semestre=3)")
		or die(print_r($bdd->errorInfo()));
		$moyen->execute(array($unite, $semestre));
		
		//on recupere la somme des coefficients des matieres de l'unité
		$nombre = $bdd -> prepare("SELECT SUM(cour.coefficient) somme FROM cour 
		INNER JOIN unite 
		ON cour.unite=unite.id 
		WHERE cour.unite=? AND (cour.semestre=? or cour.semestre=3)")
		or die(print_r($bdd->errorInfo()));
		$nombre->execute(array($unite, $semestre));
		$leNombre = $nombre->fetch();
		// echo "<label class='label label-danger'>".$leNombre["somme"]."</label>";
		// echo "<label class='label label-warning'>".$unite."</label>";
		/*on declare une variable qui va contenir l objet 
		avec les infos d une matiere, ainsi que sa moyenne*/
		while($donne = $moyen->fetch())
		{
			$la_moyenne_unite+=calcul_moyen_matiere($Cours, 
			$donne["matiere"], $semestre)*$donne["coefficient"];
		}
		if($leNombre["somme"])
		{
			$la_moyenne_unite = $la_moyenne_unite/$leNombre["somme"];
			// echo "unite : ".$la_moyenne_unite;
			return $la_moyenne_unite;
		}
		else
		{
			return 0;
		}
	}
	function calcul_moyen_general($Cours, $semestre=0)
	{
		$bdd = new PDO("mysql:host=localhost; dbname=mao", "root", "");
		$la_moyenne_general=0;
		$moyen = $bdd->prepare("SELECT unite.* FROM unite INNER JOIN exercice ON unite.exercice=exercice.id 
		INNER JOIN Cours ON Cours.exercice=exercice.id WHERE Cours.id=?")
		or die(print_r($bdd->errorInfo()));

		$moyen->execute(array($Cours));
		$i=0;
		while($donne = $moyen->fetch())
		{
			$la_moyenne_general+=calcul_moyen_unite($Cours, $donne["id"], $semestre);
		}
		// echo "general : ".$la_moyenne_general."<br>";
		return round($la_moyenne_general/3, 2);
	}
	if($_POST["action"]=="affichage_exercice")
	{
		$existance = $bdd->prepare("SELECT * from exercice WHERE nom=?");
		$existance->execute(array($_POST["dep"]));

		while($existance_cont = $existance->fetch())
		{
			echo $existance_cont["nom"]."<br>";
		}
	}
	/*if($_POST["action"]=="affiche_compte_reclamation")
	{
		$existance = $bdd->query("SELECT COUNT(*) nbr from reclamation");

		while($existance_cont = $existance->fetch())
		{   ?>                                 
			<li><a href="#" style="color:white;"><?php echo $existance_cont["nbr"]; ?></a></li>
			<?php
		}
	}
	if($_POST["action"]=="affiche_reclamation")
	{
		$existance = $bdd->query("SELECT reclamation.contenu, reclamation.id id_contenu, 
		Cours.nom, Cours.prenom, Cours.id id_e
		 from reclamation INNER JOIN Cours ON reclamation.Cours=Cours.id ORDER BY reclamation.id DESC")
		 or die(print_r($bdd->errorInfo()));

		while($existance_cont = $existance->fetch())
		{   ?>                                 
			<li>
				<a href="#" class="panel">
					<strong class="panel-title"><?php echo $existance_cont["nom"]." ".$existance_cont["prenom"]; ?></strong>
					<p class="panel-body"><?php echo $existance_cont["contenu"]; ?></p>
				</a>
			</li>
			<?php
		}
	}*/
	if($_POST["action"]=="affichage_statistique")
	{
		// $existance = $bdd->query("SELECT COUNT(*) nbr from question INNER JOIN Cours ON question.Cours=Cours.id WHERE Cours.exercice=".$_SESSION["exercice"])
		// or die(print_r($bdd->errorInfo()));

		// $nbre = $existance->fetch();
		// $nbres = $nbre["nbr"];

		// $existance = $bdd->query("SELECT COUNT(*) nbr from question WHERE valeur<10")
		// or die(print_r($bdd->errorInfo()));
		// $nbr = $existance->fetch();
		// $nbr_inf_10 = $nbr["nbr"];

		// $existance = $bdd->query("SELECT COUNT(*) nbr from question WHERE valeur>=10 AND valeur<=12")
		// or die(print_r($bdd->errorInfo()));
		// $nbr = $existance->fetch();
		// $nbr_sup_10_inf_12 = $nbr["nbr"];

		// $existance = $bdd->query("SELECT COUNT(*) nbr from question WHERE valeur>12")
		// or die(print_r($bdd->errorInfo()));
		// $nbr = $existance->fetch();
		// $nbr_sup_12 = $nbr["nbr"];

		$json[0]=(15*100)/60;
		$json[1]=32*100/60;
		$json[2]=53*100/60;

		echo json_encode($json);
		
	}
	if($_POST["action"]=="supprimer_question")
	{
		print_r($_POST);
		$pret=$bdd->prepare("DELETE FROM question WHERE id=?");
		$pret->execute(array($_POST["id"]));
	}
	if($_POST["action"]=="supprimer_facture")
	{
		$pret=$bdd->prepare("DELETE FROM facture WHERE id=?");
		$pret->execute(array($_POST["id"]));
	}
	
	function couleur($valeur)
	{
		if($valeur<10)
			return "danger";
		else if($valeur>10 AND $valeur<=12)
		{
			return "warning";
		}
		else
			return "success";

		return "info";

	}