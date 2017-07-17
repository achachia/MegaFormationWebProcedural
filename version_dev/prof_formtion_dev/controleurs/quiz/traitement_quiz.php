<?php

session_start();
session_regenerate_id();
$date_milieu = date("Y-m-d H:i:s");
$check = FALSE;
/* * *********************include les fichiers de travail *************** */
require_once './../../connection/config.php';
require_once './../../librairie/fonctions_local.php';
require_once root_dossier_modeles.'/quiz/exec_quiz.php';
ini_set('date.timezone', 'Europe/Paris');

/* * **************************************************** */
$key_tab = $_SESSION['quiz']['id_question'];

/* * **************************************************** */
if ($_SESSION['quiz']['parametres']['type_quiz'] == 'checkbox') {
    /*     * ************** QCM multiple******************************* */
    $name_input = substr($_SESSION['quiz']['parametres']['name_quiz'], 0, -2);
    if (sizeof($_POST[$name_input]) == 0) {
        $check = TRUE;
    } else {
        foreach ($_POST[$name_input] as $key => $value) {
            try {
                $sql = " SELECT  point FROM  Reponse_question   WHERE id_reponse=:param  ";
                $resultat = $cxn->prepare($sql);
                $resultat->bindParam(':param', $value);
                $resultat->execute();
                $enregistrement = $resultat->fetch();
                $_SESSION['quiz']['score'] = $_SESSION['quiz']['score'] + $enregistrement['point'];
                //  $_SESSION['quiz']['liste_reponses'][] = $value . '-' . $enregistrement['point'];
            } catch (Exception $e) {
                echo "Une erreur est survenue lors de la récupération des données";
            }
            $_SESSION['quiz']['listes_reponses'][$key_tab][] = $value;
        }
    }
}



/* * ******************************************************* */
if ($_SESSION['quiz']['parametres']['type_quiz'] == 'radio') {
    /*     * *********************** QCM Simple********************** */
    $name_input = $_SESSION['quiz']['parametres']['name_quiz'];
    if (sizeof($_POST[$name_input]) == 0) {
        $check = TRUE;
    } else {
        $id_reponse = $_POST[$name_input];

        /*         * ****************** resultat-points ********************** */
        try {
            $sql = " SELECT  point FROM  Reponse_question   WHERE id_reponse=:param  ";
            $resultat = $cxn->prepare($sql);
            $resultat->bindParam(':param', $id_reponse);
            $resultat->execute();
            $enregistrement = $resultat->fetch();
            $_SESSION['quiz']['score'] = $_SESSION['quiz']['score'] + $enregistrement['point'];
            $_SESSION['quiz']['liste_reponses'][] = $id_reponse . '-' . $enregistrement['point'];
        } catch (Exception $e) {
            echo "Une erreur est survenue lors de la récupération des données";
        }
        $_SESSION['quiz']['listes_reponses'][$key_tab][] = $id_reponse;
    }
}
if (!$check) {
    /*     * ************************ supprimer identifiant de la question de tableau des valeurs des identifiants******************************* */

    $key = array_search($_SESSION['quiz']['id_question'], $_SESSION['quiz']['tab_id_question']);
    unset($_SESSION['quiz']['tab_id_question'][$key]);
    if ($_SESSION['quiz']['parametres']['mode_affichage_question'] == '2') {
        $_SESSION['quiz']['tab_id_question'] = reordonner_cle_tab($_SESSION['quiz']['tab_id_question']);
    }
    // var_dump($_SESSION['quiz']['tab_id_question']);
    /*     * *************** Calcul progession de reussite***************************** */
    $_SESSION['quiz']['progression_reussite'] = round($_SESSION['quiz']['score'] / $_SESSION['quiz']['parametres']['total_points_quiz'] * 100, 2);

    /*     * *************** incrementation du compteur***************************** */

    $_SESSION['quiz'] ['compteur'] ++;
}



