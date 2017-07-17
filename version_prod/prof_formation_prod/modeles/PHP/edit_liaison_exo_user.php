<?php

function get_infos_liaison($keygen_liaison) {
    global $cxn;
    $infos = array();
    try {
        // requete prepare
        $sql = " SELECT  date_publication_user,date_publication_corrige,date_limite_depot_user_travail,fk_mode_groupe_users,fk_code_user,fk_keygen_groupe                 
                 FROM Liaison_exo_theme_user  WHERE keygen_liaison=:param1 ";

        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $keygen_liaison);
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $infos['fk_mode_groupe_users'] = $enregistrement['fk_mode_groupe_users'];
        $infos['fk_code_user'] = $enregistrement['fk_code_user'];
        $infos['fk_keygen_groupe'] = $enregistrement['fk_keygen_groupe'];
        $infos['date_publication_user'] = $enregistrement['date_publication_user'];
        $infos['date_limite_depot_user_travail'] = $enregistrement['date_limite_depot_user_travail'];
        $infos['date_publication_corrige'] = $enregistrement['date_publication_corrige'];
    } catch (Exception $e) {
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql);
    }

    return $infos;
}

function liste_mode_groupe_users() {
    global $cxn;
    $liste = array();
    try {
        // requete prepare
        $sql = " SELECT  id_groupe,mode_groupe FROM  Liste_mode_groupe  ";
        $resultat = $cxn->prepare($sql);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $liste[$i]['id_groupe'] = $enregistrement['id_groupe'];
            $liste[$i]['mode_groupe'] = $enregistrement['mode_groupe'];
            $i++;
        }
    } catch (Exception $e) {
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql);
    }

    return $liste;
}

function liste_groupe_users() {
    global $cxn;
    $liste = array();
    try {
        // requete prepare
        $sql = " SELECT  keygen_groupe,nom_groupe  FROM  Liste_groups_users   ";
        $resultat = $cxn->prepare($sql);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $liste[$i]['keygen_groupe'] = $enregistrement['keygen_groupe'];
            $liste[$i]['nom_groupe'] = $enregistrement['nom_groupe'];
            $i++;
        }
    } catch (Exception $e) {
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql);
    }

    return $liste;
}

function liste_users() {
    global $cxn;
    $liste = array();
    try {
        // requete prepare
        $sql = " SELECT  code_user , CONCAT( nom, '.', prenom ) AS nom_user  FROM  Membre    ";
        $resultat = $cxn->prepare($sql);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $liste[$i]['code_user'] = $enregistrement['code_user'];
            $liste[$i]['nom_user'] = $enregistrement['nom_user'];
            $i++;
        }
    } catch (Exception $e) {
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql);
    }

    return $liste;
}
