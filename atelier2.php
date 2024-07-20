<?php 
session_start();
include 'includes/connection.php';
if(!isset($_SESSION['voyage'])) { header("Location:index.php"); }
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  </head>

<body bgcolor="white" text="black" link="blue" vlink="purple" alink="red" background="images/fond.jpg">
<!-- Barre de navigation entete -->

    <?php include 'includes/barredenavigation3.php'; ?>

<?php


$expression=array("a","b","c","e","j","k","l");
$Tableau_mot_id_notion_score=explode("/", $_SESSION['mot_id_notion_score']); 
$requete = 'SELECT * FROM cours WHERE classe="'.substr($_SESSION['classe'],0,-1).'" ORDER BY id_cours, notion, objectif ASC';
$resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));
$notion="";$indice=1;
while($donneesADE = $resultat->fetch()) {

if($notion!=$donneesADE['notion']) {
if($indice!=1) {echo '</div></div></div></div></div><br>';}
echo '<div class=col-sm-12 col-md-12 col-lg-12><div class=panel panel-default><div class=panel-heading>';
echo ' <h3 class="panel-title">&nbsp&nbsp&nbsp'.$indice.'&nbsp&nbsp&nbsp'.$donneesADE['notion'].'</h3></div>';
echo '<div class="panel-body">';
$indice++;
}   
$notion=$donneesADE['notion'];

if($donneesADE['definitions']=="") {
echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.$donneesADE['objectif'].'<br>';
} else {
      echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.$donneesADE['objectif'].'<br>';
      $TabDefinitions=explode("|",$donneesADE['definitions']);
                    for($j=0;$j<count($TabDefinitions);$j++) {
                        $TabDefinitionsTitre=explode("@",$TabDefinitions[$j]);
                        $tab=explode("*",$Tableau_mot_id_notion_score[(int)$donneesADE['id_cours']-1]);
                        

                      $requeteQuestion = 'SELECT * FROM questions WHERE id_notion ='.$donneesADE['id_cours'].' AND id_definition='.$j.' ORDER BY id_question';
                      $resultatQuestion = $bdd->query($requeteQuestion) or die(print_r($bdd->errorInfo()));
                      $compteur=0;$boolean="false";$booleanEnLigne="true";$booleanZero="true";$corrigeable="false";$Intouchable="false";
                      while($donneesresultat = $resultatQuestion->fetch()) {
                          if($donneesresultat['id_definition']!="") {$compteur++;}
                          if($donneesresultat['auteur']==$_SESSION['nom']) {$boolean="true";}
                          if($donneesresultat['enligne']!=2) {$booleanEnLigne="false";}
                          if($donneesresultat['enligne']==0) {$corrigeable="true";}
                          if($donneesresultat['enligne']==1) {$Intouchable="true";}
                      }    
                      if($compteur==0) {
                      echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp('.$tab[$j].'/'.$compteur.')&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.$expression[$j].')&nbsp<a href=avion.php?id_notion='.$donneesADE['id_cours'].'&id_definition='.$j.'>'.$TabDefinitionsTitre[0].'</a><br>';
                      }
                      if(($compteur!=0) and ($boolean=="true") and ($Intouchable=="false")) {
                      echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp('.$tab[$j].'/'.$compteur.')&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.$expression[$j].')&nbsp<a href=ingenieur.php?id_notion='.$donneesADE['id_cours'].'&id_definition='.$j.'>'.$TabDefinitionsTitre[0].' - - - Corrigeable</a><br>';
                      }
                      if(($compteur!=0) and ($_SESSION['correcteur']=="active") and ($corrigeable=="true")) {
                      echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp('.$tab[$j].'/'.$compteur.')&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.$expression[$j].')&nbsp<a href=ingenieur.php?id_notion='.$donneesADE['id_cours'].'&id_definition='.$j.'>'.$TabDefinitionsTitre[0].' - - - A Corriger</a><br>';
                      }
                      if(($compteur!=0) and ($_SESSION['administrateur']=="active") and ($booleanEnLigne=="true")) {
                      echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp('.$tab[$j].'/'.$compteur.')&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.$expression[$j].')&nbsp<a href=ingenieur.php?id_notion='.$donneesADE['id_cours'].'&id_definition='.$j.'>'.$TabDefinitionsTitre[0].' - - - A valider</a><br>';
                      }
                      if(($compteur!=0) and ($_SESSION['administrateur']=="active") and ($corrigeable=="true")) {
                      echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp('.$tab[$j].'/'.$compteur.')&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.$expression[$j].')&nbsp<a href=ingenieur.php?id_notion='.$donneesADE['id_cours'].'&id_definition='.$j.'>'.$TabDefinitionsTitre[0].' - - - A Corriger</a><br>';
                      }
                    }
      }
}
 ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    </body>
</html>