<?php

// controleurs

redirection_membre($_SESSION ['membre']['code_formateur']);
require root_dossier_modeles . '/' . $module . '/' . $action . '.php';
$keygen_theme=$_GET['token_theme'];
$keygen_exo=$_GET['token_exo'];
$infos_exo=infos_exo($keygen_exo);
$list_eleves=list_eleves($keygen_exo);
$list_statut_code=list_statut_code();
$list_degre_message=list_degre_message();
$infos_module=get_infos_module($module,$action);
$infos_theme=get_infos_theme($keygen_theme);

?>

