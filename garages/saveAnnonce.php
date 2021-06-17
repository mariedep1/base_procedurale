<?php
//on récupère les librairies nécessaires
require_once "core/database.php";
require_once "core/utils.php";

//on initialise les variables
$annonceName = null; 
$annoncePrice = null; 
$garageId = null; 

if(!empty($_POST['garageId']) && ctype_digit($_POST['garageId']) ){
    $garageId = $_POST['garageId'];
}

if(!empty($_POST['name']) ){
    $annonceName = htmlspecialchars($_POST['name']);
}

if(!empty($_POST['price']) ){
    $annoncePrice = htmlspecialchars($_POST['price']);
}

if( !$garageId || !$annonceName || !$annoncePrice ){
    die("formulaire mal rempli $garageId, $annonceName, $annoncePrice");
    
}



//on trouve un garage
$garage = findGarageById($garageId);

//si le garage n'existe pas 
if(!$garage){
     die("ce garage n'existe pas");
}

//on crée une annonce
insertAnnonce($annonceName, $annoncePrice, $garageId);

redirect("garage.php?id=".$garageId);
 