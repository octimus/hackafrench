<?php
    include("fonction.php");
    $bdd = connexion();
    if(isset($_POST["action"]))
    {
        if($_POST["action"]=="traduction")
        {
            $oc=0;
            // print_r($_POST);
            $nbr = $bdd->query("SELECT * FROM francais_shinga WHERE (contenu REGEXP '".$_POST['orthographe']."')")or die(print_r($bdd->errorInfo()));

            while($donne = $nbr->fetch())
            {
                $oc++;
                ?>
                <p>
                    <?php echo $donne["contenu"];?>
                </p>
            <?php
            }
            if($oc==0)
                echo "Aucun résultat";
        }
        else if (ISSET($_POST['action']) and $_POST['action']=='connexion_admin')
        {
            if(isset($_POST['login']) AND isset($_POST['password']))
            {
                if($_POST['login']!="" AND $_POST['password']!="")
                {	
                    // print_r($_POST);
                    $dn = $bdd->prepare('select * from admin where password=?')or die(print_r($bdd->errorInfo()));
                    $dn->execute(array(sha1($_POST['password'])));
                    
                    if($repon = $dn->fetch())
                    {
                        if(sha1($_POST['password'])==$repon["password"])
                        {
                            $_SESSION["id_admin"]=$repon['id'];
                            // print_r($_SESSION);
                            // header('Location: admin/dashboard.php');
                        }
                        else
                            header('Location: admin/index.php?password=mot de passe incorrect');
    
                    }
                    else
                    {
                        echo '<br/>'.'erreur d\' authentification.<br/>combinaison de numero et mot de passe incorrecte.'.'<br/>';
                    }
                }
                else if($_POST['password']=="" AND $_POST['login']!="")
                {
                    echo "veuillez specifier un mot de passe!!!";
                }
                else
                {
                    echo "veuillez remplir les champs necessaires!!!";
                }
                
            }
            else
            {
                echo "Veuillez remplir les champs necessaires.";
            }
        }
        
        else if (ISSET($_POST['action']) and $_POST['action']=='connexion')
        {
            connecter($_POST["login"], $_POST["password"]);
        }
        
        else if (ISSET($_POST['action']) and $_POST['action']=='pointer')
        {
            $update = $bdd->prepare("update membre set exp=? where id=?");
            $update -> execute(array($_SESSION["exp"]+$_POST["gain"], $_SESSION["octram_id_visiteur"]));
            $_SESSION["exp"]=$_SESSION["exp"]+$_POST["gain"];
            echo $_SESSION["exp"];
        }
    }
?>