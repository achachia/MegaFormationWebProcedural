<?php

function get_infos_devoir($keygen_devoir) {
    global $cxn;
    $infos = array();    
    try {
        // requete prepare
        $sql = " SELECT  titre_dev  FROM  Liste_devoirs_users  WHERE   keygen_dev=:param1 ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $keygen_devoir);
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $infos['titre_dev'] = $enregistrement['titre_dev'];
    } catch (Exception $e) {
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql);
    }
    return $infos;
}

function liste_plate_forme_travail() { 
    global $cxn;
    $liste = array();
    try {
        // requete prepare 
        $sql = " SELECT * FROM Liste_plate_formes_codes ";
        $resultat = $cxn->prepare($sql);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $liste[$i]['ID_plate_forme_depot'] = $enregistrement['id_plate_forme'];
            $liste[$i]['nom_plate_forme'] = html_entity_decode(stripslashes($enregistrement['nom_plate_forme']), ENT_QUOTES);
            $i++;
        }
    } catch (Exception $e) {
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql);
    }
    return $liste;
}

function infos_exo($keygen_exo) {
    global $cxn;
    $infos = array();
    try {
        // requete prepare
        $sql = " SELECT  Liste_exo_devoirs_users.date_publication,Liste_exo_devoirs_users.aide_exo,Liste_exo_devoirs_users.date_created,Liste_exo_devoirs_users.ID_plate_forme_depot,Liste_exo_devoirs_users.titre_exo,Liste_exo_devoirs_users.contenu_exo,Liste_exo_devoirs_users.img_exo"
                . ",Liste_exo_devoirs_users.ID_plate_forme_depot,Liste_exo_devoirs_users.corrige_text,Liste_exo_devoirs_users.Codefiddle_Corrige,Liste_exo_devoirs_users.ID_plate_forme_corrige,Liste_exo_devoirs_users.nbr_points "
                . "FROM  Liste_exo_devoirs_users   WHERE      Liste_exo_devoirs_users.keygen_exo=:param1   ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $keygen_exo);
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $infos['titre_exo'] = $enregistrement['titre_exo'];
        $infos['contenu_exo'] = html_entity_decode(stripslashes($enregistrement['contenu_exo']), ENT_QUOTES);
        $infos['aide_exo'] = html_entity_decode(stripslashes($enregistrement['aide_exo']), ENT_QUOTES);
        $infos['corrige_text_exo'] = html_entity_decode(stripslashes($enregistrement['corrige_text']), ENT_QUOTES);
        $infos['codefiddle_corrige'] = html_entity_decode(stripslashes($enregistrement['Codefiddle_Corrige']), ENT_QUOTES);
        //  $liste[$i]['contenu_exo']= str_replace(['&lt;','&gt;'],['<','>'], $liste[$i]['contenu_exo']);

        $infos['ID_plate_forme_depot'] = $enregistrement['ID_plate_forme_depot'];
        $infos['ID_plate_forme_depot_corrige'] = $enregistrement['ID_plate_forme_corrige'];
        $infos['date_publication'] = $enregistrement['date_publication'];        
        $infos['nbr_points'] = $enregistrement['nbr_points'];
    } catch (Exception $e) {
        $parametres_sql = array($keygen_exo);
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
    }


    return $infos;
}

?>
