<?php

if (!function_exists("infos_user")) {

    function infos_user($code_eleve) {
        global $cxn;
        $infos = array();

        try {
            $sql = " SELECT  Membre.nom  AS nom_user,Membre.prenom  AS prenom_user,CONCAT(Membre.nom,'.',Membre.prenom) AS identite_user,Membre.profil_img,Membre.email,Membre.pseudo,DATE_FORMAT(Membre.date_inscription,'%d-%m-%Y' ) AS date_inscription,
                     List_sex.type AS sex_user,List_sex.id AS id_sex_user,Membre.newsletter,Niveau_peda.nom_niveau AS niv_peda_user,Niveau_peda.id_niveau AS id_niv_peda_user,DATE_FORMAT(Membre.date_naissance,'%Y-%m-%d' ) AS date_naissance,DATE_FORMAT(Membre.date_naissance,'%d-%m-%Y' ) AS date_naissance_view_profil "
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
                $infos['profil_img'] = url_dir_img_user . '/' . $enregistrement['profil_img'];
            } else {
                if ($enregistrement['id_sex_user'] == '1') {
                    $infos['profil_img'] = url_dir_img_user . '/avatar_h.png';
                }
                if ($enregistrement['id_sex_user'] == '2') {
                    $infos['profil_img'] = url_dir_img_user . '/avatar_f.png';
                }
            }

            if ($enregistrement['newsletter'] == '0') {
                $infos['option_newsletter'] = 'Non';
            } else {
                $infos['option_newsletter'] = 'Oui';
            }
        } catch (Exception $e) {
            $parametres_sql = array($code_eleve);
            $numargs = func_num_args();
            debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
        }

        return $infos;
    }

}

if (!function_exists("liste_sex")) {

    function liste_sex() {
        global $cxn;
        $liste = array();

        try {
            $sql = " SELECT id,type FROM List_sex ";
            $resultat = $cxn->prepare($sql);
            $resultat->execute();
            $i = 0;
            while ($enregistrement = $resultat->fetch()) {
                $liste[$i]['id_sex'] = $enregistrement['id'];
                $liste[$i]['type_sex'] = $enregistrement['type'];
                $i++;
            }
        } catch (Exception $e) {
            $numargs = func_num_args();
            debug_function(debug_backtrace(), $numargs, $e, $sql);
        }

        return $liste;
    }

}


if (!function_exists("liste_niveaux")) {

    function liste_niveaux() {
        global $cxn;
        $liste = array();

        try {
            $sql = " SELECT id,nom FROM Liste_groupe_peda  WHERE  id  IN ('2','3','4','5','6','7','8','9','10','11','12')";
            $resultat = $cxn->prepare($sql);
            $resultat->execute();
            $i = 0;
            while ($enregistrement = $resultat->fetch()) {
                $liste[$i]['nom_groupe'] = $enregistrement['nom'];
                try {
                    $sql1 = " SELECT id_niveau,nom_niveau   FROM Niveau_peda  WHERE groupe_peda=:param1 ";
                    $resultat1 = $cxn->prepare($sql1);
                    $resultat1->bindParam(':param1', $enregistrement['id']);
                    $resultat1->execute();
                    $j = 0;
                    while ($enregistrement1 = $resultat1->fetch()) {
                        $liste[$i]['liste_niveaux'][$j] ['id_niveau'] = $enregistrement1['id_niveau'];
                        $liste[$i]['liste_niveaux'][$j] ['nom_niveau'] = $enregistrement1['nom_niveau'];
                        $j++;
                    }
                } catch (Exception $e) {
                    $parametres_sql = array($enregistrement['id']);
                    $numargs = func_num_args();
                    debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
                }

                $i++;
            }
        } catch (Exception $e) {
            $numargs = func_num_args();
            debug_function(debug_backtrace(), $numargs, $e, $sql);
        }

        return $liste;
    }

}
?>

