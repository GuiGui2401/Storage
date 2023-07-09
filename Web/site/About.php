<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>MyBook | About page</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/style_about.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#!"><img src="assets/img1.jpg" width="30px" alt=""></a>
            <a class="navbar-brand" href="index.php"><b>MyBook</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="About.html">About</a></li>
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
    <section>
        <section>
            <p><strong class="logo">My<strong class="log"> Book</strong></strong> est un site de librairie en ligne, il permet a ses visiteurs de télécharger des livres en lignes </p> 
            <p>Il est reservé au grand public pour le moment, mais nous prevoyons d'y inclure une option de connexion et d'achat de certains livres pour rendre le site un peu plus rémunérateurs pour ses développeurs</p>
            <p>Ce site est proteger par les droits du Copyright, toute copie ou contrefaçon illégale se verra sanctionnée</p>
                <h4 align="center"> Ce site web est un projet des etudiants</h4>
                <ul>
                    <li>Etoga Onana Basile Jeremie</li>
                    <li>Gaiga</li>
                    <li>Ekenglo</li>
                    <li>Faycal Mohamed</li>
                    <li>Gordobe Tchobsala</li>
                </ul>
                <em>Etudiants en premiere année (ITT1 A) à SUP'PTIC dit Ecole Nationale Superieure de Poste et Telecommunication (ENSPT)</em><br><br>
                <em id="tutelle">Sous la tutelle de  Mr <strong>Saddie Juvet</strong></em>
            </p>    
        </section>
        <?php include_once("presentation.php"); ?>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; MyBook 2023</p></div>
        </footer>
</body>