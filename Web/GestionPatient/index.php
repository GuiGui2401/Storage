<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Page d'accueil - Gestion des patients</title>
	<link rel="stylesheet" href="styles/style.css">
	<script type="text/javascript">
		// sélectionner le bouton d'appel à l'action
		const ctaButton = document.querySelector('.hero .cta');

		// ajouter un écouteur d'événement pour le clic
		ctaButton.addEventListener('click', () => {
		alert('Merci d\'avoir cliqué sur notre bouton !');
		});

	</script>
</head>
<body>

	<header>
		<h1>Gestion des patients</h1>
		<nav>
			<ul>
				<li><a href="index.php">Accueil</a></li>
				<li><a href="pages/patients.php">Patients</a></li>
				<li><a href="pages/consultations.php">Consultations</a></li>
				<li><a href="pages/prescriptions.php">Prescriptions</a></li>
				<li><a href="pages/invoices.php">Factures</a></li>
			</ul>
		</nav>
	</header>
	<main>
		<section class="hero">
			<h2>Bienvenue sur le site de gestion des patients</h2>
			<p>Notre site vous permet de gérer facilement les dossiers médicaux de vos patients en évitant
				 les doublons et les erreurs. Avec notre interface conviviale,
				  vous pouvez suivre l'historique des consultations de chaque patient et
				  créer des prescriptions en un rien de temps.</p>
			<a href="pages/patients.php" class="cta">Voir les patients</a>
		</section>
		<section class="features">
			<h2>Nos fonctionnalités</h2>
			<div class="feature">
				<img src="images/consultations.png" alt="Consultations">
				<h3>Historique des consultations</h3>
				<p>Gardez une trace des consultations passées de chaque patient pour éviter
					 de refaire les mêmes tests ou examens.</p>
			</div>
			<div class="feature">
				<img src="images/prescriptions.png" alt="Prescriptions">
				<h3>Création de prescriptions</h3>
				<p>Créez facilement des prescriptions pour vos patients et suivez-les à tout moment.</p>
			</div>
			<div class="feature">
				<img src="images/invoices.png" alt="Factures">
				<h3>Gestion des factures</h3>
				<p>Gérez les factures de vos patients en un seul endroit et suivez leur historique de paiement.</p>
			</div>
		</section>
	</main>
	<footer>
		<p>&copy; 2023 Gestion des patients. Tous droits réservés.</p>
	</footer>
</body>
</html>