/* * **************** redirection *************************** */
if (sizeof($_SESSION['quiz']['tab_id_question']) > 0) {
    if (!$check) {
        /*         * *********************** incrementer le compteur des questions******************** */

        /*         * ************** Calcul la progression de travail ************************ */
        $_SESSION['quiz']['progression_travail'] = round($_SESSION['quiz'] ['compteur'] / $_SESSION['quiz']['parametres']['nbre_question'] * 100, 2);

        /*         * ************************************************************************** */
        $_SESSION['quiz']['id_question'] = generer_id_question($_SESSION['quiz']['tab_id_question'], $_SESSION['quiz']['parametres']['mode_affichage_question']);
        $lien = url_espace_eleve . '/index.php?module=quiz&action=exec_quiz';
    } else {
        $lien = url_espace_eleve . '/index.php?module=quiz&action=exec_quiz&code_erreur=message_erreur_1';
    }
} else {
    /*     * ****************** calcul le duree effectue par le quizeur *************************** */

    $date_end = date("Y-m-d H:i:s");
    $dure_traitement = difference_entre_2_dates($date_end, $date_milieu);
    $dure_total = difference_entre_2_dates($date_end, $_SESSION['quiz']['date_start']);
    $_SESSION['quiz']['temps_effectue'] = $dure_total - $dure_traitement;
    /*     * **************** serialiser la listes des reponses *********************** */
    $liste_reponses_serialise = serialize($_SESSION['quiz']['listes_reponses']);

    /*     * ***************** Enregistrement la progression-reussite dans la table Resultat-quiz*************************** */
    insert_result_quiz($_SESSION ['membre']['code_eleve'], $_SESSION['quiz']['parametres']['id_quiz'], $_SESSION['quiz']['progression_reussite'], $_SESSION['quiz']['score'], $_SESSION['quiz']['temps_effectue'], $liste_reponses_serialise);

    /*     * ***************** Compter le nombre de quiz faite par l'eleve par theme************************* */

    try {
        $sql = "   SELECT COUNT( Resultat_quiz.id_quiz ) AS nbre_quiz_effectue_par_theme
                   FROM Resultat_quiz, Quiz, Theme_quiz
                   WHERE Resultat_quiz.id_quiz = Quiz.id_quiz
                   AND Quiz.id_quiz_theme = Theme_quiz.id_theme
                   AND Resultat_quiz.code_user =:param1
                   AND Theme_quiz.id_theme =:param2 ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $_SESSION ['membre']['code_eleve']);
        $resultat->bindParam(':param2', $_SESSION['quiz']['parametres']['id_theme_quiz']);
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $nbre_quiz_effectue_theme = $enregistrement['nbre_quiz_effectue_par_theme'];
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données1";
    }
    /*     * ****************A jour la progression de travail par theme ************************ */

    $_SESSION['theme']['progression_travail'] = round($nbre_quiz_effectue_theme / $_SESSION['quiz']['parametres']['nbre_quiz_par_theme'] * 100, 2);
    /*     * ***************** Enregistrement la progression-travail par theme  dans la table Progression_theme_quiz*************************** */

    insert_progression_theme($_SESSION ['membre']['code_eleve'], $_SESSION['quiz']['parametres']['id_theme_quiz'], $_SESSION['theme']['progression_travail']);

    /*     * ***************** Enregistrement la progression-reussite par theme  dans la table Progression_reussite_theme ************************* */

    insert_progression_reussite_theme($_SESSION ['membre']['code_eleve'], $_SESSION['quiz']['parametres']['id_theme_quiz']);

    /*     * ***************** Enregistrement la progression-travail par section dans la table Progression_section_quiz*************************** */

    insert_progression_section($_SESSION ['membre']['code_eleve'], $_SESSION['quiz']['parametres']['id_section']);
    /*     * **************************************  Mise a jour les valeurs de sessions de progression de travail et de reussite ************************************* */
    /*     * ****************** progression generale ******************************** */
    $_SESSION['progression_generale_reussite']['taux'] = calcul_progression_generale_reussite($_SESSION ['membre']['code_eleve']);
    $_SESSION['progression_generale_reussite']['class'] = get_class_progression($_SESSION['progression_generale_reussite']['taux']);
    $_SESSION['progression_generale_travail']['taux'] = calcul_progression_generale_travail($_SESSION ['membre']['id_niveau_eleve'], $_SESSION ['membre']['code_eleve']);
    $_SESSION['progression_generale_travail']['class'] = get_class_progression($_SESSION['progression_generale_travail']['taux']);
    /*     * ************************* progression par matiere ************************************ */
    $_SESSION['progression_matiere_reussite']['taux'] = calcul_progression_matiere_reussite($_SESSION ['membre']['code_eleve'], $_SESSION['code_matiere']);
    $_SESSION['progression_matiere_reussite']['class'] = get_class_progression($_SESSION['progression_matiere_reussite']['taux']);
    $_SESSION['progression_matiere_travail']['taux'] = calcul_progression_generale_travail($_SESSION ['membre']['id_niveau_eleve'], $_SESSION ['membre']['code_eleve'], $_SESSION['code_matiere']);
    $_SESSION['progression_matiere_travail']['class'] = get_class_progression($_SESSION['progression_matiere_travail']['taux']);
    
    /****************************** Mise a jour le total des points ********************/
    $_SESSION ['membre'] ['total_points'] = get_total_points($_SESSION ['membre'] ['code_eleve']);

    /*     * *********************************************************************************** */
    $lien = url_espace_eleve . '/index.php?module=quiz&code_matiere=' . $_SESSION['code_matiere'] . '&action=result_quiz';
}


header("Location: $lien");


