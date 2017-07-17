<?php

function list_alertes() {
    global $cxn;
    $liste = array();
    $date_actuel = date("Y-m-d H:i:s");

    try {
        $sql = "  SELECT Liste_alerts_users.keygen_alerte,Liste_alerts_users.nom_alerte,Liste_alerts_users.description,CONCAT(Membre.nom,'.',Membre.prenom)  AS  identite_user
                  ,Liste_groups_users.nom_groupe,Liste_alerts_users.date_end,Liste_alerts_users.mode_affichage
                  ,Liste_alerts_users.date_start,Liste_alerts_users.date_end,Liste_degre_priorite.code_html  AS  code_html_priorite
                  FROM Liste_alerts_users
                  LEFT JOIN Membre ON   Liste_alerts_users.code_user = Membre.code_user
                  LEFT JOIN  Liste_groups_users  ON  Liste_alerts_users.fk_keygen_groupe=Liste_groups_users.keygen_groupe
                  LEFT JOIN Liste_degre_priorite ON   Liste_alerts_users.fk_priorite_alerte = Liste_degre_priorite.id_priorite";
                   

        $resultat = $cxn->prepare($sql);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {

            $liste[$i]['keygen_alerte'] = $enregistrement['keygen_alerte'];
            $liste[$i]['nom_alerte'] = html_entity_decode(stripslashes($enregistrement['nom_alerte']), ENT_QUOTES);
            $liste[$i]['identite_user'] = html_entity_decode(stripslashes($enregistrement['identite_user']), ENT_QUOTES);
            $liste[$i]['date_start'] = $enregistrement['date_start'];
            $liste[$i]['date_end'] = $enregistrement['date_end'];
            $liste[$i]['nom_groupe'] = html_entity_decode(stripslashes($enregistrement['nom_groupe']), ENT_QUOTES);
            $liste[$i]['description_alerte'] = html_entity_decode(stripslashes($enregistrement['description']), ENT_QUOTES);
            if ($enregistrement['date_end'] < $date_actuel) {
                $liste[$i]['etat_alerte'] = '<span class="label label-danger">Inactif</span>';
            } else {
                $liste[$i]['etat_alerte'] = '<span class="label label-info">Active</span>';
            }
            if ($enregistrement['mode_affichage'] == 'fenetre') {
                $liste[$i]['mode_affichage'] = '<span class="label label-danger">Pop-up</span>';
            } elseif ($enregistrement['mode_affichage'] == 'page') {
                $liste[$i]['mode_affichage'] = '<span class="label label-info">Bordereau</span>';
            }
          $liste[$i]['priorite_alerte'] = html_entity_decode(stripslashes($enregistrement['code_html_priorite']), ENT_QUOTES);



            $i++;
        }
    } catch (Exception $e) {
        $parametres_sql = array($id_module);
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
    }
    return $liste;
}
