<?php

function list_themes($keygen_module) {
    global $cxn;
    $liste = array();
   
    try {

        $sql = "    SELECT  Liaison_themes_users.date_publication_user,Liste_themes.nom_theme,Liste_themes.keygen_theme  "
                . " FROM    Liaison_themes_users,Liste_themes,Liste_modules   "
                . " WHERE   Liaison_themes_users.fk_theme= Liste_themes.keygen_theme "
                . "  AND  Liste_themes.fk_module=Liste_modules.keygen_module"
                . "  AND   Liste_modules.keygen_module=:param1";


        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $keygen_module);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {


            $liste[$i]['keygen_theme'] = html_entity_decode(stripslashes($enregistrement['keygen_theme']), ENT_QUOTES);

            $liste[$i]['nom_theme'] = html_entity_decode(stripslashes($enregistrement['nom_theme']), ENT_QUOTES);
            $i++;
        }
    } catch (Exception $e) {
        $parametres_sql = array($id_module);
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
    }
    return $liste;
}


