<?php
    session_start();

    // Détruire toutes les données de session
    session_destroy();

    header("Location: index.php");
    exit;
?>