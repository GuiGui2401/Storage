<?php
// login.php

session_start();

// Vérification si l'utilisateur est déjà connecté
if (isset($_SESSION['username'])) {
  header('Location: ../index.php');
  exit();
}

// Vérification si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Récupération des données de formulaire soumises
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Vérification des informations d'identification de l'utilisateur dans la base de données
  // (ceci est un exemple, vous devrez remplacer ce code avec vos propres requêtes SQL)
  if ($username === 'admin' && $password === 'password') {
    // Authentification réussie
    $_SESSION['username'] = $username;
    header('Location: ../index.php');
    exit();
  } else {
    // Authentification échouée
    $errorMessage = 'Nom d\'utilisateur ou mot de passe invalide.';
  }
}

// Si la requête n'a pas été soumise ou si l'authentification a échoué,
// afficher à nouveau le formulaire de connexion
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Connexion</title>
  <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>

  <?php
        // inclure l'en-tête
        include('header.php');
    ?>

  <h1>Se connecter</h1>

  <form action="login.php" method="POST">
    <?php if (isset($errorMessage)) { ?>
      <p class="error-message"><?php echo $errorMessage; ?></p>
    <?php } ?>

    <label for="username">Nom d'utilisateur</label>
    <input type="text" id="username" name="username">

    <label for="password">Mot de passe</label>
    <input type="password" id="password" name="password">

    <button type="submit">Se connecter</button>
  </form>

  <?php
        // inclure le pied de page
        include('footer.php');
    ?>

  <script src="../script/login.js"></script>
</body>
</html>
