<?php 

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

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- CSS -->
        <link href="assets/css/main.css" rel="stylesheet" >
        <!-- Javascript -->
        <script src="assets/js/main.js" defer></script>

        <title>Librairies api film</title>
        <!-- <link rel="icon" href="assets/images/favico.png"> -->
    </head>
    <body class="body">
        <main>
            <section class="section">
                <h2 class="title">Incontournables</h2>
                <ul class='movie-list'>
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
                            <li class='movie'>
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
            </section>
            
        </main>
    </body>
</html>