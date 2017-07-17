<?php

session_start();
session_regenerate_id();
$date = date("Y-m-d H:i:s");
$check = TRUE;
$code_matiere = $_POST['code_matiere'];
$_SESSION['form_choix_programme']['erreur'] = '';
/* * *********************include les fichiers de travail *************** */
require_once './../../connection/config.php';
require_once './../../librairie/fonctions_local.php';
require_once root_dossier_modeles.'/quiz/choix_programme_matiere.php';
ini_set('date.timezone', 'Europe/Paris');
$list_erreur = array();
/* * ********************************************** */

if (sizeof($_POST['choix_programme_matiere']) > 0) {
    /*     * *************** Intersion dans la base de donnée *************************** */
    foreach ($_POST['choix_programme_matiere'] as $key => $value) {
        $id_theme = recuperer_id_theme($value);
        try {
            $sql = " INSERT INTO  programme_eleve_matiere  (code_user,id_theme) VALUES (:param1,:param2)";
            $resultat = $cxn->prepare($sql);
            $resultat->bindParam(':param1', $_SESSION ['membre']['code_eleve']);
            $resultat->bindParam(':param2', $id_theme);
            $resultat->execute();
        } catch (Exception $e) {
            echo "Une erreur est survenue lors de la récupération des données";
            $check = FALSE;
        }
    }
    /*     * **************************************  Mise a jour les valeurs de sessions de progression de travail et de reussite ************************************* */
    /*     * ****************** progression generale ******************************** */
    $_SESSION['progression_generale_travail']['taux'] = calcul_progression_generale_travail($_SESSION ['membre']['id_niveau_eleve'], $_SESSION ['membre']['code_eleve']);
    $_SESSION['progression_generale_travail']['class'] = get_class_progression($_SESSION['progression_generale_travail']['taux']);
    /*     * ************************* progression par matiere ************************************ */
    $_SESSION['progression_matiere_travail']['taux'] = calcul_progression_generale_travail($_SESSION ['membre']['id_niveau_eleve'], $_SESSION ['membre']['code_eleve'], $_SESSION['code_matiere']);
    $_SESSION['progression_matiere_travail']['class'] = get_class_progression($_SESSION['progression_matiere_travail']['taux']);

    /*     * *********************************************************************************** */

    $lien = url_espace_eleve . '/index.php?module=quiz&action=choix_programme_matiere&code_matiere=' . $code_matiere . '&result=succees';
} else {
    /*     * ************** verifier au niveau la base de donnée si l'eleve a chois ca selection precedement ************ */
    try {
        $sql = "  SELECT id_programme  FROM  programme_eleve_matiere  WHERE  code_user='" . $_SESSION ['membre']['code_eleve'] . "' ";
        $select = $cxn->query($sql);
        $nb = $select->rowCount();
        if ($nb <= 0) {
            $_SESSION['form_choix_programme']['erreur'] = 'Vous devez choisir votre selection';
            $check = FALSE;
            $lien = url_espace_eleve . '/index.php?module=quiz&action=choix_programme_matiere&code_matiere=' . $code_matiere . '&result=echec';
        } else {
            $lien = url_espace_eleve . '/index.php?module=quiz&action=choix_programme_matiere&code_matiere=' . $code_matiere;
        }
    } catch (Exception $e) {
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql);
    }
}

header("Location: $lien");
?>




