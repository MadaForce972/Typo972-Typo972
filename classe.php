<?php 
session_start();
include 'includes/connection.php';
if(isset($_SESSION['voyage'])) { header("Location:index.php"); }
if(isset($_GET['classe'])) {
if($_GET['classe']=="6ieme") $_SESSION['classe']="6iemeA";
if($_GET['classe']=="5ieme") $_SESSION['classe']="5iemeA";
if($_GET['classe']=="4ieme") $_SESSION['classe']="4iemeA";
if($_GET['classe']=="3ieme") $_SESSION['classe']="3iemeA";
header("Location:aeroport.php");

}


 ?>
