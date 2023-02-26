<?php 
$code = "0PABK0ABM4R";
$alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

for ($i = 0; $i < strlen($alphabet); $i++) {
    for ($j = 0; $j < strlen($alphabet); $j++) {
        $new_code = substr_replace($code, $alphabet[$i], 4, 1);
        $new_code = substr_replace($new_code, $alphabet[$j], 9, 1);
        echo $new_code . "<br>";
    }
}

?>