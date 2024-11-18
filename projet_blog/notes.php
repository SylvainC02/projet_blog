<?php
//redirection après connexion
$_SESSION['user'] = $userInfos;
header('location:index.php?status="success"&message="Vous êtes bien connecté"');

//chercher dernier point
$lastDot = strrpos($name, '.');

//Requete preparé + bindparam pour plus de securite
function addPost($title, $author, $image, $content)
{
    include "connexiondb.php";
    $query = $db->prepare("INSERT INTO articles VALUES(null, :title, :author_id, null, :image, :content)");
    $query->bindParam(':title', $title);
    $query->bindParam(':author_id', $author);
    $query->bindParam(':image', $image);
    $query->bindParam(':content', $content);
    $query->execute();
}

//deco
session_destroy();
header('location:index.php?status=success&message=Vous êtes bien déconnecté');

//EDIT ARTICLE A RENOMMER
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $post = getPostById($id);
    if (isset($_SESSION['user']) && !empty($_SESSION['user']) && $_SESSION['user']['id'] === $post['author_id']) {
        if (isset($_POST) && !empty($_POST)) {
            $userId = $_SESSION['user']['id'];
            $title = $_POST['title'];
            $content = $_POST['content'];
            if (isset($_FILES) && !empty($_FILES)) {
                $image = $_FILES['image'];
                $upload_dir = 'assets/uploads/';
                $from = $image['tmp_name'];
                $lastDot = strrpos($image['name'], '.');
                $name = uniqid();
                $ext = substr($image['name'], $lastDot);
                $to = $upload_dir . $name . $ext;
                move_uploaded_file($from, $to);
            } else {
                $to = $post['image'];
            }
            editPost($title, $userId, $to, $content);
            header('location:single.php?id=' . $id . '&status=success&message=Votre article a bien été mis à jour');
        }
    } else {
        echo "Vous devez être connecté pour ajouter un article";
    }
}


$dwwm = ['Alex', 'David', 'Davy', 'Halima', 'Melvin', 'Pati', 'Julien S', 'Julien P', 'Sylvain'];
//on récupère la variable envoyé par Ajax
if (isset($_POST['wordToSearch']) && !empty($_POST['wordToSearch'])) {
    $word = $_POST['wordToSearch'];
    // la fonction strncasecomp a besoin de connaitre la longueur de la chaine à comparer donc on va le chercher avec la fonction strlen()
    $wordCount = strlen($word);
    //on regarde si cette variable correspond à un élément de notre tableau (et comme c'est un tableau => foreach)
    foreach ($dwwm as $person) {
        //pour chaque personne du tableau on compare son prénom avec la chaine envoyée, pour cela on va essayer strncasecompare()
        if (strncasecmp($person, $word, $wordCount) === 0) {
            //si ça fonctionne, on affiche les prénoms correspondant
            echo $person . '<br />';
        }
    }
}
