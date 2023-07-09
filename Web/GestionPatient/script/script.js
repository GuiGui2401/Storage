// Récupère les éléments HTML
const form = document.querySelector('form');
const inputDate = document.querySelector('#date');
const inputPatient = document.querySelector('#patient');
const inputMotif = document.querySelector('#motif');
const inputObservations = document.querySelector('#observations');
const consultationsTable = document.querySelector('#consultations');

// Fonction pour ajouter une consultation à la table
function addConsultationToTable(date, patient, motif, observations) {
  const row = consultationsTable.insertRow(-1);
  const dateCell = row.insertCell(0);
  const patientCell = row.insertCell(1);
  const motifCell = row.insertCell(2);
  const observationsCell = row.insertCell(3);
  dateCell.textContent = date;
  patientCell.textContent = patient;
  motifCell.textContent = motif;
  observationsCell.textContent = observations;
}

// Événement pour soumettre le formulaire d'ajout de consultation
form.addEventListener('submit', (e) => {
  e.preventDefault(); // Empêche la soumission du formulaire

  // Récupère les valeurs des champs du formulaire
  const date = inputDate.value;
  const patient = inputPatient.value;
  const motif = inputMotif.value;
  const observations = inputObservations.value;

  // Vérifie que tous les champs sont remplis
  if (date && patient && motif && observations) {
    // Ajoute la consultation à la table
    addConsultationToTable(date, patient, motif, observations);

    // Réinitialise le formulaire
    form.reset();
  } else {
    // Affiche un message d'erreur
    alert('Veuillez remplir tous les champs.');
  }
});

// Événement pour la recherche de consultations
document.querySelector('#search').addEventListener('input', (e) => {
  const searchValue = e.target.value.toLowerCase(); // Récupère la valeur de recherche
  const consultationsRows = consultationsTable.querySelectorAll('tr:not(:first-child)'); // Récupère toutes les lignes de consultations, sauf l'en-tête

  // Boucle sur toutes les lignes de consultations
  consultationsRows.forEach(row => {
    const date = row.cells[0].textContent.toLowerCase();
    const patient = row.cells[1].textContent.toLowerCase();
    const motif = row.cells[2].textContent.toLowerCase();
    const observations = row.cells[3].textContent.toLowerCase();

    // Affiche ou masque la ligne de consultation en fonction de la valeur de recherche
    if (date.includes(searchValue) || patient.includes(searchValue) || motif.includes(searchValue) || observations.includes(searchValue)) {
      row.style.display = '';
    } else {
      row.style.display = 'none';
    }
  });
});
