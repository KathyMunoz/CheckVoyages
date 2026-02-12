<?php
include './env.php';
include './Model/DestinationModel.php';
include './View/view_accueil.php';

try {
    $bdd = new PDO('mysql:host='.$_ENV['db_host'].';dbname='.$_ENV['db_name'].';charset=utf8mb4',$_ENV['db_user'],$_ENV['db_pwd'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    $accueilView = new AccueilView();
    $accueilView->setBdd($bdd);

    // Renvoie que le HTML des cartes aléatoires
    echo $accueilView->renderRandomCards();
} catch (Exception $e) {
    echo "Erreur lors du chargement des destinations.";
}
?>