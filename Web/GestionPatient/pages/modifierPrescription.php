<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('location: login.php');
    exit;
}

require_once 'db_connexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modifier'])) {
    $idPrescription = $_POST['idPrescription'];
    $medicament = $_POST['medicament'];
    $dosage = $_POST['dosage'];
    $duree = $_POST['duree'];

    // Préparer la requête SQL pour mettre à jour la prescription
    $sql = "UPDATE prescriptions SET medicament = ?, dosage = ?, duree = ? WHERE idPrescription = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $medicament, $dosage, $duree, $idPrescription);

    // Exécuter la requête et vérifier si elle s'est bien déroulée
    if ($stmt->execute()) {
        // Rediriger l'utilisateur vers la page des prescriptions avec un message de succès
        header("location: prescriptions.php?success=La prescription a été mise à jour avec succès.");
        exit;
    } else {
        // Rediriger l'utilisateur vers la page des prescriptions avec un message d'erreur
        header("location: prescriptions.php?error=Une erreur est survenue lors de la mise à jour de la prescription.");
        exit;
    }
}

// Fermer la connexion à la base de données
$conn->close();
?>
