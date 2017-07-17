<?php

// controleurs

redirection_membre($_SESSION ['membre']['code_formateur']);
require root_dossier_modeles . '/' . $module . '/' . $action . '.php';
$keygen_theme=$_GET['token_theme'];
$keygen_exo=$_GET['token_exo'];
$keygen_liaison=$_GET['token_liaison'];
$liste_mode_groupe_users=liste_mode_groupe_users();
$liste_groupe_users=liste_groupe_users();
$liste_users=liste_users();
$infos_module=get_infos_module($module,$action);
$infos_theme=get_infos_theme($keygen_theme);
$infos_exo=get_infos_exo($keygen_exo);
$infos_liaison=get_infos_liaison($keygen_liaison);



?>

