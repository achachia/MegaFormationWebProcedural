<?php

session_start();
session_regenerate_id();
require_once './connection/config.php';
require_once './librairie/fonctions_local.php';
ini_set('date.timezone', 'Europe/Paris');
$date_created = date("Y-m-d H:i:s");
$etat = TRUE;
$objet = array();
if ($_SESSION ['membre']['user_banni']) {
    $etat = FALSE;
}
if ($etat) {
    $keygen_exo = $_POST['keygen_exo'];
    $keygen_rep = random(20);
    $code_eleve = $_SESSION ['membre']['code_eleve'];

    $id_mode_public = $_POST['partage_code'];


    if (!empty($_POST['nom_code'])) {
        $nom_code = $_POST['nom_code'];
    } else {
        $nom_code = NULL;
    }
    if (!empty($_POST['comment_code'])) {
        $comment_code = $_POST['comment_code'];
    } else {
        $comment_code = NULL;
    }
    if (!empty($_POST['labels_code'])) {
        $labels_code = $_POST['labels_code'];
    } else {
        $labels_code = NULL;
    }
    if ($_POST['id_fiddle_exo'] == '') {
        $etat = FALSE;
    } else {
        $tab_code = explode("/", $_POST['id_fiddle_exo']);
        $id_fiddle_exo = $tab_code[0];
        $version_code = $tab_code[1];
//    if ($version_code != '') {
//        $version_code = (int) $version_code;
//       $objet[]=$version_code;
//       
//    }
    }

    if ($etat) {
        try {
            $sql = " SELECT  id_corrige  FROM  Corrige_devoirs_users  WHERE  fk_code_eleve='" . $_SESSION ['membre']['code_eleve'] . "'   AND  fk_keygen_exo='" . $keygen_exo . "'  ";
            $select = $cxn->query($sql);
            $nb = $select->rowCount();
            if ($nb <= 0) {
                try {
                    $sql = " INSERT INTO  Corrige_devoirs_users (keygen_rep,fk_keygen_exo,fk_code_eleve,code_fiddle,version_code,date_created,nom_code,id_mode_public,comment_code,labels_code)  VALUES (:param1,:param2,:param3,:param4,:param5,:param6,:param7,:param8,:param9,:param10)";
                    $stmt = $cxn->prepare($sql);
                    $stmt->bindParam(':param1', $keygen_rep);
                    $stmt->bindParam(':param2', $keygen_exo);
                    $stmt->bindParam(':param3', $code_eleve);
                    $stmt->bindParam(':param4', $id_fiddle_exo);
                    $stmt->bindParam(':param5', $version_code);
                    $stmt->bindParam(':param6', $date_created);
                    $stmt->bindParam(':param7', $nom_code);
                    $stmt->bindParam(':param8', $id_mode_public);
                    $stmt->bindParam(':param9', $comment_code);
                    $stmt->bindParam(':param10', $labels_code);
                    $stmt->execute();
                } catch (Exception $ex) {
                    echo $ex->getMessage() . '/' . $sql;
                    $etat = FALSE;
                }
            } else {

                /*                 * *************** verifier la date de limite de depot de l'exercice ****************** */
                $drapeau = TRUE;
                try {
                    $sql = "   SELECT Liaison_devoir_users.date_limite_depot_user_travail "
                            . " FROM Liste_exo_devoirs_users,Liste_devoirs_users,Liaison_devoir_users   "
                            . " WHERE  Liste_exo_devoirs_users.fk_devoir_user= Liste_devoirs_users.keygen_dev"
                            . " AND Liste_devoirs_users.keygen_dev=Liaison_devoir_users.fk_keygen_devoir "
                            . "  AND  Liste_exo_devoirs_users.keygen_exo=:param1 ";

                    $resultat = $cxn->prepare($sql);
                    $resultat->bindParam(':param1', $keygen_exo);
                    $resultat->execute();
                    $enregistrement = $resultat->fetch();
                    if ($enregistrement['date_limite_depot_user_travail'] != '') {
                        if ($enregistrement['date_limite_depot_user_travail'] < $date_created) {
                            $drapeau = FALSE;
                        }
                    }
                } catch (Exception $e) {
                    echo "Une erreur est survenue lors de la récupération des données";
                }
                /*                 * ************Mettre a jour le code et son statut ***************************** */
                try {
                    $sql = " UPDATE  Corrige_devoirs_users  SET   ";
                    if ($drapeau) {
                        $sql .= " code_fiddle=:param1, ";
                    }
                    $sql .="  date_update=:param2,version_code=:param3,nom_code=:param4,id_mode_public=:param7,comment_code=:param8,labels_code=:param9,fk_statut_code='1'   WHERE  fk_code_eleve=:param5   AND  fk_keygen_exo=:param6 ";
                    $stmt = $cxn->prepare($sql);
                    if ($drapeau) {
                        $stmt->bindParam(':param1', $id_fiddle_exo);
                    }

                    $stmt->bindParam(':param2', $date_created);
                    $stmt->bindParam(':param3', $version_code);
                    $stmt->bindParam(':param4', $nom_code);
                    $stmt->bindParam(':param5', $code_eleve);
                    $stmt->bindParam(':param6', $keygen_exo);
                    $stmt->bindParam(':param7', $id_mode_public);
                    $stmt->bindParam(':param8', $comment_code);
                    $stmt->bindParam(':param9', $labels_code);
//                $val_parametres_entree[] = $id_fiddle_exo;
//                $val_parametres_entree[] = $date_created;
//                $val_parametres_entree[] = $version_code;
//                $val_parametres_entree[] = $nom_code;
//                $val_parametres_entree[] = $code_eleve;
//                $val_parametres_entree[] = $keygen_exo;
//                $val_parametres_entree[] = $id_mode_public;
//                $val_parametres_entree[] = $comment_code;
//                $val_parametres_entree[] = $labels_code;
//                $sql = formatage_requette_sql($sql, $val_parametres_entree);
                    $stmt->execute();
                } catch (Exception $ex) {
                    echo $ex->getMessage() . '/' . $sql;
                    $etat = FALSE;
                }
            }
        } catch (Exception $e) {
            echo $ex->getMessage() . '/' . $sql;
            $etat = FALSE;
        }
        /*         * ****************** Recuperation les infos de corrigé **************** */

        $infos = array();
//    try {
//        // requete prepare
//        $sql = " SELECT  DISTINCT Liste_mode_public.nom_mode,Corrige_exercices_eleves.nom_code,Corrige_exercices_eleves.code_fiddle,Corrige_exercices_eleves.version_code"
//                . ",Corrige_exercices_eleves.comment_code,Corrige_exercices_eleves.labels_code,Corrige_exercices_eleves.fk_statut_code,Exercices_themes.titre_exo"
//                . ",Corrige_exercices_eleves.fk_statut_code,Corrige_exercices_eleves.keygen_exo,Corrige_exercices_eleves.id_mode_public  "
//                . " FROM  Corrige_exercices_eleves,Exercices_themes,Themes_codes,Liste_mode_public,Liste_statut_code  "
//                . " WHERE   Corrige_exercices_eleves.keygen_exo=Exercices_themes.keygen_exo  "
//                . " AND Corrige_exercices_eleves.id_mode_public=Liste_mode_public.id_mode"
//                . "  AND  Corrige_exercices_eleves.code_eleve=:param1 "
//                . " AND  Corrige_exercices_eleves.keygen_exo=:param2 ";
//        $resultat = $cxn->prepare($sql);
//        $resultat->bindParam(':param1', $_SESSION ['membre']['code_eleve']);
//        $resultat->bindParam(':param2', $keygen_exo);
//        $resultat->execute();
//
//        $enregistrement = $resultat->fetch();
//        $infos['nom_code'] = $enregistrement['nom_code'];
//        $infos['keygen_exo'] = $enregistrement['keygen_exo'];
//        $infos['titre_exo'] = $enregistrement['titre_exo'];
//        $infos['id_mode_public'] = $enregistrement['id_mode_public'];
//        $infos['ID_code'] = $enregistrement['code_fiddle'];
//        if ($enregistrement['version_code'] != '') {
//            $infos['ID_code'] .= '/' . $enregistrement['version_code'];
//        }
//        $infos['mode_partage'] = $enregistrement['nom_mode'];
//        $infos['comment_code'] = $enregistrement['comment_code'];
//        $infos['labels_code'] = formatage_tag_plugin($enregistrement['labels_code']);
//        if ($enregistrement['fk_statut_code'] == '1') {
//            $infos['statut_code'] = '<span class="label label-info">Attente</span>';
//        } else if ($enregistrement['fk_statut_code'] == '2') {
//            $infos['statut_code'] = '<span class="label label-primary">En cours de traitement</span>';
//        } else if ($enregistrement['fk_statut_code'] == '3') {
//            $infos['statut_code'] = '<span class="label label-success">Code correct</span>';
//        } else if ($enregistrement['fk_statut_code'] == '4') {
//            $infos['statut_code'] = '<span class="label label-danger">Code non correct</span>';
//        }
//    } catch (Exception $e) {
//        $parametres_sql = array($id_theme);
//        $numargs = func_num_args();
//        debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
//    }
//
        /*         * *************************************************************** */
    }
}












/**
 * ******************************
 */
$objet ['message'] = array(
    'reponse' => $etat,
    'infos_objet' => $infos
    
);
header('Content-type: application/json');
echo json_encode($objet);
?>


