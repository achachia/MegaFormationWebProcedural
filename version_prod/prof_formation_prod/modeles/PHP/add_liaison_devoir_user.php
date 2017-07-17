<?php

function list_liaisons_devoir($keygen_dev) {
    global $cxn;
    $liste = array();
    try {
        // requete prepare
        $sql = " SELECT  keygen_liaison,date_limite_depot_user_travail  FROM  Liaison_devoir_users   WHERE   fk_keygen_devoir=:param1  ";
        $resultat = $cxn->prepare($sql);
          $resultat->bindParam(':param1', $keygen_dev);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $liste[$i]['keygen_liaison'] = $enregistrement['keygen_liaison'];
            $liste[$i]['date_limite_depot'] = $enregistrement['date_limite_depot_user_travail'];
            $i++;
        }
    } catch (Exception $e) {     
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql);
    }

    return $liste;
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

