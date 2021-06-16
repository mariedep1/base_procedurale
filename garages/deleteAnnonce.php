<?php 

//on vérifie si GET n'est pas vite et que c'est bien un nombre
if( !empty($_GET['id']) && ctype_digit ($_GET['id']) ){
    $annonceId = $_GET['id']; 
}

//si $annonceId est vide
if(!$annonceId){
    die('oupsi');
}

//on fait la connexion à la db
$user = "garage";
$password = "garage"; 
$pdo = new PDO('mysql:host=localhost;dbname=garages', $user, $password, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
]);

//on fait la requete pour verifier si l'annonce existe 
$maRequete = $pdo->prepare('SELECT * FROM annonces WHERE id = :annonce_id');
$maRequete ->execute(array(':annonce_id'=>$annonceId));

$annonce =  $maRequete->fetch();

//on recupère garage_id de l'annonce
$garageId= $annonce['garage_id'];

//Si fetch renvoit false
if(!$annonce){
   die("ce garage n'existe pas");
}

//si l'annonce existe, on fait la requete de suppression
$requeteDeleteAnnonce = $pdo->prepare('DELETE FROM annonces WHERE id = :annonce_id');
$requeteDeleteAnnonce ->execute([':annonce_id'=>$annonceId]);
header("Location: garage.php?id=$garageId");

