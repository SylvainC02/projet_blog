$(document).ready(function () {

    $('.nouveauCommentaire').submit(function (e) {
        e.preventDefault();

        let contenu = $("#contenuCommentaire").val();
        let idArticle = $("#idArticle").val();

        $.post('traitementCommentaires.php', {
            commentaire: contenu,
            idArticle: idArticle

        }, function (data) {
            $('#commentairesAjax').append('<div class="nomAuteurCommentaire"> Votre commentaire : </div>' + '<div class="commentaireEnAttente">' + contenu + "</div>");


        })
    })
})



document.querySelectorAll(".boutonModifierCommentaire").forEach(i => i.addEventListener(
    "click",
    e => {
        e.currentTarget.parentNode.hidden = true;
        e.currentTarget.parentNode.parentNode.firstChild.nextSibling.hidden = false
    }));

