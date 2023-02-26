<?php 
    if (!empty($_POST['pseudo'])) { //voir si le champ est rempli
        $pseudo = $_POST['pseudo'];
        setcookie('pseudo', $pseudo, time() + 365*24*3600, null, null, false, true); // le 4e parametre active le http onli et faut garder les 3 autre parametres comment ça
    }

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
                <h1 class="test3 margin2">Entrez votre pseudo</h1>
                <form action="index.php" method="post">
                    <ul class="form__liste">
                        <li class="form__el">
                            <label class="label" for="pseudo">Pseudo</label>
                            <input class="input" type="text" name="pseudo">
                        </li>
                        <li class="form__el">
                            <button class="form__btn" type="submit" name="ajouter">Se connecter</button>
                        </li>
                    </ul> 
                </form>
                <?php 
                    if (!empty($_COOKIE['pseudo'])) { 
                        echo '<h2>Bienvenue '. htmlspecialchars($_COOKIE['pseudo']) . '</h2>';
                    }
                ?>
            </div> 
        </section>
    </main>
    
</body>
</html>