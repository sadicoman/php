<?php 

$pseudo = (!empty($_GET['pseudo'])) ? $_GET['pseudo'] : 'Unknow user';

echo "Hello ".$pseudo;
?>

