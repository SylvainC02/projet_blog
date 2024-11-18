<?php
session_start();
include 'fonctions.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    echo $id;
    deleteUser($id);
    session_destroy();
    header('location:index.php?status=success&message=Votre compte a bien été supprimmé.');
}
