<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

if(isset($_POST['submit']))
{	
	$docid=$_SESSION['id'];
	$patname=$_POST['patname'];
$patcontact=$_POST['patcontact'];
$patemail=$_POST['patemail'];
$gender=$_POST['gender'];
$pataddress=$_POST['pataddress'];
$patage=$_POST['patage'];
$medhis=$_POST['medhis'];
$sql=mysqli_query($con,"insert into tblpatient(Docid,PatientName,PatientContno,PatientEmail,PatientGender,PatientAdd,PatientAge,PatientMedhis) values('$docid','$patname','$patcontact','$patemail','$gender','$pataddress','$patage','$medhis')");
if($sql)
{
echo "<script>alert('Patient info added Successfully');</script>";
header('location:add-patient.php');

}
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Laboratory | Add Patient</title>
		
		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
		<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
		<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
		<link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/plugins.css">
		<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />

	<script>
function userAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'email='+$("#patemail").val(),
type: "POST",
success:function(data){
$("#user-availability-status1").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>
	<style>
		#personal>h1{
			color: #007aFF;
		}
		select{
			width: 100%;
		}
		table{
			width: 100%;
			align-items: center;
			align-content: center;
			text-align: center;
			justify-content: center;
			justify-items: center;
		}
		table>button{
			align-items: center;
		}
		.sendB{
			margin-top: 10px;
			margin-left: 10px;
		}
		#add{
			border-color: #007aFF;
			background-color: #FFFFFF;
			color: #007aFF;
			font-weight: bold;
		}
		#delete{
			border-color: #007aFF;
			background-color: #FFFFFF;
			color: #007aFF;
			font-weight: bold;
		}
	</style>
	</head>
	<body>
		<div id="app">		
<?php include('include/sidebar.php');?>
<div class="app-content">
<?php include('include/header.php');?>
						
<div class="main-content" >
<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
<section id="page-title">
<div class="row">
<div class="col-sm-8">
<h1 class="mainTitle">Patient | Add Patient</h1>
</div>
<ol class="breadcrumb">
<li>
<span>Patient</span>
</li>
<li class="active">
<span>Add Patient</span>
</li>
</ol>
</div>
</section>
<div class="container-fluid container-fullw bg-white">
<div class="row">
<div class="col-md-12">
<div class="row margin-top-30">
<div class="col-lg-8 col-md-12">
<div class="panel panel-white">
<div class="panel-heading">
<h5 class="panel-title">Add Patient</h5>
</div>
<div class="panel-body">
<form role="form" name="" method="post">

<div class="form-group">
<label for="doctorname">
Patient Name*
</label>
<input type="text" name="patname" class="form-control"  placeholder="Enter Patient Name" required="true">
</div>
<div class="form-group">
<label for="doctorname">
Last Name*
</label>
<input type="text" name="patname" class="form-control"  placeholder="Enter Patient Name" required="true">
</div>
<div class="form-group">
<label for="fess">
Identifiant*
</label>
<input type="text" name="patcontact" class="form-control"  placeholder="Enter Patient Contact no" required="true" maxlength="10" pattern="[0-9]+">
</div>
<div class="form-group">
<label for="fess">
Code Pin*
</label>
<input type="number" name="patcontact" class="form-control"  placeholder="Enter Patient Contact no" required="true" maxlength="10" pattern="[0-9]+">
</div>
<div class="form-group">
<label for="doctorname">
Birthday*
</label>
<input type="date" name="patname" class="form-control"  placeholder="Enter Patient Name" required="true">
</div>
<div class="form-group">
<label for="fess">
Patient Email*
</label>
<input type="email" id="patemail" name="patemail" class="form-control"  placeholder="Enter Patient Email id" required="true" onBlur="userAvailability()">
<span id="user-availability-status1" style="font-size:12px;"></span>
</div>
<div class="form-group">
<label class="block">
Gender
</label>
<div class="clip-radio radio-primary">
<input type="radio" id="rg-female" name="gender" value="female" >
<label for="rg-female">
Female
</label>
<input type="radio" id="rg-male" name="gender" value="male">
<label for="rg-male">
Male
</label>
</div>
</div>
<div class="form-group">
<label for="fess">
Patient Height*
</label>
<input type="number" id="patemail" name="patemail" class="form-control"  placeholder="Enter Patient Email id" required="true" onBlur="userAvailability()">
<span id="user-availability-status1" style="font-size:12px;"></span>
</div>
<div class="form-group">
<label for="fess">
Patient Tall*
</label>
<input type="number" id="patemail" name="patemail" class="form-control"  placeholder="Enter Patient Email id" required="true" onBlur="userAvailability()">
<span id="user-availability-status1" style="font-size:12px;"></span>
</div>
<div class="form-group">
<label for="select">Status Drepanositaire</label>
<select>
<option value="">&nbsp;</option>
<option>AA</option>
<option>AS</option>
<option>SS</option>
</select>
</div>
<div class="form-group">
<label for="select">Blood group</label>
<select>
	<option value="">&nbsp;</option>
	<option>A Positif</option>
	<option>A Négatif</option>
	<option>B Positif</option>
	<option>B Négatif</option>
	<option>AB Positif</option>
	<option>AB Négatif</option>
	<option>O Positif</option>
	<option>O Négatif</option>
