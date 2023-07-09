<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Gestion des consultations</title>
  <link rel="stylesheet" href="../styles/style3.css">
</head>
<body>

  <header>
    <h1>Gestion des consultations</h1>
    <nav>
      <ul>
        <li><a href="../index.php">Accueil</a></li>
        <li><a href="patients.php">Recherche de patients</a></li>
        <li><a href="logout.php">Déconnexion</a></li>
      </ul>
    </nav>
  </header>
  <main>
    <h2>Ajouter une consultation</h2>
    <form action="ajouter_consultation.php" method="post">
      <label for="patientId">Identifiant du patient :</label>
      <input type="text" id="patientId" name="patientId" required>
      <label for="date">Date de la consultation :</label>
      <input type="date" id="date" name="date" required>
      <label for="symptomes">Symptômes :</label>
      <textarea id="symptomes" name="symptomes" required></textarea>
      <label for="medecin">Médecin :</label>
      <input type="text" id="medecin" name="medecin" required>
      <input type="submit" value="Ajouter">
    </form>
    <h2>Consulter les consultations</h2>
    <form>
      <label for="patientId">Identifiant du patient :</label>
      <input type="text" id="patientId2" name="patientId2" required placeholder="idPatient">
      <input type="submit" value="Rechercher">
    </form>
    <table>
      <thead>
        <tr>
          <th>Date</th>
          <th>Symptômes</th>
          <th>Médecin</th>
        </tr>
      </thead>
      <tbody id="consultations">
      </tbody>
    </table>
  </main>
  <script src="../script/script.js"></script>
</body>
</html>
