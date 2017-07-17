<?php

// controleurs

redirection_membre($_SESSION ['membre']['code_formateur']);
require root_dossier_modeles . '/' . $module . '/' . $action . '.php';
$keygen_dev=$_GET['token_dev'];
$keygen_exo=$_GET['keygen_exo'];
$infos_exo=get_infos_exo($keygen_exo,'exo_devoir');
$infos_dev=get_infos_devoir($keygen_dev);
$infos_module=get_infos_module($module,$action);
$list_eleves=list_eleves($keygen_exo);
$list_statut_code=list_statut_code();
$list_degre_message=list_degre_message();

?>

