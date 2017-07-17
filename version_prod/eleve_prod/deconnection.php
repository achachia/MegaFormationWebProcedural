<?php

session_start();
require_once './connection/config.php';
if (isset($_SESSION['membre']['code_eleve'])) {
    $_SESSION = array();
}
session_destroy();
if (!isset($_SESSION['membre']['code_eleve'])) {
    $lien = url_espace_eleve_prod . '/login.php?message_deconnection-1=deconnection_admin';

    header("Location: $lien");
    exit();
}
?>


