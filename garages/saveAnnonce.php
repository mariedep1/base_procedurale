<?php

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

$user = "garage";
$password = "garage"; 
$pdo = new PDO('mysql:host=localhost;dbname=garages', $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
]);

$maRequete = $pdo->prepare('SELECT * FROM garages WHERE id = :garage_id');
$maRequete ->execute(array('garage_id'=>$garageId));
$garage = $maRequete->fetch();

//si le garage n'existe pas 
if(!$garage){
     die("ce garage n'existe pas");
}
                               
$maRequeteSaveAnnonce = $pdo->prepare("INSERT INTO annonces(name, price, garage_id) VALUES (:nom, :prix, :garage_id)");
$maRequeteSaveAnnonce ->execute(['nom'=>$annonceName, 
                    'prix'=>$annoncePrice,
                    'garage_id'=>$garageId]);

header("Location: garage.php?id=$garageId");
 