</select>
</div>
<div class="form-group">
<label for="fess">
 Child Number
</label>
<input type="number" name="patage" class="form-control"  placeholder="Enter Patient Age" required="true">
</div>
<div class="form-group">
<label for="fess">
 Contact
</label>
<input type="text" name="patage" class="form-control"  placeholder="Enter Patient Age" required="true">
</div>
<div class="form-group">
<label for="fess">
 Profession
</label>
<input type="text" name="patage" class="form-control"  placeholder="Enter Patient Age" required="true">
</div>
<div class="form-group">
<label for="fess">
Enterprise/School
</label>
<input type="text" name="patage" class="form-control"  placeholder="Enter Patient Age" required="true">
</div>
<div class="form-group">
<label for="fess">
Matrimonial situation
</label>
<input type="text" name="patage" class="form-control"  placeholder="Enter Patient Age" required="true">
</div>
<div class="form-group">
<label for="select">Hospital</label>
<select>
<option value="">&nbsp;</option>
<option>CHU</option>
<option>Gynéco</option>
<option>Genral Hospital</option>
<option>CNPS</option>
</select>
</div>
<div class="form-group">
<label for="select">Country</label>
<select>
<option value="">&nbsp;</option>
<option>Cameroun</option>
<option>Gabon</option>
<option>Equatorial Guinea</option>
<option>Nigeria</option>
</select>
</div>
<div class="form-group">
<label for="select">Original zone</label>
<select>
<option value="">&nbsp;</option>
<option>Center</option>
<option>South</option>
<option>South-east</option>
<option>North</option>
<option>North-west</option>
<option>West</option>											
<option>Littoral</option>
<option>East</option>
<option>Adamaoua</option>
<option>Extreme-North</option>
</select>
</div>
<div class="form-group">
<label for="select">Town</label>
<select>
<option value="">&nbsp;</option>											
<option>Douala</option>								
<option>Yaounde</option>						
<option>Garoua</option>						
<option>Maroua</option>						
<option>Ngaoundéré</option>						
<option>Ebolowa</option>							
<option>Bertoua</option>						
<option>Bafoussam</option>						
<option>Bamenda</option>						
<option>Buea</option>
</select>
</div>
<div class="form-group">
<label for="fess">
Live Zone
</label>
<input type="text" name="patage" class="form-control"  placeholder="Enter Patient Age" required="true">
</div>
<div class="form-group">
<label for="select">Town</label>
<select>
<option value="">&nbsp;</option>
<option>Cameroonian</option>											
<option>Centraficain</option>							
<option>Nigerian</option>							
<option>Gabonais</option>						
<option>Congolais RDC</option>
</select>
</div>
<div class="form-group">
<label for="fess">
Religion
</label>
<input type="text" name="patage" class="form-control"  placeholder="Enter Patient Age" required="true">
</div>

