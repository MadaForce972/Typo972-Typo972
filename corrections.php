<?php
session_start();
if(!isset($_SESSION['voyage'])) { header("Location:index.php"); }
if(isset($_POST['id_question'])) {
include 'includes/connection.php';
$requete = 'UPDATE questions SET question="'.$_POST['question'].'",choix="'.$_POST['choix'].'", reponse="'.$_POST['reponse'].'" WHERE id_question='.(int)$_POST['id_question'];
$bdd->query($requete);
//echo $_POST['id_question'].'<br>';
$texteaenlever=$_POST['id_question'].'|';
//echo $texteaenlever.'<br>';
$motReduit=str_replace($texteaenlever, "", $_SESSION['mot_id_notion_echec']);
//echo $motReduit;
$requete = 'UPDATE eleves SET mot_id_notion_echec="'.$motReduit.'" WHERE id_eleve=242';
$bdd->query($requete);
}


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
 
$requeteErreur = 'SELECT * FROM eleves WHERE id_eleve=242';
    $resultatErreur = $bdd->query($requeteErreur) or die(print_r($bdd->errorInfo()));
    $donneesErreur = $resultatErreur->fetch();
    $motErreur=$donneesErreur['mot_id_notion_echec'];
    $tabMotErreur=explode("|",$motErreur);
$_SESSION['mot_id_notion_echec']=$motErreur;

echo '<div class=col-sm-12 col-md-12 col-lg-12><div class=panel panel-default><div class=panel-heading>';
echo ' <h3 class="panel-title">Corrigeons</h3></div>';
echo ' <div class="panel-body">';
echo '</div></div></div>';

for ($v=0;$v<count($tabMotErreur);$v++) {
    $requeteQuestion = 'SELECT * FROM questions WHERE id_question ='.intval($tabMotErreur[$v]).' ORDER BY id_question';
    $resultatQuestion = $bdd->query($requeteQuestion) or die(print_r($bdd->errorInfo()));
    $donneesADE = $resultatQuestion->fetch();
    echo '<form method=post action=corrections.php>';
    echo '<div class=col-sm-12 col-md-12 col-lg-12><div class=panel panel-default><div class=panel-heading>';
    echo ' <h3 class="panel-title">Question '.$donneesADE['id_question'].')</h3></div>';
    echo ' <div class="panel-body"><input type="text" id="name" size="150" name="question" value="'.$donneesADE['question'].'"/></div>';
    echo '<div class="panel-body">';
    echo '<input type="hidden" id="custId" name="id_question" value="'.$donneesADE['id_question'].'">';
    echo '<input type="text" id="name" name="choix" size="150" value="'.$donneesADE['choix'].'" /><br>';
    echo '</div> <div class="panel-body"><input type="text" size="150" id="name" name="reponse" value="'.$donneesADE['reponse'].'" /></div>'; 
    echo '<input type=submit name=envoyer value=ok></form>';
    echo '</div></div></div><br><br>';
}

 ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
     </body>
</html>