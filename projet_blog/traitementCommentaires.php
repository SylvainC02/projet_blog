<?php
session_start();

include "fonctions.php";
if (isset($_POST) && !empty($_POST)) {

    $idArticle = $_POST["idArticle"];
    $contenu = htmlspecialchars($_POST["commentaire"]);

    if (isset($contenu) && !empty($contenu)) {

        ajouterCommentaire($idArticle, $contenu);
    }
}
