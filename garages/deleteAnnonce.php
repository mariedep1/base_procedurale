<?php 

require_once "core/database.php"; 
require_once "core/utils.php"; 
//on vérifie si GET n'est pas vite et que c'est bien un nombre
if( !empty($_GET['id']) && ctype_digit ($_GET['id']) ){
    $annonceId = $_GET['id']; 
}

//si $annonceId est vide
if(!$annonceId){
    die('oupsi');
}

//on trouve l'annonce
$annonce =  findAnnonce($annonceId);


//Si l'annonce n'existe pas
if(!$annonce){
   die("ce garage n'existe pas");
}

//on supprime l'annonce
deleteAnnonce($annonceId);

redirect('garage.php?id='.$annonce['garage_id']);

