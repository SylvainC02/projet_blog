<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Monster Hunter</title>
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon" />

</head>

<body>

    <?php
    if (isset($_GET['status']) && !empty($_GET['status'])) {
        $status = $_GET['status'];
        $message = $_GET['message'];
        if ($status != "success") { ?>
            <div class="alert alert-danger text-center" role="alert">
                <strong>Une erreur est survenue</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } else { ?>
            <div class="alert alert-success text-center" role="alert">
                <strong><?php echo $message ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
    <?php }
    }
    ?>


    <div class="header">

        <span><a class="boutonAccueil" href="index.php">Accueil</a></span>
        <?php
        if (isset($_SESSION) && !empty($_SESSION)) { ?>
            <span><a class="boutonAccueil" href="pageUser.php">Mon compte</a> </span>
        <?php } else {
        }
        ?>
        <span class="bouton"><a class="boutonAccueil" href="ajouterarticle.php">Ajouter un article</a></span>

        <?php
        if (isset($_SESSION) && !empty($_SESSION)) {
            echo ('<span><a class="boutonAccueil" href="deco.php">Se déconnecter</a>');
        } else { ?>
            <span><a class="boutonAccueil" href="signin.php">Se connecter</a></span>

            <span><a class="boutonAccueil" href="signup.php">S'inscrire</a></span>
        <?php } ?>




    </div>