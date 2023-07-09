<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Recherche de patients</title>
  <link rel="stylesheet" href="../styles/style2.css">
</head>
<body>
    <?php
        // inclure l'en-tête
        include('header.php');
    ?>
  <h1>Recherche de patients</h1>

  <form action="search_results.php" method="GET">
    <label for="search-term">Termes de recherche</label>
    <input type="text" id="search-term" name="search-term">

    <label for="search-type">Type de recherche</label>
    <select id="search-type" name="search-type">
      <option value="name">Nom</option>
      <option value="id">Identifiant</option>
      <option value="phone">Numéro de téléphone</option>
      <option value="email">Adresse e-mail</option>
    </select>

    <button type="submit">Rechercher</button>
  </form>

  <?php
        // inclure le pied de page
        include('footer.php');
    ?>

  <script src="../script/search.js"></script>
</body>
</html>
