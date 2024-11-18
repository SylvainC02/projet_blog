<?php

// Fonctions All

function recupAllCategories()
{
    include "connexiondb.php";
    $sqlQuery = "SELECT * FROM categorie";
    $result = $db->prepare($sqlQuery);
    $result->execute();
    $categorie = $result->fetchAll(PDO::FETCH_ASSOC);
    return $categorie;
}

function recupAllArticles()
{
    include "connexiondb.php";
    $sqlQuery = "SELECT * FROM article";
    $result = $db->prepare($sqlQuery);
    $result->execute();
    $articles = $result->fetchAll(PDO::FETCH_ASSOC);
    return $articles;
}

function recupAllCommentaires($id)
{
    include "connexiondb.php";
    $sqlQuery = "SELECT * FROM commentaire WHERE id_article = $id";
    $result = $db->prepare($sqlQuery);
    $result->execute();
    $commentaire = $result->fetchAll(PDO::FETCH_ASSOC);
    return $commentaire;
}







// Fonctions by id

function recupCategorieById($id)
{
    include "connexiondb.php";
    $sqlQuery = "SELECT * FROM categorie WHERE id = $id";
    $result = $db->prepare($sqlQuery);
    $result->execute();
    $categorie = $result->fetch(PDO::FETCH_ASSOC);
    return $categorie;
}

function recupArticleById($id)
{
    include "connexiondb.php";
    $sqlQuery = "SELECT * FROM article WHERE id = $id";
    $result = $db->prepare($sqlQuery);
    $result->execute();
    $article = $result->fetch(PDO::FETCH_ASSOC);
    return $article;
}






// Fonctions lié a un article

function ajouterArticle($titre, $contenu, $resume, $categorie, $image)
{
    include "connexiondb.php";
    $date = date("Y-m-d");
    $idAuteur = $_SESSION['user']['id'];
    $query = $db->prepare("INSERT INTO article VALUES (null, :titre, :date , :id_user, :contenu, :image, :id_categorie, :resume)");
    $query->bindParam(':titre', $titre);
    $query->bindParam(':date', $date);
    $query->bindParam(':id_user', $idAuteur);
    $query->bindParam(':contenu', $contenu);
    $query->bindParam(':image', $image);
    $query->bindParam(':id_categorie', $categorie);
    $query->bindParam(':resume', $resume);
    $query->execute();
}

function modifierArticle($id, $titre, $contenu, $resume, $categorie, $image)
{
    include "connexiondb.php";
    $sqlquery = $db->exec("UPDATE article SET titre = '$titre', contenu='$contenu', image='$image', id_categorie='$categorie', resume='$resume' WHERE article.id = $id");
}

function renameImage($titre)
{
    $search  = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ð', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ');
    $replace = array('A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 'a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y');
    $titreImage = str_replace($search, $replace, $titre);
    $titreImage = str_replace(" ", "", (strtolower($titreImage)));

    return $titreImage;
}

function afficherAuteurArticle($id)
{
    include "connexiondb.php";

    $sqlQuery = "SELECT pseudo FROM user 
                 INNER JOIN article ON article.id_user=user.id
                 WHERE article.id = $id";

    $result = $db->prepare($sqlQuery);
    $result->execute();
    $auteur = $result->fetch(PDO::FETCH_ASSOC);
    return $auteur["pseudo"];
}


function ajouterCommentaire($idarticle, $contenu)
{
    include "connexiondb.php";
    $date = date("Y-m-d-H-i-s");
    $idAuteur = $_SESSION['user']['id'];
    $query = $db->prepare("INSERT INTO commentaire VALUES (null, :date, :contenu, :auteur, :id_article)");
    $query->bindParam(':date', $date);
    $query->bindParam(':contenu', $contenu);
    $query->bindParam(':auteur', $idAuteur);
    $query->bindParam(':id_article', $idarticle);
    $query->execute();
}

