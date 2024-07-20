<?php
session_start();
$_SESSION['id_notion']=$_GET['id_notion'];
if(!isset($_SESSION['voyage'])) { header("Location:index.php"); }
if(isset($_SESSION['destination'])) { 
if($_SESSION['destination']==$_SESSION['avion']) {
header("Location:aeroport.php");
}
}
$_SESSION['avion']=$_GET['id_notion'].$_GET['id_definition'];
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
<script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
<script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
  </head>

<body bgcolor="white" text="black" link="blue" vlink="purple" alink="red" background="images/fond.jpg">
<!-- Barre de navigation entete -->
 <?php include 'includes/barredenavigation3.php'; ?>
 <?php include 'includes/connection.php';
 
$_SESSION['id_definition']=$_GET['id_definition'];    
// vérification du code

$requeteDefinition = 'SELECT * FROM cours WHERE id_cours="'.$_GET['id_notion'].'"';
$resultatDefinition = $bdd->query($requeteDefinition) or die(print_r($bdd->errorInfo()));
$donneesDefinition = $resultatDefinition->fetch();
      if(strpos($donneesDefinition['definitions'],'|')!==false) {
              $tabDefinition=explode("|",$donneesDefinition['definitions']);
              $tabe=explode("@",$tabDefinition[intval($_GET['id_definition'])]);
              } else {
                    $tabe=explode("@",$donneesDefinition['definitions']);
              }

$requeteQuestion = 'SELECT * FROM questions WHERE id_notion ='.$_GET['id_notion'].' AND id_definition='.$_GET['id_definition'].' ORDER BY id_question';
$resultatQuestion = $bdd->query($requeteQuestion) or die(print_r($bdd->errorInfo()));

echo '<div class=col-sm-12 col-md-12 col-lg-12><div class=panel panel-default><div class=panel-heading>';
echo ' <h3 class="panel-title">Objectifs Il s\'agit ici de choisir la bonne réponse à chaque question et de valider le QCM en bas de page.</h3></div>';
echo ' <div class="panel-body">';
echo 'Eléments de cours : '.$tabe[1];
echo '</div></div></div>';



echo '<form method=post action=destination.php>';
$i=0;

while($donneesADE = $resultatQuestion->fetch()) {
$i++;
echo '<div class=col-sm-12 col-md-12 col-lg-12><div class=panel panel-default><div class=panel-heading>';
echo ' <h3 class="panel-title">Question '.$i.'&nbsp&nbsp&nbsp&nbsp(id : '.$donneesADE['id_question'].')</h3></div>';
echo ' <div class="panel-body">'.$donneesADE['question'].'<br><br>';

$reponse=explode("@",$donneesADE['choix']);
for($o=0;$o<count($reponse);$o++) {
    if($_SESSION['eleve']=="ferme") {
    if($reponse[$o]==$donneesADE['reponse']) echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type=radio name=choix'.$i.' value="'.$reponse[$o].'"><b> '.$reponse[$o].'</b>';
    if($reponse[$o]!=$donneesADE['reponse']) echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type=radio name=choix'.$i.' value="'.$reponse[$o].'"> '.$reponse[$o];
    } else {
    if(strlen($donneesADE['choix'])>150) {
    echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type=radio name=choix'.$i.' value="'.$reponse[$o].'"> '.$reponse[$o].'<br>';
    } else {
    echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type=radio name=choix'.$i.' value="'.$reponse[$o].'"> '.$reponse[$o];
    }

    }
}
echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type=radio name=choix'.$i.' value="erreur"> Je Vous signale une erreur dans cette question';

echo'<br><br>';
if($donneesADE['image']!="") {
echo '<img src=images/'.$donneesADE['image'].' alt=Image exercice mathématique><br><br>';
}
echo '</div></div></div>';
} 
echo '<div class=col-sm-12 col-md-12 col-lg-12><div class=panel panel-default><div class=panel-heading>';
echo ' <h3 class="panel-title">Bravo d\'être arrivé(e) jusque là. Il ne te reste plus qu\'à valider en appuyant sur le bouton d\'en bas</h3></div>';
echo ' <div class="panel-body">';
echo '<input type=submit name=envoyer value=Valider></form><br><br>';
    if(($_SESSION['administrateur']=="active") or ($_SESSION['correcteur']=="active")) {
    echo '<form method=post action=assemblage.php>';
    $Valeur=$_GET['id_notion'].'|'.$_GET['id_definition'].'|'.$_SESSION['classe'];
    echo '<input type="hidden" id="custId" name="choix" value="'.$Valeur.'">';
    echo '<input type=submit name=envoyer value=Insertion10Questions><br><br></form>';
    
    echo '<form method=post action=ingenieur.php?id_notion='.$_GET['id_notion'].'&id_definition='.$_GET['id_definition'].'>';
    echo '<input type=submit name=envoyer value=Correction></form>';
    }
    echo '<form method=post action=assemblage.php>';
    if($_SESSION['ecrivain']=="active") {
    $Valeur=$_GET['id_notion'].'|'.$_GET['id_definition'].'|'.$_SESSION['classe'];
    echo '<input type="hidden" id="custId" name="choix" value="'.$Valeur.'">';
    echo '<input type=submit name=envoyer value=Insertion10Questions><br><br></form>';

    }
 

echo '</div></div></div>';

 ?>
<!-- Zone d'écriture -->
      
       
      
     
 
 

 
      


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
     </body>
</html>