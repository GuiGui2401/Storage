<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>MyBook | News</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <?php include_once("header.php");?>
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center" style="display: flex;">
                <?php
                // Ce fichier vas afficher les elements par leurs dates d'arrivée, c-a-d du plus recent au plus anciens
                //Inclusion des fichiers néccéssaires pour la page
                /**
                 * Il y'aura une fonction ici qui va renvoyer un tableau trié des informations livres en fonction de leur date d'arrivée
                 * et puis une simple boucle vas les afficher les uns apres les autres
                 */
                require_once("connect.php");
                $req="SELECT * FROM Livres ORDER BY add_day DESC";
                $exe=$connect->prepare($req);
                $exe->execute();
                $reslt=$exe->fetchAll();
                for($i=0; $i<8; $i++){
                ?>

                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Sale badge-->
                        <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">New</div>
                        <!-- Product image-->
                                                        <!--source de l'image modifiée avec php -->
                        <img class="card-img-top" src=<?php echo "Detail/".$reslt[$i][4] ?> alt="..." style="height : 200px"/>
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder"><?php echo $reslt[$i][1]?></h5>
                                <!-- Product price-->
                                <?php echo "<i>".date_diff(date_create(date('Y-m-d')),date_create($reslt[$i][6]))->format("%a")." days ago</i><br>" ?>
                                Free Version
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href=<?php echo "Livre.php?id=".$reslt[$i][0]?>>Download</a></div>            
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php include_once("footer.php"); ?>