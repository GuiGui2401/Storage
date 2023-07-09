<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Déclaration du type de document HTML -->
    <meta charset="UTF-8">
    <!-- Déclaration de la compatibilité pour les différents navigateurs -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Déclaration de la largeur de la vue pour les différents dispositifs -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Titre de la page -->
    <title>Carousel Exemple</title>
    <!-- Lien vers le fichier CSS pour la mise en forme -->
    <link rel="stylesheet" href="css/styleCaroussel.css">
    <!-- Lien vers le fichier JavaScript pour les fonctionnalités interactives -->
    <script src="Detail/js/app.js" async></script>
</head>

<body>
    <!-- Conteneur principal pour le carrousel -->
    <div class="container">
        <!-- Élément carrousel -->
        <div class="carousel">
            <!-- Conteneur interne pour les diapositives -->
            <div class="carousel-inner">
                <!-- Première diapositive -->
                <div class="slide">
                    <!-- Image de la première diapositive -->
                    <img src="Detail/R1.jpg"
                        alt="Image 1">
                </div>
                <!-- Deuxième diapositive -->
                <div class="slide">
                    <!-- Image de la deuxième diapositive -->
                    <img src="Detail/R2.jpg"
                        alt="Image 2">
                </div>
                <!-- Troisième diapositive -->
                <div class="slide">
                    <!-- Image de la troisième diapositive -->
                    <img src="Detail/R3.jpg"
                        alt="Image 3">
                </div>
                <!-- Quatrième diapositive -->
                <div class="slide">
                    <!-- Image de la quatrième diapositive -->
                    <img src="Detail/R4.webp"
                        alt="Image 4">
                </div>
                <!-- Cinquième diapositive -->
                <div class="slide">
                    <!-- Image de la cinquième diapositive -->
                    <img src="Detail/R5.jpg"
                        alt="Image 5">
                </div>
            </div>
            <!-- Conteneur pour les boutons de navigation -->
            <div class="carousel-controls">
                <!-- Bouton pour passer à la diapositive précédente -->
                <button id="prev">Précédent</button>
                <!-- Bouton pour passer à la diapositive suivante -->
                <button id="next">Suivant</button>
            </div>
            <!-- Conteneur pour les points de navigation -->
            <div class="carousel-dots"></div>
        </div>
    </div>

</body>

</html>