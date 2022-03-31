<?php

require './bdd.php';

if (isset($_POST['sub'])) {
    if (!empty($_POST['quantity']))
    {
        $id = $_GET['id'];
        $quantity = htmlspecialchars($_POST['quantity']);

        header("Location: gestionsstockage.php");
    }
}
?>