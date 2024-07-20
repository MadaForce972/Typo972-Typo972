<?php 
session_start();
include 'includes/connection.php';
$catalogue=array("0","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","37","38","39","40","41","42","43");
$prix=array(50,50,50,45,35,35,50,50,50,50,55,60,65,70,75,80,85,90,95,100,105,110,115,120,125,130,135,140,145,150,155,160,165,170,175,180,150,150,150,150,150,150,150,150);

	$tabl=explode("|",$_SESSION['avatar']);
	$tabBibliotheque=explode("|",$_SESSION['bibliotheque']);
if(isset($_POST['acheter'])) {
	if(in_array($_POST['acheter'],$tabBibliotheque)) {
	    $_SESSION['avatar']=$_POST['acheter'].'|'.$tabl[1];
		$requete = 'UPDATE eleves SET avatar="'.$_SESSION['avatar'].'" WHERE id_eleve='.(int)$_SESSION['id_eleve'];
        $bdd->query($requete); 	
	} else {
		$somme=intval($_SESSION['vmath']) - intval($prix[intval($_POST['acheter'])]) ;
		if($somme>=0) {
		$tabl[1]=intval($tabl[1])+intval($prix[intval($_POST['acheter'])]);
		$_SESSION['avatar']=$_POST['acheter'].'|'.$tabl[1];
		$_SESSION['bibliotheque'].='|'.$_POST['acheter'];
		$requete = 'UPDATE eleves SET avatar="'.$_SESSION['avatar'].'", bibliotheque="'.$_SESSION['bibliotheque'].'" WHERE id_eleve="'.(int)$_SESSION['id_eleve'].'"';
        $bdd->query($requete);   
	}
}

}
header("Location:boutique.php");
 ?>
