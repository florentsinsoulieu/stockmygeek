<?php

    require './bdd.php';

    if (isset($_POST['ajouter'])) {

    echo $_POST['production'];
    echo $_POST['urlimage'];
    echo $_POST['quantite'];

        if (
                  !empty($_POST['production']) && 
                  !empty($_POST['urlimage']) && 
                  !empty($_POST['quantite'])
            )    
        {
            $production = htmlspecialchars($_POST['production']);
            $urlimage = htmlspecialchars($_POST['urlimage']);
            $quantite = htmlspecialchars($_POST['quantite']);

            $recipesStatement = $bdd->prepare('INSERT INTO product SET production = ?, urlimage = ?, quantite = ?');
            $recipesStatement->execute([$production, $urlimage, $quantite]);
            $req->closeCursor();
            
            $message = 'user florent insert '.$production.' into the bdd';
            $date = date('d-m-y h:i:s');
            $recipesStatement2 = $bdd->prepare('INSERT INTO logs SET date = ?, message = ?');
            $recipesStatement2->execute([$date, $message]);
            $req2->closeCursor();
            
    
            header("Location: gestionsstockage.php");
        } else {
            echo "Vous n'avez pas rempli toutes les cases recommander";
        }
    }

?>




<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Gestions du Stockage </title>
    <link rel="stelesheet" href="main.css">
</head>
<bode>
    
    <header>

        <h1> Actualite du stock present </h1>

    </header>
    <div>
            
            <?php
    
                require './bdd.php';
    
                $sqlQuery = 'SELECT * FROM product';
                $recipesStatement = $bdd->prepare($sqlQuery);
                $recipesStatement->execute();
                $recipes = $recipesStatement->fetchAll();
    
                foreach ($recipes as $recipe) {
            ?>
               <div class="produit">
                    
              <img src=<?php echo $recipe['urlimage']; ?> height="250px" width="auto">

                    <p>
                        
                Nom du produit :  <?php echo $recipe['productname']; ?> <br> 
                
                Quantité :        <?php echo $recipe['quantity']; ?>

                 <form method="POST" action="modificationquantité.php">

                 <input style="display:none;" type="number" name="" value=<?php echo $recipe['id']; ?> required  readonly="readonly">

                 <input type="submit" name="editquantity" value="EDIT">

                            </form>

                        </div>
                    
                    </p>
            
                </div>
            
    
            <?php
                
                }
            
            ?>
    
            </div>
    

                <h1> Ajouter un produit </h1>


<div class="formulaire">

<form method="POST" action="">

<label for="production"> Nom du produit :</label>
<input type="text" id="production" name="production" required>

<label for="urlimage"> urlimage :</label>
<input type ="text" id= "urlimage" name="urlimage" required>

<label for="quantite"> quantite :</label>
<input type ="number" id= "quantite" name="quantite" required>


<input type="submit" id="bouton" name="ajouter" value="Envoyer"> 

</form>


</div>
<div>

        <p><a href="logs.php"> Voir les Logs du serveur</a></p>
</div>
</bode>
</html>