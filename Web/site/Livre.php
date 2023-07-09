<?php
require_once("connect.php");
//Je récupère l'id du livre
if(isset($_GET['id'])){
    $id=$_GET['id'];
}
else{
    $id=1;
}
//Je recherche un element en fonction de son id
$selection="SELECT * FROM Livres WHERE id=$id";

//Preparation de la requette
$lance=$connect->prepare($selection);
//Execution de la requette
$lance->execute();

//Recuperation de l'information
$info=$lance->fetch();
?>
<!DOCTYPE html>
<!--Le titre de la page et les differentes ecrits de la page seront affichés grace a une base de donnée-->
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>MyBook | <?php echo $info[1]; ?></title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <?php  include_once("header.livre.php");
    include_once("section.livre.php");
    include_once("related_book.php");
    include_once("footer.php");
    ?>
    
    