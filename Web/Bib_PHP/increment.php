<?php
if(isset($_POST['action']=='call_this')){
    //Cette fonction vas permettre d'incrementer le nombre de telechargement d'un livre
    require_once("connect.php"); 
        $requete="UPDATE Livres SET downloads=:inc WHERE id=:lid";
        $exec=$connect->prepare($requete);
        $req="SELECT * FROM Livres WHERE id=1";
        $ex=$connect->prepare($req);
        $ex=$connect->execute();
        $info=$ex->fetch();
        $nv=$info[5]++;
        echo $info[5];
        $exec->execute(array('inc'=>5,'lid'=>$info[0]));

}

?>