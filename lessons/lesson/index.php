<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>hackaton | lessons</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/Pretty-Footer.css">
    <link rel="stylesheet" href="assets/css/Google-Style-Login.css">
    <link rel="stylesheet" href="assets/css/Pretty-Registration-Form.css">
</head>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.10&appId=727343187438025";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<body>
    <div id="progression-bar">
        <div id="progression"></div>
    </div>
    <script>
        exp = <?php include("../../fonction.php");echo $_SESSION["exp"]; ?>
    </script>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header"><a class="navbar-brand navbar-link" href="#">Hackaton </a>
                <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
            </div>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav navbar-right">
                    <li role="presentation"><a href="../../">Accueil </a></li>
                    <li class="active" role="presentation"><a href="../../lessons">Activités </a></li>
                    <li role="presentation"><a href="../../medias">Médias </a></li>
                    <li role="presentation"><a href="..">jeux </a></li>
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
                <a href="../inscription/">Inscription</a>
            </div>
        </div>
    </div>
    <div id="promo">
    <div class="fb-share-button" data-href="http://technocom.com/lessons/lesson?id=<?php echo $_GET["id"];?>"
     data-layout="button_count" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Partager</a></div>
        <div id="lessons-container">
            <div>
                <?php 

                    if(isset($_GET["id"]))
                        affiche_lesson_visiteur($_GET["id"]);
                ?>

            </div>
            <hr>
            <form method="post" action="validation.php">
                <div>
                    <?php affiche_exercice($_GET["id"]); ?>
                        <!-- Your share button code -->
                        <div class="fb-share-button" 
                            data-href="http://comores123soleil.com/dunia/dunia/Dunia.html" 
                            data-image="http://comores123soleil.com/dunia/dunia/Dunia_files/1240699224.jpg"
                            data-layout="button_count">
                        </div> 
                </div>
                <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
                <button class="btn btn-default">Valider et passer à la leçon suivante</button>
            </form>
            
            <div id="disqus_thread"></div>
            <script>

            /**
            *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
            *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
            /*
            var disqus_config = function () {
            this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
            this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
            };
            */
            (function() { // DON'T EDIT BELOW THIS LINE
            var d = document, s = d.createElement('script');
            s.src = 'https://hackafrench.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
            })();
            </script>
            <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                                        

        </div>
    </div>
    <div></div>
    <?php include("../../footer.php");?>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
<script src= "../../fonction.js" type="text/javascript"></script>
<script src= "../../assets/js/script.js" type="text/javascript"></script>
<script src='https://code.responsivevoice.org/responsivevoice.js'></script>




</html>