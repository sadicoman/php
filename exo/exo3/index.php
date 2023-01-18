<?php 
// CONNEXION
try {
    //code...
    $bdd = new PDO('mysql:host=localhost;dbname=formation_users;charset=utf8', 'root', '');
} catch (Exception $e) {
    //throw $e;
    die('Erreur :'.$e->getMessage());
}

// JOINTURE INTERNE
// WHERE : moins en moins choisi, moins clair
// JOIN : plus en plus choisi et plus clair

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

// Ajouter un METIER
// $requete = $bdd->exec('INSERT INTO jobs(id_user,metier) VALUES(1, "Ecrivain")');
// $requete = $bdd->exec('INSERT INTO jobs(id_user,metier) VALUES(2, "Danseuse")');
// $requete = $bdd->exec('INSERT INTO jobs(id_user,metier) VALUES(3, "Programmeur")');
// $requete = $bdd->exec('INSERT INTO jobs(id_user,metier) VALUES(4, "PDG")');




// LIRE DES INFORMATIONS

// $requete = $bdd->query('SELECT * 
//                         FROM users
                        /*n affiche que Alian*/
                        /*WHERE prenom = "Alain"*/ 
                        /*Trie par ordre du nouveau a l ancien*/
                        /*ORDER BY id DESC */
                        /*n affiche que de X a X*/
                        /*LIMIT 0, 1*//*');*/
//Crypté mes donnés
// .sha1($donnees['metier'])
// .md5($donnees['metier']) // moin puissant (trop utilisé)

// JOINTURE INTERNE
// WHERE : moins en moins choisi, moins clair
// $requete = $bdd->query('SELECT id_user, prenom, nom, serie_preferee, metier
//                         FROM users, jobs
//                         WHERE users.id = jobs.id_user'); 

// JOINTURE INTERNE
// JOIN : plus en plus choisi et plus clair
$requete = $bdd->query('SELECT id_user, prenom, nom, serie_preferee, metier
                        FROM users
                        INNER JOIN jobs
                        ON users.id = jobs.id_user'); 



// $prenom = "Alain";
// $nom = "Stendhal";
// $prenom = '" OR 1=1#'; // Pour tout récupéré d'une base de données
// $prenom = htmlspecialchars($prenom); // pour sécuriser 1er façon



// JOINTURE EXTERNE
// LEFT ou RIGHT
// $requete = $bdd->query('SELECT id_user, prenom, nom, serie_preferee, metier
//                         FROM users
//                         LEFT JOIN jobs
//                         ON users.id = jobs.id_user
//                         WHERE prenom = "'.$prenom.'"'); 

// Sécuriser 2e façon renplacer query par prepare
// $requete = $bdd->prepare('SELECT id_user, prenom, nom, serie_preferee, metier
//                         FROM users
//                         LEFT JOIN jobs
//                         ON users.id = jobs.id_user
//                         WHERE prenom = ? && nom = ?'); 

// $requete->execute(array($prenom, $nom));


                        
echo '<table border>
			<tr>
				<th>Id</th>
				<th>Prenom</th>
				<th>Nom</th>
                <th>Series préferée</th>
                <th>Métier</th>
			</tr>';

while ($donnees = $requete->fetch()) {
    // echo $donnees['prenom'];
    echo'<tr>
    <td>'.$donnees['id_user'].'</td>
    <td>'.$donnees['prenom'].'</td>
    <td>'.$donnees['nom'].'</td>
    <td>'.$donnees['serie_preferee'].'</td>
    <td>'.sha1($donnees['metier']).'584f</td>
 </tr>';

// MOT DE PASSE CRYPTE
// GRAIN (584f)
// Mot de passe crypte + grain



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