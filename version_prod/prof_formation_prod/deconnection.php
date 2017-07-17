<?php

session_start();
require_once './connection/config.php';
if (isset($_SESSION['membre']['code_formateur'])) {
    $_SESSION = array();
}
session_destroy();
if (!isset($_SESSION['membre']['code_formateur'])) {
    $lien = url_espace_formateur_prod . '/login.php?message_deconnection-1=deconnection_admin';

    header("Location: $lien");
    exit();
}
?>


