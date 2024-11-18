<?php
include 'header.php';
include 'fonctions.php';
$compteur = 0;
$articles = recupAllArticles();



?>

<div>
    <h1 class="titre">Monster Hunter</h1>
</div>
<div class="descriptionJeux">Monster Hunter est une série de jeux vidéo développés et édités par Capcom (et Nintendo pour la version 3DS Monster Hunter Generations). L'histoire de la licence débute par un premier opus sur console PlayStation 2 en 2004. S'en suivront de nombreux épisodes jusqu'à Monster Hunter : Rise sorti en mars 2021 sur Nintendo Switch.
    Dans Monster Hunter, le joueur incarne un chasseur évoluant dans un monde fantasy riche, rempli de monstres en tout genre. Et puisque les chasser et les capturer c'est votre dada, votre épanouissement est total. La collecte est aussi de la partie : minéraux, poissons et autres petits monstres peu ragoutants. Au fil de ses quêtes et de sa progression, le joueur peut améliorer ses armes et son équipement pour devenir une véritable machine à tuer du monstre baveux.
    Adaptée au cinéma en 2020 par Paul W.S. Anderson (à qui l'on doit aussi le portage sur grand écran de la saga Resident Evil), on y retrouve l'actrice Milla Jovovich en tête d'affiche. Malgré une critique du film peu enthousiaste, la saga Monster Hunter fait désormais partie de ces jeux d'aventure cross média ayant marqué toute une génération.</div>




<h2 class="titre2">Nos articles</h2>

<div class="container-fluid">

    <div class="row">

        <?php
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

<h2 class="titre2">Les catégories</h2>

<div class="container-fluid">
    <div class="row">

        <?php
        $categories = recupAllCategories();

        foreach ($categories as $categorie) { ?>

            <div class="col-4">
                <div class="card text-center">
                    <a href="categorie.php?id=<?php echo $categorie["id"] ?>"> <img src="<?php echo $categorie["image"] ?>" class="card-img-top" alt="Une image représentant <?php echo $categorie["nom"] ?>"></a>
                    <div class=" card-body">
                        <a class="bouton" href="categorie.php?id=<?php echo $categorie["id"] ?>"> <?php echo $categorie["nom"] ?> </a>
                        <p class="card-text"><?php echo ($categorie['resume']) ?></p>
                    </div>
                </div>
            </div>
        <?php } ?>




    </div>
</div>

<?php include 'footer.php'; ?>