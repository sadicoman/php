<?php 
$code = "0PABK0ABM4R";
$alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$codes = array();

// Fonction pour générer les combinaisons de lettres
function generateCodes($code, $alphabet, $index, &$codes) {
    if ($index == strlen($code)) {
        array_push($codes, $code);
        return;
    }
    if ($code[$index] != '0') {
        generateCodes($code, $alphabet, $index + 1, $codes);
    } else {
        for ($i = 0; $i < strlen($alphabet); $i++) {
            $code[$index] = $alphabet[$i];
            generateCodes($code, $alphabet, $index + 1, $codes);
        }
    }
}

generateCodes($code, $alphabet, 0, $codes);

// Afficher toutes les combinaisons
foreach ($codes as $c) {
    echo $c . "<br>";
}
?>