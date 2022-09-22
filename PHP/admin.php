
<?php
include "../fonctions/check.php";
include "../fonctions/db.php"; //connexion à la BDD
include "../fonctions/admincheck.php";



$dbh = db_connect();

if ($type != 3) {

$sql = 'select question, datequestion, pseudo, idfaq
from faq f, utilisateur u
WHERE f.idutilisateur = u.idutilisateur
AND idligue=:ligue
AND reponse=""
order by datequestion';

$params = array(
    ":ligue" => $ligue,
);

try {
  $sth = $dbh->prepare($sql);
  $sth->execute($params);
  $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
}
}
else{

    $sql = 'select question, datequestion, pseudo, idfaq
    from faq f, utilisateur u
    WHERE f.idutilisateur = u.idutilisateur
    AND reponse=""
    order by datequestion';
    
    
    try {
      $sth = $dbh->prepare($sql);
      $sth->execute();
      $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
    }
}

?>





<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/FAQ_accueil.css">
    <!-- ajout de police-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka&family=Raleway:wght@500;800&display=swap" rel="stylesheet">
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




    <!-- MENU code-->
    <div class="menu">
        <p class="menu_header">Accès</p>
        <p class="elem_menu fullist"><a href="list.php"><img src="..\IMG\arrowright.png">Accèder à la liste complète des questions</a></p><br><br>
        <p class="elem_menu textbutton">vous ne trouvez pas de réponse à votre question ? <br> posez nous la votre, un
            administrateur s'occupera de vous
            répondre !</p>
        <br>
        <img src="../IMG/arrowdown.png">
        <br>

        <div class="button_slide slide_right"><a href="add.php" class="add_button">Je pose ma question!</a></div>

    </div>
    <!-- MENU END code-->




    <!-- Bienvenue+Accroche code-->
    <div class="presentation_container">
        <p class="welcome">Questions en attentes de réponses</p>
        <p class="welcome_accroche">Ici vous pouvez répondre aux questions des Utilisateurs</p>
        <hr>
    </div>
    <!-- Bienvenue+Accroche END code-->



    <!---->
    <!---->
    <!--TABLEAU QUESTION DEBUT-->
    <div class='legende'>
       Questions en attentes de réponses
    </div>
    <br>

    <div class="content">
    <?php foreach ($rows as $row){
        $linkrep = "reponse.php?id=".$row["idfaq"];
        $linksuppr = "delete.php?id=".$row["idfaq"];
echo '<div>';
echo '<input type="checkbox" id="'.$row["idfaq"].'" name="q" class="questions">';
echo '<div class="plus">+</div>
<label for="'.$row["idfaq"].'" class="question">'.
    $row["question"];
echo '<div class="info"> par '.$row["pseudo"].' le '.$row["datequestion"].'</div>
</label>
<div class="reponses norep">
                <div class="info"><a class="reponse_link" href="'.$linkrep.'">REPONDRE</a><a class="reponse_link" href="'.$linksuppr.'">SUPPRIMER</a></div>
            </div>
</div>';
}
?>
    </div>
    <!--TABLEAU QUESTION FIN-->
    <!---->
    <!---->
    <!---->



</body>

</html>