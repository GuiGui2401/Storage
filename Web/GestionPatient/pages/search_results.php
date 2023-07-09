<?php
// Vérifie si un terme de recherche a été soumis
if (isset($_GET['term'])) {
  $searchTerm = $_GET['term'];

  // Connexion à la base de données
  $dbHost = 'localhost';
  $dbName = 'hospital';
  $dbUser = 'root';
  $dbPass = '';
  $db = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass);

  // Prépare la requête SQL pour récupérer les patients qui correspondent au terme de recherche
  $stmt = $db->prepare("SELECT * FROM patients WHERE name LIKE :searchTerm OR id LIKE :searchTerm");

  // Lie le terme de recherche à la requête préparée en tant que paramètre
  $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);

  // Exécute la requête préparée
  $stmt->execute();

  // Récupère les résultats de la requête sous forme d'un tableau associatif
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // Convertit les dates de dernière consultation en format lisible par l'utilisateur
  foreach ($results as &$result) {
    $result['lastVisit'] = date('d/m/Y', strtotime($result['lastVisit']));
  }

  // Renvoie les résultats sous forme de JSON
  header('Content-Type: application/json');
  echo json_encode($results);
}
?>
