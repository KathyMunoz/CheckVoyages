<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Function utilitaire de nettoyage
function sanitize($data) {
    return htmlentities(strip_tags(stripslashes(trim($data))));
}
?>