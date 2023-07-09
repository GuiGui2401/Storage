<!--Tous les textes de cette page seron pris de la base de donnée-->
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

<section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src=<?php echo "Detail/"."$info[4]" ?> alt="..." /></div>
                    <div class="col-md-6">
                        <div class="small mb-1">SKU: BST-498</div>
                        <h1 class="display-5 fw-bolder"><?php echo $info[1] //Ce texte sera modifiable par le php?></h1>
                        <div class="fs-5 mb-5">
                            <span class="text-decoration-line-through">For Sale</span>
                            <span>Free Version</span>
                        </div>
                        <?php
                        ?>
                        <p class="lead"> <?php echo $info[3]?>.</p>
                        <div class="d-flex">
                              <button class="btn btn-outline-dark flex-shrink-0" type="button">
                                <i class="bi-download"></i>
                              <a target="_blank" href=<?php echo "download.php?id=".$info[0] /*Le lien pour telecharger le livre varie*/?>>Download</a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        