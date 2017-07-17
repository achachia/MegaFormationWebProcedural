<?php

function list_liaisons_exo($keygen_exo) {
    global $cxn;
    $liste = array();
    $date_actuel = date("Y-m-d H:i:s");
    try {
        // requete prepare
        $sql = " SELECT Liaison_exo_theme_user.keygen_liaison, CONCAT( Membre.nom, '.', Membre.prenom ) AS identite_user, Liste_groups_users.nom_groupe
                 ,Liaison_exo_theme_user.date_publication_user,Liaison_exo_theme_user.date_publication_corrige,Liaison_exo_theme_user.date_limite_depot_user_travail
                 FROM Liaison_exo_theme_user
                 LEFT JOIN Membre ON Liaison_exo_theme_user.fk_code_user = Membre.code_user
                 LEFT JOIN Liste_groups_users ON Liaison_exo_theme_user.fk_keygen_groupe = Liste_groups_users.keygen_groupe  WHERE  Liaison_exo_theme_user.fk_exo=:param1  ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $keygen_exo);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $liste[$i]['keygen_liaison'] = $enregistrement['keygen_liaison'];
            $liste[$i]['identite_user'] = html_entity_decode(stripslashes($enregistrement['identite_user']), ENT_QUOTES);
            $liste[$i]['nom_groupe'] = html_entity_decode(stripslashes($enregistrement['nom_groupe']), ENT_QUOTES);
            $liste[$i]['date_publication_user'] = $enregistrement['date_publication_user'];
            $liste[$i]['date_limite_depot'] = $enregistrement['date_limite_depot_user_travail'];
            $liste[$i]['date_publication_corrige'] = $enregistrement['date_publication_corrige'];
            if ($enregistrement['date_limite_depot_user_travail'] <= $date_actuel) {
                $liste[$i]['etat_droit'] = '<span class="label label-danger">Fermé</span>';
            } else {
                $liste[$i]['etat_droit'] = '<span class="label label-info">Ouvert</span>';
            }

            /*             * ********* Compter le nombre de corrige ************************** */
            try {
                $sql = " SELECT  id_corrige FROM Corrige_exercices_eleves   WHERE  keygen_exo='" . $keygen_exo . "'  ";
                $select = $cxn->query($sql);
                $nb = $select->rowCount();
                $liste[$i]['nbr_corrige_user'] = '<span class="badge">' . $nb . '</span>';
            } catch (Exception $e) {
                $etat = FALSE;
                echo "Une erreur est survenue lors de la récupération des données 2";
            }

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
