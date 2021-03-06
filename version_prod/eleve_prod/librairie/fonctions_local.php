<?php

function get_keygen_module($module, $action) {

    global $cxn;
    try {
        $sql = " SELECT  fk_module  FROM  Liste_menu_espace_eleve  WHERE  module=:param1   AND  action=:param2 ";

        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $module);
        $resultat->bindParam(':param2', $action);
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $keygen_module = $enregistrement['fk_module'];
    } catch (Exception $e) {
        $parametres_sql = array($module, $action);
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
    }
    return $keygen_module;
}

function get_infos_module($module, $action) {

    global $cxn;
    $infos = array();
    try {
        $sql = " SELECT  Liste_menu_espace_eleve.fk_module,Liste_modules.nom_module  FROM  Liste_menu_espace_eleve,Liste_modules "
                . " WHERE  Liste_menu_espace_eleve.fk_module=Liste_modules.keygen_module  AND  module=:param1   AND  action=:param2 ";

        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $module);
        $resultat->bindParam(':param2', $action);
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $infos['keygen_module'] = $enregistrement['fk_module'];
        $infos['nom_module'] = $enregistrement['nom_module'];
    } catch (Exception $e) {
        $parametres_sql = array($module, $action);
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
    }
    return $infos;
}

function get_infos_theme($keygen_theme) {

    global $cxn;
    $infos = array();
    try {
        $sql = " SELECT nom_theme FROM  Liste_themes WHERE  keygen_theme=:param1  ";

        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $keygen_theme);
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $infos['nom_theme'] = $enregistrement['nom_theme'];
    } catch (Exception $e) {
        $parametres_sql = array($keygen_theme);
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
    }
    return $infos;
}

function get_infos_exo($keygen_exo) {

    global $cxn;
    $infos = array();
    try {
        $sql = " SELECT titre_exo FROM  Exercices_themes   WHERE  keygen_exo=:param1  ";

        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $keygen_exo);
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $infos['nom_exo'] = $enregistrement['titre_exo'];
    } catch (Exception $e) {
        $parametres_sql = array($keygen_exo);
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
    }
    return $infos;
}

function set_historique_consultation_lien($module, $action, $code_user) {
    global $cxn;
    $date_actuel = date("Y-m-d H:i:s");
    try {
        $sql = " SELECT Historique_consultation_lien_site.id FROM  Historique_consultation_lien_site,Liste_menu_espace_eleve WHERE   Historique_consultation_lien_site.id_menu=Liste_menu_espace_eleve.id_menu  AND  Liste_menu_espace_eleve.module='" . $module . "'  AND  Liste_menu_espace_eleve.action='" . $action . "'   AND  Historique_consultation_lien_site.code_user='" . $code_user . "' ";

        $select = $cxn->query($sql);
        $nbr_consultation_lien = $select->rowCount();
        if ($nbr_consultation_lien <= 0) {
            /*             * *************** recuperation le id_menu ************************* */
            try {
                $sql = " SELECT  id_menu  FROM  Liste_menu_espace_eleve  WHERE  module=:param1    AND   action=:param2  ";
                $resultat = $cxn->prepare($sql);
                $resultat->bindParam(':param1', $module);
                $resultat->bindParam(':param2', $action);
                $resultat->execute();
                $enregistrement = $resultat->fetch();
                $id_menu = $enregistrement['id_menu'];
            } catch (Exception $e) {
                $parametres_sql = array($module, $action);
                $numargs = func_num_args();
                debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
            }


            /*             * *********** intertion les donnes dans la table ************************ */
            try {
                $sql = " INSERT INTO  Historique_consultation_lien_site (id_menu,code_user,date_created) VALUES (:param1,:param2,:param3)";
                $resultat = $cxn->prepare($sql);
                $resultat->bindParam(':param1', $id_menu);
                $resultat->bindParam(':param2', $code_user);
                $resultat->bindParam(':param3', $date_actuel);
                $resultat->execute();
            } catch (Exception $e) {
                $parametres_sql = array($id_menu, $code_user, $date_actuel);
                $numargs = func_num_args();
                debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
            }
        }
    } catch (Exception $e) {
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql);
    }
}

/* * ********* liste alertes par page ********************** */

