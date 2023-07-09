<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>MyBook | All-Items</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <?php
    include_once("header.php");
    //Section 
//Je me connecte à la base de donnée et je vais aficher les données selon les elements de la base
//include("connect.php");
require_once("connect.php");

//Je selectionne tous les elements du tableau
$selection="SELECT * FROM Livres";

//Preparation de la requette
$lance=$connect->prepare($selection);
//Execution de la requette
$lance->execute();
?>
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
        <!--Je parcoure les elements selectionés-->
        <?php while($info=$lance->fetch()){?>
            <div class="col mb-5">
                <div class="card h-100">
                    <!-- Sale badge-->
                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">New</div>
                    <!-- Product image-->
                                                    <!--source de l'image modifiée avec php -->
                    <img class="card-img-top" src=<?php echo "Detail/"."$info[4]" ?> alt="..." style="height : 200px" />
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <h5 class="fw-bolder"><?php echo $info[1]?></h5>
                            <!-- Product price-->
                            Free Version
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href=<?php echo "Livre.php?id=".$info[0]?>>Download</a></div>            
                        </div>
                    </div>
                </div>
            </div>
            <?php }?>
        </div>
    </div>
    <form method="post" action="index.php" id="frm" name="frm" onsubmit="return verification(this)">
        <input type="text" id="txt" name="txt" placeholder="Recherhe...">
        <input type="submit" value="Search"> 
   </form>
   <!--Verifiction de l'entree de la barre de recherche-->
   <script >
            function verification(element)
            {
                valeur=document.forms["frm"].elements["txt"].value;
                if(valeur=="")
                {
                    document.forms["frm"].elements["txt"].focus();
                    return false
                }
            }
    </script>
</section>
    <?php
    include_once("footer.php");
    ?>