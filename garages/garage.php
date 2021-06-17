<?php 
//on récupères les librairies nécessaires
require_once "core/database.php"; 
require_once "core/utils.php"; 

//on verifie GET['id'] et on l'assigne à la variable $garageId
$garageId = null;
if( !empty($_GET['id']) && ctype_digit ($_GET['id'])){
    $garageId = $_GET['id']; 
}

//si $garageId est vide
if(!$garageId){
    die('il faut rentrer un id');
}

//on trouve le garage
$garage = findGarageById($garageId); 

//on fixe le titre de la page
$titreDeLaPage = $garage['name']; 


//On recupére toutes les annonces du garage
$annonces = findAllAnnoncesByGarage($garageId);

render("garages/garage", 
    compact('garage','annonces', 'titreDeLaPage')); 

