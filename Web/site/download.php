<title>My Book | Thanks</title>
<?php 
//Ce fichier a été concu pour compter le nombre de fois qu'*un livre a été télécharger dans le site
// --> Je lance le telechargement due la page
if(isset($_GET['id'])){
    require_once("connect.php");
    $id=$_GET['id'];
    $req="SELECT * FROM Livres WHERE id=$id";
    $exe=$connect->prepare($req);
    $exe->execute();
    $reslt=$exe->fetch();

$var="Detail/Livre/"."$reslt[4].rar";
$download=(int)$reslt[5];
$download++;
echo "<p><i class=\"merci\">Votre Livre est entrain de telecharger... merci d'avoir utiliser notre site</i></p>";
// Je met ensuite a jour les infos
$req1="UPDATE Livres SET downloads=$download WHERE id=$id";

$exec=$connect->prepare($req1);
$exec->execute();
print("<script type='text/javascript'> window.location.href='$var'; window.location.target='_blank'</script>");

}
else{
    Echo "Cette page n'est pas independante, elle ne peut affixher que les informations qu'elle recois des autres pages du site";
}
?>