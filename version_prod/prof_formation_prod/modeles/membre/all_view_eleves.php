<?php

function list_eleves() {
    global $cxn;
    $liste = array();
    try {
        // requete prepare
        $sql = " SELECT      code_user,CONCAT(nom,'.',prenom) AS  identite_eleve,profil_img  FROM  Membre  WHERE  user_actif='1' ";
        $resultat = $cxn->prepare($sql);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $liste[$i]['code_eleve'] = $enregistrement['code_user'];
            $liste[$i]['identite_eleve'] = $enregistrement['identite_eleve'];
            $liste[$i]['profil_img'] = url_dir_img_eleves . '/' . $enregistrement['profil_img'];

            $i++;
        }
    } catch (Exception $e) {
        $parametres_sql = array($id_theme);
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
    }
    return $liste;
}
