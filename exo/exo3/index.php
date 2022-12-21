<?php 
// CONNEXION
try {
    //code...
    $bdd = new PDO('mysql:host=localhost;dbname=formation_users;charset=utf8', 'root', '');
} catch (Exception $e) {
    //throw $e;
    die('Erreur :'.$e->getMessage());
}

// Ajouter un utilisateur
// $requete = $bdd->exec('INSERT INTO users(prenom, nom, serie_preferee) VALUES("Mark", "Zuckerberg", "Koh-Lanta")');

// Modifier des données d'un utilisateur
// $requete = $bdd->exec('UPDATE users SET serie_preferee = "Les feux de l amour" WHERE prenom="Mark"');

// Suprimer une données de la base de données
// $requete = $bdd->exec('DELETE FROM users WHERE prenom="Mark"');

// AFFICHER ERREUR // Ne fonctionne pas ?
// $requete = $bdd->exec('INSERT INTO users(prenom, nom, serie_preferee) 
//                        VALUES("Mark", "Zuckerberg")') 
//                        or die(print_r($bdd->errorInfo()));



// LIRE DES INFORMATIONS

$requete = $bdd->query('SELECT * 
                        FROM users
                        /*n affiche que Alian*/
                        /*WHERE prenom = "Alain"*/ 
                        /*Trie par ordre du nouveau a l ancien*/
                        /*ORDER BY id DESC */
                        /*n affiche que de X a X*/
                        /*LIMIT 0, 1*/'); 

echo '<table border>
			<tr>
				<th>Id</th>
				<th>Prenom</th>
				<th>Nom</th>
                <th>Series préferée</th>
			</tr>';

while ($donnees = $requete->fetch()) {
    // echo $donnees['prenom'];
    echo'<tr>
    <td>'.$donnees['id'].'</td>
    <td>'.$donnees['prenom'].'</td>
    <td>'.$donnees['nom'].'</td>
    <td>'.$donnees['serie_preferee'].'</td>
 </tr>';
}
$requete->closeCursor();
echo '</table>';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>