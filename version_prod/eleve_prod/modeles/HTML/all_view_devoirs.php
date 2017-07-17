<?php

function list_devoirs($id_module, $keygen_groupe, $code_user) {
    global $cxn;
    $liste = array();
    $date_actuel = date("Y-m-d H:i:s");
    try {
        // requete prepare
        $sql = "    SELECT  Liste_devoirs_users.date_publication_devoir,Liste_devoirs_users.titre_dev , Liste_devoirs_users.keygen_dev , Liaison_devoir_users.date_limite_depot_user_travail,Liaison_devoir_users.date_publication_user  "
                . " FROM    Liste_devoirs_users,Liaison_devoir_users   "
                . " WHERE   Liste_devoirs_users.keygen_dev= Liaison_devoir_users.fk_keygen_devoir "
                . "  AND   Liste_devoirs_users.fk_module=:param1"
                . "  AND   (Liaison_devoir_users.fk_keygen_groupe=:param2  OR  Liaison_devoir_users.fk_code_user=:param3) ";

        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $id_module);
        $resultat->bindParam(':param2', $keygen_groupe);
        $resultat->bindParam(':param3', $code_user);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {

            if ($enregistrement['date_publication_user'] <= $date_actuel && $enregistrement['date_publication_devoir'] <= $date_actuel) {

                $liste[$i]['titre_dev'] = html_entity_decode(stripslashes($enregistrement['titre_dev']), ENT_QUOTES);


                $liste[$i]['keygen_dev'] = $enregistrement['keygen_dev'];

                $liste[$i]['date_limite_depot'] = $enregistrement['date_limite_depot_user_travail'];


                /*                 * ************************************ verification si l'eleve a poster un commentaire***************************************************** */
                try {
                    $sql = " SELECT  id_comment  FROM  Liste_comments_devoir   WHERE  fk_code_user='" . $_SESSION ['membre']['code_eleve'] . "'   AND  fk_devoir_user='" . $liste[$i]['keygen_dev'] . "'  ";
                    $select = $cxn->query($sql);
                    $nb = $select->rowCount();
                    if ($nb <= 0) {
                        $liste[$i]['etat_comment_dev'] = '0';
                    } else {
                        $liste[$i]['etat_comment_dev'] = '1';
                    }
                } catch (Exception $e) {
                    echo $ex->getMessage() . '/' . $sql;
                    $etat = FALSE;
                }
                /*                 * ************************************ verification si l'eleve a poster un un vote***************************************************** */
                try {
                    $sql = " SELECT  id_vote  FROM  List_post_vote_devoirs  WHERE  fk_code_eleve='" . $_SESSION ['membre']['code_eleve'] . "'   AND  fk_keygen_devoir='" . $liste[$i]['keygen_dev'] . "'  ";
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



                $i++;
            }
        }
    } catch (Exception $e) {
        $parametres_sql = array($id_module);
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
    }
    return $liste;
}

function list_difficulte_dev() {

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

        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql);
    }
    return $liste;
}

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
