<?php
session_start();

if(isset($_SESSION['id'])){
    header('Location: index.php');
    exit();
}

require_once('config.php');

if(isset($_POST['prenom'], $_POST['nom'], $_POST['pseudo'], $_POST['plateforme'], $_POST['age'], $_POST['pays'], $_POST['telephone'], $_POST['email'], $_POST['motdepasse'], $_POST['confirmer_motdepasse'])){
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $pseudo = $_POST['pseudo'];
    $plateforme = $_POST['plateforme'];
    $age = $_POST['age'];
    $pays = $_POST['pays'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $motdepasse = $_POST['motdepasse'];
    $confirmer_motdepasse = $_POST['confirmer_motdepasse'];

    if($motdepasse !== $confirmer_motdepasse){
        $erreur = 'Les mots de passe ne sont pas identiques.';
    }else{
        $user = createUser($prenom, $nom, $pseudo, $plateforme, $age, $pays, $telephone, $email, $motdepasse);
        $_SESSION['id'] = $user['id'];
        header('Location: index.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inscription - Rush Games</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Inscription - Rush Games</h1>
    <?php if(isset($erreur)): ?>
        <div class="erreur"><?= $erreur ?></div>
    <?php endif; ?>
    <form action="" method="post">
        <div>
            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" id="prenom" required>
        </div>
        <div>
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" required>
        </div>
        <div>
            <label for="pseudo">Pseudo gamer :</label>
            <input type="text" name="pseudo" id="pseudo" required>
        </div>
        <div>
            <label for="plateforme">Plateforme :</label>
            <select name="plateforme" id="plateforme" required>
                <option value="PC">PC</option>
                <option value="PlayStation">PlayStation</option>
                <option value="Xbox">Xbox</option>
                <option value="Switch">Switch</option>
            </select>
        </div>
        <div>
            <label for="age">Âge :</label>
            <input type="number" name="age" id="age" required>
        </div>
        <div>
            <label for="pays">Pays :</label>
            <input type="text" name="pays" id="pays" required>
        </div>
        <div>
            <label for="telephone">Téléphone :</label>
            <input type="tel" name="telephone" id="telephone" required>
	</div>
	<div>
		<label for="email">Email :</label>
		<input type="email" name="email" id="email" required>
	</div>
	<div>
		<label for="motdepasse">Mot de passe :</label>
		<input type="password" name="motdepasse" id="motdepasse" required>
	</div>
	<div>
		<label for="confirmer_motdepasse">Confirmer le mot de passe :</label>
		<input type="password" name="confirmer_motdepasse" id="confirmer_motdepasse" required>
	</div>
	<div>
		<input type="submit" value="S'inscrire">
	</div>
    </form>
    <p>Déjà inscrit ? <a href="login.php">Connectez-vous ici.</a></p>
</body>
</html>