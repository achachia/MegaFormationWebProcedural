<?php

// controleurs

redirection_membre($_SESSION ['membre']['code_eleve']);
require root_dossier_modeles . '/' . $module . '/' . $action . '.php';
$keygen_devoir=$_GET['token_devoir'];
$list_exercices=list_exercices($keygen_devoir);
$list_statut_eval_corrige=list_degre_comprehension_corrige();
$list_difficulte_exo=list_difficulte_exo();

?>

