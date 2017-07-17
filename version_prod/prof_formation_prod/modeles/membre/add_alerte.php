<?php
function liste_priorite_alerte() {
    global $cxn;
    $liste = array();
    try {
        // requete prepare
        $sql = " SELECT  id_priorite,nom_priorite  FROM  Liste_degre_priorite  ";
        $resultat = $cxn->prepare($sql);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $liste[$i]['id_priorite'] = $enregistrement['id_priorite'];
            $liste[$i]['nom_priorite'] = $enregistrement['nom_priorite'];
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


?>

