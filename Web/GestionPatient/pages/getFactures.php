<?php
// Connexion à la base de données
try {
    $bdd = new PDO(
        'mysql:host=localhost;
        dbname=hospital;
        charset=utf8',
        'root',
        ''
    );
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

// Récupération des factures
$reponse = $bdd->query('SELECT * FROM factures');
$factures = $reponse->fetchAll(PDO::FETCH_ASSOC);

// Envoi des factures au format JSON
header('Content-Type: application/json');
echo json_encode($factures);
?>
