<?php 
//on récupére les librairies nécessaires
 require_once "core/database.php";
 require_once "core/utils.php";
 
//on vérifie si GET n'est pas vite et que c'est bien un nombre
if( !empty($_GET['id']) && ctype_digit ($_GET['id'])){
    $garageId = $_GET['id']; 
}

//si garage_id est vide
if(!$garageId){
    die('oupsi');
}


//on trouve le garage 
$garage = findGarageById($garageId);

//si le garage n'existe pas 
if($garage == 0){
   die("ce garage n'existe pas");
}

//on supprime le garage
deleteGarage($garageId);

//on redirige 
redirect("index.php");



