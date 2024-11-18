<?php
include 'header.php';
include 'fonctions.php';
$articlesUser = recupAllArticleByUser($_SESSION["user"]["id"]);
$allArticles = recupAllArticles();
$commentairesUser = recupAllCommentaireByUser($_SESSION["user"]["id"]);

?>

<h1 class="titre">Bonjour <?php echo ($_SESSION["user"]["pseudo"]);  ?>, voici vos articles :
</h1>



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
                            <a href="modifierArticle.php?id=<?php echo $article['id'] ?>" class="btn btn-secondary btnEditerSup">Editer/Supprimer</a>
                            <p class="card-text"> <?php echo $article["resume"] ?></p>
                        </div>
                    </div>
                </div>

            <?php }
        } else { ?>
            <h2 class='titre2'>Désolé, vous n'avez aucun article.</h2>
            <div class="lienAjoutArticlePageUser">Commencez a en <a href="ajouterArticle.php">écrire</a> un ! </div>
        <?php };

        ?>

    </div>

    <h2 class="titre">Voici vos commentaires :</h2>

    <div class="container-fluid">



        <?php

        if (isset($commentairesUser) && !empty($commentairesUser)) {
            foreach ($allArticles as $articleCommenté) {
                $commentairesArticle = recupAllCommentaireByArticle($articleCommenté["id"]);
                if (isset($commentairesArticle) && !empty($commentairesArticle)) {
                    foreach ($commentairesArticle as $commentaireArticle) {
                        if ($commentaireArticle["auteur"] == $_SESSION["user"]["id"]) { ?>
                            <div class="row">
                                <div class="col-4 offset-2 articleCommentéUser">
                                    <div class="card text-center ">
                                        <a href="article.php?id=<?php echo $articleCommenté["id"] ?>"> <img src="<?php echo $articleCommenté["image"] ?>" class="card-img-top" alt="..."></a>
                                        <div class="card-body">
                                            <a class="bouton" href="article.php?id=<?php echo $articleCommenté["id"] ?>"> <?php echo $articleCommenté["titre"] ?> </a>
                                            <p class="card-text"> <?php echo $articleCommenté["resume"] ?></p>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">





                                <?php break;
                            }
                        }
                        foreach ($commentairesArticle as $commentaireArticle) {
                            if ($commentaireArticle["auteur"] == $_SESSION["user"]["id"]) { ?>

                                    <div class="row commentairePageUser">

                                        <div id="divEditer" hidden>

                                            <form action="modifierCommentaire.php" class="formEditerCommentaire" method="post">

                                                <input type="hidden" name="idUser" value=<?php echo ($_SESSION["user"]["id"]); ?>>

                                                <input type="hidden" name="idCom" value=<?php echo ($commentaireArticle['id']); ?>>

                                                <input type="submit" class="btn btn-secondary boutonModifierCommentaire" class="btn btn-secondary" value="Valider"></input>

                                                <input type="text" value="<?php echo $commentaireArticle["contenu"] ?>" class="inputEditCommentairePageUser" name="contenu"></input>

                                            </form>

                                            <form action="suppressionCommentaire.php" class="formEditerCommentaire" method="post">

                                                <input type="hidden" name="idUser" value=<?php echo ($_SESSION["user"]["id"]); ?>>

                                                <input type="hidden" name="idCom" value=<?php echo ($commentaireArticle['id']); ?>>

                                                <input type="submit" class="btn btn-secondary boutonModifierCommentaire" class="btn btn-secondary" value="Supprimer">

                                            </form>




                                        </div>

                                        <div>
                                            <button class="btn btn-secondary boutonModifierCommentaire">Editer</button>

                                            <div class=commentaireUser>
                                                <?php echo $commentaireArticle["contenu"] ?>
                                            </div>

                                            <form action="suppressionCommentaire.php" class="formEditerCommentaire" method="post">

                                                <input type="hidden" name="idUser" value=<?php echo ($_SESSION["user"]["id"]); ?>>

                                                <input type="hidden" name="idCom" value=<?php echo ($commentaireArticle['id']); ?>>

                                                <input type="submit" class="btn btn-secondary boutonModifierCommentaire" class="btn btn-secondary" value="Supprimer">

                                            </form>


                                        </div>
                                    </div>






                            <?php


                            }
                        } ?>
                                </div>
                            </div>

                    <?php

                }
            }
        } else { ?>
                    <div class='messageAucunCommentairePageUser'>Vous n'avez écrit aucun commentaires.</div>
                <?php } ?>





    </div>
    <div class="supprimerCompte">

        <a href="deleteUser.php?id=<?php echo $_SESSION["user"]["id"] ?>" class="btn btn-secondary">Supprimer votre compte</a>
    </div>
</div>

<?php
include 'footer.php';
?>