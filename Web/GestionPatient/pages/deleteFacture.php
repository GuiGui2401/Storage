<?php
// Vérifier si l'ID de la facture a été envoyé en paramètre dans l'URL
if (isset($_GET['id'])){
    // Inclure le fichier de configuration de la base de données
    include_once('config.php');
    
    // Récupérer l'ID de la facture à supprimer depuis l'URL
    $id = $_GET['id'];
    
    // Exécuter la requête DELETE pour supprimer la facture correspondante dans la base de données
    $sql = "DELETE FROM factures WHERE id = $id";
    if (mysqli_query($conn, $sql)){
        // Rediriger vers la page de gestion des factures avec un message de succès
        header('Location: gestionFactures.php?success=La facture a été supprimée avec succès.');
    } else {
        // Rediriger vers la page de gestion des factures avec un message d'erreur
        header('Location: gestionFactures.php?error=Une erreur est survenue lors de la suppression de la facture.');
    }
    
    // Fermer la connexion à la base de données
    mysqli_close($conn);
} else {
    // Rediriger vers la page de gestion des factures si l'ID de la facture n'a pas été envoyé en paramètre dans l'URL
    header('Location: gestionFactures.php');
}
?>
