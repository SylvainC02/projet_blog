<?php
include 'fonctions.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    deleteArticle($id);
    header('location:index.php?status=success&message=Votre article a bien été supprimmé');
}
