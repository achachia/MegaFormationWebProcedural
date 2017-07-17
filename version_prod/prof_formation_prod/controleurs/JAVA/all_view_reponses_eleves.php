<?php

// controleurs

redirection_membre($_SESSION ['membre']['code_formateur']);
require root_dossier_modeles . '/' . $module . '/' . $action . '.php';
$keygen_exo=$_GET['keygen_exo'];
$infos_exo=infos_exo($keygen_exo);
$list_eleves=list_eleves($keygen_exo);
$list_statut_code=list_statut_code();
$list_degre_message=list_degre_message();


?>

