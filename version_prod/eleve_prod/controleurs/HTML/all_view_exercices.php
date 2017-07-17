<?php

// controleurs

redirection_membre($_SESSION ['membre']['code_eleve']);
require root_dossier_modeles . '/' . $module . '/' . $action . '.php';
$list_exercices_html=list_exercices('1');
$list_statut_eval_corrige=list_degre_comprehension_corrige();
$list_difficulte_exo=list_difficulte_exo();

?>