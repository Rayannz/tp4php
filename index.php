<?php session_start(); ?> 
<?php include "vues/header.php";

$uc =empty($_GET['uc']) ? "acceuil": $_GET['uc'];

switch($uc){
    case 'acceuil' :
        include('vues/acceuil.php');
        break;  
    case 'continent' :
        break;  
}
include "vues/footer.php";?> 