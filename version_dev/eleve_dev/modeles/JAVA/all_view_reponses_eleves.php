<?php

function list_eleves($keygen_exo) {
    global $cxn;
    $liste = array();
    try {
        // requete prepare
        $sql = " SELECT      Membre.code_user,CONCAT(Membre.nom,'.',Membre.prenom) AS  identite_eleve,Membre.profil_img,Corrige_exercices_eleves.keygen_rep  FROM  Membre,Corrige_exercices_eleves   WHERE  Membre.code_user=Corrige_exercices_eleves.code_eleve     AND   Membre.user_actif='1'   AND   Corrige_exercices_eleves.keygen_exo=:param1  ";
        $resultat = $cxn->prepare($sql);
         $resultat->bindParam(':param1', $keygen_exo);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $liste[$i]['code_eleve'] = $enregistrement['code_user'];
            $liste[$i]['identite_eleve'] = $enregistrement['identite_eleve'];
            $liste[$i]['profil_img'] = url_dir_img_eleves . '/' . $enregistrement['profil_img'];
            $liste[$i]['keygen_rep'] = $enregistrement['keygen_rep'];

            $i++;
        }
    } catch (Exception $e) {
        $parametres_sql = array($id_theme);
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
    }
   
    return $liste;
}