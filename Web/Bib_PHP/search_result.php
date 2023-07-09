<?php
/**
 * Ce fichier vas afficher les resultats de la recherche
 */
$search=strtolower($_POST['txt']); //Je recupere la saisie de l'utilisateur
$searchs=explode(" ",$search);//Je separe la recherches en differents mots
require_once("connect.php");
    //Je selectionne tous les elements du tableau
$selection="SELECT * FROM Livres";
    //Preparation de la requette
$lance=$connect->prepare($selection);
    //Execution de la requette
$lance->execute();
$id=0;
while($livre=$lance->fetch()){
    $tags=explode("_",$livre[2]);//Je classe les diferents tags dans un tableaux
    foreach($tags as $val){
        if(in_array(strtolower($val),$searchs)){ $id=$livre[0];?>
            <div class="col mb-5">
                <div class="card h-100">
                    <!-- Sale badge-->
                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">New</div>
                    <!-- Product image-->
                                                    <!--source de l'image modifiée avec php -->
                    <img class="card-img-top" src=<?php echo "Detail/".$livre[4] ?> alt="..." />
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <h5 class="fw-bolder"><?php echo $livre[1]?></h5>
                            <!-- Product price-->
                            Free Version
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href=<?php echo "Livre.php?id=".$livre[0]?>>Download</a></div>            
                        </div>
                    </div>
                </div>
            </div>
        <?php
            break;
        }
    }
    foreach($tags as $val){
        foreach($searchs as $sch){
            if((strstr($val,$sch)||strstr($sch,$val))&&($id!==$livre[0])){ $id=$livre[0];
        ?>
                <div class="col mb-5">
                <div class="card h-100">
                    <!-- Sale badge-->
                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">New</div>
                    <!-- Product image-->
                                                    <!--source de l'image modifiée avec php -->
                    <img class="card-img-top" src=<?php echo "Detail/".$livre[4] ?> alt="..." />
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <h5 class="fw-bolder"><?php echo $livre[1]?></h5>
                            <!-- Product price-->
                            Free Version
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href=<?php echo "Livre.php?id=".$livre[0]?>>Download</a></div>            
                        </div>
                    </div>
                </div>
            </div>
<?php

                break;
            }
        }
    }
}?>
