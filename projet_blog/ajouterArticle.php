<?php include 'header.php';
include 'fonctions.php';

if (isset($_POST) && !empty($_POST)) {
    $titre = htmlspecialchars($_POST['titre']);
    $contenu = htmlspecialchars($_POST['contenu']);
    $resume = htmlspecialchars($_POST['resume']);
    $categorie = htmlspecialchars($_POST['categorie']);
    if (isset($_FILES['imagearticle']) &&  !empty($_FILES['imagearticle']['name'])) {
        $tailleMax = 2097152;
        $extensionValides = array('jpg', 'jpeg', 'gif', 'png');

        if ($_FILES['imagearticle']['size'] <= $tailleMax) {

            //strchr : prend tout ce qui vient apres le point (donc l'extension), substr pour enlever le point et lower pour eviter les JPG et tt
            $extensionUpload = strtolower(substr(strrchr($_FILES['imagearticle']['name'], "."), 1));


            $titreImage = renameImage($titre);

            if (in_array($extensionUpload, $extensionValides)) {
                $chemin = "images/" . $titreImage . "." . $extensionUpload;
                $resultat = move_uploaded_file($_FILES['imagearticle']['tmp_name'], $chemin);
                if ($resultat) {
                    ajouterArticle($titre, $contenu, $resume, $categorie, $chemin);
                    header('location:index.php?status=success&message=Votre article a bien été enregistré');
                }
            }
        }
    }
}

?>

<?php if (isset($_SESSION) && !empty($_SESSION)) { ?>
    <div class="container">

        <h1 class="titre" id="titreAjouterArticle">Ajouter un article</h1>

        <form class="nouvelarticle" action="" method="POST" enctype="multipart/form-data">
            <h2 class="legend">Veuillez remplir les champs</h2>

            <div class="titreNouveauarticle">

                <label for="titre">Titre : </label>
                <input type="text" id="titre" name="titre" placeholder="Titre..." class="form-control">

            </div>

            <div>
                <label for="contenu">Contenu : </label>
                <textarea id="contenu" name="contenu" placeholder="Contenu..." class="form-control"></textarea>

            </div>

            <div>

                <label for="resume">Résumé : </label>
                <textarea type="text" id="resume" name="resume" placeholder="Résumé..." class="form-control"></textarea>

            </div>

            <div>
                <label>Selectionnez une catégorie : </label>
                <select name="categorie" id="categorie" class="form-control">
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
                <input type="file" name="imagearticle" class="form-control">
            </div>

            <div class="mt-2">
                <input type="submit" value="Ajouter cet article" class="btn btn-secondary" id="boutonAjouterArticle">
            </div>

        </form>

    <?php } else { ?>
        <div class="connectionRequise">Vous devez être <a href="signin.php">connecté</a> pour écrire un article.</div>
    <?php } ?>

    </div>



    <?php include 'footer.php'; ?>