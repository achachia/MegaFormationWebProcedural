<?php

function get_url_fiche_cours($id_fiche) {
    global $cxn;
    $infos_cours=array();
    try {
        // requete prepare
        $sql = " SELECT  titre,url_cours   FROM  fiches_cours  WHERE id_fiche=:param1  ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $id_fiche);
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $infos_cours['titre_cours'] = $enregistrement['titre'];
        $infos_cours['url_cours'] = $enregistrement['url_cours'];
    } catch (Exception $e) {
        $parametres_sql = array($id_theme);
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
    }
    return $infos_cours;
}

