<?php

function list_snippets($id_theme) {
    global $cxn;
    $liste = array();
    try {
        // requete prepare
        $sql = " SELECT  titre,keygen_code FROM  Snippet  WHERE   id_theme=:param1 ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $id_theme);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $liste[$i]['titre'] = $enregistrement['titre'];
            $liste[$i]['keygen_code'] = $enregistrement['keygen_code'];

            $i++;
        }
    } catch (Exception $e) {
        $parametres_sql = array($id_theme);
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
    }
    return $liste;
}
