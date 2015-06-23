<?php
try{
    $pdo = new PDO('sqlite:'.dirname(__FILE__).'/data.db');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // ERRMODE_WARNING | ERRMODE_EXCEPTION | ERRMODE_SILENT
} catch(Exception $e) {
    echo "Impossible d'accéder à la base de données SQLite : ".$e->getMessage();
    die();
}
//echo '<pre>';
//$stmt = $pdo->prepare("SELECT * FROM rendezvous WHERE id = :id");
//$stmt->execute(array('id' => 1));
//$result = $stmt->fetchAll();
//print_r($result);
//echo '</pre>';