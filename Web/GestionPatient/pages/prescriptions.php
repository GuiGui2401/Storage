<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Gestion des prescriptions</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../styles/style4.css">
	<link rel="stylesheet" href="../styles/style.css">
</head>
<body>
	<header>
		<h1>Gestion des prescriptions</h1>
		<nav>
			<ul>
				<li><a href="../index.php">Accueil</a></li>
				<li><a href="patients.php">Recherche de patients</a></li>
				<li><a href="consultations.php">Gestion des consultations</a></li>
				<li><a href="prescriptions.php">Gestion des prescriptions</a></li>
			</ul>
		</nav>
	</header>

	<main class="prescription-container">
		<section class="prescription-form">
			<h2>Ajouter une prescription</h2>
			<form method="post" action="ajoutPrescription.php">
				<label for="nomMedicament">Nom du médicament :</label>
				<input type="text" id="nomMedicament" name="nomMedicament" required>

				<label for="dosage">Dosage :</label>
				<input type="text" id="dosage" name="dosage" required>

				<label for="posologie">Posologie :</label>
				<textarea id="posologie" name="posologie" rows="4" cols="50" required></textarea>

				<label for="consultation">Consultation :</label>
				<select id="consultation" name="consultation" required>
					<option value="" disabled selected>Choisissez une consultation</option>
					<!-- Liste des consultations disponibles (à générer dynamiquement avec PHP) -->
				</select>

				<input type="submit" value="Ajouter" class="btn">
			</form>
		</section>

		<section class="prescription-list">
			<h2>Liste des prescriptions</h2>
			<!-- Tableau des prescriptions (à générer dynamiquement avec PHP) -->
		</section>
	</main>

	<footer>
		<p>© 2023 Hospital Management System</p>
	</footer>

	<script src="../script/script2.js"></script>
</body>
</html>
