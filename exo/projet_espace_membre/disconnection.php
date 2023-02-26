<?php 
// INITIALISATTION LA SESSION
session_start();
// DESACTIVE LA SESSION
session_unset();
// DETRUIRE LA SESSION
session_destroy();
// DETRUIRE Le COOKIE
setcookie('log', '', time() - 3444, '/', null, false, true);
// REDIRECTION ACCUEIL NON CONNECTER
header('location: ../projet_espace_membre/index.php');
exit();
?>