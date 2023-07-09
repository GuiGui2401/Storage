<?php
// Générer une valeur aléatoire entre 0 et 1
$data = rand(0, 100) / 100;

// Envoyer la valeur en tant que réponse HTTP
echo $data;
?>
