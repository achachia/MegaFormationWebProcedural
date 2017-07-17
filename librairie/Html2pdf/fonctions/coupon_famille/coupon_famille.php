<?php

function format_date() {
    $today = date('Y/n/d');
    $tab_date = explode("/", $today);
    if ($tab_date ['1'] >= 1 && $tab_date ['1'] <= 8) {
        $anne_precedente = $tab_date ['0'] - 1;
        $annee_scolaire = $anne_precedente . "/" . $tab_date ['0'];
    } elseif ($tab_date ['1'] >= 9 && $tab_date ['1'] <= 12) {
        $annee_suivante = $tab_date ['0'] + 1;
        $annee_scolaire = $tab_date ['0'] . "/" . $annee_suivante;
    }
    return $annee_scolaire;
}

function infos_coupon($code_user, $code_facture, $nbre_cours) {
    global $cxn;
    // chercher le code beneficiaire
    try {
        $sql = " SELECT  code_eleve FROM facture_famille WHERE N_facture='" . $code_facture . "'  ";
        $resultat = $cxn->prepare($sql);
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $code_eleve = $enregistrement ['code_eleve'];
      
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    try {
        $sql = " SELECT membre_famille.nom AS nom_famille,membre_famille.prenom AS prenom_famille,"
                . "eleve_famille.nom  AS nom_eleve,eleve_famille.prenom  AS prenom_eleve,"
                . "model_coupon.nom AS dure_coupon  FROM membre_famille,eleve_famille,"
                . "facture_famille,model_coupon WHERE membre_famille.code_famille=eleve_famille.code_famille "
                . " AND membre_famille.code_famille=facture_famille.code_famille "
                . "AND facture_famille.id_model=model_coupon.id_model "
                . "AND membre_famille.code_famille='" . $code_user . "'  "
                . "AND facture_famille.N_facture='" . $code_facture . "'  "
                . "AND eleve_famille.code_eleve='" . $code_eleve . "'  ";  

        $resultat = $cxn->prepare($sql);
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $infos ['annee_scolaire'] = format_date();
        $infos ['nbre_cours'] = $nbre_cours;
        $infos ['parent_eleve'] = $enregistrement ['nom_famille'] . '.' . $enregistrement ['prenom_famille'];
        $infos ['eleve'] = $enregistrement ['nom_eleve'] . '.' . $enregistrement ['prenom_eleve'];
        $infos ['duree_coupon'] = $enregistrement ['dure_coupon'];
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $infos;
}

function liste_coupon($numero_facture) {
    global $cxn;
    $liste = array();
    $sql = "SELECT  DATE_FORMAT(date_limite,'%d/%m/%Y') AS date_limite,code_coupon,N_facture FROM e_coupon WHERE N_facture='" . $numero_facture . "'  ";
    $resultat = $cxn->prepare($sql);
    $resultat->execute();
    $i = 0;
    while ($enregistrement = $resultat->fetch()) {
        $liste [$i]['code_coupon'] = $enregistrement ['code_coupon'];
        $liste [$i]['code_facture'] = $enregistrement ['N_facture'];
        $liste [$i]['date_limite'] = $enregistrement ['date_limite'];
        $i ++;
    }
    return $liste;
}

?>
