<?php
include './utils/functions.php';

// On détruit la session
session_destroy();

// On affiche un message de remerciement
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Déconnexion - CheckVoyages</title>
    <link rel="stylesheet" href="./src/style/style-index.css">
    <style>
        .logout-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
            font-family: 'Manrope', sans-serif;
        }
        .logout-container h1 {
            color: rgb(255 113 12);
            margin-bottom: 20px;
        }
        .btn-home {
            text-decoration: none;
            color: black;
            border: solid 2px rgb(255 113 12);
            border-radius: 15px;
            padding: 10px 20px;
            transition: background 0.3s;
        }
        .btn-home:hover {
            background: rgb(255 221 197);
        }
    </style>
</head>
<body>
    <div class="logout-container">
        <h1>Merci de votre visite !</h1>
        <p>Vous avez été déconnecté avec succès.</p>
        <br>
        <a href="index.php" class="btn-home">Retour à l'accueil</a>
    </div>
</body>
</html>
