<?php

function get_infos_dev($keygen_devoir) {
    global $cxn;
    $infos = array();
    try {
        // requete prepare
        $sql = " SELECT   titre_dev,description_dev,date_publication_devoir,fk_module  FROM  Liste_devoirs_users  WHERE  keygen_dev=:param1  ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $keygen_devoir);
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $infos['titre_dev'] = html_entity_decode(stripslashes($enregistrement['titre_dev']), ENT_QUOTES);
        $infos['description_dev'] = html_entity_decode(stripslashes($enregistrement['description_dev']), ENT_QUOTES);
        $infos['date_publication']=$enregistrement['date_publication_devoir'];
        $infos['fk_module']=$enregistrement['fk_module'];
    } catch (Exception $e) {
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql);
    }

    return $infos;
}
