<?php

function infos_exo($keygen_exo) {
    global $cxn;
    $infos = array();
    try {
        $sql = " SELECT  titre_exo  FROM  Exercices_themes  WHERE  keygen_exo=:param1 ";

        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $keygen_exo);
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $infos['titre_exo'] = html_entity_decode(stripslashes($enregistrement['titre_exo']), ENT_QUOTES);
    } catch (Exception $e) {
        $parametres_sql = array($keygen_exo);
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
    }

    return $infos;
}

function list_eleves($keygen_exo) {
    global $cxn;
    $liste = array();
    $table = 'Corrige_exercices_eleves';
    try {

        $sql = " SELECT    DISTINCT  Membre.code_user,CONCAT(Membre.nom,'.',Membre.prenom) AS  identite_eleve,Membre.profil_img,Corrige_exercices_eleves.date_created,"
                . "Corrige_exercices_eleves.keygen_rep," . $table . ".code_fiddle," . $table . ".date_update," . $table . ".keygen_rep," . $table . ".fk_statut_code," . $table . ".comment_code "
                . " FROM  Membre," . $table . "   WHERE  Membre.code_user=" . $table . ".code_eleve        AND   Membre.user_actif='1'   AND   " . $table . ".keygen_exo=:param1 ORDER BY " . $table . ".date_update ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $keygen_exo);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $liste[$i]['date_creation_code'] = $enregistrement['code_user'];
            $liste[$i]['identite_eleve'] = $enregistrement['identite_eleve'];
            $liste[$i]['profil_img'] = url_dir_img_eleves . '/' . $enregistrement['profil_img'];
            $liste[$i]['keygen_rep'] = $enregistrement['keygen_rep'];
            $liste[$i]['date_creation_code'] = $enregistrement['date_created'];
            $liste[$i]['date_creation_code'] = $enregistrement['date_created'];
            $liste[$i]['date_update_code'] = $enregistrement['date_update'];
            $liste[$i]['identifiant_code_reponse'] = $enregistrement['code_fiddle'];
            $liste[$i]['id_statut_code'] = $enregistrement['fk_statut_code'];
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
            $liste[$i]['contenu_comment'] = $enregistrement['comment_code'];
            if ($enregistrement['date_update'] != '') {
                $liste[$i]['date_comment'] = $enregistrement['date_update'];
            } else {
                $liste[$i]['date_comment'] = $enregistrement['date_created'];
            }

            /*             * ******* Liste notifications *************************** */
            try {
                $sql1 = " SELECT DISTINCT Notifications_codes_eleves.contenu_notif,Notifications_codes_eleves.date_created,Notifications_codes_eleves.degre_notif,Liste_degre_message.code_span"
                        . "  FROM  Notifications_codes_eleves,Liste_degre_message"
                        . "   WHERE Notifications_codes_eleves.degre_notif=Liste_degre_message.id_level "
                        . "   AND  Notifications_codes_eleves.keygen_rep=:param1 ";

                $resultat1 = $cxn->prepare($sql1);
                $resultat1->bindParam(':param1', $enregistrement['keygen_rep']);
                $resultat1->execute();
                $j = 0;
                while ($enregistrement1 = $resultat1->fetch()) {
                    $liste[$i]['liste_notification'][$j]['degre_notif'] = $enregistrement1['code_span'];
                    $liste[$i]['liste_notification'][$j]['contenu'] = $enregistrement1['contenu_notif'];
                    $liste[$i]['liste_notification'][$j]['date_notif'] = $enregistrement1['date_created'];
                    $j++;
                }
            } catch (Exception $e) {
                $parametres_sql = array($enregistrement['keygen_rep']);
                $numargs = func_num_args();
                debug_function(debug_backtrace(), $numargs, $e, $sql1, $parametres_sql);
            }

            /*             * ********************************************************* */
            $i++;
        }
    } catch (Exception $e) {
        $parametres_sql = array($id_theme);
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
    }
    //var_dump($liste);
    return $liste;
}

function list_statut_code() {
    global $cxn;
    $liste = array();
    try {
        // requete prepare
        $sql = " SELECT * FROM  Liste_statut_code ";
        $resultat = $cxn->prepare($sql);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $liste[$i]['id_statut'] = $enregistrement['id_statut'];
            $liste[$i]['nom_statut'] = $enregistrement['nom_statut'];
            $i++;
        }
    } catch (Exception $e) {
        $parametres_sql = array($id_theme);
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
    }

    return $liste;
}

function list_degre_message() {
    global $cxn;
    $liste = array();
    try {
        // requete prepare
        $sql = " SELECT * FROM  Liste_degre_message ";
        $resultat = $cxn->prepare($sql);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $liste[$i]['id_level'] = $enregistrement['id_level'];
            $liste[$i]['nom_level'] = $enregistrement['nom_level'];
            $i++;
        }
    } catch (Exception $e) {
        $parametres_sql = array($id_theme);
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
    }

    return $liste;
}
