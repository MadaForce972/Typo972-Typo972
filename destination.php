  <?php
session_start();
if(!isset($_SESSION['voyage'])) { header("Location:index.php"); }
$_SESSION['destination']=$_SESSION['avion'];
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
$mot_id_notion_score=$_SESSION['mot_id_notion_score'];
$requeteQuestion = 'SELECT * FROM questions WHERE id_notion ='.$_SESSION['id_notion'].' AND id_definition="'.$_SESSION['id_definition'].'" ORDER BY id_question';
$resultatQuestion = $bdd->query($requeteQuestion) or die(print_r($bdd->errorInfo()));
echo '<br><br>';
$o=0;$score=0;


while($donneesADE = $resultatQuestion->fetch()) {
$o++;
echo '<div class=col-sm-12 col-md-12 col-lg-12><div class=panel panel-default><div class=panel-heading>';
echo ' <h3 class="panel-title">Question '.$o.' : </h3></div>';
echo ' <div class="panel-body">';
echo $donneesADE['id_question'].')  '.$donneesADE['question'].'<br>';

if(isset($_POST['choix'.$o])) {

if($donneesADE['reponse']==$_POST['choix'.$o]) {
echo '<b style=color:green>Bravo +1 Point. La bonne réponse est bien : '.$donneesADE['reponse'].'</b>';
$score++;
} else {
echo '<b style=color:red>'.$_POST['choix'.$o].' est une mauvaise réponse.</b>';
}
}
if(!isset($_POST['choix'.$o])) {
echo '<b>Vous n\'avez pas répondu à cette question</b>';
}
if(isset($_POST['choix'.$o])) {
    if($_POST['choix'.$o]=="erreur") {
    $requeteErreur = 'SELECT * FROM eleves WHERE id_eleve=242';
    $resultatErreur = $bdd->query($requeteErreur) or die(print_r($bdd->errorInfo()));
    $donneesErreur = $resultatErreur->fetch();
    $motErreur=$donneesErreur['mot_id_notion_echec'];
        if(!strpos($motErreur,$_POST['choix'.$o])) {
        $motErreur.=$donneesADE['id_question'].'|';
        $requete = 'UPDATE eleves SET mot_id_notion_echec="'.$motErreur.'" WHERE id_eleve=242';
        $bdd->query($requete); 
        }
    }
}

echo '</div></div></div>';
//echo'<br><br>';
}

echo '<div class=col-sm-12 col-md-12 col-lg-12><div class=panel panel-default><div class=panel-heading>';
echo ' <h3 class="panel-title">Voici ton score : ('.$score.'/'.$o.')</h3></div>';
echo ' <div class="panel-body">';
$limiteBasse =($o * 8 / 10);
$limiteMoyenne =($o * 9 / 10);

If($score<$limiteBasse) {echo ' ta note est insuffisante pour valider ton exercice. Réessaye. Il te faut avoir au moins 80 pourcent de bonnes réponses';}
If(($score>=$limiteBasse) AND ($score<$limiteMoyenne))  {echo ' Bravo tu as validé ton exercice. Ta mention est : HONORABLE. Réessaye pour avoir la Mention BIEN';}
If(($score>=$limiteMoyenne) AND ($score<$o)) {echo 'BRAVO tu as validé ton exercice. Ta mention est : BIEN. Réessaye pour avoir la Mention TRES BIEN';}
If($score==$o) {echo ' EXCELLENT tu as validé ton exercice. Ta mention est : TRES BIEN.';}
echo '<br><br><a href=aeroport.php>Clique ici pour retourner au sommaire</a><br>';
echo '</div></div></div>';



$scoreNotion="";$motscore="";
$Tableau_mot_id_notion_score = explode("/",$mot_id_notion_score);
$Tableau_de_la_notion = explode("*",$Tableau_mot_id_notion_score[(int)$_SESSION['id_notion']-1]);
$Tableau_de_la_notion[(int)$_SESSION['id_definition']]=$score;

for($k=0;$k<count($Tableau_de_la_notion)-1;$k++){
$scoreNotion.=$Tableau_de_la_notion[$k].'*';
}

$Tableau_mot_id_notion_score[(int)$_SESSION['id_notion']-1]=$scoreNotion.'0';
for($i=0;$i<count($Tableau_mot_id_notion_score)-1;$i++){
$motscore.=$Tableau_mot_id_notion_score[$i].'/';
}
$_SESSION['mot_id_notion_score']=$motscore;
//préparation de la requete
$requete = 'UPDATE eleves SET mot_id_notion_score="'.$motscore.'" WHERE id_eleve="'.(int)$_SESSION['id_eleve'].'"';
         // Exécution de la requête SQL
$bdd->query($requete); 
 ?>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
     </body>
</html>