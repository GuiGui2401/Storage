// Récupération du formulaire de recherche et du champ de recherche
const searchForm = document.querySelector('#search-form');
const searchInput = document.querySelector('#search-input');

// Écouteur d'événement pour la soumission du formulaire de recherche
searchForm.addEventListener('submit', (event) => {
event.preventDefault(); // Empêche la soumission du formulaire

const searchTerm = searchInput.value.trim(); // Récupère le terme de recherche

// Vérifie si le terme de recherche est vide
if (searchTerm === '') {
    alert('Veuillez entrer un terme de recherche.'); // Affiche un message d'erreur
    return;
}

// Effectue une requête AJAX pour récupérer les résultats de recherche
const xhr = new XMLHttpRequest();
xhr.open('GET', `search.php?term=${searchTerm}`, true);
xhr.onload = () => {
    if (xhr.status === 200) {
    const results = JSON.parse(xhr.responseText); // Analyse les résultats JSON
    displayResults(results); // Affiche les résultats de recherche
    } else {
    alert('Une erreur s\'est produite. Veuillez réessayer.'); // Affiche un message d'erreur
    }
};
xhr.send();
});

// Fonction pour afficher les résultats de recherche
function displayResults(results) {
const resultsContainer = document.querySelector('#results-container');
resultsContainer.innerHTML = ''; // Efface les résultats de recherche précédents

if (results.length === 0) {
    resultsContainer.innerHTML = '<p>Aucun résultat trouvé.</p>'; // Affiche un message si aucun résultat n'est trouvé
} else {
    results.forEach(result => {
    const resultDiv = document.createElement('div');
    resultDiv.classList.add('result');
    resultDiv.innerHTML = `
        <h3>${result.name}</h3>
        <p><strong>ID:</strong> ${result.id}</p>
        <p><strong>Âge:</strong> ${result.age}</p>
        <p><strong>Dernière consultation:</strong> ${result.lastVisit}</p>
    `;
    resultsContainer.appendChild(resultDiv); // Ajoute chaque résultat à la page
    });
}
}