<?php

// controleurs

redirection_membre($_SESSION ['membre']['code_eleve']);

require root_dossier_modeles . '/' . $module . '/' . $action . '.php';
$mod_statistique = $_GET['mod_statistique'];
if(empty($mod_statistique)){
    $mod_statistique = 'section';
}
if ($mod_statistique == 'section') {
    $title = ' PROGRESSION DU REUSSITE PAR SECTION';
    $list_sujets = list_section($_SESSION ['membre']['code_eleve'], $_SESSION ['membre']['id_niveau_eleve'], $_SESSION['code_matiere']);
} elseif ($mod_statistique == 'theme') {
    $title = ' PROGRESSION DU REUSSITE PAR THEME';
    $list_sujets = list_themes($_SESSION ['membre']['code_eleve'], $_SESSION ['membre']['id_niveau_eleve'], $_SESSION['code_matiere']);
} elseif ($mod_statistique == 'quiz') {
    $title = ' PROGRESSION DU REUSSITE PAR QUIZ';
    $list_sujets = list_quiz($_SESSION ['membre']['code_eleve'], $_SESSION ['membre']['id_niveau_eleve'], $_SESSION['code_matiere']);
}
arsort($list_sujets);
if (isset($_SESSION['quiz'])) {
    unset($_SESSION['quiz']);
}

?>
