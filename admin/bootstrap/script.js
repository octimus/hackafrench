<?php
	SESSION_START();
	include('config.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>IUT - ACCUEIL</title>
    <link href="style.css" rel="stylesheet" />
</head>
<body data-spy="scroll" data-target=".navbar-default" data-offset="140">
  <header>

  </header>
	<section>
		<form action="inscription.php">
      <input type="text" name="login" placeholder="login"/>
      <input type="password" name="pass" placeholder="mot de passe"/>
      <input type="password" name="pass" placeholder="mot de passe"/>
      <input type="submit" value="ok"/>
    </form>
	</section>
</body>
</html>
