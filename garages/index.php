<?php 

//on récupère les librairies nécessaires

require_once "core/database.php";
require_once "core/utils.php";



//on récupère tous les garages
$garages = findAllGarages(); 


//on fixe le titre de la page
$titreDeLaPage = "Garages"; 


//on affiche
render("garages/garages", 
        compact('garages', 'titreDeLaPage')); 