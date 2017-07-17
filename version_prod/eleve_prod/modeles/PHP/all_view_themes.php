<?php

function list_themes($keygen_module, $keygen_groupe, $code_user) {
    global $cxn;
    $liste = array();
    $date_actuel = date("Y-m-d H:i:s");
    try {
      
        $sql = "    SELECT  Liaison_themes_users.date_publication_user,Liste_themes.nom_theme,Liste_themes.keygen_theme  "
                . " FROM    Liaison_themes_users,Liste_themes,Liste_modules   "
                . " WHERE   Liaison_themes_users.fk_theme= Liste_themes.keygen_theme "
                ."  AND  Liste_themes.fk_module=Liste_modules.keygen_module"
                . "  AND   Liste_modules.keygen_module=:param1"
                . "  AND   (Liaison_themes_users.fk_keygen_groupe=:param2  OR  Liaison_themes_users.fk_code_user=:param3) ";

        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $keygen_module);
        $resultat->bindParam(':param2', $keygen_groupe);
        $resultat->bindParam(':param3', $code_user);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {

            if ($enregistrement['date_publication_user'] <= $date_actuel ) {
                 $liste[$i]['keygen_theme'] = html_entity_decode(stripslashes($enregistrement['keygen_theme']), ENT_QUOTES);

                $liste[$i]['nom_theme'] = html_entity_decode(stripslashes($enregistrement['nom_theme']), ENT_QUOTES);
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





