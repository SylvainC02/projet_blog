<?php
session_start();
include 'fonctions.php';

if (isset($_POST['idCom']) && !empty($_POST['idCom'])) {
    $idCom = htmlspecialchars($_POST['idCom']);
    echo $_POST["idUser"];
    deleteCommentaire($idCom);

    if (isset($_POST['idCom']) && !empty($_POST['idCom'])) {
        modifierCommentaire($idCom, $contenu);


        if (isset($_POST['idArticle']) && !empty($_POST['idArticle'])) {
            $idArticle = htmlspecialchars($_POST['idArticle']);
            header('location:article.php?id=' . $idArticle . '&status=success&message=Votre commentaire a bien été supprimé');
        } else {
            if (isset($_POST['idUser']) && !empty($_POST['idUser'])) {
                $idUser = htmlspecialchars($_POST["idUser"]);
                header('location:pageUser.php?id=' . $idUser . '&status=success&message=Votre commentaire a bien été supprimé');
            };
        }
    }
}
