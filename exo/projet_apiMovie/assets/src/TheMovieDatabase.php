<?php
// Clé API TMDb
$api_key = "0339ad9655ab9b314b8b31be137ba2a5";

// Connexion à la base de données
$bdd = new PDO('mysql:host=localhost;dbname=netflix;charset=utf8', 'root', '');

// Récupération des noms de films choisis dans la base de données
$query = $bdd->query("SELECT * FROM movies");
$movies = $query->fetchAll();

// Boucle sur les films choisis
foreach ($movies as $movie) {
    // URL de l'API TMDb pour récupérer les détails du film
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
            "Postman-Token: your_postman_token_here",
            "User-Agent: PostmanRuntime/7.26.5",
            "cache-control: no-cache"
        ),
    ));

    // Exécution de cURL
    $response = curl_exec($curl);
    $err = curl_error($curl);

    // Fermeture de cURL
    curl_close($curl);

    // Récupération des détails du film
    $poster_path = "https://image.tmdb.org/t/p/w500" . $movie['poster_path'];
    $title = $movie['title'];
    $overview = $movie['overview'];



    // Affichage des détails du film
    echo "<img src='" . $poster_path . "' alt='" . $movie['title'] . "'>";
    echo "<h3>" . $movie['title'] . "</h3>";
    echo "<p>" . $movie['overview'] . "</p>";

}


?>