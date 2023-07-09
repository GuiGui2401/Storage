<section class="py-5 bg-light">
<h2 align=center class="fw-bolder mb-4">Related products</h2>
    <div class="container px-4 px-lg-5 mt-5" id="related">
           <?php
           //Je verifie que l'id du livre a bien été envoyé 
           if(isset($_GET['id'])){
            $id=$_GET['id'];
           }
           else{
            echo "Impossible de trouver le livre";
            exit();
           }
           //Connection à la base de donnée
           require_once("connect.php");
           $selection="SELECT * FROM Livres WHERE id=$id";
                //Preparation de la requette
            $lance=$connect->prepare($selection);
                //Execution de la requette
            $lance->execute();
            //Je recupere les infos du livres
            $info=$lance->fetch();
            //Je récupère les differents tags du livre
           $tags=explode("_",$info[2]);

           /**
            * Je lance une nouvelle requette pour determiner les livres ayant les memes tags que celui passé plus haut
            */
            //Je selectionne tous les elements de la base de donnée
           $selection="SELECT * FROM Livres WHERE id!=$id";
           $lance=$connect->prepare($selection);
           $lance->execute();

           $i=1; //Compteur
                           //Je vais recuperer chaque element du tableau de livre
           $info=$lance->fetchAll();
           
           $cpt=0;
           /**
            * Je voulais que la taille des images des livres dependent du nombre de livre affichés
            */
            $nb=0;
            while(($i<41)&&($nb<3)){
                $taggs=explode("_",$info[$i][2]);
                foreach($taggs as $val){
                    if(in_array($val,$tags)){
                        $nb++;
                        break;
                    }
                }
                $i++;
            }
            $i=0;
                while(($i<41)&&($cpt<3)){
                    $taggs=explode("_",$info[$i][2]);
                    foreach($taggs as $val){
                        if(in_array($val,$tags)){    
            ?>
            <div class="container px-4 px-lg-5 mt-5">
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <?php if($nb==3) {?>
                            <img class="card-img-top" style="height : 200px" src=<?php echo "Detail/".$info[$i][4] ?> alt="..." />
                            <?php } else { ?>
                                <img class="card-img-top" src=<?php echo "Detail/".$info[$i][4] ?> alt="..." />
                            <?php } ?>
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?php echo $info[$i][1];?></h5>
                                    <!-- Product price-->
                                    Free
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href=<?php echo "Livre.php?id=".$info[$i][0] ;?>>View Items</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                   $cpt++;
                   break; 
                }
            }
            $i=$i+1;
           }?>
    </div>
</section>