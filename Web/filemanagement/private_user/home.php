<!DOCTYPE html>
<html lang="en">

<head> 
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>End-of-studies Memory Manager</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.css" rel="stylesheet">


<!-- 
<link href="css/addons/datatables.min.css" rel="stylesheet">
<script href="js/addons/datatables.min.js" rel="stylesheet"></script>
<link href="css/addons/datatables-select.min.css" rel="stylesheet">
<script href="js/addons/datatables-select.min.js" rel="stylesheet"></script> -->


<!-- <link rel="stylesheet" id="font-awesome-style-css" href="http://phpflow.com/code/css/bootstrap3.min.css" type="text/css" media="all">
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js"></script> -->
    <script src="js/jquery-1.8.3.min.js"></script>
    <link rel="stylesheet" type="text/css" href="media/css/dataTable.css" />
    <script src="media/js/jquery.dataTables.js" type="text/javascript"></script>
    <!-- end table-->
    <script type="text/javascript" charset="utf-8">
  $(document).ready(function(){
      $('#dtable').dataTable({
                "aLengthMenu": [[5, 10, 15, 25, 50, 100 , -1], [5, 10, 15, 25, 50, 100, "All"]],
                "iDisplayLength": 10
                //"destroy":true;
            });
  })
    </script>
    <style type="text/css">
      select[multiple], select[size] {
    height: auto;
    width: 20px;
}
table {    -webkit-box-shadow: 0 2px 5px 0 rgba(0,0,0,.16), 0 2px 10px 0 rgba(0,0,0,.12);
    box-shadow: 0 2px 5px 0 rgba(0,0,0,.16), 0 2px 10px 0 rgba(0,0,0,.12);
    border: 0;
  border-radius: 12px;
  backdrop-filter: blur (7px);
  border-collapse: collapse;
  background-color: rgba(173, 216, 230, 0.5); /* bleu ciel avec une opacité de 50% */
}


td, th {
  vertical-align: middle;
  padding: .5em;
  text-align: center;
 /* bordure solide en bleu ciel */
    border-width : thin; 
}
.pull-right {
    float: right;
    margin: 2px !important;
}
    #loader{
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url('img/lg.flip-book-loader.gif') 50% 50% no-repeat rgb(249,249,249);
        opacity: 1;
    }
 / #dtable{

  overflow-x: scroll;
  width: 600px;
    }*/



  </style>

    <script src="jquery.min.js"></script>
<script type="text/javascript">
  $(window).on('load', function(){
    //you remove this timeout
    setTimeout(function(){
          $('#loader').fadeOut('slow');  
      });
      //remove the timeout
      //$('#loader').fadeOut('slow'); 
  });
</script>

</head>

<body width=90% style="padding:0px; margin:60px; background-color:#f8f9fa ;font-family:arial,helvetica,sans-serif,verdana,'Open Sans'">
 
  <!-- Start your project here-->
<!--Navbar --> 
<nav class="mb-1 navbar navbar-expand-lg navbar-dark default-color fixed-top">
    <a class="navbar-brand" href="#"><img src="js/img/Files_Download.png" width="33px" height="33px"> <font color="#FFFFFF">SUP'PTIC End-of-studies Memory Manager</font></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4"
    aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">
          <i class="fab fa-facebook-f"></i>
          <span class="sr-only">(current)</span>
        </a>
      </li>
   
     
    </ul>
  </div>
