<?php

// controleurs

redirection_membre($_SESSION ['membre']['code_formateur']);
require root_dossier_modeles . '/' . $module . '/' . $action . '.php';
$keygen_theme=$_GET['token_theme'];
$keygen_exo=$_GET['keygen_exo'];
$liste_plate_forme_travail=liste_plate_forme_travail();
$infos_exo=infos_exo($keygen_exo);
$infos_module=get_infos_module($module,$action);
$infos_theme=get_infos_theme($keygen_theme);


?>
