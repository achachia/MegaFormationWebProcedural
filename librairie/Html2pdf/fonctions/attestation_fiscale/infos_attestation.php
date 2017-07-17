<?php

function formatage_nombre($nombre) {
    if ($nombre != NULL) {
        $tab_val = explode(".", $nombre);
        if ($tab_val ['1'] == '00' || !isset($tab_val ['1'])) {
            $nbre_h = $tab_val ['0'];
        } else {
            $nbre_h = $tab_val ['0'] . '.30';
        }
    } else {
        $nbre_h = '0';
    }
    return $nbre_h;
}

function infos_attestation($date_attestation, $annee_fiscale, $code_famille) {
    global $cxn;
    $infos = array();
    $infos ['annee_fiscale'] = $annee_fiscale;
    /**
     * ********* Clacul la somme des factures **
     */
    try {
        $sql = " SELECT  ROUND( SUM(model_coupon.dure*(facture_famille.total_paye/facture_famille.Qte)),2) AS total_paye,SUM(model_coupon.dure) AS NB_H ";

        $sql .= " FROM   compte_rendu,e_coupon,eleve_famille,membre_famille,facture_famille,model_coupon ";

        $sql .= " WHERE  compte_rendu.e_coupon=e_coupon.code_coupon ";

        $sql .= " AND    e_coupon.id_model=model_coupon.id_model ";

        $sql .= " AND    facture_famille.N_facture=e_coupon.N_facture ";

        $sql .= " AND    compte_rendu.code_eleve=eleve_famille.code_eleve";

        $sql .= " AND    membre_famille.code_famille=eleve_famille.code_famille ";

        $sql .= " AND    DATE_FORMAT(compte_rendu.date_cours,'%Y' )=:param1 ";

        $sql .= " AND   e_coupon.check_coupon='1' ";

        $sql .= " AND    membre_famille.code_famille=:param2";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $annee_fiscale);
        $resultat->bindParam(':param2', $code_famille);
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $infos ['total_regle'] = $enregistrement ['total_paye'];
        $infos ['total_h'] = formatage_nombre($enregistrement ['NB_H']);
        $infos ['date_attestation'] = $date_attestation;
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données1";
    }
    return $infos;
}

function liste_interventions($annee_fiscale, $code_famille) {
    global $cxn;
    $infos = array();
    try {
        $sql = " SELECT CONCAT( intervenants.nom, ' ', intervenants.prenom ) AS identite_intervenant, ROUND( SUM( model_coupon.dure * ( facture_famille.total_paye / facture_famille.Qte ) ) , 2 ) AS total_paye, SUM( model_coupon.dure ) AS NB_H ";
        $sql .= " FROM compte_rendu, e_coupon, eleve_famille, membre_famille, intervenants, facture_famille, model_coupon ";
        $sql .= " WHERE compte_rendu.e_coupon = e_coupon.code_coupon ";
        $sql .= " AND e_coupon.id_model = model_coupon.id_model ";
        $sql .= " AND facture_famille.N_facture = e_coupon.N_facture ";
        $sql .= " AND compte_rendu.code_eleve = eleve_famille.code_eleve ";
        $sql .= " AND membre_famille.code_famille = eleve_famille.code_famille ";
        $sql .= " AND compte_rendu.code_intervenant = intervenants.code_intervenant ";
        $sql .= " AND DATE_FORMAT( compte_rendu.date_cours, '%Y' ) = :param1 ";
        $sql .= " AND e_coupon.check_coupon = '1' ";
        $sql .= " AND membre_famille.code_famille =:param2 ";
        $sql .= " GROUP BY compte_rendu.code_intervenant ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $annee_fiscale);
        $resultat->bindParam(':param2', $code_famille);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $infos [$i] ['identite_intervenant'] = $enregistrement ['identite_intervenant'];
            $infos [$i] ['total_regle'] = $enregistrement ['total_paye'] . '&euro;';
            $infos [$i] ['total_h'] = formatage_nombre($enregistrement ['NB_H']) . 'H';
            $i ++;
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données1";
    }
    return $infos;
}

