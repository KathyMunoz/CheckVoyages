<?php
include './Model/DestinationModel.php';
include './View/view_accueil.php';

try {
    $bdd = new PDO('mysql:host=localhost;dbname=checkvoyages;charset=utf8mb4', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    $accueilView = new AccueilView();
    $accueilView->setBdd($bdd);

    // On ne renvoie que le HTML des cartes aléatoires
    echo $accueilView->renderRandomCards();
} catch (Exception $e) {
    echo "Erreur lors du chargement des destinations.";
}
?>