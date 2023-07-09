<?php
session_start();

if(isset($_SESSION['id'])){
    header('Location: index.php');
    exit();
}

require_once('config.php');

if(isset($_POST['email'], $_POST['motdepasse'])){
    $email = $_POST['email'];
    $motdepasse = $_POST['motdepasse'];

    $user = getUserByEmailAndPassword($email, $motdepasse);

    if($user){
        $_SESSION['id'] = $user['id'];
        header('Location: index.php');
        exit();
    }else{
        $erreur = 'Identifiant ou mot de passe incorrect.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Connexion - Rush Games</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Connexion - Rush Games</h1>
    <?php if(isset($erreur)): ?>
        <div class="erreur"><?= $erreur ?></div>
    <?php endif; ?>
    <form action="" method="post">
        <div>
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div>
            <label for="motdepasse">Mot de passe :</label>
            <input type="password" name="motdepasse" id="motdepasse" required>
        </div>
	<div>
            <input type="submit" value="Se connecter">
        </div>
    </form>
    <p>Pas encore inscrit ? <a href="inscription.php">Inscrivez-vous ici.</a></p>
</body>
</html>