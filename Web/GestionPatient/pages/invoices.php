<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <title>Gestion des factures</title>
    <link rel="stylesheet" href="../styles/style5.css">
    <link rel="stylesheet" href="../styles/style.css">
    <script src="../script/script3.js"></script>
  </head>
  <body>
    <header>
      <h1>Gestion des factures</h1>
      <nav>
        <ul>
          <li><a href="../index.php">Accueil</a></li>
          <li><a href="patients.php">Recherche de patients</a></li>
          <li><a href="consultations.php">Gestion des consultations</a></li>
          <li><a href="prescriptions.php">Gestion des prescriptions</a></li>
          <li class="current"><a href="invoices.php">Gestion des factures</a></li>
          <li><a href="logout.php">Déconnexion</a></li>
        </ul>
      </nav>
    </header>
    <main class="container">
      <h2>Factures</h2>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Montant</th>
            <th>Patient</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // TODO: Récupérer les factures depuis la base de données et les afficher dans le tableau
          ?>
        </tbody>
      </table>
      <button id="ajouter-facture" class="btn">Ajouter une facture</button>
    </main>
    <footer>
      <p>© 2023 Hospital Management System</p>
    </footer>
  </body>
</html>
