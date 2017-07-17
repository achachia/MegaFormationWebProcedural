<?php

// controleurs

redirection_membre($_SESSION ['membre']['code_eleve']);
require root_dossier_modeles . '/' . $module . '/' . $action . '.php';
$random_theme = $_GET['random_theme'];
$nom_theme = infos_theme($random_theme);
//$list_quiz=list_quiz($random_theme,$_SESSION  ['membre']['code_eleve']);
//$nbr_quiz = sizeof($list_quiz);
$nbr_quiz = get_nomber_quiz($random_theme, $_SESSION ['membre']['code_eleve']);
$nbr_pages = ceil($nbr_quiz / $item_per_page);
if (isset($_SESSION['quiz'])) {
    unset($_SESSION['quiz']);
}


?>
