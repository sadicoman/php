<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire img</title>
    <link href="assets/css/main.css" rel="stylesheet" >
</head>
<body>
    <?php include("assets/header.php"); ?>
    <main>
        <section class="section__form">
            <div class="form">
                <h2 class="test3 margin2">Envoie image formulaire</h2>
                <form action="formulaire_img.php" method="post" enctype="multipart/form-data">
                    <ul class="form__liste">
                        <li class="form__el">
                            <label class="label" for="image">Image</label>
                            <input class="input" type="file" name="image">
                        </li>
                       
                        <li class="form__el">
                            <button class="form__btn" type="submit" name="valider">Envoyer</button>
                        </li>
                    </ul>
                </form>
            </div>
        </section>
        <?php 
            // $_FILES['image']['name'] //Nom
            // $_FILES['image']['type'] //Type image/png
            // $_FILES['image']['size'] //Taille
            // $_FILES['image']['tmp_name'] //Emplacement fichier temporaire
            // $_FILES['image']['error'] //Erreur

            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0){
                if ($_FILES['image']['size'] <= 3000000){
                    $informasImage = pathinfo($_FILES['image']['name']);
                    $extensionImage = $informasImage['extension'];
                    $extensionArray = array('png', 'gif', 'jpeg', 'jpg');
                    if (in_array($extensionImage, $extensionArray)) {
                        move_uploaded_file($_FILES['image']['tmp_name'], 'assets/uploads/'.time().basename($_FILES['image']['name']));
                        echo 'Envoie bien réussi !';
                    }
                }
            }


            
        ?> 
    </main>
    <?php include("assets/footer.php"); ?>
</body>
</html>