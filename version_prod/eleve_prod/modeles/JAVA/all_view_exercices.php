<?php

function list_exercices($id_theme) {
    global $cxn;
    $liste = array();
    $date_actuel = date("Y-m-d H:i:s");
    try {
        // requete prepare
        $sql = " SELECT  Exercices_themes.date_created,Exercices_themes.date_limite_depot,Liste_plate_formes_codes.url,Liste_plate_formes_codes.nom_plate_forme,Exercices_themes.titre_exo,Exercices_themes.contenu_exo,Exercices_themes.keygen_exo,Exercices_themes.img_exo"
                . ",Exercices_themes.aide_exo,Exercices_themes.date_publication,Exercices_themes.Corrige_text,Exercices_themes.Codefiddle_Corrige "
                . "FROM  Exercices_themes,Liste_plate_formes_codes   WHERE  Exercices_themes.id_plate_forme=Liste_plate_formes_codes.id_plate_forme   AND   Exercices_themes.id_theme=:param1   ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $id_theme);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            if ($enregistrement['date_publication'] <= $date_actuel) {
                $liste[$i]['titre_exo'] = html_entity_decode(stripslashes($enregistrement['titre_exo']), ENT_QUOTES);
                $liste[$i]['contenu_exo'] = html_entity_decode(stripslashes($enregistrement['contenu_exo']), ENT_QUOTES);
                //  $liste[$i]['contenu_exo']= str_replace(['&lt;','&gt;'],['<','>'], $liste[$i]['contenu_exo']);
                $liste[$i]['keygen_exo'] = $enregistrement['keygen_exo'];
                $liste[$i]['plate_forme'] = $enregistrement['nom_plate_forme'];
                $liste[$i]['url_palte_forme'] = $enregistrement['url'];
                $liste[$i]['date_limite_depot'] = $enregistrement['date_limite_depot'];
                $liste[$i]['date_creation_exo'] = $enregistrement['date_created'];
                if ($enregistrement['img_exo'] != '') {
                    $liste[$i]['img_exo'] = url_dir_fichier_exercices . '/' . $enregistrement['keygen_exo'] . '/' . $enregistrement['img_exo'];
                }
                if ($enregistrement['Codefiddle_Corrige'] != '' || $enregistrement['Corrige_text'] != '') {
                    $liste[$i]['etat_corrige_exo'] = '<span class="label label-danger">Corrigé disponible</span>';
                }


                $liste[$i]['aide_exo'] = html_entity_decode(stripslashes($enregistrement['aide_exo']), ENT_QUOTES);
                /*                 * ************************** Corrige *************************** */
                if ($enregistrement['Corrige_text'] != '' || $enregistrement['Codefiddle_Corrige'] != '') {
                    $liste[$i]['corrige_exo_dispo'] = '1';
                } else {
                    $liste[$i]['corrige_exo_dispo'] = '0';
                }
                /*                 * ************************************ verification si l'eleve a poster une evaluation***************************************************** */
                try {
                    $sql = " SELECT  id_post  FROM  List_post_degre_comprehension_corrige  WHERE  code_eleve='" . $_SESSION ['membre']['code_eleve'] . "'   AND  keygen_exo='" . $liste[$i]['keygen_exo'] . "'  ";
                    $select = $cxn->query($sql);
                    $nb = $select->rowCount();
                    if ($nb <= 0) {
                        $liste[$i]['etat_eval_corrige_exo'] = '0';
                    } else {
                        $liste[$i]['etat_eval_corrige_exo'] = '1';
                    }
                } catch (Exception $e) {
                    echo $ex->getMessage() . '/' . $sql;
                    $etat = FALSE;
                }

                /*                 * ************************************ verification si l'eleve a poster un commentaire***************************************************** */
                try {
                    $sql = " SELECT  id_comment  FROM  List_comments_exo  WHERE  code_eleve='" . $_SESSION ['membre']['code_eleve'] . "'   AND  keygen_exo='" . $liste[$i]['keygen_exo'] . "'  ";
                    $select = $cxn->query($sql);
                    $nb = $select->rowCount();
                    if ($nb <= 0) {
                        $liste[$i]['etat_comment_corrige_exo'] = '0';
                    } else {
                        $liste[$i]['etat_comment_corrige_exo'] = '1';
                    }
                } catch (Exception $e) {
                    echo $ex->getMessage() . '/' . $sql;
                    $etat = FALSE;
                }

                /*                 * ************************************ verification si l'eleve a poster un un vote***************************************************** */
                try {
                    $sql = " SELECT  id_vote  FROM  List_post_vote_exo  WHERE  code_eleve='" . $_SESSION ['membre']['code_eleve'] . "'   AND  keygen_exo='" . $liste[$i]['keygen_exo'] . "'  ";
                    $select = $cxn->query($sql);
                    $nb = $select->rowCount();
                    if ($nb <= 0) {
                        $liste[$i]['etat_vote_exo'] = '0';
                    } else {
                        $liste[$i]['etat_vote_exo'] = '1';
                    }
                } catch (Exception $e) {
                    echo $ex->getMessage() . '/' . $sql;
                    $etat = FALSE;
                }



                /*                 * ****************************************************** */
                try {
                    $sql = " SELECT  code_fiddle,fk_statut_code,version_code,nom_code,id_mode_public,comment_code,labels_code   FROM Corrige_exercices_eleves   WHERE  keygen_exo='" . $enregistrement['keygen_exo'] . "'   AND  code_eleve='" . $_SESSION ['membre']['code_eleve'] . "' ";
                    $select = $cxn->query($sql);
                    $enregistrement = $select->fetch();
                    $liste[$i]['code_fiddle_corrige_eleve'] = $enregistrement['code_fiddle'];
                    $liste[$i]['nom_code'] = $enregistrement['nom_code'];
                    $liste[$i]['id_mode_public'] = $enregistrement['id_mode_public'];
                    $liste[$i]['comment_code'] = $enregistrement['comment_code'];
                    $liste[$i]['labels_code'] = $enregistrement['labels_code'];
                    if ($enregistrement['fk_statut_code'] == '1') {
                        $liste[$i]['statut_code'] = '<span class="label label-info">Attente</span>';
                    } else if ($enregistrement['fk_statut_code'] == '2') {
                        $liste[$i]['statut_code'] = '<span class="label label-primary">En cours de traitement</span>';
                    } else if ($enregistrement['fk_statut_code'] == '3') {
                        $liste[$i]['statut_code'] = '<span class="label label-success">Code correct</span>';
                    } else if ($enregistrement['fk_statut_code'] == '4') {
                        $liste[$i]['statut_code'] = '<span class="label label-danger">Code non correct</span>';
                    } else if ($enregistrement['fk_statut_code'] == '5') {
                        $liste[$i]['statut_code'] = '<span class="label label-warning">Code inaccessible</span>';
                    }
                    $liste[$i]['version_code_reponse'] = $enregistrement['version_code'];
                } catch (Exception $e) {
                    $etat = FALSE;
                    echo "Une erreur est survenue lors de la récupération des données 2";
                }

                /*                 * ********************  Liste des notifications ************************** */
                try {
                    $sql1 = " SELECT  Notifications_codes_eleves.contenu_notif,Notifications_codes_eleves.date_created 


                          FROM  Notifications_codes_eleves,Corrige_exercices_eleves 


                          WHERE Notifications_codes_eleves.keygen_rep=Corrige_exercices_eleves.keygen_rep



                         AND   Corrige_exercices_eleves.keygen_exo=:param1   AND  Corrige_exercices_eleves.code_eleve=:param2  ";


                    $resultat1 = $cxn->prepare($sql1);
                    $resultat1->bindParam(':param1', $liste[$i]['keygen_exo']);
                    $resultat1->bindParam(':param2', $_SESSION ['membre']['code_eleve']);
                    $resultat1->execute();
                    $j = 0;
                    while ($enregistrement1 = $resultat1->fetch()) {
                        $liste[$i]['liste_notification'][$j]['contenu'] = $enregistrement1['contenu_notif'];
                        $liste[$i]['liste_notification'][$j]['date_notif'] = $enregistrement1['date_created'];
                        $j++;
                    }
                } catch (Exception $e) {
                    $parametres_sql = array($liste[$i]['keygen_exo']);
                    $numargs = func_num_args();
                    debug_function(debug_backtrace(), $numargs, $e, $sql1, $parametres_sql);
                }





                /*                 * ************ compter le nombre de notifications non lus********************************** */
                try {
                    $sql2 = " SELECT  Notifications_codes_eleves.contenu_notif,Notifications_codes_eleves.date_created 


                          FROM  Notifications_codes_eleves,Corrige_exercices_eleves 


                          WHERE Notifications_codes_eleves.keygen_rep=Corrige_exercices_eleves.keygen_rep



                         AND   Corrige_exercices_eleves.keygen_exo='" . $liste[$i]['keygen_exo'] . "'   AND  Corrige_exercices_eleves.code_eleve='" . $_SESSION ['membre']['code_eleve'] . "'   AND  Notifications_codes_eleves.consultation_eleve='0' ";


                    $select = $cxn->query($sql2);
                    $liste[$i]['nbr_notification_non_lue'] = $select->rowCount();
                } catch (Exception $e) {
                    $parametres_sql = array($liste[$i]['keygen_exo']);
                    $numargs = func_num_args();
                    debug_function(debug_backtrace(), $numargs, $e, $sql1, $parametres_sql);
                }






                /*                 * ********************************************** */
                $i++;
            }
        }
    } catch (Exception $e) {
        $parametres_sql = array($id_theme);
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
    }
    return $liste;
}

function list_degre_comprehension_corrige() {

    global $cxn;
    $liste = array();
    try {
        $sql = " SELECT id_degre,nom_degre FROM  List_degre_comprehension_corrige ";
        $resultat = $cxn->prepare($sql);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $liste [$i]['id_degre'] = $enregistrement['id_degre'];
            $liste [$i]['nom_degre'] = $enregistrement['nom_degre'];
            $i++;
        }
    } catch (Exception $e) {
        $parametres_sql = array($id_theme);
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
    }
    return $liste;
}

function list_difficulte_exo() {

    global $cxn;
    $liste = array();
    try {
        $sql = " SELECT  id_difficulte,nom_difficulte  FROM  Liste_difficulte_exo  ";
        $resultat = $cxn->prepare($sql);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $liste [$i]['id_difficulte'] = $enregistrement['id_difficulte'];
            $liste [$i]['nom_difficulte'] = $enregistrement['nom_difficulte'];
            $i++;
        }
    } catch (Exception $e) {
        $parametres_sql = array($id_theme);
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
    }
    return $liste;
}
