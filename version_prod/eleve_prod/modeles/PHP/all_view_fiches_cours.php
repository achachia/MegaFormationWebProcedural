<?php

function list_fiches_cours($id_theme) {
    global $cxn;
    $liste = array();
    try {
       
        $sql = " SELECT  id_fiche,titre FROM  fiches_cours  WHERE id_theme=:param1  AND  fiche_actif='1' ";        
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $id_theme);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $liste[$i]['id_fiche'] = $enregistrement['id_fiche'];
            $liste[$i]['titre'] = $enregistrement['titre'];
            $i++;
        }
    } catch (Exception $e) {
        $parametres_sql = array($id_theme);
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
    }
    return $liste;
}
