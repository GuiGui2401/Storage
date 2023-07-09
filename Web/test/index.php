<!DOCTYPE html>
<html>
<head>
  <title>Ajouter une ligne au tableau</title>
  <style>
    /* Style du bouton */
    .add-button {
      background-color: #4CAF50;
      color: white;
      padding: 10px 20px;
      border: none;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <table id="myTable">
    <tr>
      <th>Colonne 1</th>
      <th>Colonne 2</th>
    </tr>
    <tr>
      <td>Donnée 1</td>
      <td>Donnée 2</td>
    </tr>
  </table>

  <button class="add-button" onclick="addRow()">Ajouter une ligne</button>

  <script>
  	function addRow() {
  // Crée une nouvelle ligne
  var table = document.getElementById("myTable");
  var newRow = table.insertRow();

  // Ajoute deux cellules à la nouvelle ligne
  var cell1 = newRow.insertCell();
  var cell2 = newRow.insertCell();

  // Ajoute du texte aux cellules
  var newText1 = document.createTextNode("Nouvelle donnée 1");
  var newText2 = document.createTextNode("Nouvelle donnée 2");
  cell1.appendChild(newText1);
  cell2.appendChild(newText2);
}

  </script>
</body>
</html>
