<?php

function list_exercices($id_theme) {
    global $cxn;
    $liste = array();
    try {
        // requete prepare
        $sql = " SELECT  Liste_plate_formes_codes.nom_plate_forme,Exercices_themes.titre_exo,Exercices_themes.contenu_exo,Exercices_themes.keygen_exo,Exercices_themes.img_exo "
                . "FROM  Exercices_themes,Liste_plate_formes_codes   WHERE  Exercices_themes.id_plate_forme=Liste_plate_formes_codes.id_plate_forme   AND   Exercices_themes.id_theme=:param1   ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $id_theme);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $liste[$i]['titre_exo'] = $enregistrement['titre_exo'];
            $liste[$i]['contenu_exo'] = html_entity_decode(stripslashes($enregistrement['contenu_exo']), ENT_QUOTES);
            //  $liste[$i]['contenu_exo']= str_replace(['&lt;','&gt;'],['<','>'], $liste[$i]['contenu_exo']);
            $liste[$i]['keygen_exo'] = $enregistrement['keygen_exo'];
            $liste[$i]['plate_forme'] = $enregistrement['nom_plate_forme'];
            if ($enregistrement['img_exo'] != '') {
                $liste[$i]['img_exo'] = url_dir_fichier_exercices . '/' . $enregistrement['keygen_exo'] . '/' . $enregistrement['img_exo'];
            }

            /*             * ****************************************************** */
            try {
                $sql = " SELECT  id_corrige FROM Corrige_exercices_eleves   WHERE  keygen_exo='" . $enregistrement['keygen_exo'] . "'  ";
                $select = $cxn->query($sql);
                $nb = $select->rowCount();
                $liste[$i]['nbr_reponses'] = $nb;
            } catch (Exception $e) {
                $etat = FALSE;
                echo "Une erreur est survenue lors de la récupération des données 2";
            }
            /*             * ********************************************** */

            $i++;
        }
    } catch (Exception $e) {
        $parametres_sql = array($id_theme);
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
    }
    return $liste;
}
