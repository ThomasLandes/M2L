<?php 
session_start();
if (isset($_SESSION['id'])) {

    $pseudo = $_SESSION['pseudo'];
    $id = $_SESSION['id'];
    $type = $_SESSION['type'];
    $ligue = $_SESSION['ligue'];
}
else{
    header('Location: connexion.php');
}
?>