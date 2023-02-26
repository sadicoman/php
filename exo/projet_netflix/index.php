<?php 

session_start();

require('src/log.php');

// Clé API TMDb
// $api_key = "0339ad9655ab9b314b8b31be137ba2a5";
$api_key = "0339ad9655ab9b314b8b31be137ba2a5";

// Connexion à la base de données
$bdd = new PDO('mysql:host=localhost;dbname=netflix;charset=utf8', 'root', '');

// Requête pour récupérer les films sélectionnés par l'utilisateur
$query = "SELECT title FROM movies";
$stmt = $bdd->prepare($query);
$stmt->execute();
$selected_movies = $stmt->fetchAll();


if(!empty($_POST['email']) && !empty($_POST['password'])){
	
	require('src/connect.php');

	// VARIABLES
	$email = htmlspecialchars($_POST['email']);
	$password = htmlspecialchars($_POST['password']);
		
	// TEST SI EMAIL  VALIDE
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		header('location:../projet_netflix/index.php?error=1&message=Invalid email');
		exit();
	}
	
	// TEST SI EMAIL UTILISE
    $req = $bdd->prepare("SELECT count(*) as numberEmail FROM user WHERE email = ?");
    $req->execute(array($email));

    while($email_verification = $req->fetch()){
        if($email_verification['numberEmail'] != 1) {
            header('location: ../projet_netflix/index.php?error=1&message=Unable to authenticate correctly.');
            exit();
         }
    }

    // CRYPTAGE DU PASSWORD
    $password = "a3b".sha1($password."adm5l")."rr6c";

	// CONNEXION
	$req = $bdd->prepare("SELECT * FROM user WHERE email = ?");
	$req->execute(array($email));

	while($user = $req->fetch()){
		if($password == $user['password']){

			$_SESSION['connect'] = 1;
			$_SESSION['email'] = $user['email'];

			if(isset($_POST['auto'])){
				setcookie('auth', $user['secret'], time() + 364*24*3600, '/', null, false, true);
			}

			header('location: ../projet_netflix/index.php?success=1');
			exit();

		}
		else {

			header('location: index.php?error=1&Impossible de vous authentifier correctement.');
			exit();

		}
		
	}

}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Netflix</title>
	<link rel="stylesheet" type="text/css" href="design/default.css">
	<!-- Javascript -->
	<script src="design/main.js" defer></script>

	<link rel="icon" type="image/pngn" href="img/favicon.png">


	



</head>
<body>

	<?php include('src/header.php'); ?>
	
	<section>
		<div id="login-body">
		<?php if(isset($_SESSION['connect'])) { ?>

			<h1>Bonjour !</h1>
			<?php
			if(isset($_GET['success'])){
				echo'<div class="alert success">Vous êtes maintenant connecté.</div>';
			} ?>
			<p>Qu'allez-vous regarder aujourd'hui ?</p>
			<section class="section">
                <h2 class="title">Incontournables</h2>
                <ul class='movie-list slider-container'>
                <?php 
                    // Boucle sur les films sélectionnés pour afficher les détails
                    foreach ($selected_movies as $movie) {
                    // URL de l'API TMDb pour récupérer les détails d'un film
                    $url = "https://api.themoviedb.org/3/search/movie?api_key=" . $api_key . "&language=fr&query=" . urlencode($movie['title']);
                    
                    // Le reste du code cURL
                    // Initialisation de cURL
                    $curl = curl_init();

                    // Configuration de cURL
                    curl_setopt_array($curl, array(
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_POSTFIELDS => "",
                    CURLOPT_HTTPHEADER => array(
                        "Accept: */*",
                        "Accept-Encoding: gzip, deflate",
                        "Cache-Control: no-cache",
                        "Connection: keep-alive",
                        "Host: api.themoviedb.org",
                        "User-Agent: PostmanRuntime/7.26.5",
                        "cache-control: no-cache"
                    ),
                    ));

                    // Exécution de cURL
                    $response = curl_exec($curl);
                    $err = curl_error($curl);

                    // Fermeture de cURL
                    curl_close($curl);

                    // Vérification de l'erreur
                    if ($err) {
                        echo "cURL Error #:" . $err;
                    } else {
                        // Décodage de la réponse JSON
                        $data = json_decode($response, true);

                    // Boucle sur les films trouvés pour afficher les détails
                        foreach ($data['results'] as $movie) {
                        // Récupération des détails du film
                        $poster_path = "https://image.tmdb.org/t/p/w500" . $movie['poster_path'];
                        $title = $movie['title'];
                        $overview = $movie['overview'];
                        $release_date = $movie['release_date'];
                        }
                        // Affichage des détails du film
                        // echo "<div class='movie'>";
                        // echo "<img src='$poster_path' alt='Poster de $title'>";
                        // echo "<h2>$title</h2>";
                        // echo "<p><strong>Date de sortie :</strong> $release_date</p>";
                        // echo "<p><strong>Résumé :</strong> $overview</p>";
                        // echo "</div>";

                        echo "
                            <li class='movie '>
                                <img class='movie__img' src='$poster_path' alt='Poster de $title'>
                                <div class='movie-details'>
                                    <div class='movie-details__img'>
                                        <img src='$poster_path' alt='Poster de $title'>
                                    </div>    
                                    <div class='movie-details__text'>
                                        <h3 class='title--niveau3'>$title</h4>
                                        <p class='text--date'><strong>Date de sortie :</strong> $release_date</p>
                                        <p class='text'>$overview</p>
                                    </div>
                                </div>
                            </li>";
                        }
                        }
                    ?>
                </ul>  
				<div class="btn">	
					<button class="btn--icone" id="prev-btn"><</button>
    				<button class="btn--icone" id="next-btn">></button> 
				</div>	

            </section>
			<small><a href="logout.php">Déconnexion</a></small>

			<?php } else { ?>

				<h1>S'identifier</h1>

				<?php 
				if(isset($_GET['error'])) {
					if(isset($_GET['message'])) {
						echo '<div class="alert error">'.htmlspecialchars($_GET['message']).'</div>';
					}
				} ?>
				<form method="post" action="index.php">
					<input type="email" name="email" placeholder="Votre adresse email" required />
					<input type="password" name="password" placeholder="Mot de passe" required />
					<button type="submit">S'identifier</button>
					<label id="option"><input type="checkbox" name="auto" checked />Se souvenir de moi</label>
				</form>
			

				<p class="grey">Première visite sur Netflix ? <a href="../projet_netflix/inscription.php">Inscrivez-vous</a>.</p>
				<?php } ?>
		</div>
	</section>

	<?php include('src/footer.php'); ?>
</body>
</html>