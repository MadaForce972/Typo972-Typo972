<?php 
session_start();
include 'includes/connection.php';
if(isset($_SESSION['voyage'])) { header("Location:index.php"); }
 ?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <title>Mathématiques et QCM</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  </head>

<body bgcolor="white" text="black" link="blue" vlink="purple" alink="red" background="images/fond.jpg">
<!-- Barre de navigation entete -->

    <?php include 'includes/barredenavigation3.php'; ?>

<?php
$expression=array("a","b","c","e","j","k","l");
echo '<form method="post" action="assemblage.php" class="form-inline">';
echo '<div class="form-group mx-sm-3 mb-2">';
echo '<label for="choix">Choisissez une option :</label>';
echo '<select class="form-control" id="choix" name="choix">';
 
$requete = 'SELECT * FROM cours WHERE classe="'.substr($_SESSION['classe'],0,-1).'"';
$resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));
$notion="";$indice=0;
while($donnees = $resultat->fetch()) {
        if(strpos($donnees['definitions'],'|')!==false) {
        echo $donnees['definitions'];
        if($notion!=$donnees['notion']) {$indice++;$notion=$donnees['notion'];
}
        $tabDefinition=explode("|",$donnees['definitions']);
        $i=0;
              for($i=0;$i<count($tabDefinition);$i++) {
              $TabTitre=explode("@",$tabDefinition[$i]);
              $Valeur=$donnees['id_cours'].'|'.$i.'|'.$donnees['classe'];
              echo '<option value="'.$Valeur.'">'.$indice.' | '.$donnees['notion'].' | '.$donnees['objectif'].' | '.$expression[$i].') '.$TabTitre[0].'</option>';
              }
        } else {
              $tabAlone=explode("@",$donnees['definitions']);
              $Valeur=$donnees['id_cours'].'|0|'.$donnees['classe'];
              echo '<option value="'.$Valeur.'">'.$indice.' | '.$donnees['notion'].' | '.$donnees['objectif'].' | '.$expression[$i].') '.$tabAlone[0].'</option>';
        }

 
}

echo '</select><button type=submit class=btn btn-primary mb-2>ok</button>';

echo '<form>';
echo '</div></div>';

 ?>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    </body>
</html>