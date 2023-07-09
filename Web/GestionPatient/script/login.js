// login.js

const form = document.querySelector('form');
const usernameInput = document.querySelector('#username');
const passwordInput = document.querySelector('#password');

form.addEventListener('submit', function(event) {
// Empêcher la soumission par défaut du formulaire
event.preventDefault();

// Validation des entrées utilisateur
if (usernameInput.value.trim() === '') {
    alert('Veuillez entrer un nom d\'utilisateur valide.');
    usernameInput.focus();
    return;
}

if (passwordInput.value.trim() === '') {
    alert('Veuillez entrer un mot de passe valide.');
    passwordInput.focus();
    return;
}

// Si les entrées sont valides, envoyer le formulaire
form.submit();
});