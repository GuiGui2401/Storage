
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="#!"><img src="assets/img1.jpg" width="30px" alt=""></a>
        <a class="navbar-brand" href="#!"><b>MyBook</b></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="About.php">About</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Browse</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="all_items.php">All Items</a></li>
                        <li><a class="dropdown-item" href="popular-items.php">Popular Items</a></li>
                        <li><a class="dropdown-item" href="new.php">New Arrivals</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- Header-->
<header class="bg-dark py-5" style="margin-bottom : 100px;">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">MyBook</h1>
            <p class="lead fw-normal text-white-50 mb-0">Build your future here.</p>
        </div>
    </div>

    <!--Modificatuion pour le menu defilant-->
    
    <div class="slider" >
        <div class="slides">
            <?php
            require_once("connect.php");
              $req="SELECT * FROM Livres";
              $exec=$connect->prepare($req);
              $exec->execute();
              $reslt=$exec->fetchAll();
              $hasard=array_rand($reslt,6);
              $i=0;
              for($i=0; $i<5; $i++){
            ?>
            <div class="slide">
                <div class="info">
                    <h3 align=center style="margin-top : 20px; color : white;"><strong><?php echo $reslt[$hasard[$i]][1] ;?></strong></h3>
                    <p style="margin-top: 60px; margin-left : 10px;" class="lead fw-normal text-white-50 mb-0"><?php echo $reslt[$hasard[$i]][3] ;?></p>
                </div>
                <img class="image" src=<?php echo "Detail/".$reslt[$hasard[$i]][4]; ?> alt="...">
                <div>
                    <div style="margin-top: 100px; margin-left: 50px; margin-right: 50px;" class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center" style=" background-color : white; border-radius: 5px;"><a  class="btn btn-outline-dark mt-auto" href=<?php echo "Livre.php?id=".$reslt[$hasard[$i]][0] ;?>>View Items</a></div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</header>