<?php

include "../fonctions/db.php"; //connexion à la BDD
include "../fonctions/check.php";
include "../fonctions/admincheck.php";

$dbh = db_connect();

// Récupère l'ID passé dans l'URL 
$id = isset($_GET['id']) ? $_GET['id'] : '';

// Lecture du formulaire
$submit = isset($_POST['submit']);

// Suppression dans la base
if ($submit) {
    // Formulaire validé : on supprime l'enregistrement
    $id = $_POST['id'];
    // Suppression de la question
    $sql = "delete from faq where idfaq=:id";
    $params = array(
        ":id" => $id
    );
    try {
        $sth = $dbh->prepare($sql);
        $sth->execute($params);
        $nb = $sth->rowcount();
    } catch (PDOException $e) {
        die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
    }

    header('Location: admin.php');
} else {
    // Formulaire non encore validé : on affiche l'enregistrement
    $sql = "select * from faq where idfaq=:id";
    $params = array(
        ":id" => $id
    );
    try {
        $sth = $dbh->prepare($sql);
        $sth->execute($params);
        $row = $sth->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
    }
    $question = $row["question"];
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/navbox.css">
    <!-- ajout de police-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400&family=Raleway:wght@500&display=swap" rel="stylesheet">
    <title>Accueil</title>
</head>

<body>
    <!-- NAVBAR code -->
    <nav class="navbar">
        <div class="nav_container">
            <ul class="nav_ul">
                <li class="nav_list left"><a href="historique.php"><img class="nav_icon" src="..\IMG\user.png" alt="Profil">
                        Profil </a></li>
                <li class="nav_list mid"><a href="FAQ_accueil.php"><img class="nav_icon" src="..\IMG\home.png" alt="Accueil">
                        Accueil</a></li>
                <li class="nav_list right"><a href="deconnexion.php">se deconnecter<img class="nav_icon" src="..\IMG\logout.png" alt="logout"></a></li>
            </ul>
        </div>
    </nav>
    <!-- NAVBAR END code-->
    <h1>Foire aux Questions</h1>
    <!-- ADD QUESTION code -->
    <div class="container">

        <div class="container-onglets">
            <a href="historique.php"><img src="../IMG/back.png" alt=""></a>
            <div class="onglets active">Supprimer la question</div>
        </div>

        <div class="contenu">

            <div class="login">
                <form class="login-container" id="add_form" method="POST">
                    <label for="Add">Vous êtes sur le point de supprimer cette question :</label>
                    <p> <textarea name="question" id="Add" rows="5" readonly><?php echo $question; ?></textarea></p>
                    <p><input type="hidden" name="id" value="<?php echo $id; ?>"></p>
                    <p><a href="#open-modal"><button type="submit" name="submit" form="add_form">Supprimer</button></a></p>
                </form>
            </div>
        </div>
    </div>
    <div id="open-modal" class="modal-window">
        <div>
            <a href="#modal-close" title="Close" class="modal-close">Fermer &times;</a>
            <h1>Question Supprimé</h1>
            <div>La question a été supprimé avec succès</div><br>
            <form action="historique.php">
                <input type="submit" value="Retour profil">
            </form>
        </div>
    </div>
    <!-- ADD QUESTION end code -->
    <!-- MENU code-->
    <div class="menu">
        <p class="menu_header">Accès</p>
        <p class="elem_menu fullist"><a href="list.php"><img src="..\IMG\arrowright.png">Accèder à la liste complète des questions</a></p><br><br>
        <p class="elem_menu historique"><a href="historique.php"><img src="..\IMG\arrowright.png">Mon Profil </a><span style="font-size: 0.7em;">(historique des questions)</span></a></p><br><br>
    </div>
    <!-- MENU END code-->


</body>