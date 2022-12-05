<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link href="assets/css/main.css" rel="stylesheet" >
</head>
<body>
    <?php include("assets/header.php"); ?>
    <main>
        
        <section class="section__form">
            <div class="form">
                <h2 class="test3 margin2">Nous contacter par email</h2>
                <form action="contact.php" method="post">
                    <ul class="form__liste">
                        <li class="form__el">
                            <label class="label" for="name">Nom</label>
                            <input class="input" type="text" is="name" name="user_name" autocomplete="off">
                        </li>
                        <li class="form__el">
                            <label class="label" for="firstName">Prénom</label>
                            <input class="input" type="text" is="firstName" name="user_firstName" autocomplete="off">
                        </li>
                        <li class="form__el">
                            <label class="label" for="email">E-mail</label>
                            <input class="input" type="email" is="email" name="user_email" autocomplete="off" placeholder="email@hotmail.be">
                        </li>
                        <li class="form__el">
                            <label class="label" for="sujet">Sujet</label>
                            <input class="input" type="text" is="sujet" name="user_sujet" autocomplete="off">
                        </li>
                        <li class="form__el">
                            <label class="label" for="msg">Message</label>
                            <textarea class="textarea" name="user_msg" id="msg" placeholder="Votre message..."></textarea>
                        </li>
                        <li class="form__el">
                            <button class="form__btn" type="submit" name="valider">Nous contacter</button>
                        </li>
                    </ul>
                </form>
            </div>
        </section>
        <?php 
            if(isset($_POST['user_name']) && isset($_POST['user_firstName'])) {
                
                $firstName = htmlspecialchars($_POST['user_firstName']);
                $name = htmlspecialchars($_POST['user_name']);

                echo 'Bonjour '.$name.' '.$firstName.' !';
            }
        ?> 
    </main>
    <?php include("assets/footer.php"); ?>
</body>
</html>