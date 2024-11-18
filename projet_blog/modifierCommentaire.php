<?php
include 'header.php';
include 'fonctions.php';

$contenu = htmlspecialchars($_POST['contenu']);
$id = htmlspecialchars($_POST["id"]);
$idCom = htmlspecialchars($_POST["idCom"]);

if (isset($_POST['idCom']) && !empty($_POST['idCom'])) {
    modifierCommentaire($idCom, $contenu);


    if (isset($_POST['idArticle']) && !empty($_POST['idArticle'])) {
        $idArticle = htmlspecialchars($_POST['idArticle']);
        header('location:article.php?id=' . $idArticle . '&status=success&message=Votre commentaire a bien été modifié');
    } else {
        if (isset($_POST['idUser']) && !empty($_POST['idUser'])) {
            $idUser = htmlspecialchars($_POST["idUser"]);
            header('location:pageUser.php?id=' . $idUser . '&status=success&message=Votre commentaire a bien été modifié');
        };
    }
}
