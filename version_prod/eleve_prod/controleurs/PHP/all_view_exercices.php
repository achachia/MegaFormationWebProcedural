<?php

// controleurs

redirection_membre($_SESSION ['membre']['code_eleve']);
require root_dossier_modeles . '/' . $module . '/' . $action . '.php';
$keygen_theme=$_GET['token_theme'];
$list_exercices_php=list_exercices($keygen_theme,$_SESSION ['membre'] ['keygen_groupe'],$_SESSION ['membre']['code_eleve']);
$list_statut_eval_corrige=list_degre_comprehension_corrige();
$list_difficulte_exo=list_difficulte_exo();


?>