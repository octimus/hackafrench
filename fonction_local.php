<?php
	if(!isset($_SESSION))
		session_start();
	function connexion()
    {
        try
        {
            $bdd= new PDO('mysql:host=localhost;dbname=hackaton','root','');
            return $bdd;
        }
        catch(Exception $e)
        {
            die('error'.$e->getMessage());
        }
    }
	function connecter($login, $pass)
	{
		$bdd = connexion();
		$selection_con=$bdd->prepare("SELECT * FROM membre where (telephone=? or email=?) and password=?");
		$selection_con->execute(array($login,$login, sha1($pass)))or die(print_r($bdd->
		errorInfo()));
		
		if($user=$selection_con->fetch())
		{
				$_SESSION['nom']=$user['nom'];
				$_SESSION['telephone']=$user['telephone'];
				$_SESSION['email']=$user['email'];
				$_SESSION['password']=$user['password'];
				$_SESSION['naissance']=$user['date_naissance'];
				$_SESSION['exp']=$user['exp'];
				$_SESSION['octram_id_visiteur']=$user['id'];
				$_SESSION['octram_id_boutique']=1;
				$_SESSION['id_boutique']=1;
				echo "success";
				// header("Location:index.php");
		}
		else
		{
			echo '<label class="label label-danger" >Erreur d\' authentification</label>';
		}
	}
   
    function load($table, $condition)
    {
        $bdd = connexion();

        $recuperation = $bdd->query("SELECT * FROM ".$table." WHERE ".$condition)or die(print_r($bdd->errorInfo()));
        return $recuperation;
    }
    function disponible($voiture, $type=0)
    {
        $bdd = connexion();
        $disponible=1;
        
        if($type==0)
        {
            $dispoCars=$bdd->prepare("SELECT location.date_debut,
            location.date_fin FROM location 
            WHERE (id_voiture=? AND (
            (location.date_debut<=? AND ?<= location.date_fin) 
            OR 
            (location.date_debut<=? AND ?<= location.date_fin) 
            OR 
            (? <= location.date_debut AND location.date_debut <= ?)
            OR 
            (? <= location.date_fin AND location.date_fin <= ?) ))")or die(print_r($bdd->errorInfo()));
            
        }
        else if($type==1)
        {
            $dispoCars=$bdd->prepare("SELECT reservation_driver.date_debut,
            reservation_driver.date_fin FROM reservation_driver 
            WHERE (id_driver=? AND (
            (reservation_driver.date_debut<=? AND ?<= reservation_driver.date_fin) 
            OR 
            (reservation_driver.date_debut<=? AND ?<= reservation_driver.date_fin) 
            OR 
            (? <= reservation_driver.date_debut AND reservation_driver.date_debut <= ?)
            OR 
            (? <= reservation_driver.date_fin AND reservation_driver.date_fin <= ?) ))")or die(print_r($bdd->errorInfo()));
        }
        
        $dispoCars->execute(array($voiture
        ,$_POST['debutLocation'],$_POST['debutLocation'],
        $_POST['finLocation'],$_POST['finLocation'], 
        $_POST['debutLocation'],$_POST['finLocation'], 
        $_POST['debutLocation'],$_POST['finLocation']));
        
        
        if($voituresDispo=$dispoCars->fetch())
        {
            $disponible=0;
        }
        return $disponible;
    }
    function dernier_facture()
    {
        $bdd=connexion();
        $prepare = $bdd->query("SELECT id FROM facture WHERE acheteur="
        .$_SESSION["octram_id_visiteur"]." AND id_boutique=".$_SESSION["octram_id_boutique"]." ORDER BY id DESC LIMIT 1")or die(print_r($bdd->errorInfo()));
        if($donne = $prepare->fetch())
        	return $donne["id"];
		else
		{
			$ins = $bdd->prepare("INSERT INTO facture (date, etat, acheteur, id_boutique)VALUES(NOW(), 'proforma', ?,?)");
			$ins->execute(array($_SESSION["octram_id_visiteur"], $_SESSION["octram_id_boutique"])) or die();
			
			return $bdd->lastInsertedId();
		}
    }
    function calcul_total($id_facture)
    {
        $bdd=connexion();
        $selection_total = $bdd->query("SELECT SUM(question.prix*question.quantite) total from question where question.id_facture=".$id_facture)or die(print_r($bdd->errorInfo()));
        $total = $selection_total->fetch();
        return $total["total"];
    }
    function darkroom($img, $to, $width = 0, $height = 0, $useGD = TRUE)
    {

        $dimensions = getimagesize($img);
        $ratio      = $dimensions[0] / $dimensions[1];

        // Calcul des dimensions si 0 passé en paramètre
        if($width == 0 && $height == 0){
            $width = $dimensions[0];
            $height = $dimensions[1];
        }elseif($height == 0){
            $height = round($width / $ratio);
        }elseif ($width == 0){
            $width = round($height * $ratio);
        }

        if($dimensions[0] > ($width / $height) * $dimensions[1]){
            $dimY = $height;
            $dimX = round($height * $dimensions[0] / $dimensions[1]);
            $decalX = ($dimX - $width) / 2;
            $decalY = 0;
        }
        if($dimensions[0] < ($width / $height) * $dimensions[1]){
            $dimX = $width;
            $dimY = round($width * $dimensions[1] / $dimensions[0]);
            $decalY = ($dimY - $height) / 2;
            $decalX = 0;
        }
        if($dimensions[0] == ($width / $height) * $dimensions[1]){
            $dimX = $width;
            $dimY = $height;
            $decalX = 0;
            $decalY = 0;
        }

        // Création de l'image avec la librairie GD
        if($useGD){
            $pattern = imagecreatetruecolor($width, $height);
            $type = mime_content_type($img);
            switch (substr($type, 6)) {
                case 'jpeg':
                    $image = imagecreatefromjpeg($img);
                    break;
                case 'gif':
                    $image = imagecreatefromgif($img);
                    break;
                case 'png':
                    $image = imagecreatefrompng($img);
                    break;
            }
            imagecopyresampled($pattern, $image, 0, 0, 0, 0, $dimX, $dimY, $dimensions[0], $dimensions[1]);
            imagedestroy($image);
            imagejpeg($pattern, $to, 100);

            return TRUE;

            // Création de l'image avec ImageMagick
        }else{
            $cmd = '/usr/bin/convert -resize '.$dimX.'x'.$dimY.' "'.$img.'" "'.$dest.'"';
                shell_exec($cmd);

                // $cmd = '/usr/bin/convert -gravity Center -quality '.self::$quality.' -crop '.$largeur.'x'.$hauteur.'+0+0 -page '.$largeur.'x'.$hauteur.' "'.$dest.'" "'.$dest.'"';
                        // shell_exec($cmd);	
        }
        return TRUE;
    }
    function affiche_membre($existance_cont)
    {
        ?>
			<tr>
				
				<td>
					<?php echo $existance_cont["nom"];?>
				</td>
				<td>
					<?php echo $existance_cont["email"];?>
				</td>
				<td>
					<?php echo $existance_cont["date_naissance"]?>
				</td>
				<td>
					<?php echo $existance_cont["domicile"]?>
				</td>
				<td>
					<?php 
					if($existance_cont["etat_compte"]=="innactif" || $existance_cont["etat_compte"]=="viree")
					{?>
						<button class="btn btn-success" onclick="updateAvecParams({action:'update_membre', id:
					<?php echo $existance_cont["id"]?>, statut:'actif'}, this.querySelector('.update_loader'), 
					function(){loadAvecParams({action:'affiche_membres'}
					, '#membres table tbody');});">
						Engager <span class='update_loader'></span>
					</button>
					<?php
					}
					else
					{?>
						<button class="btn btn-danger" onclick="updateAvecParams({action:'update_membre', id:
					<?php echo $existance_cont["id"]?>, statut:'viree'}, this.querySelector('.update_loader'),
					function(){loadAvecParams({action:'affiche_membres'}
					, '#membres table tbody');});">
						Virée <span class='update_loader'></span>
					</button>
					<?php
					}
					?>
					<button class="btn btn-danger" onclick="supprimer('supprimer_membre', 
					<?php echo $existance_cont["id"]?>, function(){load('membres', '#membres table tbody');});">
						SUPPRIMER
					</button>
				</td>
			</tr>
			<?php
    }
    function affiche_lesson($existance_cont)
    {
        ?>
			<tr>
				<td class="col-sm-1">
					<img class="img-responsive thumbnail" 
					src="../images/produit/thumbnail/<?php echo $existance_cont["photo"];?>"/>
				</td>
				<td>
					<?php echo $existance_cont["nom"]; ?>
				</td>
				<td>
					<?php echo $existance_cont["description"]?>
				</td>
				<td>
					<?php echo $existance_cont["prix"]?>
				</td>
				<td>
					<button class="btn btn-danger" onclick="supprimer('supprimer_produit', 
					<?php echo $existance_cont["id"]?>, function(){load('questions', '#produits table tbody');});">
						SUPPRIMER
					</button>
					
					<a class="btn btn-primary" data-toggle="modal" href='#modal-produit'
					onclick="loadAvecParams({action:'affiche_lesson_admin', id:<?php echo $existance_cont["id"];?>}, '#modal-produit .modal-body');" 
					class="btn btn-warning">
						ouvrire
					</a>
					
				</td>
				
			</tr>
		<?php
    }
    function affiche_facture($id_facture)
    {
        $bdd = connexion();
        $selection = $bdd->query("SELECT question.prix prix_a, question.id, question.date, question.quantite, question.livraison,
		produit.nom, produit.photo, produit.unite FROM question INNER JOIN produit ON 
		question.id_produit=produit.id INNER JOIN facture ON question.id_facture=facture.id 
		WHERE question.id_boutique=".$_SESSION["id_boutique"]."
		 AND id_acheteur=".$_SESSION["octram_id_visiteur"]
		 ." AND facture.id=".$id_facture." ORDER BY question.date DESC")or die(print_r($bdd->errorInfo()));
		?>
		
		<table class="text-left hidden-print table table-striped table-hover table-bordered" id="tableau_panier">
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Désignation</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Frais de livraison</th>
                    <th>Montant total</th>
                    <th>Date d'ajout</th>
                    <th>Option</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($donne2 = $selection -> fetch())
                    {
                        ?>
                        <tr>
                            <td>
                                <img src="images/produit/thumbnail/<?php echo $donne2["photo"]; ?>" 
                                class="img-responsive thumbnail" alt="Image">
                            </td>
                            <td><?php echo $donne2["nom"]; ?></td>
                            <td><?php echo $donne2["prix_a"]; ?></td>
                            <td class="tdQuantite">
                                <input class="remplir" 
                                onblur="updateAvecParams({quantite:this.value,action:'update_question', id:<?php echo $donne2["id"];?>}, this, function(){loadAvecParams({action:'affiche_panier'}, 
                                '#modal-blanc .contenu');})"type="number" value="<?php echo $donne2["quantite"]; ?>"/>
                                <span class="badge"><?php echo $donne2["unite"];?></span>
                            </td>
                            <td>
                                <?php echo $donne2["livraison"];?>
                            </td>
                            <td>
                                <?php echo ($donne2["prix_a"]*$donne2["quantite"])+$donne2["livraison"];?>
                            </td>
                            <td><?php echo $donne2["date"]; ?></td>
                            <td>
                                <button type="button" onclick="supprimer('supprimerQuestion', 
                                <?php echo $donne2["id"];?>, loadAvecParams({action:'affiche_panier'}, 
                                '#modal-blanc .contenu'))" class="btn btn-danger">Supprimer</button>
                            </td>
                        </tr>
                    <?php
                    }
                ?>
			</tbody>
		</table>
		
		<div class="alert alert-info hidden-print">
            <div class="row">
                <div class="col-xs-6 text-left">
                    <strong>Montant Total</strong>
                </div>
                <div class="col-xs-6 text-right">
                    <?php $leTotalFC = calcul_total($id_facture); echo $leTotalFC; ?> FC
					<div><?php echo round($leTotalFC/490); ?> €</div>
                </div>
            </div>
		</div>
		
		
		<div class="visible-print"style="overflow:hidden!important;" id="modal-facture">
			<div class="panel panel-danger imprimable">
				<div class="panel-heading">
					<h4 class="panel-title"><img src="img/logo.png"/><span class="padding titre-facture">Facture Proforma</span></h4>
				</div>
				<div class="panel-body text-center">
					<div class="row">
						<div class="col-xs-7 client-info">
						</div>
						<div class="col-xs-5 text-center facture-div-group">
							<div class="facture-date">
								<?php echo date("j/m/y"); ?>
							</div>
							<div class="numero-facture">
								Numero de facture : 120
							</div>
						</div>
					</div>
					<br/><br/><br/>
					<div class="row">
						<table class="text-left table table-striped table-hover table-bordered" id="tableau_panier">
									<thead>
										<tr>
											<th>Date</th>
											<th>Désignation</th>
											<th>Quantité</th>
											<th>P.U</th>
											<th>Montant total</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$selection = $bdd->query("SELECT question.prix prix_a, question.id, question.date,question.livraison,
										 question.quantite, 
										produit.nom, produit.photo, produit.unite FROM question INNER JOIN produit ON 
										question.id_produit=produit.id WHERE question.id_boutique=".$_SESSION["id_boutique"]." 
										 AND question.id_facture=".$id_facture." ORDER BY question.date DESC")or die(print_r($bdd->errorInfo()));
		
									while($donne2 = $selection -> fetch())
									{
										?>
										<tr>
											<td><?php echo $donne2["date"]; ?></td>
											<td><?php echo $donne2["nom"]; ?></td>
											<td class="tdQuantite">
												<input class="remplir" 
												onblur="updateAvecParams({quantite:this.value,action:'update_question', id:<?php echo $donne2["id"];?>}, this, function(){loadAvecParams({action:'affiche_panier'}, 
												'#modal-blanc .contenu');})"type="number" value="<?php echo $donne2["quantite"]; ?>"/>
												<span class="badge"><?php echo $donne2["unite"];?></span>
											</td>
											<td><?php echo $donne2["prix_a"]; ?></td>
											<td>
												<?php echo ($donne2["prix_a"]*$donne2["quantite"]);?>
											</td>
										</tr>
							<?php
							}
							?>
							</tbody>
						</table>
					</div>
					<div class="row">
						<div class="alert alert-info text-left">
							<div class="row">
								<div class="col-xs-6 text-left">
									<strong class="">Total :</strong>
								</div>
								<div class="col-xs-6 text-right">
									<?php echo calcul_total($id_facture); ?>
								</div>
							</div>
						</div>
					</div>
					
				</div>
				<div class="panel-footer hidden-print">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" onclick="print();" class="btn btn-primary">
						<span class="glyphicon glyphicon-print"></span> Imprimer
					</button>
				</div>
			</div>
		</div>
		<?php
    }
    function affiche_facture_admin($id_facture)
    {
        $bdd = connexion();
        $selection = $bdd->query("SELECT question.prix prix_a, question.id, question.date, question.quantite, question.livraison,
		produit.nom, produit.photo, produit.unite FROM question INNER JOIN produit ON 
		question.id_produit=produit.id INNER JOIN facture ON question.id_facture=facture.id 
		WHERE question.id_boutique=".$_SESSION["id_boutique"]
		 ." AND facture.id=".$id_facture." ORDER BY question.date DESC")or die(print_r($bdd->errorInfo()));
		?>
		
		<div class="table-responsive">
			<table class="text-left  
			hidden-print table table-striped table-hover table-bordered" id="tableau_panier">
				<thead>
					<tr>
						<th>Photo</th>
						<th>Désignation</th>
						<th>Prix</th>
						<th>Quantité</th>
						<th>Frais de livraison</th>
						<th>Montant total</th>
					</tr>
				</thead>
				<tbody>
					<?php
						while($donne2 = $selection -> fetch())
						{
							?>
							<tr>
								<td>
									<img style="width:95%;height:auto;"src="../images/produit/thumbnail/<?php echo $donne2["photo"]; ?>" alt="photo"/>
								</td>
								<td><?php echo $donne2["nom"]; ?></td>
								<td class="tdQuantite">
									<input class="remplir" 
									onblur="updateAvecParams({prix:this.value,action:'update_question', id:<?php echo $donne2["id"];?>}, 
									this, function(){loadAvecParams({action:'affiche_facture_admin', id:<?php echo $id_facture;?>}, 
									'#modal-facture .modal-body');})"type="number" value="<?php echo $donne2["prix_a"]; ?>"/>
								</td>
								<td>
									<?php echo $donne2["quantite"]; ?>
									<span class="badge"><?php echo $donne2["unite"];?></span>
								</td>
								<td>
									<?php echo $donne2["livraison"];?>
								</td>
								<td>
									<?php echo ($donne2["prix_a"]*$donne2["quantite"])+$donne2["livraison"];?>
								</td>
							</tr>
						<?php
						}
					?>
				</tbody>
			</table>
		</div>
		
		<div class="alert alert-info hidden-print">
			<strong>Montant Total</strong> <?php echo calcul_total($id_facture); ?>
		</div>
		
		
		<div class="visible-print" id="modal-facture">
			<div class="panel panel-danger imprimable">
				<div class="panel-heading">
					<h4 class="panel-title"><img src="../img/logo.png"/><span class="padding titre-facture">Facture Proforma</span></h4>
				</div>
				<div class="panel-body text-center">
					<div class="row">
						<div class="col-xs-7 client-info">
						</div>
						<div class="col-xs-5 text-center facture-div-group">
							<div class="facture-date">
								<?php echo date("j/m/y"); ?>
							</div>
							<div class="numero-facture">
								Numero de facture : 120
							</div>
						</div>
					</div>
					<br/><br/><br/>
					<div class="row">
						<table class="text-left table table-striped table-hover table-bordered" id="tableau_panier">
									<thead>
										<tr>
											<th>Date</th>
											<th>Désignation</th>
											<th>Quantité</th>
											<th>P.U</th>
											<th>Montant total</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$selection = $bdd->query("SELECT question.prix prix_a, question.id, question.date,question.livraison,
										 question.quantite, 
										produit.nom, produit.photo, produit.unite FROM question INNER JOIN produit ON 
										question.id_produit=produit.id WHERE question.id_boutique=".$_SESSION["id_boutique"]." 
										 AND question.id_facture=".$id_facture." ORDER BY question.date DESC")or die(print_r($bdd->errorInfo()));
		
									while($donne2 = $selection -> fetch())
									{
										?>
										<tr>
											<td><?php echo $donne2["date"]; ?></td>
											<td><?php echo $donne2["nom"]; ?></td>
											<td class="tdQuantite">
												<input class="remplir" 
												onblur="updateAvecParams({quantite:this.value,action:'update_question', id:<?php echo $donne2["id"];?>}, this, function(){loadAvecParams({action:'affiche_panier'}, 
												'#modal-blanc .contenu');})"type="number" value="<?php echo $donne2["quantite"]; ?>"/>
												<span class="badge"><?php echo $donne2["unite"];?></span>
											</td>
											<td><?php echo $donne2["prix_a"]; ?></td>
											<td>
												<?php echo ($donne2["prix_a"]*$donne2["quantite"]);?>
											</td>
										</tr>
							<?php
							}
							?>
							</tbody>
						</table>
					</div>
					<div class="row">
						<div class="alert alert-info text-left">
							<div class="row">
								<div class="col-xs-6 text-left">
									<strong class="">Total :</strong>
								</div>
								<div class="col-xs-6 text-right">
									<?php echo calcul_total($id_facture); ?>
								</div>
							</div>
						</div>
					</div>
					
				</div>
				<div class="panel-footer hidden-print">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" onclick="print();" class="btn btn-primary">
						<span class="glyphicon glyphicon-print"></span> Imprimer
					</button>
				</div>
			</div>
		</div>
		<?php
    }
	function affiche_lesson_admin($id_produit)
    {
        $bdd = connexion();
        $selection = $bdd->query("SELECT * FROM cours WHERE id=".$id_produit." ORDER BY date DESC")or die(print_r($bdd->errorInfo()));
		?>
		
		<div class="table-responsive">
			<table class="text-left  
			hidden-print table table-striped table-hover table-bordered" id="tableau_panier">
				<thead>
					<tr>
						<th>Photo</th>
						<th>titre</th>
						<th>Déscription</th>
						<th>Contenu</th>
					</tr>
				</thead>
				<tbody>
					<?php
						while($donne2 = $selection -> fetch())
						{
							?>
							<tr>
								<td>
									<img style="max-width:95%;height:auto;"src="../images/produit/thumbnail/<?php echo $donne2["photo"]; ?>" alt="photo"/>
								</td>
								<td>
									<input type="text" class="remplir"value="<?php echo $donne2["titre"]; ?>" onblur="updateAvecParams({nom:this.value,action:'update_cours', id:<?php echo $donne2["id"];?>}, 
									this, function(){loadAvecParams({action:'affiche_lesson_admin', id:<?php echo $id_produit;?>}, 
									'#modal-produit .modal-body');})"/>
								</td>
								<td class="tdQuantite">
									<input class="remplir" 
									onblur="updateAvecParams({prix:this.value,action:'update_cours', id:<?php echo $donne2["id"];?>}, 
									this, function(){loadAvecParams({action:'affiche_lesson_admin', id:<?php echo $id_produit;?>}, 
									'#modal-produit .modal-body');})"type="number" value="<?php echo $donne2["description"]; ?>"/>
								</td>
								<!--<td>
									<?php echo $donne2["description"]; ?>
									<span class="badge"><?php echo $donne2["contenu"];?></span>
								</td>-->
								<!--<td>
									<?php echo $donne2["livraison"];?>
								</td>-->
								<td>
									<textarea class="form-control"onblur="updateAvecParams({description:this.value,action:'update_produit', id:<?php echo $donne2["id"];?>}, 
									this, function(){loadAvecParams({action:'affiche_lesson_admin', id:<?php echo $id_produit;?>}, 
									'#modal-produit .modal-body');})"><?php echo $donne2["description"];?></textarea>
								</td>
							</tr>
						<?php
						}
					?>
				</tbody>
			</table>
			<form enctype="multipart/form-data">
				<div class="form-group">
					<div class="col-sm-10">
						<input type="file" onchange="updatePhoto(this, 'update_produit', <?php echo $id_produit;?>, function(){affiche('produits');});"name="photo" id="photo" class="form-control" pattern="" title="">
					</div>
				</div>
				<div class="progress"><div class="progress-bar"></div></div>
			</form>
		</div>
		
		
		<div class="visible-print" id="modal-produit">
			<div class="panel panel-danger imprimable">
				<div class="panel-heading">
					<h4 class="panel-title"><img src="../img/logo.jpeg"/><span class="padding titre-produit">produit Proforma</span></h4>
				</div>
				<div class="panel-body text-center">
					<div class="row">
						<div class="col-xs-7 client-info">
						</div>
						<div class="col-xs-5 text-center produit-div-group">
							<div class="produit-date">
								<?php echo date("j/m/y"); ?>
							</div>
							<div class="numero-produit">
								Numero de produit : 120
							</div>
						</div>
					</div>
					<br/><br/><br/>
					<div class="row">
						<table class="text-left table table-striped table-hover table-bordered" id="tableau_panier">
							<thead>
								<tr>
									<th>Date</th>
									<th>Désignation</th>
									<th>Quantité</th>
									<th>P.U</th>
									<th>Montant total</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$selection = $bdd->query("SELECT question.prix prix_a, question.id, question.date,question.livraison,
									question.quantite, 
								produit.nom, produit.photo, produit.unite FROM question INNER JOIN produit ON 
								question.id_produit=produit.id WHERE question.id_boutique=".$_SESSION["id_boutique"]." 
									AND question.id_produit=".$id_produit." ORDER BY question.date DESC")or die(print_r($bdd->errorInfo()));

							while($donne2 = $selection -> fetch())
							{
								?>
								<tr>
									<td><?php echo $donne2["date"]; ?></td>
									<td><?php echo $donne2["nom"]; ?></td>
									<td class="tdQuantite">
										<input class="remplir" 
										onblur="updateAvecParams({quantite:this.value,action:'update_question', id:<?php echo $donne2["id"];?>}, this, function(){loadAvecParams({action:'affiche_panier'}, 
										'#modal-blanc .contenu');})"type="number" value="<?php echo $donne2["quantite"]; ?>"/>
										<span class="badge"><?php echo $donne2["unite"];?></span>
									</td>
									<td><?php echo $donne2["prix_a"]; ?></td>
									<td>
										<?php echo ($donne2["prix_a"]*$donne2["quantite"]);?>
									</td>
								</tr>
							<?php
							}
					?>
							</tbody>
						</table>
					</div>
					<div class="row">
						<div class="alert alert-info text-left">
							<div class="row">
								<div class="col-xs-6 text-left">
									<strong class="">Total :</strong>
								</div>
								<div class="col-xs-6 text-right">
									<?php echo calcul_total($id_produit); ?>
								</div>
							</div>
						</div>
					</div>
					
				</div>
				<div class="panel-footer hidden-print">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" onclick="print();" class="btn btn-primary">
						<span class="glyphicon glyphicon-print"></span> Imprimer
					</button>
				</div>
			</div>
		</div>
		<?php
	}
	function affiche_lessons($id_categorie)
    {
        $bdd = connexion();
		$selection = $bdd->query("SELECT * FROM cours WHERE categorie=".$id_categorie." ORDER BY date DESC")or die(print_r($bdd->errorInfo()));
		while($donne_seel=$selection->fetch())
		{
			?>
				<a href="lesson?id=<?php echo $donne_seel['id']; ?>"> <?php echo $donne_seel['titre']; ?> </a> <br/>
			<?php
		}
	}
	function charger_produits($post, $nbr_per_page, $photo="photo!='default.png'")
	{
		$bdd = connexion();
		$prep_requet;
	
		if(!isset($post["categorie"]) OR empty($post["categorie"]))
			$categorie_filtre = "1";
		else
			$categorie_filtre = " categorie=".$post["categorie"];

		if(empty($post["nom"]))
		{
			// echo $categorie_filtre."<br>";
			$nbr = $bdd->query("SELECT COUNT(*) nbr FROM produit WHERE id_boutique=1 
			AND ".$photo." AND ".$categorie_filtre)OR DIE(print_r($bdd->errorInfo()));
			$nbrr=$nbr->fetch();

			$nbr_total = $nbrr["nbr"]/$nbr_per_page;
			$prep_requet = $bdd->prepare("SELECT * FROM produit WHERE id_boutique=? AND ".$photo." 
			AND ".$categorie_filtre." 
			ORDER BY date DESC LIMIT ".$nbr_per_page." OFFSET ".$post["offset"]."");
			$prep_requet -> execute(array(1));
		}
		else
		{
			$nbr = $bdd->query("SELECT COUNT(*) nbr FROM produit WHERE (id_boutique=1 and nom REGEXP '".$post['nom']."' 
			OR famille REGEXP '".$post['nom']."') AND ".$categorie_filtre);
			$nbrr=$nbr->fetch();

			$nbr_total = $nbrr["nbr"]/$nbr_per_page;

			$prep_requet = $bdd->prepare("SELECT * FROM produit WHERE (id_boutique=? 
			and nom REGEXP '".$post['nom']."' OR famille REGEXP '".$post['nom']."')  
			AND ".$categorie_filtre." ORDER BY date DESC LIMIT ".$nbr_per_page." 
			OFFSET ".$post["offset"]."");
			$prep_requet -> execute(array(1));
		}
		return array("nbr_total"=>$nbr_total, "prep_requet"=>$prep_requet);
	}
	function affiche_lesson_visiteur($id)
	{
		$bdd = connexion();
        $selection = $bdd->query("SELECT * FROM cours WHERE id=".$id)or die(print_r($bdd->errorInfo()));
		
		while($donne = $selection->fetch())
		{
		?>
			<div class="col-sm-12" style="display: block; padding-left:58px;padding-right:158px;">
				<div class="img-container col-sm-12 col-md-12">
					<img src="./images/produit/full/<?php echo $donne["photo"]; ?>" class="img-responsive" alt="">
				</div>
				<div class="col-md-12">
					<h1 class="titre title" style="height:50px;"><?php echo $donne["titre"]; ?></h1>
				</div>
			</div>
			<div>
				<?php echo $donne["contenu"]; ?><br>
				<button class="btn btn-default" onclick='lire(`<?php echo $donne["contenu"]; ?>`)'>
				
				<span class="glyphicon glyphicon-volume-up" aria-hidden="true"></span>
				 Ecouter</button>
				<div class="row">
					<div class="col-md-5">
						<a href="../../images/cours/full/<?php echo $donne['photo']; ?>" class="thumbnail">
						 <img src="../../images/cours/full/<?php echo $donne['photo']; ?>" class="img-responsive" alt="Image">
						</a>
					</div>
				</div>
				 
				              
			</div>
		<?php
		}
	}

	function affiche_exercice_resultat($lesson)
	{
		//recuperation du nom de l'étudiants
		$bdd = connexion();
		$existance = $bdd->query("SELECT * from exercice WHERE cours=".$lesson." ORDER BY id ASC")
		or die(print_r($bdd->errorInfo()));

		while($existance_cont = $existance->fetch())
		{
			?>
				<h1 class="text-center titre-exo"><?php echo $existance_cont["titre"];?>(correction)</h1>
			<?php

			$point_gagne = 0;

			$exi = $bdd->query("SELECT * from question WHERE exercice=".$existance_cont["id"]." ORDER BY id ASC")
			or die(print_r($bdd->errorInfo()));

			while($eont = $exi->fetch())
			{
				$index = "reponse".$eont["id"];
				?>
					<h3><?php echo $eont["contenu"];?></h3>
				<?php
					$ex = $bdd->query("SELECT * from reponse WHERE question=".$eont["id"]." ORDER BY id ASC")
					or die(print_r($bdd->errorInfo()));

					while($nt = $ex->fetch())
					{
						if($nt["verite"]=="1" && $nt["id"]==$_POST[$index])
						{
							$point_gagne += 10;
						?>
							<script>gagnerDesPoints("../../", 20);</script>
						<?php	
						}
						if(!$nt["verite"] && $nt["id"]==$_POST[$index])
						{
						?>
							
						<?php	
						}
						?>
							
							<div class="radio">
								<p>
									<strong><?php echo $nt["contenu"];?></strong> 
									<span class="label 
									<?php if($nt["verite"])echo 'label-success';else echo 'label-danger'; ?>">
									<?php if($nt["verite"])echo 'Vrai';else echo "Faux"; ?></span>
								</p>
							</div>
							
						<?php
					}
					$_SESSION["exp"]+=$point_gagne;
					?>
						
						<div class="alert alert-info">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							Vous avez gagne <strong><?php echo $point_gagne; ?></strong>
							, votre EXP est de <?php echo $_SESSION["exp"]; ?>
						</div>
						
					<?php
			}
			
		}
	}
	function affiche_exercice($lesson)
	{
		//recuperation du nom de l'étudiants
		$bdd = connexion();
		$existance = $bdd->query("SELECT * from exercice WHERE cours=".$lesson." ORDER BY id ASC")
		or die(print_r($bdd->errorInfo()));

		while($existance_cont = $existance->fetch())
		{
			?>
				<h3><?php echo $existance_cont["titre"];?></h3>
			<?php
			$exi = $bdd->query("SELECT * from question WHERE exercice=".$existance_cont["id"]."")
			or die(print_r($bdd->errorInfo()));

			while($ont = $exi->fetch())
			{
			
				?>
					<h4><?php echo $ont["contenu"];?></h4>
				<?php

					$reponse = $bdd->prepare("SELECT reponse.id, reponse.contenu from reponse WHERE reponse.question=?")
					or die(print_r($bdd->errorInfo()));
					$reponse->execute(array($ont["id"]));
					while($lareponse = $reponse->fetch())
					{
						?>
							
							<div class="radio">
								<label>
									
									<input type="radio" name="reponse<?php echo $ont["id"];?>" value="<?php echo $lareponse["id"];?>">
									<?php echo $lareponse["contenu"];?>
								</label>
							</div>
							
						<?php
					}
			}
			
		}
	}

	function affiche_categories_select()
	{
		$bdd = connexion();
		$prep_requet = $bdd->prepare("SELECT * FROM categorie ORDER BY date DESC");
		$prep_requet -> execute(array(1));

		while($donne = $prep_requet->fetch())
		{
			?>
				<option value="<?php echo $donne['id']; ?>"><?php echo $donne['titre']; ?></option>
			<?php
		}
	}
?>