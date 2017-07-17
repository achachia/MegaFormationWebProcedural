<?php

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
            $liste[$i]['id_plate_forme'] = $enregistrement['id_plate_forme'];
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
        $sql = " SELECT  Exercices_themes.date_publication,Exercices_themes.aide_exo,Exercices_themes.date_created,Exercices_themes.id_plate_forme,Exercices_themes.titre_exo,Exercices_themes.contenu_exo,Exercices_themes.exercice_actif,Exercices_themes.img_exo"
                . ",Exercices_themes.date_limite_depot,Exercices_themes.corrige_text,Exercices_themes.Codefiddle_Corrige,Exercices_themes.ID_plate_forme_corrige "
                . "FROM  Exercices_themes   WHERE      Exercices_themes.keygen_exo=:param1   ";
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
        $infos['select_etat_exo'] = $enregistrement['exercice_actif'];
        $infos['id_plate_forme'] = $enregistrement['id_plate_forme'];
        $infos['id_plate_forme_corrige'] = $enregistrement['ID_plate_forme_corrige'];
        $infos['date_publication'] = $enregistrement['date_publication'];
        $infos['date_limite_depot'] = $enregistrement['date_limite_depot'];
    } catch (Exception $e) {
        $parametres_sql = array($keygen_exo);
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
    }


    return $infos;
}

?>