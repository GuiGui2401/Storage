<?php

require_once('config.php');

// Vérifier que l'utilisateur est connecté en tant que médecin
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'medecin') {
    header('Location: login.php');
    exit();
}

// Récupérer les prescriptions associées à un patient donné
if (isset($_GET['patient_id'])) {
    $patient_id = $_GET['patient_id'];

    // Préparer la requête SQL
    $query = "SELECT * FROM prescriptions WHERE patient_id = :patient_id";

    // Exécuter la requête
    $stmt = $db->prepare($query);
    $stmt->bindParam(':patient_id', $patient_id);
    $stmt->execute();

    // Récupérer les résultats
    $prescriptions = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Envoyer les résultats au format JSON
    echo json_encode($prescriptions);
} else {
    // Si le patient_id n'a pas été fourni en paramètre, renvoyer une erreur
    header('HTTP/1.1 400 Bad Request');
    exit();
}
?>
