<?php

include 'header.php';
include 'fonctions.php';

if (isset($_POST) && !empty($_POST)) {
    $email = htmlspecialchars($_POST['email']);
    $entering_password = $_POST['password'];
    //etape 1 : récupérer les données de l'utilisateur
    $userInfos = getUserInfosByMail($email);

    if ($userInfos) {
        //etape 2 : comparer le mot de passe saisie avec celui de la base, problème celui ci est chiffré => password_verify
        $hashed_password = $userInfos['mdp'];
        $isConfirmed = password_verify($entering_password, $hashed_password);
        if ($isConfirmed) {
            $_SESSION['user'] = $userInfos;
            header('location:index.php?status=success&message=Vous êtes désormais connecté(e) !');
        };
    } else {
        echo (" 
        <div style='text-align:center'>Ce compte n'existe pas</div>
        ");
    };
};
?>

<div class="titre"> Connectez - vous! </div>

<div id="missedConnection"></div>

<div class="container form_signin">
    <form action="" method="post">
        <div> <label for="email"> Email </label>
            <input id="email" class="form-control" name="email" type="email">
        </div>
        <div>
            <label for="password"> Password </label>
            <input id="password" class="form-control" name="password" type="password">
        </div>
        <input type="submit" value="Je me connecte !" class="btn btn-secondary btnConnection">
    </form>
</div>

<?php include 'footer.php'; ?>