function infos_famille($code_famille) {
    global $cxn;
    $infos = array();  
    try {
        // requete prepare
        $sql = " SELECT civilite,nom,prenom,adresse,adresse_suite,code_postale,ville,pays,adresse_facturation FROM membre_famille WHERE code_famille=:param ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param', $param);
        $param = $code_famille;
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $infos ['civilite'] = $enregistrement ['civilite'];
        $infos ['nom'] = $enregistrement ['nom'];
        $infos ['prenom'] = $enregistrement ['prenom'];
        $infos ['adresse'] = $enregistrement ['adresse'];
        $infos ['adresse_suite'] = $enregistrement ['adresse_suite'];
        $infos ['code_postale'] = $enregistrement ['code_postale'];
        $infos ['ville'] = $enregistrement ['ville'];
        $infos ['pays'] = $enregistrement ['pays'];
        if ($enregistrement ['adresse_facturation'] != '') {
            $sql1 = " SELECT * FROM adresse_facturation   WHERE code_client=:param1 ";
            $resultat1 = $cxn->prepare($sql1);
            $resultat1->bindParam(':param1', $enregistrement ['adresse_facturation']);            
            $resultat1->execute();
            $enregistrement1 = $resultat1->fetch();
            $infos ['civilite'] = $enregistrement1 ['civilite'];
            $infos ['nom'] = $enregistrement1 ['nom'];
            $infos ['prenom'] = $enregistrement1 ['prenom'];
            $infos ['adresse'] = $enregistrement1 ['adresse'];
            $infos ['adresse_suite'] = $enregistrement1 ['adresse_suite'];
            $infos ['code_postale'] = $enregistrement1 ['code_postale'];
            $infos ['ville'] = $enregistrement1 ['ville'];
            $infos ['pays'] = $enregistrement1 ['pays'];
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $infos;
}

function infos_gerant() {
    global $cxn;
    $infos = array();
    try {
        $sql = " SELECT nom,prenom,adresse,code_postale,ville,pays,email,numero_identification,numero_agrement,date_agrement  FROM agences  WHERE id_agence='1' ";
        $resultat = $cxn->prepare($sql);
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $infos ['nom'] = $enregistrement ['nom'];
        $infos ['prenom'] = $enregistrement ['prenom'];
        $infos ['adresse'] = $enregistrement ['adresse'];
        $infos ['code_postale'] = $enregistrement ['code_postale'];
        $infos ['ville'] = $enregistrement ['ville'];
        $infos ['pays'] = $enregistrement ['pays'];
        $infos ['email'] = $enregistrement ['email'];
        $infos ['n_siret'] = $enregistrement ['numero_identification'];
        $infos ['n_agrement'] = $enregistrement ['numero_agrement'];
        $infos ['date_agrement'] = $enregistrement ['date_agrement'];
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $infos;
}

function insert_info_attestation($infos) {
    global $cxn;
    $id_attestation = 0;
    try {
        $select = $cxn->query(" SELECT id FROM attestation_fiscale  WHERE code_famille='" . $infos['code_famille'] . "'  AND  annee_fiscale='" . $infos['annee_fiscale'] . "' ");
        $nb = $select->rowCount();
        if ($nb <= 0) {
            try {
                $sql = " INSERT INTO  attestation_fiscale (annee_fiscale,code_famille,Nbre_heure,montant,date_attestation) VALUES (:param1,:param2,:param3,:param4,:param5) ";
                $resultat = $cxn->prepare($sql);
                $resultat->bindParam(':param1', $param1);
                $resultat->bindParam(':param2', $param2);
                $resultat->bindParam(':param3', $param3);
                $resultat->bindParam(':param4', $param4);
                $resultat->bindParam(':param5', $param5);
                $param1 = $infos['annee_fiscale'];
                $param2 = $infos['code_famille'];
                $param3 = $infos['Nbre_heure'];
                $param4 = $infos['montant'];
                $param5 = $infos['date_attestation'];
                $resultat->execute();
            } catch (Exception $e) {
                echo "Une erreur est survenue lors de la récupération des données";
            }
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    try {
        $sql = " SELECT id FROM attestation_fiscale WHERE code_famille=:param1 AND annee_fiscale=:param2 ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $param1);
        $resultat->bindParam(':param2', $param2);
        $param1 = $infos['code_famille'];
        $param2 = $infos['annee_fiscale'];
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $id_attestation = $enregistrement['id'];
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $id_attestation;
}

?>