<div id="personal">										
<h1>Information CanCerologique</h1>					
</div>
<div class="form-group">
<label for="fess">
File Number
</label>
<input type="text" name="patage" class="form-control"  placeholder="Enter Patient Age" required="true">
</div>
<div class="form-group">
<label for="fess">
Tumer Site
</label>
<input type="text" name="patage" class="form-control"  placeholder="Enter Patient Age" required="true">
</div>
<div class="form-group">
<label for="select">Treatment</label>
<select>
<option value="">&nbsp;</option>
<option>Radiotherapy</option>											
<option>Chimiotherapy</option>							
<option>Chirurgie</option>
</select>
</div>
<div class="form-group">
<label for="checkbox">
<input type="checkbox" value="traitments" placeholder="Response">
This treatment is on during?
</label>
</div>
<div class="form-group">
<label for="fess">
Last date
</label>
<input type="text" name="patage" class="form-control"  placeholder="Enter Patient Age" required="true">
</div>
<div class="form-group">
<label for="fess">
Actual Doctor
</label>
<input type="text" name="patage" class="form-control"  placeholder="Enter Patient Age" required="true">
</div>
<div class="form-group">
<label for="fess">
Doctor contact
</label>
<input type="text" name="patage" class="form-control"  placeholder="Enter Patient Age" required="true">
</div>
<div class="form-group">
<label for="select">Treatment Strategy</label>
<select>
<option value="">&nbsp;</option>
<option>Radiotherapy</option>											
<option>Chimiotherapy</option>							
<option>Chirurgie</option>
</select>
</div>
<div class="form-group">
<label for="fess">
Others
</label>
<input type="text" name="patage" class="form-control"  placeholder="Enter Patient Age" required="true">
</div>
<div id="personal">										
<h1>Information Patient Drepanocytose</h1>					
</div>
<div class="form-group">
<label for="fess">
File Number
</label>
<input type="text" name="patage" class="form-control"  placeholder="Enter Patient Age" required="true">
</div>
<div class="form-group">
<label for="fess">
Age of diagnostic
</label>
<input type="text" name="patage" class="form-control"  placeholder="Enter Patient Age" required="true">
</div>
<div class="form-group">
<label for="fess">
PHENOTYPEEHEMOGOBLINE
</label>
<input type="text" name="patage" class="form-control"  placeholder="Enter Patient Age" required="true">
</div>
<div class="form-group">
<label for="fess">
 Other informations
</label>
<textarea type="text" name="medhis" class="form-control"  placeholder="Enter commentaire"></textarea>
</div>	
<div id="personal">										
<h1>Contact Persons</h1>					
</div>
	<button onclick="addRow()" id="add">
		+
	</button>
	<table border="1" id="myTable">
		<tr>
			<th>Nom</th>										
			<th>Numéro</th>								
			<th>Lien</th>								
			<th>Action</th>
		</tr>
			<tr>
				<td>
					<input type="text">
				</td>
				<td>
					<input type="text">
				</td>
				<td>
				<select required>
					<option value="">&nbsp;</option>
					<option value="Option 1">Father</option>
					<option value="Option 2">Mother</option>
					<option value="Option 3">Aunt</option>
					<option value="Option 4">Uncle</option>
					<option value="Option 5">Brother</option>
					<option value="Option 6">Sister</option>
					<option value="Option 7">grandfather</option>
					<option value="Option 8">grandmother</option>
				</select>
				</td>
				<td>
					<button onclick="deleteRow(this)" id="delete">X</button>
				</td>
			</tr>
		<br/>
	</table>
	<div id="personal">									
		<h1>Actual Doctor</h1>
	</div>
	<button onclick="addRow2()" id="add">
		+
	</button>
	<table border="1" id="myTable2">
		<tr>
		<th>Doctor</th>									
		<th>Speciality</th>									
		<th>Contact</th>								
		<th>Hospital</th>								
		<th>Action</th>
		</tr>
			<tr>
				<td>
					<input type="text">
				</td>
				<td>
				<select required>
					<option value="">&nbsp;</option>
					<option value="Option 1">Father</option>
					<option value="Option 2">Mother</option>
					<option value="Option 3">Aunt</option>
					<option value="Option 4">Uncle</option>
					<option value="Option 5">Brother</option>
					<option value="Option 6">Sister</option>
					<option value="Option 7">grandfather</option>
					<option value="Option 8">grandmother</option>
				</select>
				</td>
				<td>
					<input type="text">
				</td>
				<td>
					<input type="text">
				</td>
				<td>
					<button onclick="deleteRow(this)" id="delete">X</button>
				</td>
			</tr>
		<br/>
	</table>
	<div id="personal">
		<h1>Assurances</h1>
	</div>
	<button onclick="addRow3()" id="add">
		+
	</button>
	<table border="1" id="myTable3">
		<tr>
		<th>Assurance</th>									
		<th>Numéro d'assuré</th>									
		<th>Couverture percentage</th>									
		<th>Action</th>
		</tr>
			<tr>
				<td>
					<input type="text">
				</td>
				<td>
					<input type="number">
				</td>
				<td>
					<input type="number">
				</td>
				<td>
					<button onclick="deleteRow(this)" id="delete">X</button>
				</td>
			</tr>
		<br/>
	</table>
	<div id="personal">
		<h1>Allergie</h1>
	</div>
	<button onclick="addRow4()" id="add">
		+
	</button>
	<table border="1" id="myTable4">
		<tr>
		<th>Affection</th>
		<th>Commentaire</th>
		<th>Date</th>									
		<th>Action</th>
		</tr>
			<tr>
				<td>
					<input type="text">
				</td>
				<td>
					<input type="text">
				</td>
				<td>
					<input type="date">
				</td>
				<td>
					<button onclick="deleteRow(this)" id="delete">X</button>
				</td>
			</tr>
		<br/>
	</table>
	<div id="personal">
		<h1>Traitement suivi</h1>
	</div>
	<button onclick="addRow5()" id="add">
		+
	</button>
	<table border="1" id="myTable5">
		<tr>
		<th>Traitement</th>
		<th>début</th>
		<th>Fin</th>									
		<th>Action</th>
		</tr>
			<tr>
				<td>
					<input type="text">
				</td>
				<td>
					<input type="date">
				</td>
				<td>
					<input type="date">
				</td>
				<td>
					<button onclick="deleteRow(this)" id="delete">X</button>
				</td>
			</tr>
		<br/>
	</table>
	<div id="personal">
		<h1>Traitement suivi</h1>
	</div>
	<button onclick="addRow6()" id="add">
		+
	</button>
	<table border="1" id="myTable6">
		<tr>
		<th>Vaccin</th>
		<th>Détails</th>
		<th>Date</th>
		<th>Rappel</th>									
		<th>Action</th>
		</tr>
			<tr>
				<td>
					<input type="text">
				</td>
				<td>
					<input type="text">
				</td>
				<td>
					<input type="date">
				</td>
				<td>
					<input type="text">
				</td>
				<td>
					<input type="text">
				</td>
				<td>
					<button onclick="deleteRow(this)" id="delete">X</button>
				</td>
			</tr>
		<br/>
	</table>	

