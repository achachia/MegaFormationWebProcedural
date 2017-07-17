<?php

// controleurs

redirection_membre($_SESSION ['membre']['code_formateur']);
require root_dossier_modeles . '/' . $module . '/' . $action . '.php';
$infos_module=get_infos_module($module,$action);
$keygen_dev=$_GET['token_devoir'];
$liste_plate_forme_travail=liste_plate_forme_travail();
$infos_dev=get_infos_devoir($keygen_dev);
$infos_exo=array();


?>

