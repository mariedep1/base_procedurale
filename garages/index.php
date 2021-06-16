<?php 

// moteur: mysql hote: localhost db:garages user:garage mdp: garage

$user = "garage";
$password = "garage"; 

$myConnection = new PDO('mysql:host=localhost;dbname=garages', $user, $password, [ 
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
] );

//on récupère les garages
$resultat = $myConnection ->query('SELECT * FROM garages'); 
$garages = $resultat->fetchAll();

$titreDeLaPage = "Garages"; 


//on active la mémoire tampon 

ob_start();

require_once "templates/garages/garages.html.php";

//on stoppe la mémoire tampon

$contenuDeLaPage = ob_get_clean();


require_once "templates/layout.html.php";
