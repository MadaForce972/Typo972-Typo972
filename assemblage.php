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
  </head>

<body bgcolor="white" text="black" link="blue" vlink="purple" alink="red" background="images/fond.jpg">
<!-- Barre de navigation entete -->

<?php include 'includes/barredenavigation3.php'; ?>

<?php
echo '<form method="post" action="rangement.php" class="form-inline">';
$tab=explode("|",$_POST['choix']);
$requete = 'SELECT * FROM cours WHERE id_cours="'.$tab[0].'"';
$resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));
while($donneesADE = $resultat->fetch()) {
    $table=explode("|",$donneesADE['definitions']);
    echo '<div class=col-sm-12 col-md-12 col-lg-12><div class=panel panel-default><div class=panel-heading>';
    echo '<h3 class="panel-title">Formulaire de création des questions</h3></div>';
    echo '<div class="panel-body">';
    echo '<p>id_notion : '.$tab[0].'<br>'.' Classe : '.$tab[2].'<br> id_definition : <b>'.$tab[1].'</b></p>';
    $tabTitreetDefinition=explode("@",$table[intval($tab[1])]);
    echo '<p>Définition : '.$tabTitreetDefinition[0].'</p>';
    echo '<b>'.$tabTitreetDefinition[1].'</b>';
    echo '<input type="hidden" id="custId" name="id_notion" value="'.$tab[0].'">';
    echo '<input type="hidden" id="custId" name="classe" value="'.$tab[2].'">';
    echo '<input type="hidden" id="custId" name="id_definition" value="'.$tab[1].'">';
    echo '</div></div></div>';
}
 ?>

<div class=col-sm-12 col-md-12 col-lg-12><div class=panel panel-default><div class=panel-heading><h3 class="panel-title">Formulaire de création des questions</h3></div>
<div class="panel-body">

  <div class="form-group">
    <label for="exampleFormControlTextarea1">Inscris les questions l'une en dessous de l'autre (tape entrée à chaque fois)</label><br>
    <textarea class="form-control form-control-lg" id="questions" name="questions" rows="6"></textarea>
  </div>
<br><br>


<div class="form-group">
    <label for="exampleFormControlTextarea1">Inscris les 4 réponses séparés par @ en mettant la bonne réponse en premier</label><br>
    <textarea class="form-control-lg" id="quatrereponses" name="quatrereponses" rows="3"></textarea>
</div>  
<br><br>



<div class="form-group">
    <label for="exampleFormControlTextarea1">Code secret de validation</label><br>
    <input type="text" class="form-control" id="code" name="code">
  </div>

</div></div>
<button type=submit class=btn btn-primary mb-2>ok</button>
</form>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
    </body>
</html>