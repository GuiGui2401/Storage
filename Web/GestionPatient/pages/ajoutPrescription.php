<?php
    // Inclure le fichier de configuration de la base de données
    include_once "config.php";

    // Vérifier si le formulaire a été soumis
    if (isset($_POST['submit'])) {
        // Récupérer les données du formulaire
        $nomMedicament = $_POST['nomMedicament'];
        $dosage = $_POST['dosage'];
        $duree = $_POST['duree'];
        $idConsultation = $_POST['idConsultation'];

        // Préparer la requête SQL pour insérer une nouvelle prescription
        $sql = "INSERT INTO prescriptions (nom_medicament, dosage, duree, id_consultation) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $nomMedicament, $dosage, $duree, $idConsultation);

        // Exécuter la requête SQL
        if ($stmt->execute()) {
            // Rediriger l'utilisateur vers la page de gestion des prescriptions avec un message de succès
            header("location: gestionPrescriptions.php?consultation_id=".$idConsultation.
            "&success=Prescription ajoutée avec succès.");
            exit();
        } else {
            // Rediriger l'utilisateur vers la page de gestion des prescriptions avec un message d'erreur
            header("location: gestionPrescriptions.php?consultation_id=".$idConsultation.
            "&error=Une erreur est survenue lors de l'ajout de la prescription.");
            exit();
        }
    }
?>
