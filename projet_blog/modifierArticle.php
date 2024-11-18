<?php
include 'header.php';
include 'fonctions.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $article = recupArticleById($id);

    if (isset($_POST) && !empty($_POST)) {

        $titre = htmlspecialchars($_POST['titre']);
        $contenu = htmlspecialchars($_POST['contenu']);
        $resume = htmlspecialchars($_POST['resume']);
        $categorie = htmlspecialchars($_POST['categorie']);

        if (isset($_FILES['imagearticle']) &&  !empty($_FILES['imagearticle']['name'])) {
            $tailleMax = 2097152;
            $extensionValides = array('jpg', 'jpeg', 'gif', 'png');

            if ($_FILES['imagearticle']['size'] <= $tailleMax) {

                //strchr : prend tout ce qui vient apres le point (donc l'extension), substr pour enlever le point et lower pour eviter les JPG,...
                $extensionUpload = strtolower(substr(strrchr($_FILES['imagearticle']['name'], "."), 1));


                $titreImage = renameImage($titre);

                if (in_array($extensionUpload, $extensionValides)) {
                    $chemin = "images/" . $titreImage . "." . $extensionUpload;
                    $resultat = move_uploaded_file($_FILES['imagearticle']['tmp_name'], $chemin);
                }
            }
        } else {
            $chemin = $article['image'];
        }
        modifierArticle($id, $titre, $contenu, $resume, $categorie, $chemin);
        header('location:article.php?id=' . $id . '&status=success&message=Votre article a bien été modifié !');
    }
}
?>

<h1 class="titre">Modifier cet article</h1>
<div class="supprimerArticle">

    <a href="deleteArticle.php?id=<?php echo $id ?>" class="btn btn-secondary">Supprimer cet article</a>
</div>


<div class="container">

    <form class="nouvelarticle" action="" method="POST" enctype="multipart/form-data">
        <h2 class="legend">Veuillez remplir les champs</h2>

        <div class="titreNouveauarticle">

            <label for="titre">Le titre : </label>
            <input type="text" id="titre" name="titre" placeholder="Titre..." value="<?php echo $article['titre'] ?>" class="form-control">

        </div>

        <div>
            <label for=" contenu">Contenu : </label>
            <textarea class="form-control" id="contenu" name="contenu"><?php echo $article['contenu'] ?></textarea>

        </div>

        <div>

            <label for=" resume">Resume : </label>
            <textarea class="form-control" type="text" id="resume" name="resume"> <?php echo $article['resume'] ?> </textarea>

        </div>

        <div>
            <label>Selectionnez une catégorie : </label>
            <select class="form-control" name="categorie" id="categorie">
                <?php
                $categories = recupAllCategories();
                foreach ($categories as $categorie) {
                    echo ("<option value='");
                    echo $categorie['id'];
                    echo ("'>");
                    echo ($categorie["nom"]);
                    echo ("</option>");
                }
                ?>

            </select>

        </div>

        <div>
            <label>Image : </label>
            <input type="file" name="imagearticle" class="form-control" value="<? echo $article['image'] ?>">
        </div>

        <div>
            <input type="submit" value="Modifier" class="btn btn-secondary submitModifierArticle">
        </div>
    </form>
</div>


<?php
include 'footer.php';
?>