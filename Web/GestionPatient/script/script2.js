// Exemple de code JavaScript pour la page de gestion des prescriptions
// Ce code est à titre indicatif et doit être adapté en fonction des fonctionnalités souhaitées

// Récupération des prescriptions depuis la base de données via une requête AJAX
function getPrescriptions() {
    $.ajax({
      url: 'get_prescriptions.php',
      type: 'GET',
      dataType: 'json',
      success: function(data) {
        // Traitement des données récupérées
        if (data && data.length > 0) {
          // Affichage des prescriptions dans la liste des prescriptions
          var prescriptionsList = $('#prescriptionsList');
          prescriptionsList.empty();
          $.each(data, function(i, prescription) {
            var prescriptionItem = $('<li>').addClass('prescription-item');
            var prescriptionLink = $('<a>').attr('href', 'view_prescription.php?id=' + prescription.id);
            prescriptionLink.append($('<span>').addClass('prescription-title').text(prescription.title));
            prescriptionLink.append($('<span>').addClass('prescription-date').text(prescription.date));
            prescriptionItem.append(prescriptionLink);
            prescriptionsList.append(prescriptionItem);
          });
        } else {
          // Affichage d'un message si aucune prescription n'a été trouvée
          $('#noPrescriptions').show();
        }
      },
      error: function(jqXHR, textStatus, errorThrown) {
        // Affichage d'un message d'erreur en cas d'échec de la requête AJAX
        console.error('Error getting prescriptions: ' + errorThrown);
      }
    });
  }
  
  // Ajout d'une nouvelle prescription via un formulaire
  $('#addPrescriptionForm').submit(function(event) {
    event.preventDefault();
    var prescriptionTitle = $('#prescriptionTitle').val();
    var prescriptionDate = $('#prescriptionDate').val();
    // Vérification des champs du formulaire
    if (prescriptionTitle && prescriptionDate) {
      // Envoi des données du formulaire via une requête AJAX
      $.ajax({
        url: 'add_prescription.php',
        type: 'POST',
        data: {
          title: prescriptionTitle,
          date: prescriptionDate
        },
        success: function(data) {
          // Actualisation de la liste des prescriptions après l'ajout de la nouvelle prescription
          getPrescriptions();
        },
        error: function(jqXHR, textStatus, errorThrown) {
          // Affichage d'un message d'erreur en cas d'échec de la requête AJAX
          console.error('Error adding prescription: ' + errorThrown);
        }
      });
    } else {
      // Affichage d'un message d'erreur si des champs obligatoires sont manquants
      $('#addPrescriptionError').show();
    }
  });
  
// fonction pour ajouter une nouvelle prescription
function ajouterPrescription() {
    // récupérer les valeurs saisies par l'utilisateur
    var patient = document.getElementById("patient").value;
    var medicament = document.getElementById("medicament").value;
    var dosage = document.getElementById("dosage").value;
    var duree = document.getElementById("duree").value;
  
    // vérifier si toutes les données ont été saisies
    if (patient === "" || medicament === "" || dosage === "" || duree === "") {
      alert("Veuillez remplir tous les champs !");
      return false;
    }
  
    // envoyer les données saisies à la page PHP pour traitement
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "ajoutPrescription.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // afficher la réponse du serveur
        alert(xhr.responseText);
  
        // recharger la page pour afficher la nouvelle prescription ajoutée
        location.reload();
      }
    };
    xhr.send("patient=" + patient + "&medicament=" + medicament + "&dosage=" + dosage + "&duree=" + duree);
  }
  
  // fonction pour supprimer une prescription
  function supprimerPrescription(id) {
    // demander confirmation à l'utilisateur avant de supprimer
    if (confirm("Voulez-vous vraiment supprimer cette prescription ?")) {
      // envoyer l'ID de la prescription à la page PHP pour traitement
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "supprimerPrescription.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
          // afficher la réponse du serveur
          alert(xhr.responseText);
  
          // recharger la page pour afficher la prescription supprimée
          location.reload();
        }
      };
      xhr.send("id=" + id);
    }
  }
  
  // fonction pour modifier une prescription
  function modifierPrescription(id) {
    // récupérer les nouvelles valeurs saisies par l'utilisateur
    var patient = document.getElementById("patient-" + id).value;
    var medicament = document.getElementById("medicament-" + id).value;
    var dosage = document.getElementById("dosage-" + id).value;
    var duree = document.getElementById("duree-" + id).value;
  
    // vérifier si toutes les données ont été saisies
    if (patient === "" || medicament === "" || dosage === "" || duree === "") {
      alert("Veuillez remplir tous les champs !");
      return false;
    }
  
    // envoyer les données saisies à la page PHP pour traitement
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "modifierPrescription.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // afficher la réponse du serveur
        alert(xhr.responseText);
  
        // recharger la page pour afficher la prescription modifiée
        location.reload();
      }
    };
    xhr.send("id=" + id + "&patient=" + patient + "&medicament=" + medicament + "&dosage=" + dosage + "&duree=" + duree);
  }
  ``
  
  