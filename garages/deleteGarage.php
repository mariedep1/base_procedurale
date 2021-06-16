<?php 
 
//on vérifie si GET n'est pas vite et que c'est bien un nombre
if( !empty($_GET['id']) && ctype_digit ($_GET['id'])){
    $garageId = $_GET['id']; 
}

//si garage_id est vide
if(!$garageId){
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

//on fait la requête pour vérifier l'existence du garage 
$maRequete = $pdo->prepare('SELECT * FROM garages WHERE id = :garage_id');
$maRequete ->execute(array(':garage_id'=>$garageId));
$garage = $maRequete->rowCount();

//si le garage n'existe pas 
if($garage == 0){
   die("ce garage n'existe pas");
}

//si le garage existe, on effectue la requête de suppression
$requeteDelete = $pdo->prepare('DELETE FROM garages WHERE id = :garage_id');
$requeteDelete ->execute([':garage_id'=>$garageId]);
header("Location: index.php");



