<?php
    session_start();
    require "./bdd.php";

    if(isset($_POST["bouton"])) {
        if (!empty($_POST["identifiant"]) and !empty($_POST["motdepasse"])) {

            $identifiant = htmlspecialchars($_POST["identifiant"]);
            $motdepasse = htmlspecialchars($_POST["motdepasse"]);

            $get_user = $bdd->prepare("SELECT * FROM `users` WHERE username = ? and passw = ?");
            $get_user->execute(array($identifiant,$motdepasse));

            if ($get_user->rowCount() > 0) {

                $_SESSION ["identifiant"] = $get_user->fetch();

                header("Location: gestionsstockage.php");
                echo "connecte";

            }
        } else {
            echo "Les informations sont vides !";
        }
    }

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
        <header class= "center">

            <h1> LA PAGE DE CONNECTION </h1>

        </header>

        <div class="formulaire">
            
            <form method="post" action="">

            <label for="identifiant"> Identifiant :</label>
            <input type="text" id="identifiant" name="identifiant" required>

            <label for="motdepasse"> Mot de passe :</label>
            <input type ="text" id= "motdepasse" name="motdepasse" required>


            <input type="submit" id="bouton" name="bouton" value="Envoyer"> 

            
            
           </form>

        </div>
</body>
</html>