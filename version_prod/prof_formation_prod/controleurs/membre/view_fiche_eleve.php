<?php

// controleurs

redirection_membre($_SESSION ['membre']['code_formateur']);
require root_dossier_modeles . '/' . $module . '/' . $action . '.php';
$code_eleve = $_GET['code_eleve'];
$infos_user = infos_user($code_eleve);
?>