<button type="submit" name="submit" id="submit" class="btn btn-primary" class="sendB" style="position:relative;top:15px;left:680px;margin-bottom:10px; background-color:#007aFF;color:#FFFFFF;">
Add
</button>
</form>
</div>
</div>
</div>
</div>
</div>
<div class="col-lg-12 col-md-12">
<div class="panel panel-white">
</div>
</div>
</div>
</div>
</div>
</div>				
</div>
</div>
</div>
			<!-- start: FOOTER -->
<?php include('include/footer.php');?>
			<!-- end: FOOTER -->
		
			<!-- start: SETTINGS -->
<?php include('include/setting.php');?>
			
			<!-- end: SETTINGS -->
		</div>
		<!-- start: MAIN JAVASCRIPTS -->
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
		<script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
		<script src="vendor/autosize/autosize.min.js"></script>
		<script src="vendor/selectFx/classie.js"></script>
		<script src="vendor/selectFx/selectFx.js"></script>
		<script src="vendor/select2/select2.min.js"></script>
		<script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
		<script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CLIP-TWO JAVASCRIPTS -->
		<script src="assets/js/main.js"></script>
		<!-- start: JavaScript Event Handlers for this page -->
		<script src="assets/js/form-elements.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				FormElements.init();
			});
		</script>
		<script>

			function addRow() {
			// Crée une nouvelle ligne
			var table = document.getElementById("myTable");
			var newRow = table.insertRow();

			// Ajoute quatre cellules avec des champs de texte, un menu déroulant et un bouton pour supprimer la ligne à la nouvelle ligne
			for (var i = 0; i < 4; i++) {
				var cell = newRow.insertCell();
				var input;

				if (i === 2) {
				// Crée un menu déroulant pour la troisième cellule
				input = document.createElement("select");
				var options = [" ", "Father", "Mother", "Aunt", "Uncle", "Brother", "Sister", "grandfather", "grandmother"];

				for (var j = 0; j < options.length; j++) {
					var option = document.createElement("option");
					option.value = options[j];
					option.text = options[j];
					input.appendChild(option);
				}
				} else if (i === 3) {
				// Crée un bouton pour supprimer la ligne pour la quatrième cellule
				input = document.createElement("button");
				input.textContent = "X";
				input.onclick = function() {
					deleteRow(this);
				};
				} else {
				// Crée un champ de texte pour les deux premières cellules
				input = document.createElement("input");
				input.type = "text";
				}

				cell.appendChild(input);
			}
			}

			function deleteRow(button) {
			// Supprime la ligne parente de la cellule contenant le bouton
			var row = button.parentNode.parentNode;
			row.parentNode.removeChild(row);
			}

			function addRow2() {
			// Crée une nouvelle ligne
			var table = document.getElementById("myTable2");
			var newRow = table.insertRow();

			// Ajoute quatre cellules avec des champs de texte, un menu déroulant et un bouton pour supprimer la ligne à la nouvelle ligne
			for (var i = 0; i < 5; i++) {
				var cell = newRow.insertCell();
				var input;

				if (i === 1) {
				// Crée un menu déroulant pour la troisième cellule
				input = document.createElement("select");
				var options = [" ", "Father", "Mother", "Aunt", "Uncle", "Brother", "Sister", "grandfather", "grandmother"];

				for (var j = 0; j < options.length; j++) {
					var option = document.createElement("option");
					option.value = options[j];
					option.text = options[j];
					input.appendChild(option);
				}
				} else if (i === 4) {
				// Crée un bouton pour supprimer la ligne pour la quatrième cellule
				input = document.createElement("button");
				input.textContent = "X";
				input.onclick = function() {
					deleteRow(this);
				};
				} else {
				// Crée un champ de texte pour les deux premières cellules
				input = document.createElement("input");
				input.type = "text";
				}

				cell.appendChild(input);
			}
			}

			function addRow3() {
			// Crée une nouvelle ligne
			var table = document.getElementById("myTable3");
			var newRow = table.insertRow();

			// Ajoute quatre cellules avec des champs de texte, un menu déroulant et un bouton pour supprimer la ligne à la nouvelle ligne
			for (var i = 0; i < 4; i++) {
				var cell = newRow.insertCell();
				var input;

				if (i === 3) {
				// Crée un bouton pour supprimer la ligne pour la quatrième cellule
				input = document.createElement("button");
				input.textContent = "X";
				input.onclick = function() {
					deleteRow(this);
				};
				} else {
				// Crée un champ de texte pour les deux premières cellules
				input = document.createElement("input");
				input.type = "text";
				}

				cell.appendChild(input);
			}
			}

			function addRow4() {
			// Crée une nouvelle ligne
			var table = document.getElementById("myTable4");
			var newRow = table.insertRow();

			// Ajoute quatre cellules avec des champs de texte, un menu déroulant et un bouton pour supprimer la ligne à la nouvelle ligne
			for (var i = 0; i < 4; i++) {
				var cell = newRow.insertCell();
				var input;

				if (i === 2) {
					input = document.createElement("input");
					input.type = "date";
				}else if (i === 3) {
				// Crée un bouton pour supprimer la ligne pour la quatrième cellule
				input = document.createElement("button");
				input.textContent = "X";
				input.onclick = function() {
					deleteRow(this);
				};
				} else {
				// Crée un champ de texte pour les deux premières cellules
				input = document.createElement("input");
				input.type = "text";
				}

				cell.appendChild(input);
			}
			}

			function addRow5() {
			// Crée une nouvelle ligne
			var table = document.getElementById("myTable5");
			var newRow = table.insertRow();

			// Ajoute quatre cellules avec des champs de texte, un menu déroulant et un bouton pour supprimer la ligne à la nouvelle ligne
			for (var i = 0; i < 4; i++) {
				var cell = newRow.insertCell();
				var input;

				if (i === 1) {
					input = document.createElement("input");
					input.type = "date";
				}else if (i === 2) {
					input = document.createElement("input");
					input.type = "date";
				} else if (i === 3) {
				// Crée un bouton pour supprimer la ligne pour la quatrième cellule
				input = document.createElement("button");
				input.textContent = "X";
				input.onclick = function() {
					deleteRow(this);
				};
				} else {
				// Crée un champ de texte pour les deux premières cellules
				input = document.createElement("input");
				input.type = "text";
				}

				cell.appendChild(input);
			}
			}

			function addRow6() {
			// Crée une nouvelle ligne
			var table = document.getElementById("myTable6");
			var newRow = table.insertRow();

			// Ajoute quatre cellules avec des champs de texte, un menu déroulant et un bouton pour supprimer la ligne à la nouvelle ligne
			for (var i = 0; i < 5; i++) {
				var cell = newRow.insertCell();
				var input;

				if (i === 2) {
					input = document.createElement("input");
					input.type = "date";
				} else if (i === 4) {
				// Crée un bouton pour supprimer la ligne pour la quatrième cellule
				input = document.createElement("button");
				input.textContent = "X";
				input.onclick = function() {
					deleteRow(this);
				};
				} else {
				// Crée un champ de texte pour les deux premières cellules
				input = document.createElement("input");
				input.type = "text";
				}

				cell.appendChild(input);
			}
			}
		</script>
		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->
	</body>
</html>