<?php

session_start();
if (!isset($_SESSION['id'])) {
    header('Location: ../index.php');
    exit();
}

include('config.php');

if (isset($_POST['submit'])) {
    $patient_id = $_POST['patient_id'];
    $date_consultation = $_POST['date_consultation'];
    $heure_consultation = $_POST['heure_consultation'];
    $description = $_POST['description'];

    $query = "INSERT INTO consultations (patient_id, date_consultation, heure_consultation, description)
    VALUES (:patient_id, :date_consultation, :heure_consultation, :description)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':patient_id', $patient_id);
    $stmt->bindParam(':date_consultation', $date_consultation);
    $stmt->bindParam(':heure_consultation', $heure_consultation);
    $stmt->bindParam(':description', $description);
    $stmt->execute();

    header('Location: consultations.php');
    exit();
}

$query = "SELECT * FROM patients ORDER BY nom_patient";
$stmt = $conn->prepare($query);
$stmt->execute();
$patients = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter consultation</title>
    <link rel="stylesheet" href="style3.css">
</head>

<body>
    <?php include('header.php'); ?>
    <div class="container">
        <h1>Ajouter une consultation</h1>
        <form method="POST">
            <div class="form-group">
                <label for="patient_id">Patient:</label>
                <select name="patient_id" id="patient_id">
                    <?php foreach ($patients as $patient) { ?>
                        <option value="<?php echo $patient['id']; ?>">
                            <?php echo $patient['nom_patient'] . ' ' . $patient['prenom_patient']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="date_consultation">Date:</label>
                <input type="date" name="date_consultation" id="date_consultation" required>
            </div>
            <div class="form-group">
                <label for="heure_consultation">Heure:</label>
                <input type="time" name="heure_consultation" id="heure_consultation" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" cols="30" rows="10" required></textarea>
            </div>
            <button type="submit" name="submit">Enregistrer</button>
        </form>
    </div>
    <?php include('footer.php'); ?>
</body>

</html>
