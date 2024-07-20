 <?php     
// vérification du code
 session_start();
if(isset($_POST['code'])) {
include 'includes/connection.php';
$req = $bdd->prepare('SELECT * FROM eleves WHERE code = ?');
$req->execute(array($_POST['code']));
$donnees = $req->fetch();
$administrateur=array("YjzTx","bx321"); 
$correcteur=array("ZPqL8"); 
$ecrivain=array("L4qcp","gqr9J","9ZFXz","jVpKJ");
$professeur=array("ghjYv","QwbdX","6b4wV","PtTYZ","pK6hv");
$listeAdmin=array("YjzTx","bx321","ZPqL8","L4qcp","gqr9J","9ZFXz","jVpKJ","ghjYv","QwbdX","6b4wV","PtTYZ","pK6hv");
    if($donnees[0]!='') { 
    $_SESSION['voyage']="en_cours";

    $tabNom=explode(" ",$donnees['nom']);
    for($d=0;$d<count($tabNom);$d++) {
    $nom.=substr($tabNom[$d], 0,3).'.';
    }

    //$_SESSION['nom']=$donnees['nom'];
    $_SESSION['nom']=$nom;

    $_SESSION['id_eleve']=$donnees['id_eleve'];
    $_SESSION['mot_id_notion_score']=$donnees['mot_id_notion_score'];
    $_SESSION['classe']=$donnees['classe'];
    $_SESSION['classedepart']=$donnees['classe'];
    $_SESSION['police']=$donnees['police'];
    $_SESSION['difficulte']=$donnees['difficulte'];
    $_SESSION['grade']=$donnees['grade'];
    $_SESSION['avatar']=$donnees['avatar'];
    $_SESSION['bibliotheque']=$donnees['bibliotheque'];
    $_SESSION['vmath']="";
    $_SESSION['score']="";
    $_SESSION['administrateur']="ferme";$_SESSION['correcteur']="ferme";$_SESSION['ecrivain']="ferme";$_SESSION['professeur']="ferme";$_SESSION['eleve']="ferme";
        if(in_array($donnees['code'],$administrateur)) {$_SESSION['administrateur']="active";} 
        if(in_array($donnees['code'],$correcteur)) {$_SESSION['correcteur']="active";}
        if(in_array($donnees['code'],$ecrivain)) {$_SESSION['ecrivain']="active";}
        if(in_array($donnees['code'],$professeur)) {$_SESSION['professeur']="active";}
        if(!in_array($donnees['code'],$listeAdmin)) {$_SESSION['eleve']="active";}
        header("Location: aeroport.php");
    }
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
  </head>

<body bgcolor="white" text="black" link="blue" vlink="purple" alink="red" background="images/fond bleu5.jpeg">
<!-- Barre de navigation entete -->
   <?php include 'includes/barredenavigationmotdepasse.php'; ?>

<div class=col-sm-12 col-md-12 col-lg-12><div class=panel panel-default><div class=panel-heading>
<div class="container mt-4">
  <div class="row">
    <div class="col">
      <h2>Bienvenue cher élève</h2>
    </div>
  </div>
  <div class="row">
    <div class="col-md-2">
      <img src="images/professeur.png" class="img-fluid" alt="Image">
    </div>
    <div class="col-md-10">   

<b>Version 1.6 - Notes de mise à jour :</b><br><br>
      Vous disposez de nouveau de TOUS vos Vmath pour racheter de nouveaux skins ou les mêmes<br>Le skin Pingouin vous est offert (Excusez de la panne de la boutique)<br>De nouveaux skins proposés par les jeunes sont disponibles<br>Tous les prix des nouveaux skins sont plafonnés à 150<br>L'un d'entre vous est proche du grade Chevalier du Roi<br><br>



      <b>Version 1.5 - Notes de mise à jour :</b><br><br>
      Vos noms et prénoms seront remplacé par vos initiales (exemple ETANIEL Ray sera remplacé par ETA.R.)<br>Trois nombres seront mis à coté de vos initiales (exemple E.R. 1-1-1)<br><ul><li>Le premier indique votre position dans le collège</li><li>Le second indique votre position parmi les sixièmes, les cinquièmes, les quatrièmes ou les troisièmes</li><li>Le dernier votre position dans votre classe</li></ul>Le bouton retour arrière ne fonctionne plus, donc quand vous avez valider ne retournez pas en arrière.<br>Un nouveau grade sera rajouté après chevalier du roi. Il s'agit du chevalier légendaire.
    </div>
  </div>
</div>
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
     </body>
</html>
