<?php

function list_devoirs($id_module) {
    global $cxn;
    $liste = array();
    $date_actuel = date("Y-m-d H:i:s");
    try {
        // requete prepare
        $sql = "    SELECT  Liste_devoirs_users.titre_dev , Liste_devoirs_users.keygen_dev "
                . " FROM    Liste_devoirs_users   "
                . " WHERE   Liste_devoirs_users.fk_module=:param1 ";
              
           

        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $id_module);
   
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {           

                $liste[$i]['titre_dev'] = html_entity_decode(stripslashes($enregistrement['titre_dev']), ENT_QUOTES);


                $liste[$i]['keygen_dev'] = $enregistrement['keygen_dev'];

             
                $i++;
         
        }
    } catch (Exception $e) {
        $parametres_sql = array($id_module);
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
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

