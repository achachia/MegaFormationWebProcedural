<?php

if (!function_exists("infos_user")) {

    function infos_user($code_eleve) {
        global $cxn;
        $infos = array();

        try {
            $sql = " SELECT  Membre.nom  AS nom_user,Membre.prenom  AS prenom_user,CONCAT(Membre.nom,'.',Membre.prenom) AS identite_user,Membre.profil_img,Membre.email,Membre.pseudo,DATE_FORMAT(Membre.date_inscription,'%d-%m-%Y' ) AS date_inscription,
                     List_sex.type AS sex_user,List_sex.id AS id_sex_user,Niveau_peda.nom_niveau AS niv_peda_user,Niveau_peda.id_niveau AS id_niv_peda_user,DATE_FORMAT(Membre.date_naissance,'%Y-%m-%d' ) AS date_naissance,DATE_FORMAT(Membre.date_naissance,'%d-%m-%Y' ) AS date_naissance_view_profil,
                     Membre.code_jsfidlle,Membre.code_phpfiddle,
                     Membre.projet_prof,Membre.contenu_projet_prof,Membre.deja_programme,Membre.langages_dev,Membre.attentes,Membre.deja_avoir_formation,Membre.contenu_formation  "
                    . "  FROM  Membre,List_sex,Niveau_peda  "
                    . " WHERE  Membre.sex=List_sex.id "
                    . " AND  Membre.id_niveau=Niveau_peda.id_niveau "
                    . " AND   Membre.code_user=:param1 ";

            $resultat = $cxn->prepare($sql);
            $resultat->bindParam(':param1', $code_eleve);
            $resultat->execute();
            $enregistrement = $resultat->fetch();
            $infos['nom_user'] = $enregistrement['nom_user'];
            $infos['prenom_user'] = $enregistrement['prenom_user'];
            $infos['identite_user'] = $enregistrement['identite_user'];
            $infos['pseudo'] = $enregistrement['pseudo'];
            $infos['email'] = $enregistrement['email'];
            $infos['date_naissance'] = $enregistrement['date_naissance'];
            $infos['date_naissance_view_profil'] = $enregistrement['date_naissance_view_profil'];
            $infos['date_inscription'] = $enregistrement['date_inscription'];
            $infos['sex_user'] = $enregistrement['sex_user'];
            $infos['id_sex_user'] = $enregistrement['id_sex_user'];
            $infos['niv_peda_user'] = $enregistrement['niv_peda_user'];
            $infos['id_niv_peda_user'] = $enregistrement['id_niv_peda_user'];
            if ($enregistrement['profil_img'] != '') {
                $infos['profil_img'] = url_dir_img_eleves . '/' . $enregistrement['profil_img'];
            } else {
                if ($enregistrement['id_sex_user'] == '1') {
                    $infos['profil_img'] = url_dir_img_eleves . '/avatar_h.png';
                }
                if ($enregistrement['id_sex_user'] == '2') {
                    $infos['profil_img'] = url_dir_img_eleves . '/avatar_f.png';
                }
            }
            $infos['id_js_fiddle'] = $enregistrement['code_jsfidlle'];
            $infos['id_php_fiddle'] = $enregistrement['code_phpfiddle'];
            if ($enregistrement['projet_prof'] == '1') {
                $infos['projet_professionel'] = 'OUI';
            } else {
                $infos['projet_professionel'] = 'NON';
            }
            $infos['contenu_projet_professionel'] = html_entity_decode(stripslashes($enregistrement['contenu_projet_prof']), ENT_QUOTES);
            if ($enregistrement['deja_programme'] == '1') {
                $infos['deja_programme'] = 'OUI';
            } else {
                $infos['deja_programme'] = 'NON';
            }

            $infos['liste_langages_dev'] = html_entity_decode(stripslashes($enregistrement['langages_dev']), ENT_QUOTES);
            $infos['attentes'] = html_entity_decode(stripslashes($enregistrement['attentes']), ENT_QUOTES);
            if ($enregistrement['deja_avoir_formation'] == '1') {
                $infos['deja_avoir_formation'] = 'OUI';
            } else {
                $infos['deja_avoir_formation'] = 'NON';
            }
            $infos['contenu_formation'] = html_entity_decode(stripslashes($enregistrement['contenu_formation']), ENT_QUOTES);
        } catch (Exception $e) {
            $parametres_sql = array($code_eleve);
            $numargs = func_num_args();
            debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
        }

        return $infos;
    }

}
