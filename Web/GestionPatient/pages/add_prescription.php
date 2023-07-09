<?php
require_once('db_connexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_consultation = $_POST['id_consultation'];
    $date_prescription = $_POST['date_prescription'];
    $medicament = $_POST['medicament'];
    $posologie = $_POST['posologie'];
    
    $stmt = $pdo->prepare('INSERT INTO prescriptions (id_consultation, date_prescription, medicament, posologie)
     VALUES (?, ?, ?, ?)');
    $stmt->execute([$id_consultation, $date_prescription, $medicament, $posologie]);
    
    header('Location: prescriptions.php');
    exit();
}
?>
