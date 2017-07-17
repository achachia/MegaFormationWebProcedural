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

function infos_facture($id_facture, $code_famille) {
    global $cxn;
    $infos = array();
    try {
        $sql = "    SELECT facture_famille.TotalTva,facture_famille.MontantTva,facture_famille.TauxTVA,DATE_FORMAT(facture_famille.date_facture,'%d/%m/%Y') AS date_facture,"
                . " facture_famille.N_facture,facture_famille.etat_facture,ListeModePaiements.nom_mode AS mode_paiement,facture_famille.objet_facture,facture_famille.total_paye,facture_famille.designation,"
                . " facture_famille.Qte,facture_famille.PrixHT,facture_famille.genre_remise,facture_famille.remise,facture_famille.total_paye,facture_famille.numero_acompte "
                . " FROM facture_famille,ListeModePaiements"
                . " WHERE facture_famille.mode_paiement=ListeModePaiements.id_mode  "
                . " AND N_facture=:param1  AND code_famille=:param2 ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $param1);
        $resultat->bindParam(':param2', $param2);
        $param1 = $id_facture;
        $param2 = $code_famille;
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $infos ['date_facture'] = $enregistrement ['date_facture'];
        $infos ['N_facture'] = $enregistrement ['N_facture'];
        $infos ['etat_facture'] = $enregistrement ['etat_facture'];
        $infos ['mode_paiement'] = $enregistrement ['mode_paiement'];
        $infos ['objet_facture'] = $enregistrement ['objet_facture'];
        $infos ['total_paye'] = $enregistrement ['total_paye'];
        $infos ['designation_facture'] = html_entity_decode($enregistrement ['designation']);
        $infos ['Qte'] = formatage_nombre($enregistrement ['Qte']);
        $infos ['PU_HT'] = $enregistrement ['PrixHT'];
        if ($enregistrement ['genre_remise'] != NULL) {
            $infos ['remise'] = $enregistrement ['remise'];
        } else {
            $infos ['remise'] = 0;
        }
        if ($enregistrement ['TauxTVA'] != NULL) {
            $infos ['TauxTVA'] = $enregistrement ['TauxTVA'];
            $infos ['MontantTva'] = $enregistrement ['MontantTva'];
            $infos ['TotalTva'] = $enregistrement ['TotalTva'];
        }
        if ($enregistrement ['numero_acompte'] != 0) {
            try {
                $sql1 = " SELECT total_acompte,date_acompte FROM acompte WHERE   N_acompte=:param3 ";
                $resultat1 = $cxn->prepare($sql1);
                $resultat1->bindParam(':param3', $param3);
                $param3 = $enregistrement ['numero_acompte'];
                $resultat1->execute();
                $enregistrement1 = $resultat1->fetch();
                $infos ['numero_acompte'] = $enregistrement ['numero_acompte'];
                $infos ['total_acompte'] = $enregistrement1 ['total_acompte'];
                $infos ['date_acompte'] = $enregistrement1 ['date_acompte'];
            } catch (Exception $e) {
                echo "Une erreur est survenue lors de la récupération des données00";
            }
        } else {
            $infos ['total_acompte'] = 0;
        }
        $infos ['total_restant'] = $infos ['total_paye'] - $infos ['total_acompte'];
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données01";
    }
    return $infos;
}

function infos_famille($code_famille,$N_facture) {
    global $cxn;
    $infos = array();

    try {

        $sql = " SELECT  adresse_facturation FROM  facture_famille     WHERE   code_famille ='" . $code_famille . "'  AND  N_facture='" . $N_facture . "' ";     
        $select = $cxn->query($sql);
        $nb = $select->rowCount();
        if ($nb > 0) {
            $enregistrement = $select->fetch();
            if ($enregistrement['adresse_facturation'] != '') {
                $code_client=$enregistrement['adresse_facturation'];
               
                try {

                    $sql = " SELECT civilite,nom,prenom,"
                            . "adresse,adresse_suite,"
                            . "code_postale,ville,pays FROM adresse_facturation WHERE code_client=:param ";
                    $resultat = $cxn->prepare($sql);
                    $resultat->bindParam(':param', $param);
                    $param = $code_client;
                    $resultat->execute();
                    $enregistrement = $resultat->fetch();
                    $infos ['nom'] = $enregistrement ['civilite'] . ' ' . $enregistrement ['nom'] . ' ' . $enregistrement ['prenom'];
                    $infos ['adresse'] = $enregistrement ['adresse'];
                    if (!is_null($enregistrement ['adresse_suite'])) {
                        $infos ['adresse_suite'] = $enregistrement ['adresse_suite'];
                    }
                    $infos ['code_postale'] = $enregistrement ['code_postale'];
                    $infos ['ville'] = $enregistrement ['ville'];
                    $infos ['pays'] = $enregistrement ['pays'];
                } catch (Exception $e) {
                    $objet ['message_erreur'] [] = '[Exception] : ' . $e->getMessage();
                }
            } else {
                /*                 * ******************en cas de pas adresse de facturation *********************************** */
                try {

                    $sql = " SELECT civilite,nom,prenom,"
                            . "adresse,adresse_suite,"
                            . "code_postale,ville,pays FROM membre_famille WHERE code_famille=:param ";
                    $resultat = $cxn->prepare($sql);
                    $resultat->bindParam(':param', $param);
                    $param = $code_famille;
                    $resultat->execute();
                    $enregistrement = $resultat->fetch();
                    $infos ['nom'] = $enregistrement ['civilite'] . ' ' . $enregistrement ['nom'] . ' ' . $enregistrement ['prenom'];
                    $infos ['adresse'] = $enregistrement ['adresse'];
                    if (!is_null($enregistrement ['adresse_suite'])) {
                        $infos ['adresse_suite'] = $enregistrement ['adresse_suite'];
                    }
                    $infos ['code_postale'] = $enregistrement ['code_postale'];
                    $infos ['ville'] = $enregistrement ['ville'];
                    $infos ['pays'] = $enregistrement ['pays'];
                } catch (Exception $e) {
                    $objet ['message_erreur'] [] = '[Exception] : ' . $e->getMessage();
                }
            }
        }
    } catch (Exception $e) {

        $objet ['message_erreur'] [] = '[Exception] : ' . $e->getMessage();
    }

    return $infos;
}

function infos_gerant() {
    global $cxn;
    $infos = array();
    try {
        $sql = " SELECT nom,prenom,adresse,code_postale,ville,pays,email,numero_identification,numero_agrement  FROM agences  WHERE id_agence='1' ";
        $resultat = $cxn->prepare($sql);
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $infos ['nom'] = $enregistrement ['nom'] . ' ' . $enregistrement ['prenom'];
        $infos ['adresse'] = $enregistrement ['adresse'];
        $infos ['code_postale'] = $enregistrement ['code_postale'];
        $infos ['ville'] = $enregistrement ['ville'];
        $infos ['pays'] = $enregistrement ['pays'];
        $infos ['email'] = $enregistrement ['email'];
        $infos ['n_siret'] = $enregistrement ['numero_identification'];
        $infos ['n_agrement'] = $enregistrement ['numero_agrement'];
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $infos;
}

?>
