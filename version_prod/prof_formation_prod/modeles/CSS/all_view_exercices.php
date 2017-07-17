<?php

function list_exercices($id_theme) {
    global $cxn;
    $liste = array();
    $date_actuel = date("Y-m-d H:i:s");
    try {
        // requete prepare
        $sql = " SELECT  Liste_plate_formes_codes.nom_plate_forme,Exercices_themes.titre_exo,Exercices_themes.contenu_exo,Exercices_themes.keygen_exo,Exercices_themes.img_exo"
                . ",Exercices_themes.date_limite_depot,Exercices_themes.Codefiddle_Corrige,Exercices_themes.Corrige_text "
                . "FROM  Exercices_themes,Liste_plate_formes_codes   WHERE  Exercices_themes.id_plate_forme=Liste_plate_formes_codes.id_plate_forme   AND   Exercices_themes.id_theme=:param1   ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $id_theme);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $liste[$i]['titre_exo'] = html_entity_decode(stripslashes($enregistrement['titre_exo']), ENT_QUOTES);
            $liste[$i]['contenu_exo'] = html_entity_decode(stripslashes($enregistrement['contenu_exo']), ENT_QUOTES);
            //  $liste[$i]['contenu_exo']= str_replace(['&lt;','&gt;'],['<','>'], $liste[$i]['contenu_exo']);
            $liste[$i]['keygen_exo'] = $enregistrement['keygen_exo'];
            $liste[$i]['plate_forme'] = $enregistrement['nom_plate_forme'];
            if ($enregistrement['img_exo'] != '') {
                $liste[$i]['img_exo'] = url_dir_fichier_exercices . '/' . $enregistrement['keygen_exo'] . '/' . $enregistrement['img_exo'];
            }
            $liste[$i]['date_limite_depot'] = $enregistrement['date_limite_depot'];
            if ($enregistrement['date_limite_depot'] > $date_actuel) {
                $liste[$i]['etat_depot_rep'] = '<span class="label label-info">Ouvert</span>';
            } else {
                $liste[$i]['etat_depot_rep'] = '<span class="label label-danger">Fermé</span>';
            }
             if ($enregistrement['Codefiddle_Corrige']!=''  || $enregistrement['Corrige_text']!='' ) {
                $liste[$i]['etat_corrige_exo'] = '<span class="label label-info">Corrigé disponible</span>';
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

