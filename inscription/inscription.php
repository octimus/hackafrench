<?php
    include("../fonction.php");
    $bdd=connexion();
    if(isset($_POST))
    {
        if(!empty($_POST['nom'])and !empty($_POST['email']) and !empty($_POST['pass']))
        {
            $selection=$bdd->prepare("SELECT * FROM membre where email=?");
            $selection->execute(array($_POST['email']))or die(print_r($bdd->errorInfo()));
            
            if(!$user=$selection->fetch())
            {
                $insertion=$bdd->prepare("INSERT INTO membre(nom,password, email)values(?,?,?)");
                $insertion->execute(array($_POST['nom'],sha1($_POST['pass']),$_POST['email']));
                
                $selection=$bdd->prepare("SELECT * FROM membre where  email=? and password=?");
                $selection->execute(array($_POST['email'], sha1($_POST['pass'])))or die(print_r($bdd->
                errorInfo()));
                
                if($user2=$selection->fetch())
                {
                    $_SESSION['nom']=$user2['nom_prenom'];
                    $_SESSION['pass']=$user2['pass'];
                    $_SESSION['email']=$user2['email'];
                    $_SESSION["exp"]=$user2['exp'];
                    $_SESSION['octram_id_visiteur']=$user2['id'];
                    header("Location:..");
                }
                echo '<span class="success text-center">inscription reussie</span>';
            }
            else
            {
                echo '<span class="red text-center">le numero ou l\'email que vous avez ecrit est deja inscrit.
                    veuillez verifier</span>';										
            }
            
        }
        else
        {
            echo '<span class="red text-center">Veuillez remplir les champs obligatoires vides</span>';
        }
    }
    else
        echo "Veuillez remplire tous les champs necessaires.";print_r($_POST);