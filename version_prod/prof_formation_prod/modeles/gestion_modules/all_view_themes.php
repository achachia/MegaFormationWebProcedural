<?php

function list_themes($keygen_module) {
    global $cxn;
    $liste = array();
    try {

        $sql = "     SELECT nom_theme,keygen_theme FROM  Liste_themes  WHERE  fk_module=:param1  ";

        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $keygen_module);

        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {

            $liste[$i]['nom_theme'] = html_entity_decode(stripslashes($enregistrement['nom_theme']), ENT_QUOTES);


            $liste[$i]['keygen_theme'] = $enregistrement['keygen_theme'];


            $i++;
        }
    } catch (Exception $e) {
        $parametres_sql = array($keygen_module);
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
    }
    return $liste;
}