</nav>
<br>
<!--/.Navbar -->
<br><Br><br>
<!-- Card -->
<div class="" width=100%>
  <div class="" width=90%>
     <?php 
      $select = 0;
      $couleur1 = "#4CAF50";
      $couleur2 = "rgb(243, 255, 245)";
      if (isset($_GET['name'])) {
        $select = 1;
        $couleur1 = "rgb(243, 255, 245)";
        $couleur2 = "#4CAF50";
      } elseif (isset($_GET['bb'])) {
        $select = 2;
        $couleur1 = "#4CAF50";
        $couleur2 = "rgb(243, 255, 245)";
      }
     ?>
  <a href='home.php?name=true' style="background-color: <?php echo $couleur2; ?>; color: <?php echo $couleur1; ?>; padding: 12px 24px; border: <?php echo $couleur1; ?> solid 2px; border-radius: 4px; cursor: pointer;">
        Licence</a>
  <a href='home.php?bb=false' style="background-color: <?php echo $couleur1; ?>; color: <?php echo $couleur2; ?>; padding: 12px 24px; border: <?php echo $couleur2; ?> solid 2px; border-radius: 4px; cursor: pointer;">
        Master</a>
<hr>
  <table id="dtable">
     <thead>

    <th>Filename</th>
    <th>FileSize</th>
    
     <th>Date/Time Upload</th>
     <th>Auteur</th>
     <th>Encadreur</th>
     <th>Thème</th>
     <th>Annee</th>
     <th>Niveau</th>
     <th>Downloads</th>
    <th>Action</th>

</thead>
<tbody>

    
    <tr>
      
        <?php 
   
        require_once("include/connection.php");
      if ($select == 1) {
        $query = mysqli_query($conn,"SELECT ID,NAME,SIZE,EMAIL,ADMIN_STATUS,TIMERS,DOWNLOAD,auteurs,annee,encadreurs,niveau,Theme FROM upload_files WHERE niveau = 'LicenceIII' group by NAME DESC") or die (mysqli_error($conn));
      } elseif ($select == 2) {
      $query = mysqli_query($conn,"SELECT ID,NAME,SIZE,EMAIL,ADMIN_STATUS,TIMERS,DOWNLOAD,auteurs,annee,encadreurs,niveau,Theme FROM upload_files WHERE niveau = 'MASTERII' group by NAME DESC") or die (mysqli_error($conn));
      } else {
        $query = mysqli_query($conn,"SELECT ID,NAME,SIZE,EMAIL,ADMIN_STATUS,TIMERS,DOWNLOAD,auteurs,annee,encadreurs,niveau,Theme FROM upload_files group by NAME DESC") or die (mysqli_error($conn));
      }
      while ($file=mysqli_fetch_array($query)){
         $id =  $file['ID'];
         $name =  $file['NAME'];
         $size =  $file['SIZE'];
         $uploads =  $file['EMAIL'];
          $status =  $file['ADMIN_STATUS'];
         $time =  $file['TIMERS'];
         $download =  $file['DOWNLOAD'];
         $auteurs = $file['auteurs'];
         $annee = $file['annee'];
         $encadreurs = $file['encadreurs'];
         $niveau = $file['niveau'];
         $Theme = $file['Theme'];
    
      ?>
     
      <td width="17%"><?php echo  $name; ?></td>
      <td><?php echo floor($size / 1000) . ' KB'; ?></td>
      
      <td><?php echo $time; ?></td>
      <td><?php echo $auteurs; ?></td>
      <td><?php echo $encadreurs; ?></td>
      <td><?php echo $Theme; ?></td>
      <td><?php echo $annee; ?></td>
      <td><?php echo $niveau; ?></td>
      <td><?php echo $download; ?></td>


        <td style=""><a href='downloads.php?file_id=<?php echo $id; ?>'><img src="img/698569-icon-57-document-download-128.png" width="30px" height="30px" title="Download File"></a> </td>
    </tr>
<?php } ?>
</tbody>
   </table>
    </div>
 


</script>



<!-- Card -->
  <!-- /Start your project here-->

  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="js/jquery-3.4.0.min.js"></script>

  <script type="text/javascript" src="js/popper.min.js"></script>

  <script type="text/javascript" src="js/bootstrap.min.js"></script>

  <script type="text/javascript" src="js/mdb.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css"/>   
<script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/1.0.3/css/dataTables.responsive.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/1.0.3/js/dataTables.responsive.js"></script>

</body>
</html>
