<?php

function liste_plate_forme_travail() {
    global $cxn;
    $liste = array();
    try {
        // requete prepare
        $sql = " SELECT * FROM Liste_plate_formes_codes ";
        $resultat = $cxn->prepare($sql);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $liste[$i]['id_plate_forme'] = $enregistrement['id_plate_forme'];
            $liste[$i]['nom_plate_forme'] = html_entity_decode(stripslashes($enregistrement['nom_plate_forme']), ENT_QUOTES);
            $i++;
        }
    } catch (Exception $e) {
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql);
    }
    return $liste;
}
?>

