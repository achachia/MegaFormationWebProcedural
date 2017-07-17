<?php

// controleurs

redirection_membre($_SESSION ['membre']['code_eleve']);
require root_dossier_modeles . '/' . $module . '/' . $action . '.php';
if (!empty($_GET['action_quiz']) || !empty($_GET['source_quiz'])) {
    $action_quiz = $_GET['action_quiz'];
    $source_quiz = $_GET['source_quiz'];
    if ($action_quiz == 'remake' || $source_quiz == 'page_result_quiz') {
        unset($_SESSION['quiz']);
    }
}


if (is_null($_SESSION['quiz']['id_question'])) {
    $random_quiz = $_GET['random_quiz'];
    $_SESSION['quiz']['parametres'] = parametres_quiz($random_quiz);
    $_SESSION['quiz']['tab_id_question'] = array_id_question($random_quiz);
    $_SESSION['quiz']['id_question'] = generer_id_question($_SESSION['quiz']['tab_id_question'],  $_SESSION['quiz']['parametres']['mode_affichage_question']);
    $_SESSION['quiz']['score'] = 0;
    $_SESSION['quiz']['date_start'] = date("Y-m-d H:i:s");
    $_SESSION['quiz'] ['compteur'] = 1;
    $_SESSION['quiz']['progression_travail'] = round($_SESSION['quiz'] ['compteur'] / $_SESSION['quiz']['parametres']['nbre_question'] * 100, 2);
    $_SESSION['theme']['progression_travail'] = 0;
}

$quiz = elements_quiz($_SESSION['quiz']['id_question']);
/*******************************************/


?>

