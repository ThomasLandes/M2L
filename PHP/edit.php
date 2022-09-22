<?php

include "../fonctions/db.php"; //connexion à la BDD
include "../fonctions/check.php";

$dbh = db_connect();

// Récupère l'ID passé dans l'URL 
$idfaq = isset($_GET['id']) ? $_GET['id'] : '';
// Lecture du formulaire
$question = isset($_POST['question']) ? $_POST['question'] : '';
$submit = isset($_POST['submit']);

// Modification dans la base
if ($submit) {
    // Formulaire validé : on modifie l'enregistrement
    $idfaq = $_POST['idfaq'];
    $sql = "UPDATE faq SET question= :question WHERE idfaq=:id";
    $params = array(
        ":id" => $idfaq,
        ":question" => $question,
    );

    try {
        $sth = $dbh->prepare($sql);
        $sth->execute($params);
        $nb = $sth->rowcount();
    } catch (PDOException $e) {
        die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
    }
    header('Location: historique.php');

} else {
    // Formulaire non encore validé : on affiche l'enregistrement
    $sql = "select * from faq where idfaq=:id";
    $params = array(
        ":id" => $idfaq
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
            <!--<div class="title">
                <h2>Maison des Ligues Lorraines - FAQ</h2>
            </div>-->
        </div>
    </nav>
    <!-- NAVBAR END code-->
    <h1>Foire aux Questions</h1>
    <!-- ADD QUESTION code -->
    <div class="container">

        <div class="container-onglets">
            <a href="historique.php"><img src="../IMG/back.png" alt=""></a>
            <div class="onglets active">Modifier une question</div>
        </div>

        <div class="contenu">

            <div class="login">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="login-container" method="POST">
                    <label for="Add">Modifiez votre question :</label>
                    <p> <textarea name="question" id="Add" rows="5"><?php echo $question ?></textarea></p>
                    <p><input type="hidden" name="idfaq" value="<?php echo $idfaq; ?>"></p>
                    <p><input type="submit" name="submit" value="Modifier"></p>
                </form>
            </div>
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