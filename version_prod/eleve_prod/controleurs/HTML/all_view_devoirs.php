<?php

// controleurs

redirection_membre($_SESSION ['membre']['code_eleve']);
require root_dossier_modeles . '/' . $module . '/' . $action . '.php';
$keygen_module=get_keygen_module($module,$action);
$list_devoirs=list_devoirs($keygen_module,$_SESSION ['membre'] ['keygen_groupe'],$_SESSION ['membre']['code_eleve']);
$list_difficulte_dev=list_difficulte_dev();

?>

