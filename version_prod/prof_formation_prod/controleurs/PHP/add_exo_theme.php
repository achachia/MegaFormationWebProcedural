<?php

// controleurs

redirection_membre($_SESSION ['membre']['code_formateur']);
require root_dossier_modeles . '/' . $module . '/' . $action . '.php';
$keygen_theme=$_GET['token_theme'];
$keygen_module=get_keygen_module($module, $action);
$liste_plate_forme_travail=liste_plate_forme_travail();
$infos_module=get_infos_module($module,$action);
$infos_theme=get_infos_theme($keygen_theme);


?>
