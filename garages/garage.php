<?php 

//on verifie GET['id'] et on l'assigne à la variable $garageId
$garageId = null;
if( !empty($_GET['id']) && ctype_digit ($_GET['id'])){
    $garageId = $_GET['id']; 
}

//si $garageId est vide
if(!$garageId){
    die('il faut rentrer un id');
}

//on fait la connexion
$user = "garage";
$password = "garage"; 
$pdo = new PDO('mysql:host=localhost;dbname=garages', $user, $password, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
]);

//On récupère le garage grace à son id 
$resultat = $pdo->prepare('SELECT * FROM garages WHERE id = :garage_id');
$resultat ->execute(array(':garage_id'=>$garageId));
$garage = $resultat->fetch();

$titreDeLaPage = "Garage"; 


//On recupére toutes les annonces par l'id du garage
$resultat = $pdo ->prepare('SELECT * FROM annonces WHERE garage_id=:garage_id'); 
$resultat ->execute(array(':garage_id'=>$garageId));

$annonces = $resultat->fetchAll();

//on démarre la mémoire tampon 
ob_start();

require_once "templates/garages/garage.html.php"; 

//on récupère les données et on arrête la mémoire tampon 
$contenuDeLaPage = ob_get_clean();

require_once "templates/layout.html.php"; 

