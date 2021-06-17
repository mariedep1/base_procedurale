<?php 

/**
 * 
 * trouve PDO
 * @return PDO
 */
function getPdo() :PDO{

    $pdo = new PDO('mysql:host=localhost;dbname=garages', 'garage', 'garage', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
    ]);
    
    return $pdo;

}

/**
 * 
 * Retourne un tableau avec tous les garages de la table garage
 * @return array
 */

function findAllGarages() :array{

    $pdo = getPdo(); 
    $resultat = $pdo ->query('SELECT * FROM garages'); 
    $garages = $resultat->fetchAll();
    return $garages; 

}

/**
 * trouve un garage par son id
 * retourne un tableau ou un booléen s'il n'existe pas
 * @param  integer $garageId
 * @return array|bool
 */

function findGarageById(int $garageId) {

    $pdo = getPdo();
    $resultat = $pdo->prepare('SELECT * FROM garages WHERE id = :garage_id');
    $resultat ->execute(array(':garage_id'=>$garageId));
    $garage = $resultat->fetch();

    return $garage;     

}

/**
 * retourne un tableau avec toutes les annonces d'un garage
 * @param integer $garageId
 * @return array|bool
 * 
 */

function findAllAnnoncesByGarage(int $garageId){
    $pdo = getPdo();
    $resultat = $pdo ->prepare('SELECT * FROM annonces WHERE garage_id=:garage_id'); 
    $resultat ->execute(array(':garage_id'=>$garageId));
    $annonces = $resultat->fetchAll();
    return $annonces;
}


/**
 * trouve une annonce par son id
 * retourne un tableau ou un booléen booléen s'elle n'existe pas
 * @param integer $annonceId
 * @return array|bool
 */

function findAnnonce(int $annonceId) {
    $pdo=getPdo(); 
    $maRequete = $pdo->prepare('SELECT * FROM annonces WHERE id = :annonce_id');
    $maRequete ->execute(array(':annonce_id'=>$annonceId));
    $annonce =  $maRequete->fetch();
    return $annonce; 

}

/**
 * 
 * Supprime une annonce grâce à son id
 * @param integer $annonceId
 * @return void
 */

function deleteAnnonce(int $annonceId) :void{
    $pdo=getPdo(); 
    $requeteDeleteAnnonce = $pdo->prepare('DELETE FROM annonces WHERE id = :annonce_id');
    $requeteDeleteAnnonce ->execute([':annonce_id'=>$annonceId]);
}

/**
 * 
 * supprime un garage grâce à l'id du garage (et ses annonces s'il en a)
 * @param integer $garageId
 * @return void
 */
function deleteGarage(int $garageId) :void{
    $pdo=getPdo(); 
    $requeteDelete = $pdo->prepare('DELETE FROM garages WHERE id = :garage_id');
    $requeteDelete ->execute([':garage_id'=>$garageId]);
}

/**
 * 
 * Ajoute une annonce dans la base de données 
 * @param string $name
 * @param integer $price
 * @param integer $garageId
 * @return void
 */


function insertAnnonce(string $name, int $price, int $garageId) :void{

    $pdo = getPdo();

    $maRequeteSaveAnnonce = $pdo->prepare("INSERT INTO annonces(name, price, garage_id) VALUES (:nom, :prix, :garage_id)");
    $maRequeteSaveAnnonce ->execute(['nom'=>$name, 
                        'prix'=>$price,
                        'garage_id'=>$garageId]);
    
}



