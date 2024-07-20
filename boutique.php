<?php 
session_start();
include 'includes/connection.php';
if(empty($_SESSION['voyage'])) { header("Location:index.php"); }
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


<div class="container">
  <div class="row">
    <?php
$catalogue=array("0","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","37","38","39","40","41","42","43");
$prix=array(50,50,50,45,35,35,50,50,50,50,55,60,65,70,75,80,85,90,95,100,105,110,115,120,125,130,135,140,145,150,155,160,165,170,175,180,150,150,150,150,150,150,150,150);
$tabBibliotheque=explode("|",$_SESSION['bibliotheque']);
    // Supposons que $images contient les chemins vers vos 36 images
    echo '<form method="post" action="caisse.php">';
    for ($i = 0; $i < 44; $i++) {
      $image_path = "images/miniature" . $i . ".png"; // Chemin de l'image

    ?>
    <div class="col-md-4">
      <div class="image-container border">
        <center><img src="<?php echo $image_path; ?>" class="img-fluid" class="rounded" width="150" heigh="150" alt="Image <?php echo $i; ?>"></center>
        <div class="image-text">
<?php
  if(in_array($catalogue[$i],$tabBibliotheque)) {
    echo '<center>Choisir ';
  } else {
    echo '<center>Acheter '.$prix[$i].'  Vmath ';}
    echo '<input type="radio" id="huey'.$i.'" name="acheter" value="'.$catalogue[$i].'"/></center>';
    $a=$i+1;    
    if($a%3==0) {echo '<br><br>';}  
echo '</div></div></div>';
}
echo '<br><center><input type="submit" value="ok"></center>';
echo '</form>'
?>

      
    
  </div>
</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    </body>
</html>