 <?php     
// vérification du code
 session_start();
if(!isset($_SESSION['voyage'])) { header("Location:index.php"); }
header("Refresh:10");
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
<body bgcolor="white" text="black" link="blue" vlink="purple" alink="red" background="images/fond bleu5.jpeg">
<!-- Barre de navigation entete -->
   <?php include 'includes/barredenavigation3.php';
include 'includes/connection.php';
$grade=array("écuyer débutant","écuyer confirmé","cavalier débutant","cavalier confirmé","chevalier débutant","chevalier confirmé","Chevalier du Roi");
$req = $bdd->prepare('SELECT * FROM eleves WHERE classe = ? ORDER BY score DESC');
$req->execute(array($_GET['classe']));

echo '<div class=col-sm-12 col-md-12 col-lg-12><div class=panel panel-default><div class=panel-heading>';
echo '<div class="panel-body">';
echo '<table class="table table-bordered"><tr><th>Nom</th><th>Score</th><th>Statut</th></tr>';
while($donnees = $req->fetch()) {
      $points=0;
      $Tableau = explode("/",$donnees['mot_id_notion_score']);
      for($i=0;$i<count($Tableau);$i++) {
        $Tab=explode("*",$Tableau[$i]);
        for($o=0;$o<count($Tab);$o++) {
          $points+=intval($Tab[$o]);
        }
      }
      if(substr($_SESSION['classe'],0,1)=="6") {$coef=array(0,50,150,250,350,450,550,650,750);}
      if(substr($_SESSION['classe'],0,1)=="5") {$coef=array(0,50,150,250,350,450,550,650,750);}
      if(substr($_SESSION['classe'],0,1)=="4") {$coef=array(0,50,150,250,350,450,550,650,750);}
      if(substr($_SESSION['classe'],0,1)=="3") {$coef=array(0,50,150,250,350,450,550,650,750);}

      for($z=0;$z<8;$z++) {
      if(($points>=$coef[$z]) & ($points<$coef[$z+1])) { 
      $a=$points-$coef[$z+1];
      //echo $grade[$z].' ('.$a.')';}
      $val=$grade[$z];
            
      
      }
      }
    $tabNom=explode(" ",$donnees['nom']);
    $nom="";
    for($d=0;$d<count($tabNom);$d++) {
    $nom.=substr($tabNom[$d], 0,3).'.';
    }


    echo '<tr><td>'.$nom.'</td><td>'.$points.'</td><td>'.$val.'</td></tr>';
}

echo '<table>';
echo '</div></div></div></div><br>';

  ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
     </body>
</html>