function modifierCommentaire($idCom, $contenu)
{
    include "connexiondb.php";

    $db->exec("UPDATE commentaire SET contenu = '$contenu' WHERE commentaire.id = $idCom");
}

function afficherAuteurCommentaire($id)
{
    include "connexiondb.php";

    $sqlQuery = "SELECT pseudo FROM user 
                 INNER JOIN commentaire ON commentaire.auteur=user.id
                 WHERE commentaire.id = $id";

    $result = $db->prepare($sqlQuery);
    $result->execute();
    $auteur = $result->fetch(PDO::FETCH_ASSOC);
    return $auteur["pseudo"];
}

function deleteArticle($id)
{
    include "connexiondb.php";
    $sqlQuery = "DELETE FROM commentaire WHERE id_article = $id";
    $deleteCom = $db->prepare($sqlQuery);
    $deleteCom->execute();

    $sqlQuery = "DELETE FROM article WHERE id = $id";
    $deleteArticle = $db->prepare($sqlQuery);
    $deleteArticle->execute();
}

function deleteCommentaire($id)
{
    include "connexiondb.php";
    $sqlQuery = "DELETE FROM commentaire WHERE id = $id";
    $deleteCom = $db->prepare($sqlQuery);
    $deleteCom->execute();
}




// Fonctions lié a un user

function register($pseudo, $password, $email)
{
    include "connexiondb.php";
    $query = $db->prepare("INSERT INTO user VALUES (null, :pseudo, :mdp, :mail)");
    $query->bindParam(':pseudo', $pseudo);
    $query->bindParam(':mdp', $password);
    $query->bindParam(':mail', $email);
    $query->execute();
}

function getUserInfosByMail($email)
{
    include "connexiondb.php";
    $query = $db->query("SELECT * FROM user WHERE user.mail='$email'");
    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function deleteUser($id)
{
    include "connexiondb.php";
    $sqlQuery = "DELETE FROM commentaire WHERE auteur = $id";
    $deleteCom = $db->prepare($sqlQuery);
    $deleteCom->execute();

    $sqlQuery = "DELETE FROM article WHERE id_user = $id";
    $deleteArticle = $db->prepare($sqlQuery);
    $deleteArticle->execute();

    $sqlQuery = "DELETE FROM user WHERE id = $id";
    $deleteArticle = $db->prepare($sqlQuery);
    $deleteArticle->execute();
}




// Fonctions recup X By Y

function recupArticleByCategorie($idCategorie)
{
    include "connexiondb.php";
    $sqlQuery = "SELECT * FROM article WHERE id_categorie = $idCategorie";
    $result = $db->prepare($sqlQuery);
    $result->execute();
    $article = $result->fetchAll(PDO::FETCH_ASSOC);
    return $article;
}

function recupAllArticleByUser($id)
{
    include "connexiondb.php";
    $sqlQuery = "SELECT * FROM article WHERE id_user = $id";
    $result = $db->prepare($sqlQuery);
    $result->execute();
    $article = $result->fetchAll(PDO::FETCH_ASSOC);
    return $article;
}

function recupAllCommentaireByArticle($id)
{
    include "connexiondb.php";
    $sqlQuery = "SELECT * FROM commentaire WHERE id_article = $id";
    $result = $db->prepare($sqlQuery);
    $result->execute();
    $commentaire = $result->fetchAll(PDO::FETCH_ASSOC);
    return $commentaire;
}

function recupAllCommentaireByUser($id)
{
    include "connexiondb.php";
    $sqlQuery = "SELECT * FROM commentaire WHERE auteur = $id";
    $result = $db->prepare($sqlQuery);
    $result->execute();
    $commentaire = $result->fetchAll(PDO::FETCH_ASSOC);
    return $commentaire;
}

function recupArticleByCommentaire($comId)
{
    include "connexiondb.php";
    $sqlQuery = "SELECT * FROM article WHERE id = $comId";
    $result = $db->prepare($sqlQuery);
    $result->execute();
    $article = $result->fetch(PDO::FETCH_ASSOC);
    return $article;
}
