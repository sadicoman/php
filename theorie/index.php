<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP</title>
</head>
<body>
    <?php

    // Je suis un commentaire uni-ligne
    /* Je suis un commentaire multiligne */

        // echo "Hello World";

        // VARIABLES
        $age_du_lyceen = 18; // ENTIER (INT)
        $age_du_lyceen = 18.5; // FLOAT
        $age_du_lyceen = "18.5"; // STRING
        $age_du_lyceen = "\"18.5\""; // STRING
        $age_du_lyceen = '"18.5"'; // STRING

        $est_majeur = true; // BOOL

        // CONVENTION INTERNATIONALE
        $ageDuLyceen = 18;

        // CONCATENATION DE VARIABLES
        $direBonjour = "Hello";
        $destination = "World";


        // echo $direBonjour . ' ' . $destination . ' comment allez-vous ?';


        // TABLEAU
        // $identite = array
        // (
        //     'id' => 1,
        //     'prenom' => 'Nicolas', 
        //     'nom' => 'Dupont', 
        //     'age' => 20  
        // );
        // TABLEAU index auto [ 0, 1 , 2, 3, ...]
        // $identiteA = array
        // (
        //     2,
        //     'François', 
        //     'Szczepkowski', 
        //     23  
        // );

        // echo 'Bonjour ' . $identite['prenom'] . ' ' . $identite['nom'] . ' !';
        // echo "<br>";
        // echo 'Bonjour ' . $identiteA[1] . ' '  . $identiteA[2] . ' !';

        // $reponseAge = $identite['age'] + 50;


        // echo 'Bonjour ' . $identite['prenom'] . ' ' . $identite['nom'] . ' !' . ' Dans 50 ans vous aurez ' . $reponseAge . ' ans.';


        // CONDIOTIONS : IF
        // $age = 18;

        // if ($age > 18) {
        //     echo "Vous êtes majeur !";
        // } 
        // elseif ($age == 18) {
        //     echo "Vous êtes enfin majeur !";
        // }
        // else {
        //     echo "Vous êtes mineur !";
        // }

        // CONDIOTIONS TERNAIRES
        // $number = 10;
        // echo ($number % 10 == 0) ? 'true' : 'false';

        // EXO : MDP ET PSD
        // $speudo = "Arnold";
        // $mdp = "Lune";

        // if ($speudo == "Tintin" && $mdp == "Lune") {
        //     echo "Mot de passe valide.";
        // } else {
        //     echo "Mot de passe invalide.";
        // }



        // CONDIOTIONS : SWITCH
        // $note = 20;

        // switch ($note) {
        //     case '0':
        //         echo 'Vous êtes vraiment nul.';
        //         break;
        //     case '1':
        //         echo 'Vous êtes (vraiment) nul.';
        //         break;
        //     default:
        //     echo 'Vous êtes magnifiquement nul.';
        //         break;
        // }



        // CONDIOTIONS : SIMPLE
        // $number = 10;
        // if ($number == 10) 
        //     echo "true";
        // else 
        //     echo "false";




        // BOUCLES : WHILE
        // $ligne = 0;

        // while ($ligne < 10) {
        //     echo "Voici le numéro de la ligne : " . ($ligne+1) . "<br>";
        //     $ligne++;
        // }
        

        // BOUCLES : FOR
        // for ($ligne=0; $ligne < 10 ; $ligne++) { 
        //     echo "Voici le numéro de la ligne : " . ($ligne+1) . "<br>";  
        // }


        // TABLEAUX : BOUCLE / FOREACH 
        // $identiteA = array
        // (
        //     'Nicolas',
        //     'François', 
        //     'George', 
        //     'Marc' ,
        //     'Emmanuel',
        //     'Stendhal'
        // );

        // foreach ($identiteA as $value) {
        //     echo $value . '<br>';
        // }
        
        // foreach ($identiteA as $key => $value) {
        //     echo $value . '<br>';
        // }

        // EXO tableau avec nom des clés
        // $nicolas = array
        // (
        //     'prenom' => 'Nicolas', 
        //     'nom' => 'Dupont', 
        //     'age' => 20  
        // );

        // foreach ($nicolas as $value) {
        //     echo $value . '<br>';
        // }



        // BOUCLES : DO - WHILE
        // $x = 0;
        // do {
        //     echo 'Le nombre est égal : ' . $x . '<br>';
        //     $x++;
        // } while ($x <= 10);
        

        
        // BOUCLES - IMBRIQUEES

        // for ($i=1; $i <= 10; $i++) { 
        //     for ($j=1; $j <= 10; $j++) { 
        //         echo $i*$j.' ';
        //     }
        //     echo '<br>';
        // }
        
        // EXO Tableaux de multiplicite 
        // echo '<table border style="border-collapse: collapse;">
		// <tr>
		// 	<th></th>
		// 	<th>1</th>
		// 	<th>2</th>
		// 	<th>3</th>
		// 	<th>4</th>
		// 	<th>5</th>
		// 	<th>6</th>
		// 	<th>7</th>
		// 	<th>8</th>
		// 	<th>9</th>
		// 	<th>10</th>
		// </tr>';
        // for($i = 1; $i <= 10; $i++){
        //     echo '<tr><th>'.$i.'</th>';
        
        //         for($j = 1; $j <= 10; $j++)
        //         {
        //             echo '<td>'.$i*$j.'</td>';
        //         }
        
        //     echo '</tr>';
        // }




        // EXO Tableaux de Nombre, carré, racine 
        // echo '<table border style="border-collapse: collapse;">
        //     <tr>
        //         <th>Nombre</th>
        //         <th>Carré</th>
        //         <th>Racine</th>
        //     </tr>';
        // for ($i=1; $i < 10; $i++) { 
        //     echo '<tr>';
        //     echo '<th>' . $i . '</th>' . '<th>' . ($i*$i) . '</th>' . '<th>' . sqrt($i) . '</th>';
        //     echo'</tr>';
        // }
        // echo '</table>'; 





        // FONCTION
        // function Hello($prenom) {
        //     echo 'Hello ' . $prenom . ' ! <br>';
        // }

        // Hello("Sadico");
        // Hello("Fakirano");

        
        // FONCTION 2
        // function Formule($x, $y){
        //     $temp = $x * $y;
        //     $temp /= 5;
        //     $temp = $x + $temp - ($x + $y);
        //     return $temp;
        // }

        // $resultat = Formule(52, 74);

        // echo $resultat






        
    ?>
</body>
</html>