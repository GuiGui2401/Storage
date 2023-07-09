<!DOCTYPE html>
<html lang="fr">
  <head>
    <title>Connexion</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/styles.css">
  </head>
  <body>
    <?php
        // inclure l'en-tête
        include('header.php');
    ?>

    <h1>Connexion</h1>
    <form action="login.php" method="post">
      <label for="username">Nom d'utilisateur :</label>
      <input type="text" id="username" name="username" required>

      <label for="password">Mot de passe :</label>
      <input type="password" id="password" name="password" required>

      <button type="submit">Se connecter</button>
    </form>

    <?php
        // inclure le pied de page
        include('footer.php');
    ?>
  </body>
</html>