function liste_alertes_user($code_user, $keygen_groupe, $mode_groupe_public, $mode_affichage, $id_priorite_alerte) {

    global $cxn;
    $liste = array();
    $date_actuel = date("Y-m-d H:i:s");
    //  echo $keygen_groupe ;
    $i = 0;
    if (!is_null($code_user)) {
        /*         * ******************** Liste des alertes individuels *********************** */
        try {
            $sql = " SELECT   Liste_alerts_users.id_alerte,Liste_alerts_users.date_start,Liste_alerts_users.date_end,Liste_alerts_users.description,Liste_alerts_users.nom_alerte,fk_priorite_alerte,Liste_degre_priorite.fa_icone,Liste_degre_priorite.class_alerte "
                    . " FROM  Liste_alerts_users,Liste_degre_priorite   WHERE  Liste_alerts_users.fk_priorite_alerte=Liste_degre_priorite.id_priorite   AND  Liste_alerts_users.code_user=:param1  ";
            if (!is_null($mode_affichage)) {
                $sql .= " AND  Liste_alerts_users.mode_affichage=:param2  ";
            }
            if ($id_priorite_alerte == '1') {
                $sql .= " AND  Liste_alerts_users.fk_priorite_alerte='1'  ";
            }
            if ($id_priorite_alerte == '2') {
                $sql .= " AND  Liste_alerts_users.fk_priorite_alerte='2'  ";
            }
            if ($id_priorite_alerte == '3') {
                $sql .= " AND  Liste_alerts_users.fk_priorite_alerte='3'  ";
            }
            $sql.="  ORDER BY Liste_alerts_users.date_created DESC";
            // echo $sql;
            $resultat = $cxn->prepare($sql);
            $resultat->bindParam(':param1', $code_user);
            if (!is_null($mode_affichage)) {
                $resultat->bindParam(':param2', $mode_affichage);
            }
            $resultat->execute();

            while ($enregistrement = $resultat->fetch()) {
                if (($enregistrement['date_start'] <= $date_actuel) && ($date_actuel <= $enregistrement['date_end'])) {
                    $liste [$i]['class_alerte'] = $enregistrement['class_alerte'];
                    $liste [$i]['class_icone'] = $enregistrement['fa_icone'];
                    $liste [$i]['nom_alerte'] = $enregistrement['nom_alerte'];
                    $liste [$i]['description'] = html_entity_decode(stripslashes($enregistrement['description']), ENT_QUOTES);
                    $i++;
                }
            }
        } catch (Exception $e) {
            $parametres_sql = array($code_user);
            $numargs = func_num_args();
            debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
        }
    }
    if (!is_null($keygen_groupe)) {
        /*         * ************************* Liste des alertes par groupe *********************** */
        try {
            $sql = " SELECT   Liste_alerts_users.id_alerte,Liste_alerts_users.date_start,Liste_alerts_users.date_end,Liste_alerts_users.description,Liste_alerts_users.nom_alerte,fk_priorite_alerte,Liste_degre_priorite.fa_icone,Liste_degre_priorite.class_alerte "
                    . " FROM  Liste_alerts_users,Liste_degre_priorite   WHERE  Liste_alerts_users.fk_priorite_alerte=Liste_degre_priorite.id_priorite   AND  Liste_alerts_users.fk_keygen_groupe=:param3  ";
            if (!is_null($mode_affichage)) {
                $sql .= " AND  Liste_alerts_users.mode_affichage=:param4  ";
            }
            if ($id_priorite_alerte == '1') {
                $sql .= " AND  Liste_alerts_users.fk_priorite_alerte='1'  ";
            }
            if ($id_priorite_alerte == '2') {
                $sql .= " AND  Liste_alerts_users.fk_priorite_alerte='2'  ";
            }
            if ($id_priorite_alerte == '3') {
                $sql .= " AND  Liste_alerts_users.fk_priorite_alerte='3'  ";
            }
            //   echo $sql;
            $resultat = $cxn->prepare($sql);
            $resultat->bindParam(':param3', $keygen_groupe);
            if (!is_null($mode_affichage)) {
                $resultat->bindParam(':param4', $mode_affichage);
            }
            $sql.="  ORDER BY Liste_alerts_users.date_created DESC";
            $resultat->execute();

            while ($enregistrement = $resultat->fetch()) {
                if (($enregistrement['date_start'] <= $date_actuel) && ($date_actuel <= $enregistrement['date_end'])) {
                    $liste [$i]['class_alerte'] = $enregistrement['class_alerte'];
                    $liste [$i]['class_icone'] = $enregistrement['fa_icone'];
                    $liste [$i]['nom_alerte'] = $enregistrement['nom_alerte'];
                    $liste [$i]['description'] = html_entity_decode(stripslashes($enregistrement['description']), ENT_QUOTES);
                    $i++;
                }
            }
        } catch (Exception $e) {
            $parametres_sql = array($code_user);
            $numargs = func_num_args();
            debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
        }
    }
    if (!is_null($mode_groupe_public)) {
        /*         * ************************* Liste des alertes public *********************** */
        try {
            $sql = " SELECT   Liste_alerts_users.id_alerte,Liste_alerts_users.date_start,Liste_alerts_users.date_end,Liste_alerts_users.description,Liste_alerts_users.nom_alerte,fk_priorite_alerte,Liste_degre_priorite.fa_icone,Liste_degre_priorite.class_alerte "
                    . " FROM  Liste_alerts_users,Liste_degre_priorite   WHERE  Liste_alerts_users.fk_priorite_alerte=Liste_degre_priorite.id_priorite   AND  Liste_alerts_users.fk_mode_groupe_users='1'  ";
            if (!is_null($mode_affichage)) {
                $sql .= " AND  Liste_alerts_users.mode_affichage=:param5  ";
            }
            if ($id_priorite_alerte == '1') {
                $sql .= " AND  Liste_alerts_users.fk_priorite_alerte='1'  ";
            }
            if ($id_priorite_alerte == '2') {
                $sql .= " AND  Liste_alerts_users.fk_priorite_alerte='2'  ";
            }
            if ($id_priorite_alerte == '3') {
                $sql .= " AND  Liste_alerts_users.fk_priorite_alerte='3'  ";
            }
            // echo $sql;
            $resultat = $cxn->prepare($sql);
            if (!is_null($mode_affichage)) {
                $resultat->bindParam(':param5', $mode_affichage);
            }
            $sql.="  ORDER BY Liste_alerts_users.date_created DESC";
            $resultat->execute();

            while ($enregistrement = $resultat->fetch()) {
                if (($enregistrement['date_start'] <= $date_actuel) && ($date_actuel <= $enregistrement['date_end'])) {
                    $liste [$i]['class_alerte'] = $enregistrement['class_alerte'];
                    $liste [$i]['class_icone'] = $enregistrement['fa_icone'];
                    $liste [$i]['nom_alerte'] = $enregistrement['nom_alerte'];
                    $liste [$i]['description'] = html_entity_decode(stripslashes($enregistrement['description']), ENT_QUOTES);
                    $i++;
                }
            }
        } catch (Exception $e) {
            $parametres_sql = array($code_user);
            $numargs = func_num_args();
            debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
        }
    }


    return $liste;
}

