<?php 
session_start();

require('assets/src/connection.php');

$drapeau = 0;

if(!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['passwordConfirm'])) {
    
    // VARIABLES
    $pseudo         = htmlspecialchars($_POST['pseudo']);
    $email          = htmlspecialchars($_POST['email']);
    $password       = htmlspecialchars($_POST['password']);
    $pass_confirm   = htmlspecialchars($_POST['passwordConfirm']);

    // TEST SI PASSWORD = PASSWORD_CONFIRM
    if ($password  != $pass_confirm ) {
        header('location: ../projet_espace_membre/index.php?error=1&pass=1');
        exit();
    }

    // TEST SI EMAIL  VALIDE
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		header('location: ../projet_espace_membre/index.php?error=1&email=1');
        exit();
    }

    // TEST SI EMAIL UTILISE
    $req = $bdd->prepare("SELECT count(*) as numberEmail FROM users WHERE email = ?");
    $req->execute(array($email));

    while($email_verification = $req->fetch()){
        if($email_verification['numberEmail'] != 0) {
            header('location: index.php?error=1&email=1');
            exit();
         }
    }

    // HASH
    $secret = sha1($email).time();
    $secret = sha1($secret).time().time();

    // CRYPTAGE DU PASSWORD
    $password = "a3b".sha1($password."adm5l")."rr6c";

    // ENVOIE DE LA REQUETE
    $req = $bdd->prepare('INSERT INTO users(pseudo, email, password, secret) VALUE(?, ?, ?, ?)');
    $req->execute(array($pseudo, $email, $password, $secret));
    header('location: ../projet_espace_membre/index.php?success=1');
    $_SESSION['pseudo'] = $pseudo;
    exit();


}


?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="assets/css/main.css" rel="stylesheet" >
        <title>Un espace membre</title>
        <!-- <link rel="icon" href="assets/images/favico.png"> -->
    </head>
    <body class="body">
        <main>
        <?php 
            if(!isset($_SESSION['connect'])){ ?>
            <section class="section">
                <h1 class="title">Inscription</h1>
                <p>Bienvenue sur mon site, pour en voir plus, inscrivez-vous. Déjà inscrit ? <a class="lien" href="connection.php">connectez-vous.</a></p>

                <?php 
                    if (isset($_GET['error'])) {
                        if (isset($_GET['pass'])) {
                            echo '<p class="error">Les mots de passe ne sont pas identiques.</p>';
                        }
                        else if (isset($_GET['email'])) {
                            echo '<p class="error">Cette adresse email est déjà utilisé.</p>';
                        }
                    } else if (isset($_GET['success'])) {
                        echo '<p class="success">Votre inscription a bien été prise en compte., vous allez être redirigé dans 3 seconde.</p>';  
                        // header("Refresh:6; url=connection.php");

                        $_SESSION['connect'] = 1;
                        $_SESSION['id'] = $bdd->lastInsertId();
                        // $_SESSION['pseudo'] = $pseudo;
                        // header('Refresh:6; ../projet_espace_membre/connection.php?success=1');
                        header('Refresh: 3; url=../projet_espace_membre/connection.php?success=1');
                        exit();
                    }
                    
                ?>

                <form action="index.php" method="post">
                    <ul class="form__liste">
                        <li class="form__el input-group">
                            <input  type="text" name="pseudo" autocomplete="off" required="" class="input">
                            <label class="user-label">Pseudo</label>
                        </li>
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
                            <div class="div">
                                <input type="password" name="passwordConfirm" autocomplete="off" required="" class="input">
                                <label class="user-label">Confirmer mot de passe</label>
                                <div class="password-icon">
                                    <i data-feather="eye"></i>
                                    <i data-feather="eye-off"></i>
                                </div>
                            </div>
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
                                <span class="form__btn--span">Inscription</span>
                            </button>
                        </li>
                    </ul> 
                </form>
            </section>
        <?php    
            } else{ ?> 
            <section class="section">
                <h1 class="title">Bonjour</h1>
                <p>
                    Comment allez-vous ? <?= $_SESSION['pseudo'] ?> 
                </p>
                <a href="disconnection.php">Déconnexion</a>
            </section>
        <?php
            }
        ?>    
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