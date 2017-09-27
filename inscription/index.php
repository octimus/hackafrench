<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>hackafrench | inscription</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
    <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/Pretty-Footer.css">
    <link rel="stylesheet" href="assets/css/Google-Style-Login.css">
    <link rel="stylesheet" href="assets/css/Pretty-Registration-Form.css">
</head>

<body>
    <div id="promo">
        <div id="formulaire">
            <div class="row">
                <div class="col-md-12">
                    <div class="row register-form">
                        <div class="col-md-8 col-md-offset-2">
                            <form method="post" class="form-horizontal custom-form" action="inscription.php">
                                <h1>Inscription </h1>
                                <div class="form-group">
                                    <div class="col-sm-4 label-column">
                                        <label class="control-label" for="name-input-field">Nom et prénom</label>
                                    </div>
                                    <div class="col-sm-6 input-column">
                                        <input class="form-control" name="nom" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4 label-column">
                                        <label class="control-label" for="email-input-field">Addresse email</label>
                                    </div>
                                    <div class="col-sm-6 input-column">
                                        <input class="form-control" name="email" type="email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4 label-column">
                                        <label class="control-label" for="pawssword-input-field">Mot de passe</label>
                                    </div>
                                    <div class="col-sm-6 input-column">
                                        <input class="form-control" type="password" name="pass">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4 label-column">
                                        <label class="control-label" for="repeat-pawssword-input-field">Repeter votre mot de passe</label>
                                    </div>
                                    <div class="col-sm-6 input-column">
                                        <input class="form-control" type="password" name="pass">
                                    </div>
                                </div>
                                <button class="btn btn-default submit-button" type="">Valider </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("../footer.php");?>
    <?php 
        include("../header.php");
    ?>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>