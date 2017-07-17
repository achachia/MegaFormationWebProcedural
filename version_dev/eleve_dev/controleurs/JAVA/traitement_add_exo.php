<?php

session_start();
session_regenerate_id();
require_once './../../connection/config.php';
require_once './../../librairie/fonctions_local.php';
ini_set('date.timezone', 'Europe/Paris');
$etat = TRUE;
$list_erreur = array();
$date_created = date("Y-m-d H:i:s");
$titre_exo = unhtmlentities($_POST['titre_exo']);
$contenu_exo = unhtmlentities($_POST['contenu_exo']);
$select_etat_exo = unhtmlentities($_POST['select_etat_exo']);
$date_publication = unhtmlentities($_POST['date_publication']);
$code_intervenant = $_SESSION ['membre']['code_intervenant'];
$id_theme = unhtmlentities($_POST['id_theme']);



//if ($nom_quiz == '' || $type_quiz == '' || $difficulte_quiz == '' || $description_quiz == '' || $nbr_question == '' || $score_requis == '' || $random_theme == '' || $nbr_essai == '' || $tag == '' || $mode_affichage_question == '') {
//    if ($nom_quiz == '') {
//        $list_erreur['nom_quiz'] = fa_warring . ' Le champ Nom  ne doit pas etre vide';
//    }
//    if ($type_quiz == '') {
//        $list_erreur['select_type_quiz'] = fa_warring . ' Le champ Type du quiz  doit etre selectionné';
//    }
//    if ($difficulte_quiz == '') {
//        $list_erreur['select_difficulte_quiz'] = fa_warring . ' Le champ difficulté du quiz  doit etre saisi';
//    }
//    if ($description_quiz == '') {
//        $list_erreur['description_quiz'] = fa_warring . ' Le champ description du quiz doit etre saisi';
//    }
//    if ($nbr_question == '') {
//        $list_erreur['nbr_question'] = fa_warring . ' Le champ nombre de question du quiz  doit etre saisi';
//    }
//
//    if ($mode_affichage_question == '') {
//        $list_erreur['mode_affichage_question'] = fa_warring . ' Le champ Ordre d\'affichage du quiz  doit etre selectionné';
//    }
//
//    if ($tag == '') {
//        $list_erreur['tag_quiz'] = fa_warring . ' Le champ tag du quiz   doit etre saisi';
//    }
//    if ($date_publication == '') {
//        $list_erreur['date_publication'] = fa_warring . ' Le champ date de publication du quiz   doit etre saisi';
//    }
//
//    if ($random_theme == '') {
//        // echo '5-8';
//    }
//    $etat = FALSE;
//}
//if (isset($_POST['select_partage_eleve_quiz'])) {
//    $mode_partage_eleve = unhtmlentities($_POST['select_partage_eleve_quiz']);
//    if ($mode_partage_eleve == '') {
//        $list_erreur['select_partage_eleve_quiz'] = fa_warring . ' Le champ partage  du quiz doit etre selectionné';
//        $etat = FALSE;
//    }
//}
//if (!isset($_POST['select_groupes_eleve_quiz']) && $mode_partage_eleve == '2') {
//
//    $list_erreur['select_groupe_eleve_quiz'] = fa_warring . ' Le champ des groupes d\'eleves  doit etre selectionné';
//    $etat = FALSE;
//}
//if ($etat) {
//    // echo $random_theme;
//    try {
//        $sql = " SELECT id_theme FROM Theme_quiz  WHERE random=:param ";
//        $stmt = $cxn->prepare($sql);
//        $stmt->bindParam(':param', $random_theme);
//        $stmt->execute();
//        $enregistrement = $stmt->fetch();
//        $id_theme = $enregistrement['id_theme'];
//    } catch (Exception $ex) {
//        echo $ex->getMessage() . '/' . $sql;
//        $etat = FALSE;
//    }
//}
/* * *********** Check activation quiz ***************** */
//$random_quiz = unhtmlentities($_POST['random_quiz']);
//if ($activation == '1') {
//    if (!check_valid_quiz($random_quiz)) {
//        $list_erreur['select_etat_quiz'] = fa_warring . ' Le quiz n\'est pas complet.';
//        $etat = FALSE;
//    }
//}
/* * ********************************************** */
//var_dump($list_erreur);  //debug


