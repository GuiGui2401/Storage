<?php
session_start();

if(!isset($_SESSION['id'])){
    header('Location: login.php');
    exit();
}

require_once('config.php');

$user_id = $_SESSION['id'];
$user = getUserById($user_id);

$annonces = getAnnonces();
$duels = getDuels();
$statistiques = getStatistiques($user_id);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Rush Games</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Bienvenue sur Rush Games, <?= $user['pseudo'] ?>!</h1>
    <h2>Annonces</h2>
    <?php foreach($annonces as $annonce): ?>
        <div class="annonce">
            <p><?= $annonce['texte'] ?></p>
            <p>Posté par <?= $annonce['pseudo'] ?> le <?= $annonce['date_creation'] ?></p>
        </div>
    <?php endforeach; ?>

    <h2>Duels</h2>
    <?php foreach($duels as $duel): ?>
        <div class="duel">
            <p><?= $duel['adversaire_pseudo'] ?></p>
            <p>Créé le <?= $duel['date_creation'] ?></p>
        </div>
    <?php endforeach; ?>

    <h2>Statistiques</h2>
    <p>Parties gagnées : <?= $statistiques['partie_gagnee'] ?></p>
    <p>Parties perdues : <?= $statistiques['partie_perdue'] ?></p>

    <a href="annonce.php">Poster une annonce</a>
    <a href="duel.php">Créer un duel</a>
    <a href="logout.php">Se déconnecter</a>
</body>
</html>