function liste_alertes_user_bordereau($code_user, $keygen_groupe) {

    global $cxn;
    $liste = array();
    $date_actuel = date("Y-m-d H:i:s");
// echo $date_actuel ;
    $i = 0;

    /*     * ******************** Liste des alertes individuels *********************** */
    try {
        $sql = " SELECT  id_alerte  FROM  Liste_alerts_users   WHERE     Liste_alerts_users.code_user='" . $code_user . "'  AND  fk_priorite_alerte='2' AND ( date_start <= '" . $date_actuel . "')  AND  ('" . $date_actuel . "'<= date_end) ";
        $sql .= " AND  Liste_alerts_users.mode_affichage='page'  ";
        // echo $sql;
        $select = $cxn->query($sql);
        $nbr_user_urgent = $select->rowCount();
        // echo $nbr_user;
        if ($nbr_user_urgent > 0) {
            $liste = liste_alertes_user($code_user, NULL, NULL, 'page', '2');
        } else {
            $sql = " SELECT  id_alerte  FROM  Liste_alerts_users   WHERE     Liste_alerts_users.fk_keygen_groupe='" . $keygen_groupe . "'  AND  fk_priorite_alerte='2' AND ( date_start <= '" . $date_actuel . "')  AND  ('" . $date_actuel . "'<= date_end) ";
            $sql .= " AND  Liste_alerts_users.mode_affichage='page'  ";
            $select = $cxn->query($sql);
            $nbr_groupe_urgent = $select->rowCount();
            //  echo $nbr_groupe;
            if ($nbr_groupe_urgent > 0) {
                /*                 * ************************* Liste des alertes par groupe *********************** */
                $liste = liste_alertes_user(NULL, $keygen_groupe, NULL, 'page', '2');
            } else {
                $sql = " SELECT  id_alerte  FROM  Liste_alerts_users   WHERE     Liste_alerts_users.fk_mode_groupe_users='1'    AND  fk_priorite_alerte='2' AND ( date_start <= '" . $date_actuel . "')  AND  ('" . $date_actuel . "'<= date_end) ";
                $sql .= " AND  Liste_alerts_users.mode_affichage='page'  ";
                $select = $cxn->query($sql);
                $nbr_public_urgent = $select->rowCount();
                if ($nbr_public_urgent > 0) {
                    /*                     * ************************* Liste des alertes public *********************** */
                    $liste = liste_alertes_user(NULL, NULL, 'public', 'page', '2');
                } else {
                    $sql = " SELECT  id_alerte  FROM  Liste_alerts_users   WHERE     Liste_alerts_users.code_user='" . $code_user . "'  AND  fk_priorite_alerte='3' AND ( date_start <= '" . $date_actuel . "')  AND  ('" . $date_actuel . "'<= date_end) ";
                    $sql .= " AND  Liste_alerts_users.mode_affichage='page'  ";
                    // echo $sql;
                    $select = $cxn->query($sql);
                    $nbr_user_important = $select->rowCount();
                    // echo $nbr_user;
                    if ($nbr_user_important > 0) {
                        $liste = liste_alertes_user($code_user, NULL, NULL, 'page', '3');
                    } else {
                        $sql = " SELECT  id_alerte  FROM  Liste_alerts_users   WHERE     Liste_alerts_users.fk_keygen_groupe='" . $keygen_groupe . "'  AND  fk_priorite_alerte='3' AND ( date_start <= '" . $date_actuel . "')  AND  ('" . $date_actuel . "'<= date_end) ";
                        $sql .= " AND  Liste_alerts_users.mode_affichage='page'  ";
                        $select = $cxn->query($sql);
                        $nbr_groupe_important = $select->rowCount();
                        //  echo $nbr_groupe;
                        if ($nbr_groupe_important > 0) {
                            /*                             * ************************* Liste des alertes par groupe *********************** */
                            $liste = liste_alertes_user(NULL, $keygen_groupe, NULL, 'page', '3');
                        } else {
                            $sql = " SELECT  id_alerte  FROM  Liste_alerts_users   WHERE     Liste_alerts_users.fk_mode_groupe_users='1'    AND  fk_priorite_alerte='3' AND ( date_start <= '" . $date_actuel . "')  AND  ('" . $date_actuel . "'<= date_end) ";
                            $sql .= " AND  Liste_alerts_users.mode_affichage='page'  ";
                            $select = $cxn->query($sql);
                            $nbr_public_urgent = $select->rowCount();
                            if ($nbr_public_important > 0) {
                                /*                                 * ************************* Liste des alertes public *********************** */
                                $liste = liste_alertes_user(NULL, NULL, 'public', 'page', '3');
                            } else {
                                $sql = " SELECT  id_alerte  FROM  Liste_alerts_users   WHERE     Liste_alerts_users.code_user='" . $code_user . "'  AND  fk_priorite_alerte='1' AND ( date_start <= '" . $date_actuel . "')  AND  ('" . $date_actuel . "'<= date_end) ";
                                $sql .= " AND  Liste_alerts_users.mode_affichage='page'  ";
                                // echo $sql;
                                $select = $cxn->query($sql);
                                $nbr_user_normal = $select->rowCount();
                                // echo $nbr_user;
                                if ($nbr_user_normal > 0) {
                                    $liste = liste_alertes_user($code_user, NULL, NULL, 'page', '1');
                                } else {
                                    $sql = " SELECT  id_alerte  FROM  Liste_alerts_users   WHERE     Liste_alerts_users.fk_keygen_groupe='" . $keygen_groupe . "'  AND  fk_priorite_alerte='1' AND ( date_start <= '" . $date_actuel . "')  AND  ('" . $date_actuel . "'<= date_end) ";
                                    $sql .= " AND  Liste_alerts_users.mode_affichage='page'  ";
                                    $select = $cxn->query($sql);
                                    $nbr_groupe_normal = $select->rowCount();
                                    //  echo $nbr_groupe;
                                    if ($nbr_groupe_normal > 0) {
                                        /*                                         * ************************* Liste des alertes par groupe *********************** */
                                        $liste = liste_alertes_user(NULL, $keygen_groupe, NULL, 'page', '1');
                                    } else {
                                        $sql = " SELECT  id_alerte  FROM  Liste_alerts_users   WHERE     Liste_alerts_users.fk_mode_groupe_users='1'    AND  fk_priorite_alerte='1' AND ( date_start <= '" . $date_actuel . "')  AND  ('" . $date_actuel . "'<= date_end) ";
                                        $sql .= " AND  Liste_alerts_users.mode_affichage='page'  ";
                                        $select = $cxn->query($sql);
                                        $nbr_public_normal = $select->rowCount();
                                        if ($nbr_public_normal > 0) {
                                            /*                                             * ************************* Liste des alertes public *********************** */
                                            $liste = liste_alertes_user(NULL, NULL, 'public', 'page', '1');
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    } catch (Exception $e) {
        $parametres_sql = array($code_user);
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
    }


    return $liste;
}

/* * ******************  Lien breadcrumb **************************** */

function get_breadcrumb($module, $action) {
    global $cxn;
    $breadcrumb = '';
    try {
        $sql = " SELECT  nom_lien  FROM  Liste_menu_espace_eleve   WHERE  module=:param1  AND  action=:param2  ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $module);
        $resultat->bindParam(':param2', $action);
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $breadcrumb = $enregistrement['nom_lien'];
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }

    return $breadcrumb;
}

/* * ************************* Nbre_notifications non-lus par theme  *************************** */

function nbr_notifications_non_lus_par_theme($id_theme) {
    global $cxn;
    $nbr = 0;
    try {
        $sql = " SELECT  Notifications_codes_eleves.id_notif 


                    FROM   Notifications_codes_eleves,Corrige_exercices_eleves,Exercices_themes



                    WHERE  Notifications_codes_eleves.keygen_rep=Corrige_exercices_eleves.keygen_rep


                    AND    Corrige_exercices_eleves.keygen_exo=Exercices_themes.keygen_exo 

                    AND   Notifications_codes_eleves.consultation_eleve='0'                              

                    AND   Exercices_themes.id_theme='" . $id_theme . "' 


                    AND  Corrige_exercices_eleves.code_eleve='" . $_SESSION ['membre']['code_eleve'] . "' ";


        $select = $cxn->query($sql);
        $nbr = $select->rowCount();
    } catch (Exception $e) {
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql);
    }

    return $nbr;
}

/* * ********************* Fonctions debug-1**************************** */
if (!function_exists("controle_debug")) {

    function controle_debug($module, $action) {
        global $cxn;
        $controle = array();
        $controle['drapeau'] = FALSE;
        try {
            $sql = " SELECT fk_debug,date_end   FROM  Debug_site   WHERE   module= :param1  AND   action=:param2 ";
            $resultat = $cxn->prepare($sql);
            $resultat->bindParam(':param1', $module);
            $resultat->bindParam(':param2', $action);
            $resultat->execute();
            $enregistrement = $resultat->fetch();
            $fk_debug = $enregistrement['fk_debug'];
            if ($enregistrement['fk_debug'] == '2' && $_SESSION ['membre']['code_eleve'] != 'CE2') {

                $controle['drapeau'] = TRUE;
                $controle['date_end'] = $enregistrement['date_end'];
            }
        } catch (Exception $e) {
            echo "Une erreur est survenue lors de la récupération des données";
        }
        return $controle;
    }

}


/* * ********************* Fonctions debug-2**************************** */
if (!function_exists("debug_function")) {

    function debug_function($array_debug, $numargs, $e, $sql, $parametres_sql = array()) {
        $date_debug = date("d-m-Y   H:i:s");
        if (sizeof($parametres_sql) != 0) {
            $sql = formatage_requette_sql($sql, $parametres_sql);
        }
        $message_erreur = '<table class="table"  border="1">';
        $message_erreur.='<tr>';
        $message_erreur.='<td colspan="2"  style="text-align:center;background-color:#2AABD2;color:#F2FFFF">URL PAGE</td>';
        $message_erreur.='</tr>';
        $message_erreur.='<tr>';
        $message_erreur.='<td style="text-align:center">URL</td>';
        $message_erreur.='<td style="text-align:center">' . $_SERVER['HTTP_REFERER'] . '</td>';
        $message_erreur.='</tr>';
        $message_erreur.='<tr>';
        $message_erreur.='<td style="text-align:center">DATE ERREUR</td>';
        $message_erreur.='<td style="text-align:center">' . $date_debug . '</td>';
        $message_erreur.='</tr>';
        $message_erreur.='<tr>';
        $message_erreur.='<td colspan="2"  style="text-align:center;background-color:#2AABD2;color:#F2FFFF">Les informations sur la fonction</td>';
        $message_erreur.='</tr>';
        $message_erreur.='<tr>';
        $message_erreur.='<td style="text-align:center">Nom de la fonction </td>';
        $message_erreur.='<td style="text-align:center">' . $array_debug['0']['function'] . '</td>';
        $message_erreur.='</tr>';
        $message_erreur.='<tr>';
        $message_erreur.='<tr>';
        $message_erreur.='<td style="text-align:center">Nombre d\'arguments </td>';
        $message_erreur.='<td style="text-align:center">' . $numargs . '</td>';
        $message_erreur.='</tr>';
        $message_erreur.='<tr>';
        $message_erreur.='<td style="text-align:center">Les Valeurs des arguments </td>';
        $message_erreur.='<td>';
        $message_erreur.='<ul>';
        foreach ($array_debug['0']['args'] as $value) {
            $message_erreur.='<li>' . $value . '</li>';
        }
        $message_erreur.='</ul>';
        $message_erreur.= '</td>';
        $message_erreur.='</tr>';
        $message_erreur.='<tr>';
        $message_erreur.='<td colspan="2"  style="text-align:center;background-color:#2AABD2;color:#F2FFFF">Erreur du traitement d\'une requette SQL </td>';
        $message_erreur.='</tr>';
        $message_erreur.='<tr>';
        $message_erreur.='<td style="text-align:center">N° Ligne </td>';
        $message_erreur.='<td style="text-align:center">' . $e->getLine() . '</td>';
        $message_erreur.='</tr>';
        $message_erreur.='<tr>';
        $message_erreur.='<td style="text-align:center">Le fichier </td>';
        $message_erreur.='<td style="text-align:center">' . $e->getFile() . '</td>';
        $message_erreur.='</tr>';
        $message_erreur.='<tr>';
        $message_erreur.='<td style="text-align:center">LA REQUETTE SQL </td>';
        $message_erreur.='<td style="text-align:center">' . $sql . '</td>';
        $message_erreur.='</tr>';
        $message_erreur.='<tr>';
        $message_erreur.='<td style="text-align:center">Exception lancée </td>';
        $message_erreur.='<td style="text-align:center">' . $e->getMessage() . '</td>';
        $message_erreur.='</tr>';
        $message_erreur.='</table>';
        echo $message_erreur;
    }

}
/* * ************************* Formatage la requette SQL **************************************** 

 *      $parametres_sql = array($code_user, $id_section);
  echo formatage_requette_sql($sql, $parametres_sql).'<br/><br/><br/>';
 *  */
if (!function_exists("formatage_requette_sql")) {

    function formatage_requette_sql($sql, $val_parametres_entree) {
        /*         * ****************************************** */
        $j = 0;
        foreach ($val_parametres_entree as $value) {
            $formatage_parametre_entree[$j] = "'" . $value . "'";
            $j++;
        }
        /*         * ****************************************** */
        $size_of = sizeof($val_parametres_entree);
        for ($i = 1; $i <= $size_of; $i++) {
            $val_parametres_sql[] = ':param' . $i;
        }
        /*         * ****************************************** */
        $sql = str_replace($val_parametres_sql, $formatage_parametre_entree, $sql);

        return $sql;
    }

}
/* * **************************************************** */
if (!function_exists("check_code_adhesion")) {

    function check_code_adhesion($code_adhesion) {
        global $cxn;
        $check = FALSE;
        try {
            $sql = " SELECT  id_code FROM  Codes_invitations_mail  WHERE  code='" . $code_adhesion . "'   AND   statut='1' ";
            $select = $cxn->query($sql);
            $nb = $select->rowCount();
            if ($nb > 0) {
                $check = TRUE;
            }
        } catch (Exception $e) {
            echo "Une erreur est survenue lors de la récupération des données";
        }

        return $check;
    }

}

/* * ***************************************************************** */
if (!function_exists("random")) {

    function random($car) {
        $string = "";
        $chaine = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        srand((double) microtime() * 1000000);
        for ($i = 0; $i < $car; $i ++) {
            $string .= $chaine [rand() % strlen($chaine)];
        }
        return $string;
    }

}
/* * ************************************************************** */

function logOut() {
    $_SESSION = array();
    session_destroy();
}

function redirection_membre($user) {

    $etat = false;
//    $root_web = "http://" . $_SERVER ['HTTP_HOST'] . rtrim($_SERVER ['PHP_SELF'], '/\\');
//    $root_web = substr($root_web, 0, - 9);

    if (!isset($user)) {
        $etat = true;
        $lien = url_espace_eleve_prod . '/login.php?message_inactivite_session=no_session';
    } else {

        /*         * **************************Inactivite de session ************************* */
        $logLength = 3600; # time in seconds :: 1800 = 30 minutes 
        $ctime = strtotime("now"); # Create a time from a string    
        # Check if they have exceded the time limit of inactivity
        if (((strtotime("now") - $_SESSION ['membre']['sessionX']) > $logLength)) {
            # If exceded the time, log the user out
            logOut();
            # Redirect to login page to log back in
            $lien = $root_web . 'login.php?message_inactivite_session=inactivite_session';
        } else {
            # If they have not exceded the time limit of inactivity, keep them logged in
            $_SESSION ['membre']['sessionX'] = $ctime;
        }
    }

    if ($etat) {
        header("Location: $lien");
    }
}

function unhtmlentities($string) {
    $string = trim($string);
    $string = (!get_magic_quotes_gpc()) ? addslashes($string) : $string;
    $string = htmlentities($string, ENT_QUOTES);
    return $string;
}

if (!function_exists("get_nom_matiere")) {

    function get_nom_matiere($code_matiere) {
        global $cxn;

        try {
            $sql = " SELECT   nom_matiere FROM   List_matiere WHERE   code_matiere = :param1 ";
            $resultat = $cxn->prepare($sql);
            $resultat->bindParam(':param1', $code_matiere);
            $resultat->execute();
            $enregistrement = $resultat->fetch();
            $nom_matiere = mb_strtoupper($enregistrement['nom_matiere'], 'UTF-8');
        } catch (Exception $e) {
            echo "Une erreur est survenue lors de la récupération des données";
        }

        return $nom_matiere;
    }

}
if (!function_exists("html_entity_decode_string")) {

    function html_entity_decode_string($string) {
        //echo $string;
        // echo html_entity_decode($string, ENT_QUOTES);
        $string = mb_strtoupper(html_entity_decode($string, ENT_QUOTES), 'UTF-8');

        return $string;
    }

}

if (!function_exists("get_nom_theme")) {

    function get_nom_theme($random_theme) {
        global $cxn;

        try {
            $sql = " SELECT  nom  FROM  Theme_quiz  WHERE  random=:param1  ";
            $resultat = $cxn->prepare($sql);
            $resultat->bindParam(':param1', $random_theme);
            $resultat->execute();
            $enregistrement = $resultat->fetch();
            $nom_theme = mb_strtoupper($enregistrement['nom'], 'UTF-8');
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $nom_theme;
    }

}

if (!function_exists("get_nom_quiz")) {

    function get_nom_quiz($random_quiz) {
        global $cxn;

        try {
            $sql = " SELECT Quiz.nom AS nom_quiz FROM  Quiz  WHERE   Quiz.random=:param1 ";

            $resultat = $cxn->prepare($sql);
            $resultat->bindParam(':param1', $random_quiz);
            $resultat->execute();
            $enregistrement = $resultat->fetch();
            $nom_quiz = $enregistrement['nom_quiz'];
        } catch (Exception $e) {
            echo "Une erreur est survenue lors de la récupération des données";
        }
        return $nom_quiz;
    }

}

if (!function_exists("breadcrumb")) {

    function breadcrumb($module, $action) {
        global $cxn;
        $breadcrumb = '<li><a href="index.php"><i class="fa fa-home"></i></a><span class="separator"></span></li>
                       <li class="active">Accueil</li>';

        /*         * ************************ Code matiere **************************** */
        if (!empty($_GET['code_matiere'])) {
            $code_matiere = unhtmlentities($_GET['code_matiere']);
        }
        if (!empty($_SESSION['quiz']['parametres']['code_matiere'])) {
            $code_matiere = $_SESSION['quiz']['parametres']['code_matiere'];
        }
        if (!empty($code_matiere)) {

            $nom_matiere = get_nom_matiere($code_matiere);

            $breadcrumb .='<li><span class="separator"></span>' . $nom_matiere . '</li>';
        }
        /*         * ********************************************* */
        if (!empty($_GET['random_quiz'])) {
            $random_quiz = unhtmlentities($_GET['random_quiz']);
        }
        if (!empty($_SESSION['quiz']['parametres']['random_quiz'])) {
            $random_quiz = $_SESSION['quiz']['parametres']['random_quiz'];
        }
        /*         * ********************************************* */
        if (!empty($_GET['random_theme'])) {
            $random_theme = unhtmlentities($_GET['random_theme']);
        } else {
            if (!empty($random_quiz)) {

                try {
                    $sql = " SELECT Theme_quiz.random  AS random_theme FROM  Quiz,Theme_quiz  WHERE   Quiz.id_quiz_theme=Theme_quiz.id_theme  AND Quiz.random=:param1 ";

                    $resultat = $cxn->prepare($sql);
                    $resultat->bindParam(':param1', $random_quiz);
                    $resultat->execute();
                    $enregistrement = $resultat->fetch();
                    $random_theme = $enregistrement['random_theme'];
                } catch (Exception $e) {
                    echo "Une erreur est survenue lors de la récupération des données";
                }
            }
        }
        /*         * ********************************************* */
        if (!empty($random_theme)) {

            $breadcrumb .='<li><a href="index.php?module=quiz&action=list_themes_quiz&nom_matiere=' . $nom_matiere . '&code_matiere=' . $code_matiere . '"><span class="separator"></span> CATALOGUE DES TH&Eacute;MES</a></li>';
            $nom_theme = get_nom_theme($random_theme);

            if (empty($random_quiz)) {
                $breadcrumb .='<li><span class="separator"></span>' . html_entity_decode_string($nom_theme) . '</li>';
            } else {
                $nom_quiz = get_nom_quiz($random_quiz);
                $breadcrumb .='<li><a href="index.php?module=quiz&action=list_quiz_theme&nom_matiere=' . $nom_matiere . '&code_matiere=' . $code_matiere . '&random_theme=' . $random_theme . '"><span class="separator"></span>' . html_entity_decode_string($nom_theme) . '</a></li>';
                $breadcrumb .='<li><span class="separator"></span>' . html_entity_decode_string($nom_quiz) . '</li>';
            }
        }



        /*         * ********************************************************** */
        try {
            $sql = " SELECT  nom FROM  Breadcrumb_eleve  WHERE  module=:param1   AND  action=:param2 ";
            $resultat = $cxn->prepare($sql);
            $resultat->bindParam(':param1', $module);
            $resultat->bindParam(':param2', $action);
            $resultat->execute();
            $enregistrement = $resultat->fetch();
            $lien_active = $enregistrement['nom'];
        } catch (Exception $e) {
            echo "Une erreur est survenue lors de la récupération des données";
        }
        /*         * ************************************************** */

        /*         * **************************************************** */
        if ($lien_active != '') {
            $breadcrumb .='<li class="active"><span class="separator"></span>' . html_entity_decode_string($lien_active) . ' </li>';
        }


        return $breadcrumb;
    }

}
if (!function_exists("get_class_progression")) {

    function get_class_progression($taux) {
        $class = 'progress-bar progress-bar-u';
        if (($taux > 0) && ($taux < 25)) {
            /*             * ******* Tres faible************** */
            $class = 'progress-bar progress-bar-red';
        } elseif (($taux >= 25) && ($taux < 50)) {
            /*             * ******* Faible************** */
            $class = 'progress-bar progress-bar-dark';
        } elseif (($taux >= 50) && ($taux < 70)) {
            /*             * ******* Moyen************** */
            $class = 'progress-bar progress-bar-orange';
        } elseif (($taux >= 70) && ($taux < 80)) {
            /*             * ******* Bien************** */
            $class = 'progress-bar progress-bar-blue';
        } elseif (($taux >= 80) && ($taux <= 100)) {
            /*             * ******* Trés bien************** */
            $class = 'progress-bar progress-bar-u';
        }

        return $class;
    }

}
if (!function_exists("calcul_progression_generale_reussite")) {

    function calcul_progression_generale_reussite($code_user) {
        global $cxn;

        try {
            $sql = "  SELECT AVG(Progression_reussite_theme.taux_progression)  AS taux_reussite

                   FROM  Progression_reussite_theme  

                   WHERE Progression_reussite_theme .code_user='" . $code_user . "' ";

            $select = $cxn->query($sql);
            $enregistrement = $select->fetch();
            $taux = sprintf("%.2f", $enregistrement ['taux_reussite']);
        } catch (Exception $e) {
            echo "Une erreur est survenue lors de la récupération des données";
        }

        return $taux;
    }

}
if (!function_exists("calcul_progression_matiere_reussite")) {

    function calcul_progression_matiere_reussite($code_user, $code_matiere) {
        global $cxn;

        try {
            $sql = "  SELECT AVG(Progression_reussite_theme.taux_progression)  AS taux_reussite_matiere
                      FROM Progression_reussite_theme, Theme_quiz, Section_theme
                      WHERE Progression_reussite_theme.id_theme = Theme_quiz.id_theme
                      AND Theme_quiz.section_theme = Section_theme.id_section
                      AND Section_theme.code_matiere =  '" . $code_matiere . "'
                      AND Progression_reussite_theme.code_user =  '" . $code_user . "' ";

            $select = $cxn->query($sql);
            $enregistrement = $select->fetch();
            $taux = sprintf("%.2f", $enregistrement ['taux_reussite_matiere']);
        } catch (Exception $e) {
            echo "Une erreur est survenue lors de la récupération des données";
        }

        return $taux;
    }

}
if (!function_exists("calcul_progression_generale_travail")) {

    function calcul_progression_generale_travail($id_niveau, $code_user, $code_matiere = NULL) {
        global $cxn;
        $taux = 0;
        if (is_null($code_matiere)) {
            /*             * ************ Progression generale ***************** */
            $nbre_quiz_total_par_niveau = nombre_quiz_niveau($id_niveau, $code_user);

            $nbre_quiz_effectue_par_niveau = nombre_quiz_effectue_niveau($code_user, $id_niveau);

            if ($nbre_quiz_total_par_niveau != 0) {
                $taux = round($nbre_quiz_effectue_par_niveau / $nbre_quiz_total_par_niveau * 100, 2);
            }
        } else {
            /*             * ************ Progression par matiere ***************** */
            $nbre_quiz_total_par_niveau_matiere = nombre_quiz_niveau($id_niveau, $code_user, $code_matiere);

            $nbre_quiz_effectue_par_niveau_matiere = nombre_quiz_effectue_niveau($code_user, $id_niveau, $code_matiere);
            if ($nbre_quiz_total_par_niveau_matiere != 0) {
                $taux = round($nbre_quiz_effectue_par_niveau_matiere / $nbre_quiz_total_par_niveau_matiere * 100, 2);
            }
        }

        return $taux;
    }

}
if (!function_exists("nombre_quiz_niveau")) {

    function nombre_quiz_niveau($id_niveau, $code_user, $code_matiere = NULL) {
        global $cxn;
        $nombre = 0;
        try {
            $sql = 'SELECT COUNT( Quiz.id_quiz ) ';
            if (is_null($code_matiere)) {

                /*                 * ************ Progression generale ***************** */
                $sql .='AS nbre_quiz_par_niveau';
                $sql.=' FROM Quiz, Theme_quiz, Section_theme, List_matiere,programme_eleve_matiere';
            } else {

                /*                 * ************ Progression par matiere ***************** */
                $sql .='AS nbre_quiz_par_niveau_matiere';
                $sql.=' FROM Quiz, Theme_quiz,Section_theme,programme_eleve_matiere ';
            }
            $sql.='  WHERE Quiz.id_quiz_theme = Theme_quiz.id_theme
                 AND programme_eleve_matiere.id_theme=Theme_quiz.id_theme
                 AND Theme_quiz.section_theme = Section_theme.id_section';
            if (is_null($code_matiere)) {
                /*                 * ************ Progression generale ***************** */
                $sql .=' AND Section_theme.code_matiere = List_matiere.code_matiere';
            }
            $sql.=' AND Section_theme.id_niveau =:param1';
            $sql.=' AND programme_eleve_matiere.code_user =:param3';
            if (!is_null($code_matiere)) {

                /*                 * ************ Progression generale ***************** */
                $sql .=' AND Section_theme.code_matiere =:param2 ';
            }

            $resultat = $cxn->prepare($sql);
            $resultat->bindParam(':param1', $id_niveau);
            $resultat->bindParam(':param3', $code_user);
            if (!is_null($code_matiere)) {
                /*                 * ************ Progression generale ***************** */
                $resultat->bindParam(':param2', $code_matiere);
            }

            $resultat->execute();
            $enregistrement = $resultat->fetch();
            if (is_null($code_matiere)) {
                /*                 * ************ Progression generale ***************** */

                $nombre = $enregistrement['nbre_quiz_par_niveau'];
            } else {
                /*                 * ************ Progression par matiere ***************** */
                $nombre = $enregistrement['nbre_quiz_par_niveau_matiere'];
            }
        } catch (Exception $e) {
            echo "Une erreur est survenue lors de la récupération des données 1";
        }


        return $nombre;
    }

}

if (!function_exists("nombre_quiz_effectue_niveau")) {

    function nombre_quiz_effectue_niveau($code_user, $id_niveau, $code_matiere = NULL) {
        global $cxn;
        $nombre = 0;
        try {

            $sql = 'SELECT  COUNT(id_resultat) ';
            if (is_null($code_matiere)) {
                /*                 * ************ Progression generale ***************** */
                $sql .='AS nbre_quiz_effectue_par_niveau';
                $sql.=' FROM  Resultat_quiz,Quiz,Theme_quiz,Section_theme,List_matiere';
            } else {
                /*                 * ************ Progression par matiere ***************** */
                $sql .=' AS nbre_quiz_effectue_par_niveau_matiere';
                $sql.='  FROM  Resultat_quiz,Quiz,Theme_quiz,Section_theme';
            }
            $sql.=' WHERE Resultat_quiz.id_quiz=Quiz.id_quiz 
                AND Quiz.id_quiz_theme=Theme_quiz.id_theme
                AND Theme_quiz.section_theme=Section_theme.id_section';
            if (is_null($code_matiere)) {
                /*                 * ************ Progression generale ***************** */
                $sql .=' AND Section_theme.code_matiere = List_matiere.code_matiere';
            }
            $sql.=' AND Section_theme.id_niveau =:param1';
            $sql.=' AND Resultat_quiz.code_user=:param2';
            if (!is_null($code_matiere)) {
                /*                 * ************ Progression generale ***************** */
                $sql .=' AND Section_theme.code_matiere =:param3 ';
            }
            $resultat = $cxn->prepare($sql);
            $resultat->bindParam(':param1', $id_niveau);
            $resultat->bindParam(':param2', $code_user);
            if (!is_null($code_matiere)) {
                /*                 * ************ Progression generale ***************** */
                $resultat->bindParam(':param3', $code_matiere);
            }

            $resultat->execute();
            $enregistrement = $resultat->fetch();
            if (is_null($code_matiere)) {
                /*                 * ************ Progression generale ***************** */
                $nombre = $enregistrement['nbre_quiz_effectue_par_niveau'];
            } else {
                /*                 * ************ Progression par matiere ***************** */
                $nombre = $enregistrement['nbre_quiz_effectue_par_niveau_matiere'];
            }
        } catch (Exception $e) {
            echo "Une erreur est survenue lors de la récupération des données2";
        }

        return $nombre;
    }

}

function formatage_dure($dure) {
    $retour = array();
    $format_temps = '';

    $retour['second'] = $dure % 60;

    $dure = floor(($dure - $retour['second']) / 60);
    $retour['minute'] = $dure % 60;

    $dure = floor(($dure - $retour['minute']) / 60);
    $retour['hour'] = $dure % 24;

    $dure = floor(($dure - $retour['hour']) / 24);
    $retour['day'] = $dure;
    $format_temps = $retour['hour'] . 'H:' . $retour['minute'] . 'm :' . $retour['second'] . 's';
    return $format_temps;
}

function array_id_citation($code_matiere) {
    global $cxn;
    $array_id = array();
    /*     * ************ recuperation id_quiz ******************** */
    try {
        $sql = " SELECT  id_citation  FROM  Citations_proverbe  WHERE  matiere=:param ";

        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param', $code_matiere);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $array_id [$i] = $enregistrement['id_citation'];
            $i++;
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $array_id;
}

function generer_id_citation($array_id_citation) {
    $identifiant = '';
    $key = array_rand($array_id_citation, 1);
    $identifiant = $array_id_citation[$key];
    return $identifiant;
}

function infos_citation($id_citation) {
    global $cxn;
    $infos = array();
    try {
        $sql = " SELECT Citations_proverbe.citation,Auteurs_citations.nom,Auteurs_citations .profil,Auteurs_citations.img  

                 FROM  Citations_proverbe,Auteurs_citations   

                 WHERE Citations_proverbe.auteur=Auteurs_citations.id_auteur  AND  Citations_proverbe.id_citation=:param ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param', $id_citation);
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $infos['nom'] = $enregistrement['nom'];
        $infos['profil'] = $enregistrement['profil'];
        $infos['img'] = $enregistrement['img'];
        $infos['citation'] = $enregistrement['citation'];
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $infos;
}

function list_matiere($id_niveau, $code_eleve) {
    global $cxn;
    $list = array();
    /*     * ************ recuperation id_quiz ******************** */
    try {
        $sql = " SELECT  Liaison_matiere_niveau_eleve.id_liaison,List_matiere.nom_matiere,Liaison_matiere_niveau_eleve.code_matiere

                 FROM    Liaison_matiere_niveau_eleve,List_matiere 


                 WHERE   Liaison_matiere_niveau_eleve.code_matiere=List_matiere.code_matiere

                 AND     Liaison_matiere_niveau_eleve.activation='1'

                 AND      Liaison_matiere_niveau_eleve.id_niveau=:param ";

        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param', $id_niveau);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $list[$i]['nom_matiere'] = $enregistrement['nom_matiere'];
            $list[$i]['id_liaison'] = $enregistrement['id_liaison'];
            $list[$i]['code_matiere'] = $enregistrement['code_matiere'];
            $list[$i]['taux_progression_travail'] = calcul_progression_generale_travail($id_niveau, $code_eleve, $enregistrement['code_matiere']);
            $list[$i]['taux_progression_reussite'] = calcul_progression_matiere_reussite($code_eleve, $enregistrement['code_matiere']);
            $i++;
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $list;
}

function list_menu_1($id_liaison) {
    global $cxn;
    $list = array();
    /*     * ************ recuperation id_quiz ******************** */
    try {
        $sql = " SELECT nom, module,action,sous_menu,id_menu  FROM Menu_1_eleve WHERE activation = '1' AND id_liaison =:param ";

        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param', $id_liaison);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $list[$i]['nom'] = $enregistrement['nom'];
            $list[$i]['module'] = $enregistrement['module'];
            $list[$i]['action'] = $enregistrement['action'];
            $list[$i]['id_menu'] = $enregistrement['id_menu'];
            $list[$i]['sous_menu'] = $enregistrement['sous_menu'];
            $i++;
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données2**********";
    }
    return $list;
}

function list_menu_2($id_menu_1) {
    global $cxn;
    $list = array();
    /*     * ************ recuperation id_quiz ******************** */
    try {
        $sql = " SELECT  nom,module,action FROM  Menu_1_2_eleve  WHERE   activation='1'   AND   id_menu_1=:param ";

        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param', $id_menu_1);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $list[$i]['nom'] = $enregistrement['nom'];
            $list[$i]['module'] = $enregistrement['module'];
            $list[$i]['action'] = $enregistrement['action'];
            $i++;
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données3";
    }
    return $list;
}

function get_total_points($code_user) {
    global $cxn;

    try {
        $sql = "  SELECT  SUM(score_quiz)  AS total_points  FROM  Resultat_quiz   WHERE  code_user=:param1 ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $code_user);
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $total_points = $enregistrement ["total_points"];
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $total_points;
}

/* * *************************  Fonction  Upload ************************* */
if (!function_exists("upload_img_profil")) {

    function upload_img_profil($FILES, $random_img, $precedant_fichier = NULL) {
        $controle = TRUE;
        $imgFile = $FILES['name'];
        $tmp_dir = $FILES['tmp_name'];
        $imgSize = $FILES['size'];

        if (!empty($imgFile)) {
            $upload_dir = root_dir_img_user; // upload directory         
            $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension
            // valid image extensions
            $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
            // rename uploading image


            $img_question = $random_img . "." . $imgExt;

            // allow valid image file formats
            if (in_array($imgExt, $valid_extensions)) {

                // Check file size '5MB'
                if ($imgSize < 5000000) {

                    if (!is_null($precedant_fichier)) {
                        //echo '7';
                        $url_precedant_fichier = $upload_dir . $precedant_fichier;   //emplacement du fichier avant pour le supprimer avant le uplaod
                        // echo $url_precedant_fichier;  //debug
                        if (file_exists($url_precedant_fichier)) {
                            unlink($url_precedant_fichier);
                        }
                    }

                    $distination_img = $upload_dir . '/' . $img_question;

                    if (!move_uploaded_file($tmp_dir, $distination_img)) {
                        $controle = FALSE;
                        //echo 'entre-2';
                    }
                }
            }
        }
        return $controle;
    }

}

/* * **************** Formatage les tags ************************* */

function formatage_tag_plugin($tag) {
    if ($tag != '') {
        $tag_array = explode(',', $tag);
        $tag_formate = '';
        foreach ($tag_array as $value) {
            $tag_formate.="<span class=\"label label-info\">" . $value . "</span>&nbsp;";
        }
        $tag_formate = substr($tag_formate, 0, -1);
    }

    return $tag_formate;
}

?>