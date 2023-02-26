<?php 
// IS received Shortcut
if (isset($_GET['q'])){

    // VARIABLE
    $shortcut = htmlspecialchars($_GET['q']);

    // IS A Shortcut ?
    $bdd = new PDO('mysql:host=localhost;dbname=bitly;charset=utf8', 'root', '');
    $req = $bdd->prepare('SELECT COUNT(*) AS x FROM links WHERE shortcut = ?');
    $req->execute(array($shortcut));

    while ($result = $req->fetch()) {
        if ($result['x'] != 1) {
            header('location: /php/exo/projet_bit-ly/?error=true&message=Adresse url non connue');
            exit();
        }
    }

    // REDICRECTION
    $req = $bdd->prepare('SELECT * FROM links WHERE shortcut = ?');
    $req->execute(array($shortcut));

    while ($result = $req->fetch()) {

        header('location: /php/exo/projet_bit-ly/index.php'.$result['url']);
        exit();

    }

}



// IS SENDING A FORM
if (isset($_POST['url'])) {
    // variable
    $url = $_POST['url'];
    // verification
    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        header('location: /php/exo/projet_bit-ly/?error=true&message=Adresse url non valide');
        exit();
    }
    // shortcut
        $shortcut = crypt($url, rand());
    // has been already send ? adresse deja rentré
        $bdd = new PDO('mysql:host=localhost;dbname=bitly;charset=utf8', 'root', '');
        $req = $bdd->prepare('SELECT COUNT(*) AS x FROM links WHERE url = ?');
        $req->execute(array($url));

        while ($result = $req->fetch()) {
            if ($result['x'] != 0) {
                header('location: /php/exo/projet_bit-ly/?error=true&message=Adresse déjà raccourcie');
                exit();
            }
        }
    // sending
    $req = $bdd->prepare('INSERT INTO links(url, shortcut) VALUE(?, ?)');
    $req->execute(array($url, $shortcut));
    header('location: /php/exo/projet_bit-ly/?short='.$shortcut);
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="assets/css/main.css" rel="stylesheet" >
        <title>Raccourcisseur d'url express</title>
        <link rel="icon" href="assets/images/favico.png">
    </head>
    <body class="body">
        <main>
            <div class=" hello">
                <section class="section ">
                    <img class="logo" src="assets/images/logo.png" alt="logo bitly blanc">
                    <h1 class="title">Une url Longue ? Raccourcissez-là ?</h1>
                    <p class="txt--white">Largement meilleur et plus court que les autres.</p>
                    <form action="index.php" method="post">
                        <ul class="form__liste">
                            <li class="form__el">
                                <input class="input" type="url" name="url" placeholder="Collez un lien à raccourcir">
                            </li>
                            <li class="form__el">
                                <button class="form__btn" type="submit" name="raccourcir">Raccourcir</button>
                            </li>
                        </ul> 
                    </form>

                    <?php 
                        if (isset($_GET['error']) && isset($_GET['message'])){
                    ?>   
                        <div class="center">
                            <div class="result">
                                <b><?php echo htmlspecialchars($_GET['message']); ?></b>
                            </div>
                        </div>     
                    <?php } else if (isset($_GET['short'])) {
                    ?> 
                        <div class="center">
                            <div class="result">
                                <b>URL RACCOURCIE :</b> http://localhost/?q=<?php echo htmlspecialchars($_GET['short']); ?>
                            </div>
                        </div>
                    <?php } ?>
                    
                    
                    

                </section>
            </div>
            <div class="section--marques">
                <section class="section">
                    <h2 class="title title--niveau2">Ces marques nous font confiance</h2>
                    <ul class="section__liste">
                        <li class="liste__el">
                            <img class="liste__img" src="assets/images/1.png" alt="Images sponsor">
                        </li>
                        <li class="liste__el">
                            <img class="liste__img" src="assets/images/2.png" alt="Images sponsor">
                        </li>
                        <li class="liste__el">
                            <img class="liste__img" src="assets/images/3.png" alt="Images sponsor">
                        </li>
                        <li class="liste__el">
                            <img class="liste__img" src="assets/images/4.png" alt="Images sponsor">
                        </li>
                    </ul>
                </section>
            </div>
        </main>
        <footer class="footer">
            <ul class="footer__liste">
                <li class="footer__el">
                    <img class="footer__img" src="assets/images/logo2.png" alt="logo bitly orange">
                </li>
                <li class="footer__el">
                    <p>Bitly © 2023</p>
                </li>
            </ul>
        </footer>
    </body>
</html>