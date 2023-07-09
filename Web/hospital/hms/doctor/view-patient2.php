<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

$query2=mysqli_query($con,"select doctorName from doctors where id='".$_SESSION['id']."'");
while($row=mysqli_fetch_array($query2))
{
	$doctorname = $row['doctorName'];
}

if(isset($_POST['submit']))
  {
    
    
    $vid=$_GET['viewid'];
    $bp=$_POST['bp'];
    $bs=$_POST['bs'];
    $weight=$_POST['weight'];
    $temp=$_POST['temp'];
    $hop=$_POST['hop'];
    $spec=$_POST['spec'];
    $hypo=$_POST['hypo'];
    $hosp=$_POST['hosp'];
    $res=$_POST['reson'];
    $medic=$_POST['medic'];
    $poso=$_POST['poso'];
    $cont=$_POST['cont'];
    $analy=$_POST['analy'];
    $desc=$_POST['desc'];
 
      $query.=mysqli_query($con, "insert   tblmedicalhistory(PatientID,BloodPressure,Tension,Weight,Temperature,Hopital,speciality,hypothese,reson,hospitalisation,medicament,posology,contact,analysis,description,doctorname)value('$vid','$bp','$bs','$weight','$temp','$hop','$spec','$hypo','$res','$hosp','$medic','$poso','$cont','$analy','$desc','$doctorname')");
    if ($query) {
    echo '<script>alert("Medical history has been added.")</script>';
    echo "<script>window.location.href ='manage-patient.php'</script>";
  }
  else
    {
      echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }

  
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Doctor | Manage Patients</title>
		
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
    <style>
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
<h1 class="mainTitle">Doctor | Manage Patients</h1>
</div>
<ol class="breadcrumb">
<li>
<span>Doctor</span>
</li>
<li class="active">
<span>Manage Patients</span>
</li>
</ol>
</div>
</section>
<div class="container-fluid container-fullw bg-white">
<div class="row">
<div class="col-md-12">
<h5 class="over-title margin-bottom-15">Manage <span class="text-bold">Patients</span></h5>
<?php
                               $vid=$_GET['viewid'];
                               $ret=mysqli_query($con,"select * from tblpatient where ID='$vid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {
                               ?>
<table border="1" class="table table-bordered">
 <tr align="center" style="background-color: #77B5FE;">
<td colspan="4" style="font-size:20px;">
<span style="color: #FFFFFF;">Patient Details</span></td></tr>

    <tr>
    <th scope>Patient Name</th>
    <td><?php  echo $row['PatientName'];?></td>
    <th scope>Patient Email</th>
    <td><?php  echo $row['PatientEmail'];?></td>
  </tr>
  <tr>
    <th scope>Patient Mobile Number</th>
    <td><?php  echo $row['PatientContno'];?></td>
    <th>Patient Address</th>
    <td><?php  echo $row['PatientAdd'];?></td>
  </tr>
    <tr>
    <th>Patient Gender</th>
    <td><?php  echo $row['PatientGender'];?></td>
    <th>Patient Age</th>
    <td><?php  echo $row['PatientAge'];?></td>
  </tr>
  <tr>
    
    <th>Patient Medical History(if any)</th>
    <td><?php  echo $row['PatientMedhis'];?></td>
     <th>Patient Reg Date</th>
    <td><?php  echo $row['CreationDate'];?></td>
  </tr>
 
<?php }?>
</table>
<?php  

$ret=mysqli_query($con,"select * from tblmedicalhistory  where PatientID='$vid'");



 ?>
<table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; text-align:center;">
  <tr style="background-color: #77B5FE;">
   <th colspan="16" style=" text-align:center;"><span style="color: #FFFFFF;">Medical History</span></th> 
  </tr>
  <tr>
    <th>#</th>
<th>Blood Pressure</th>
<th>Tension</th>
<th>Weight</th>
<th>Body Temperature</th>
<th>Hopital</th>
<th>Speciality</th>
<th>hypothese</th>
<th>reson</th>
<th>hospitalisation</th>
<th>medicament</th>
<th>posology</th>
<th>contact</th>
<th>analysis</th>
<th>description</th>
<th>Visit Date</th>
</tr>
<?php  
while ($row=mysqli_fetch_array($ret)) { 
  ?>
<tr>
  <td><?php echo $cnt;?></td>
 <td><?php  echo $row['BloodPressure'];?></td>
 <td><?php  echo $row['Tension'];?></td>
 <td><?php  echo $row['Weight'];?></td>
  <td><?php  echo $row['Temperature'];?></td>
  <td><?php  echo $row['Hopital'];?></td>
  <td><?php  echo $row['speciality'];?></td>
  <td><?php  echo $row['hypothese'];?></td>
  <td><?php  echo $row['reson'];?></td>
  <td><?php  echo $row['hospitalisation'];?></td>
  <td><?php  echo $row['medicament'];?></td>
  <td><?php  echo $row['posology'];?></td>
  <td><?php  echo $row['contact'];?></td>
  <td><?php  echo $row['analysis'];?></td>
  <td><?php  echo $row['description'];?></td>
  <td><?php  echo $row['CreationDate'];?></td> 
</tr>
<?php $cnt=$cnt+1;} ?>
</table>
  

<?php  ?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
     <div class="modal-content">
      <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Medical History</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                <table class="table table-bordered table-hover data-tables">

                                 <form method="post" name="submit">

      <tr>
    <th>Blood Pressure :
    <input name="bp" placeholder="Blood Pressure" class="form-control wd-450" required="true">
    </th>
  </tr>                          
     <tr>
    <th>Tension :
    <input name="bs" placeholder="Tension" class="form-control wd-450" required="true"></th>
  </tr> 
  <tr>
    <th>Weight :
    <input name="weight" placeholder="Weight" class="form-control wd-450" required="true"></th>
  </tr>
  <tr>
    <th>Body Temperature :
    
    <input name="temp" placeholder="Body Temperature" class="form-control wd-450" required="true"></th>
  </tr>

  <tr>
  <th>Hopital<select style="width: 100%; color:lightgray;" name ="hop">
  <option value="default">&nbsp;</option>
  <option value="CHU">CHU</option>
  <option value="Gynéco">Gynéco</option>
  <option value="General Hospital">General Hospital</option>
  <option value="CNPS">CNPS</option>
</select></th>
</tr>
                         
  <tr align="center">
   <th colspan="8" >Other Information</th> 
</tr>
<tr>
  <th>Speciality
    <select style="width: 100%; color:lightgray;" name="spec">
      <option value="default">&nbsp;</option>
      <option value="Cardiology">Cardiology</option>
      <option value="Radiology">Radiology</option>
      <option value="Neurology">Neurology</option>
    </select>
  </th>
</tr>
<tr>
  <th>Diagnostic Hypothese
    <input name="hypo" placeholder="Diagnostic Hypothese" class="form-control wd-450" required="true"></th>
</tr>
<tr>
  <th>Reson
    <input name="reson" placeholder="Reson" class="form-control wd-450" required="true"></th>
</tr>
<tr>
  <th>hospitalisation
    <input name="hosp" placeholder="hospitalisation" class="form-control wd-450" required="true"></th>
</tr>
<tr align="center">
   <th colspan="8" >Medicaments List</th> 
</tr>
<tr>
  <th>
  <button onclick="addRow()" id="add">
		+
	</button>
	<table border="1" id="myTable" style="width: 100%;">
		<tr>
		<th>Medicament</th>									
		<th>Posology Informations</th>									
		<th>Contact</th>		
		</tr>
			<tr>
				<td>
				<input type="text" name="medic">
				</td>
				<td>
					<input type="text" name="poso">
				</td>
				<td>
					<input type="text" name="cont">
				</td>
				<td>
					<button onclick="deleteRow(this)" id="delete">X</button>
				</td>
			</tr>
		<br/>
	</table>
  </th>
</tr>
<tr align="center">
   <th colspan="8" >Analysis List</th> 
</tr>
<tr>
  <th>
<button onclick="addRow2()" id="add">
		+
	</button>
	<table border="1" id="myTable2" style="width: 100%;">
		<tr>
		<th>Analysis</th>									
		<th>Description</th>	
		</tr>
			<tr>
				<td>
				<input type="text" name="analy">
				</td>
				<td>
					<input type="text" name="desc">
				</td>
				<td>
					<button onclick="deleteRow(this)" id="delete">X</button>
				</td>
			</tr>
		<br/>
	</table>
  </th>
</tr>  
   
</table>
</div>
<div class="modal-footer">
 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 <button type="submit" name="submit" class="btn btn-primary">Submit</button>
  
  </form>
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
			for (var i = 0; i < 3; i++) {
				var cell = newRow.insertCell();
				var input;

				if (i === 2) {
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
