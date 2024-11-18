<?php include 'header.php';
include 'fonctions.php';
$idCategorie = $_GET['id'];
$categorie = recupCategorieById($idCategorie)
?>

<h1 class="titre">Catégorie : <?php echo ($categorie['nom']); ?> </h1>

<div class="container-fluid">
    <div class="row">

        <?php



        $articles = recupArticleByCategorie($idCategorie);

        foreach ($articles as $article) { ?>
            <div class="col-4">
                <div class="card text-center">
                    <a href="article.php?id=<?php echo $article["id"] ?>"> <img src="<?php echo $article["image"] ?>" class="card-img-top" alt="Une image représentant <?php echo $article["titre"] ?>"></a>
                    <div class="card-body">
                        <a class="bouton" href="article.php?id=<?php echo $article["id"] ?>"> <?php echo $article["titre"] ?> </a>
                        <p class="card-text"> <?php echo $article["resume"] ?></p>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>


</div>


<?php include 'footer.php'; ?>