<?php 
	session_start();
	
	if(!isset($_SESSION["id_admin"]))
	{
?>

<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>123 Soleil | administrations</title>

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
	<style>
		body
		{
			background:url("../img/header3.jpg");
		}
		body div form .form-control
		{
			background:rgba(255,255,255, 0.5);
		}
	</style>
</head>
<div class="content" style="height:auto;" id="departements">
	<div class="row" style="height:25%;"></div>
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6" >
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="card" >
							<div class="header">
								<h4 class="title">Veuillez vous identifier</h4>
							</div>
							<div class="content">
								<form action="../action.php" method="post">
									<input type="hidden" name="action" value="connexion_admin" />
									<input type="hidden" name="login" value="admin" />
									<div class="row">
										<div class="col-md-12">
											<div class="form-group
											<?php
												if(isset($_GET["login"]))
													echo " has-error";
											?>">
												<label>Login</label>
												<input type="text" disabled id="inputLogin" 
												class="form-control" value="Administrateur" required="required" 
												name="" title="">
												<span class="help-block">
													<?php
														if(isset($_GET["login"]))
															echo $_GET["login"];
													?>
												</span>
												
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group
											<?php
												if(isset($_GET["password"]))
													echo " has-error";
											?>">
												<label>Mot de passe</label>
												<input type="password" class="form-control" 
												placeholder="Mot de passe" value="" name="password" required>
												<span class="help-block">
													<?php
														if(isset($_GET["password"]))
															echo $_GET["password"];
													?>
												</span>
											</div>
										</div>
									</div>
									<button type="submit" class="btn btn-info btn-fill pull-right">
										Connexion
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
</div>
<!--
<div class="lat">
	<form action="action.php" method="post">
		<input type="tel" placeholder="numero de telephone" name="tel" /> 
		<input type="password"placeholder="mot de passe" name="pass"/>
		<input type="hidden" name="action" value="login"/>
		<input type="submit" value="se connecter"/>
	</form>
</div>-->

<?php 
	}
	else{
		
		header("Location:dashboard.php");
		}
	?>

