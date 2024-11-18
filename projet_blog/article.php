<?php include 'header.php';
include "fonctions.php";
$id = $_GET['id'];
$commentaires = recupAllCommentaires($id);
$article = recupArticleById($id);


?>

<h1 class="titreArticle"><?php echo ($article['titre']); ?></h1>

<img src='<?php echo ($article['image']) ?>' class="imageArticle">

<div class="auteur">
      <form action="articleUser.php" method="post">
            <div>
                  <input type="hidden" name="id" value=<?php echo ($article['id_user']); ?>>
            </div>

            <div>
                  <input id="submitArticleUser" type="submit" value="<?php echo (afficherAuteurArticle($id)) ?>">,
            </div>
      </form>

      <?php echo ($article['date']); ?>
</div>

<div class="contenuarticle"><?php echo ($article['contenu']); ?></div>


<h2 class="titreSecondaireArticle">Ajouter un commentaire :</h2>

<?php if (isset($_SESSION) && !empty($_SESSION)) {
?>

      <form class="nouveauCommentaire" action="traitementCommentaires.php" method="post">


            <div>
                  <textarea type="text" id="contenuCommentaire" name="contenu" placeholder="Contenu..."></textarea>
            </div>

            <div>
                  <input class="btn btn-secondary" id="ajouterCommentaire" type="submit" value="Ajouter">
            </div>


            <div>
                  <input type="hidden" value="<?php echo $id ?>" id="idArticle" name="idArticle" require>
            </div>

      </form>

<?php } else {
?>
      <div class="preventCommentaire">Vous devez être <a href="signin.php">inscrit</a> pour ajouter un commentaire.</div>

<?php } ?>


<div id="commentaire">

      <h2 class='titreSecondaireArticle'>Commentaires de l'article : </h2>


      <?php
      if (!empty($commentaires)) {
            foreach ($commentaires as $commentaire) {
                  if (isset($_SESSION["user"]) && ($commentaire['auteur'] == $_SESSION["user"]["id"])) {
      ?>


                        <div class="nomAuteurCommentaire">
                              Votre commentaire :
                        </div>

                        <div>
                              <div id="divEditer" hidden>

                                    <form action="modifierCommentaire.php" class="formEditerCommentaire" method="post">

                                          <input type="hidden" name="idArticle" value=<?php echo ($article['id']); ?>>

                                          <input type="hidden" name="idCom" value=<?php echo ($commentaire['id']); ?>>

                                          <input type="submit" class="btn btn-secondary boutonModifierCommentaire" class="btn btn-secondary" value="Valider"></input>

                                          <input type="text" value="<?php echo $commentaire["contenu"] ?>" class="inputEditCommentaire" name="contenu"></input>

                                    </form>


                                    <form action="suppressionCommentaire.php" class="formEditerCommentaire" method="post">

                                          <input type="hidden" name="idArticle" value=<?php echo ($article["id"]); ?>>

                                          <input type="hidden" name="idCom" value=<?php echo ($commentaire['id']); ?>>

                                          <input type="submit" class="btn btn-secondary boutonModifierCommentaire" class="btn btn-secondary" value="Supprimer">

                                    </form>



                              </div>

                              <div>
                                    <button class="btn btn-secondary boutonModifierCommentaire">Editer</button>

                                    <div class=commentaireUser>
                                          <?php echo $commentaire["contenu"] ?>
                                    </div>

                                    <form action="suppressionCommentaire.php" class="formEditerCommentaire" method="post">

                                          <input type="hidden" name="idArticle" value=<?php echo ($article["id"]); ?>>

                                          <input type="hidden" name="idCom" value=<?php echo ($commentaire['id']); ?>>

                                          <input type="submit" class="btn btn-secondary boutonModifierCommentaire" class="btn btn-secondary" value="Supprimer">

                                    </form>

                              </div>
                        </div>

                  <?php }
            }
            foreach ($commentaires as $commentaire) {
                  if (!isset($_SESSION["user"]) || ($commentaire['auteur'] !== $_SESSION["user"]["id"])) { ?>



                        <div class="nomAuteurCommentaire">
                              <?php echo afficherAuteurCommentaire($commentaire["id"]) ?> :
                        </div>

                        <div class=commentaire>
                              <?php echo $commentaire["contenu"] ?>

                        </div>




            <?php
                  };
            };
      } else { ?>
            <div class='aucunCommentaire'>
                  <div>Il n'y a aucun commentaire pour cette article.</div>
                  <div>Soyez le premier à donner votre avis !</></span>
                  </div>
            <?php
      }
            ?>
            </div>

            <div id="commentairesAjax">

            </div>



</div>




<?php include 'footer.php'; ?>