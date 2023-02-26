<?php 
session_start();

if(isset($_SESSION['connect'])){
    header('location: ../projet_espace_membre/index.php');
    exit();
}


require('assets/src/connection.php');

if(!empty($_POST['email']) && !empty($_POST['password'])){

    // VARIABLES
    $email          = htmlspecialchars($_POST['email']);
    $password       = htmlspecialchars($_POST['password']);
    $error          = 1; 

    // CRYPTAGE DU PASSWORD
    $password = "a3b".sha1($password."adm5l")."rr6c";

    $req = $bdd->prepare('SELECT * FROM users WHERE email = ?');
    $req->execute(array($email));

    while ($user = $req->fetch()){
        if ($password == $user['password']){
            $error = 0;

            // SESSION
            $_SESSION['connect'] = 1;
            $_SESSION['pseudo'] = $user['pseudo'];

            // Si la case connection auto est cocher
            if(isset($_POST['connect'])){
                setcookie('log', $user['secret'], time() + 365*24*3600, '/', null, false, true);
            }

            // REDIRECTION
            header('location: ../projet_espace_membre/connection.php?success=1');
            exit();
        }
    }
    if ($error == 1) {
        header('location: ../projet_espace_membre/connection.php?error=1');
        exit();
    }
}








?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="assets/css/main.css" rel="stylesheet" >
        <title>Connection</title>
        <!-- <link rel="icon" href="assets/images/favico.png"> -->
    </head>
    <body class="body">
    <main>
        <section class="section">
            <h1 class="title">Connexion</h1>
            <p>Bienvenue sur mon site, si vous n'êtes pas inscrit, <a class="lien" href="index.php">créez un compte.</a></p>

            <?php 
            if (isset($_GET['error'])) {
                echo '<p class="error">Nous ne pouvons pas vous authentifier.</p>';
            } else if (isset($_GET['success'])) {
                echo '<p class="success">Vous êtes maintenant connecté.</p>';
            }
            ?>

            <form class="form" action="connection.php" method="post">
                <ul class="form__liste">
                    <li class="form__el input-group">
                        <input  type="email" name="email" autocomplete="off" required="" class="input">
                        <label class="user-label">Email</label>
                    </li>
                    <li class="form__el input-group">
                        <div class="div">
                            <input id="password" type="password" name="password" autocomplete="off" required="" class="input">
                            <label class="user-label">Mot de passe</label>
                            <div class="password-icon">
                                <i data-feather="eye"></i>
                                <i data-feather="eye-off"></i>
                            </div>
                        </div>
                    </li>
                    <li class="form__el input-group">
                        <p>
                            <label>
                                <input type="checkbox" name="connect">
                                Connexion automatique  
                            </label>
                        </p>
                    </li>
                    <li class="form__el">
                        <button class="form__btn" type="submit" name="envoyer">
                            <div class="svg-wrapper-1">
                                <div class="svg-wrapper">
                                <svg class="form__btn--svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                    <path fill="none" d="M0 0h24v24H0z"></path>
                                    <path fill="currentColor" d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z"></path>
                                </svg>
                                </div>
                            </div>
                            <span class="form__btn--span">Connection</span>
                        </button>
                    </li>
                </ul> 
            </form>
        </section>
    </main>
    </body>
        <!-- ICON SCRIPT -->
        <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace();
    </script>
    <script>
        const eyes = document.querySelectorAll(".feather-eye");
        const eyeOffs = document.querySelectorAll(".feather-eye-off");
        const passwordFields = document.querySelectorAll("input[type=password]");

        eyes.forEach((eye, index) => {
            eye.addEventListener("click", () => {
                eye.style.display = "none";
                eyeOffs[index].style.display = "block";
                passwordFields[index].type = "text";
            });
        });

        eyeOffs.forEach((eyeOff, index) => {
            eyeOff.addEventListener("click", () => {
                eyeOff.style.display = "none";
                eyes[index].style.display = "block";
                passwordFields[index].type = "password";
            });
        });
    </script>
</html>