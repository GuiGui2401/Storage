$(document).ready(function() {
    // Charger la liste des factures lors du chargement de la page
    $.ajax({
      url: "getFactures.php",
      type: "POST",
      success: function(data) {
        $("#factureList").html(data);
      }
    });
  
    // Ajouter une nouvelle facture
    $("#addFactureForm").on("submit", function(e) {
      e.preventDefault();
      var form = $(this);
      $.ajax({
        url: form.attr("action"),
        type: form.attr("method"),
        data: form.serialize(),
        success: function(data) {
          alert(data);
          // Recharger la liste des factures après l'ajout
          $.ajax({
            url: "getFactures.php",
            type: "POST",
            success: function(data) {
              $("#factureList").html(data);
            }
          });
          // Vider les champs du formulaire après l'ajout
          form.trigger("reset");
        }
      });
    });
  
    // Supprimer une facture
    $(document).on("click", ".deleteFactureBtn", function() {
      var id = $(this).attr("data-id");
      var parent = $(this).parent().parent();
      if (confirm("Êtes-vous sûr de vouloir supprimer cette facture ?")) {
        $.ajax({
          url: "deleteFacture.php",
          type: "POST",
          data: { id: id },
          success: function(data) {
            alert(data);
            // Supprimer la facture de la liste après la suppression
            parent.fadeOut("slow", function() {
              $(this).remove();
            });
          }
        });
      }
    });
  });
  