<?php 
    //ENVOI DE FICHIERS PHP
    if(isset($_FILES['image']) && $_FILES['image']['error'] ==0){  //l'image existe et a été stockée temporairement sur le serveur

        // VARIABLES
        $error = 1;

        if ($_FILES['image']['size']<= 3000000){ //l'image fait moins de 3MO

            $informationsImage = pathinfo($_FILES['image']['name']);
            $extensionImage = $informationsImage['extension'];
            $extensionsArray = array('png', 'gif', 'jpg', 'jpeg'); //extensions qu'on autorise

            if(in_array($extensionImage, $extensionsArray)){  // le type de l'image correspond à ce que l'on attend, on peut alors l'envoyer sur notre serveur

                $adress ='assets/uploads/'.time().rand().rand().'.'.$extensionImage;

                // move_uploaded_file($_FILES['image']['tmp_name'], 'assets/uploads/'.time().basename($_FILES['image']['name'])); // on renomme notre image avec une clé unique suivie du nom du fichier
                // move_uploaded_file($_FILES['image']['tmp_name'], 'assets/uploads/'.time().rand().rand()); // on renomme notre image avec une clé unique 
                move_uploaded_file($_FILES['image']['tmp_name'], $adress); 

                $error = 0;

                echo 'Envoi bien réussi !' ;

            }
        }
    }         
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hébergeur d'images</title>
    <link href="assets/css/main.css" rel="stylesheet" >
</head>
<body>
    <?php include("assets/header.php"); ?>
    <main>
        <h1>Hébergeur d'image</h1>
        <section class="section__form">
            <div class="form">
                <h2 class="test3 margin2">Envoie d'image à l'hébergeur</h2>
                <form action="hebergeur-image.php" method="post" enctype="multipart/form-data">
                    <ul class="form__liste">
                        <li class="form__el">
                            <label class="label" for="image">Image</label>
                            <input class="input" type="file" name="image" required>
                        </li>
                        <li class="form__el">
                            <button class="form__btn" type="submit" name="valider">Envoyer</button>
                        </li>
                    </ul>
                </form>
            </div>
        </section>
        <section>

        <?php 

            if (isset($error) && $error == 0) {
                echo '<img class="image" src="'.$adress.'" alt="">
                <input type="text" value="http://localhost/php/exo/exo2/'.$adress.'">';
            } else if (isset($error) && $error == 1){
                echo 'Votre image ne peut pas être envoyée. Vérifier son extension et sa taille (maximum à 3 mo).';
            }
            
        ?> 

        </section>
        
    </main>
    <?php include("assets/footer.php"); ?>
</body>
</html>