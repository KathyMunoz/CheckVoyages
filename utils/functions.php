<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Function utilitaire de nettoyage: html nettoi les balises html, stripslashes suprimme les anti slash \, striptag supprime balises html et PHP et trim supprime les espaces
function sanitize($data) {
    return htmlentities(strip_tags(stripslashes(trim($data))));
}
?>