<?php

function liste_codes() {
    global $cxn;
    $liste = array();
    $date_actuel = date("Y-m-d H:i:s");
    try {
        // requete prepare
        $sql = " SELECT  DISTINCT Liste_mode_public.nom_mode,Corrige_exercices_eleves.nom_code,Liste_modules.nom_module,Corrige_exercices_eleves.code_fiddle,Corrige_exercices_eleves.version_code"
                . ",Corrige_exercices_eleves.date_created,Corrige_exercices_eleves.comment_code,Corrige_exercices_eleves.labels_code,Corrige_exercices_eleves.fk_statut_code,Exercices_themes.titre_exo,Exercices_themes.date_limite_depot"
                . ",Corrige_exercices_eleves.fk_statut_code,Corrige_exercices_eleves.keygen_exo,Corrige_exercices_eleves.id_mode_public  "
                . " FROM  Corrige_exercices_eleves,Exercices_themes,Liste_modules,Liste_mode_public,Liste_statut_code  "
                . " WHERE   Corrige_exercices_eleves.keygen_exo=Exercices_themes.keygen_exo  "
                . "AND  Exercices_themes.id_theme=Liste_modules.id_module "
                . " AND Corrige_exercices_eleves.id_mode_public=Liste_mode_public.id_mode"
                . "  AND  Corrige_exercices_eleves.code_eleve=:param1  ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $_SESSION ['membre']['code_eleve']);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $liste[$i]['date_created'] = $enregistrement['date_created'];
            $liste[$i]['nom_code'] = $enregistrement['nom_code'];

            $liste[$i]['keygen_exo'] = $enregistrement['keygen_exo'];
            $liste[$i]['titre_exo'] = $enregistrement['titre_exo'];
            $liste[$i]['id_mode_public'] = $enregistrement['id_mode_public'];
            $liste[$i]['ID_code'] = $enregistrement['code_fiddle'];
            if ($enregistrement['version_code'] != '') {
                $liste[$i]['ID_code'] .= '/' . $enregistrement['version_code'];
            }
            $liste[$i]['nom_theme'] = $enregistrement['nom_module'];
            $liste[$i]['mode_partage'] = $enregistrement['nom_mode'];
            $liste[$i]['comment_code'] = $enregistrement['comment_code'];
            $liste[$i]['labels_code'] = $enregistrement['labels_code'];
            $liste[$i]['labels_code_formate'] = formatage_tag_plugin($enregistrement['labels_code']);
            if ($enregistrement['fk_statut_code'] == '1') {
                $liste[$i]['statut_code'] = '<span class="label label-info">Attente</span>';
            } else if ($enregistrement['fk_statut_code'] == '2') {
                $liste[$i]['statut_code'] = '<span class="label label-primary">En cours de traitement</span>';
            } else if ($enregistrement['fk_statut_code'] == '3') {
                $liste[$i]['statut_code'] = '<span class="label label-success">Code correct</span>';
            } else if ($enregistrement['fk_statut_code'] == '4') {
                $liste[$i]['statut_code'] = '<span class="label label-danger">Code non correct</span>';
            } else if ($enregistrement['fk_statut_code'] == '5') {
                $liste[$i]['statut_code'] = '<span class="label label-warning">Code inaccessible</span>';
            }
            $liste[$i]['option_disabled'] = '';
            if ($enregistrement['date_limite_depot'] != '') {
                if ($enregistrement['date_limite_depot'] < $date_actuel) {
                    $liste[$i]['option_disabled'] = 'disabled';
                }
            }

            $i++;
        }
    } catch (Exception $e) {
        $parametres_sql = array($id_theme);
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
    }
    return $liste;
}
