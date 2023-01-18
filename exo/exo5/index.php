<?php 
// CONNEXION
try {
    //code...
    $bdd = new PDO('mysql:host=localhost;dbname=formation_users;charset=utf8', 'root', '');
} catch (Exception $e) {
    //throw $e;
    die('Erreur :'.$e->getMessage());
}

// AJOUTE UN NOUVEL UTILISATEUR
if (isset($_GET['prenom']) && isset($_GET['nom']) && isset($_GET['serie'])) {
    $prenom = $_GET['prenom'];
    $nom    = $_GET['nom'];
    $serie  = $_GET['serie'];

    $requete = $bdd->prepare('INSERT INTO users(prenom, nom, serie_preferee) VALUES(?, ?, ?)') or die(print_r($bdd->errorInfo()));
    $requete->execute(array($prenom, $nom, $serie));

    header('location:../');

}


// AFFICHER LES INFORMZTIONS
$requete = $bdd->query('SELECT id, prenom, nom, serie_preferee
                        FROM users'); 

                        
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
    <link href="assets/css/main.css" rel="stylesheet" >
    <title>Document</title>
</head>
<body>
    <main>
        <section class="section__form">
            <div class="form">
                <h1 class="test3 margin2">Ajouter un utilisateur</h1>
                <form action="index.php" method="get">
                    <ul class="form__liste">
                        <li class="form__el">
                            <label class="label" for="prenom">Prénom</label>
                            <input class="input" type="text" name="prenom">
                        </li>
                        <li class="form__el">
                            <label class="label" for="nom">Nom</label>
                            <input class="input" type="text" name="nom">
                        </li>
                        <li class="form__el">
                            <label class="label" for="serie">Série preferée</label>
                            <input class="input" type="text" name="serie">
                        </li>
                        <li class="form__el">
                            <button class="form__btn" type="submit" name="ajouter">Ajouter</button>
                        </li>
                    </ul> 
                </form>
            </div> 
        </section>
    </main>
    
</body>
</html>