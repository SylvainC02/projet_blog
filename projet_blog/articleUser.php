<?php
include 'header.php';
include 'fonctions.php';
$id = $_POST['id'];
$articlesUser = recupAllArticleByUser($id);
?>

<h1 class="titre">Voici les articles de <?php echo afficherAuteurArticle($id) ?></h1>

<div class="container-fluid">
    <div class="row">

        <?php
        if (!empty($articlesUser)) {
            foreach ($articlesUser as $article) { ?>

                <div class="col-4">
                    <div class="card text-center">
                        <a href="article.php?id=<?php echo $article["id"] ?>"> <img src="<?php echo $article["image"] ?>" class="card-img-top" alt="..."></a>
                        <div class="card-body">
                            <a class="bouton" href="article.php?id=<?php echo $article["id"] ?>"> <?php echo $article["titre"] ?> </a>
                            <p class="card-text"> <?php echo $article["resume"] ?></p>
                        </div>
                    </div>
                </div>

        <?php }
        } else {
            echo ("<h2 class='titre2'>Désolé, vous n'avez aucun article.</h2>");
        }



        ?>

    </div>


</div>


<?php
include 'footer.php';
?>