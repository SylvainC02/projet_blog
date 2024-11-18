<?php
include 'header.php';
include 'fonctions.php';
if (isset($_POST) && !empty($_POST)) {
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $email = htmlspecialchars($_POST['email']);
    $password_clean = htmlspecialchars($_POST['password']);
    $hashed_password = password_hash($password_clean, PASSWORD_BCRYPT);
    register($pseudo, $hashed_password, $email);
    header('location:index.php?status=success&message=Votre compte a bien été créé !');
}

?>

<div class="titre">Créer votre compte !</div>


<div class="container form_signun">
    <form action="" method="post">
        <div>
            <label for="pseudo">Pseudo</label>
            <input id="pseudo" name="pseudo" type="text" class="form-control">
        </div>
        <div>
            <label for="email">Email</label>
            <input id="email" name="email" type="email" class="form-control">
        </div>
        <div>
            <label for="password">Password</label>
            <input id="password" name="password" type="password" class="form-control">
        </div>
        <input type="submit" value="Je crée mon compte !" class="btn btn-secondary btnCreerCompte">
    </form>
</div>


<?php include 'footer.php'; ?>