if ($etat) {


    $keygen_exo = random(20);
    if (!empty($_FILES['img_exo']['name'])) {
        $imgExt = strtolower(pathinfo($_FILES['img_exo']['name'], PATHINFO_EXTENSION));
        $random_img = random(20);
        $img_exo = $random_img . '.' . $imgExt;
    } else {
        $img_exo = NULL;
    }

    try {
        $sql = " INSERT INTO  Exercices_themes (titre_exo,contenu_exo,keygen_exo,id_theme,exercice_actif,img_exo)  VALUES (:param1,:param2,:param3,:param4,:param5,:param6)";
        $stmt = $cxn->prepare($sql);
        $stmt->bindParam(':param1', $titre_exo);
        $stmt->bindParam(':param2', $contenu_exo);
        $stmt->bindParam(':param3', $keygen_exo);
        $stmt->bindParam(':param4', $id_theme);
        $stmt->bindParam(':param5', $select_etat_exo);
        $stmt->bindParam(':param6', $img_exo);
        $stmt->execute();
    } catch (Exception $ex) {
        echo $ex->getMessage() . '/' . $sql;
        $etat = FALSE;
    }

    /*     * ***************** Upload fichier image ***************************** */
    if (!empty($_FILES['img_exo']['name'])) {
        $etat = upload_fichier_exercices($_FILES['img_exo'], $keygen_exo, $random_img);
    }
}
//if ($etat) {
//    if ($mode_partage_eleve == '2') {
//
//        try {
//            $sql = " SELECT  id_liaison  FROM  Liaison_groupe_eleve_quiz  WHERE  random_quiz='" . $random_quiz . "' ";
//            $select = $cxn->query($sql);
//            $nb = $select->rowCount();
//            if ($nb <= 0) {
//                foreach ($_POST['select_groupes_eleve_quiz'] as $value) {
//                    try {
//                        $sql = " INSERT INTO  Liaison_groupe_eleve_quiz(random_quiz,id_groupe,date_created) VALUES (:param1,:param2,:param3)";
//                        $stmt = $cxn->prepare($sql);
//                        $stmt->bindParam(':param1', $random_quiz);
//                        $stmt->bindParam(':param2', $value);
//                        $stmt->bindParam(':param3', $date_created);
//                        $stmt->execute();
//                    } catch (Exception $ex) {
//                        echo $ex->getMessage() . '/' . $sql;
//                        $etat = FALSE;
//                    }
//                }
//            } else {
//                // $enregistrement = $select->fetch();
//                try {
//                    $sql = " DELETE FROM  Liaison_groupe_eleve_quiz  WHERE  random_quiz=:param1";
//                    $stmt = $cxn->prepare($sql);
//                    $stmt->bindParam(':param1', $random_quiz);
//                    $stmt->execute();
//                } catch (Exception $ex) {
//                    echo $ex->getMessage() . '/' . $sql;
//                    $etat = FALSE;
//                }
//                /*                 * ********* Mise a  jour la base ************************* */
//                foreach ($_POST['select_groupes_eleve_quiz'] as $value) {
//                    try {
//                        $sql = " INSERT INTO  Liaison_groupe_eleve_quiz(random_quiz,id_groupe,date_created) VALUES (:param1,:param2,:param3)";
//                        $stmt = $cxn->prepare($sql);
//                        $stmt->bindParam(':param1', $random_quiz);
//                        $stmt->bindParam(':param2', $value);
//                        $stmt->bindParam(':param3', $date_created);
//                        $stmt->execute();
//                    } catch (Exception $ex) {
//                        echo $ex->getMessage() . '/' . $sql;
//                        $etat = FALSE;
//                    }
//                }
//            }
//        } catch (Exception $e) {
//            echo $ex->getMessage() . '/' . $sql;
//            $etat = FALSE;
//        }
//    }
//}
if ($etat) {
    if (isset($_SESSION ['traitement_form_exo'])) {
        unset($_SESSION ['traitement_form_exo']);
    }
    $url = url_espace_formateur . '/index.php?module=JAVA_SCRIPT&action=all_view_exercices&result=succees';
} else {
    $_SESSION ['traitement_form_exo']['tableau_serialise'] = serialize($_POST);
    $_SESSION ['traitement_form_exo']['list_erreur'] = $list_erreur;
    $url = url_espace_formateur . '/index.php?module=JAVA_SCRIPT&action=all_view_exercices&result=echec';
}
header("Location:  $url");


