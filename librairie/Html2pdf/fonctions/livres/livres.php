<?php

function rapport_recettes($month = NULL, $from = NULL, $to = NULL, $etat_facture = 'regl&eacute;') {
    global $cxn;
    $liste = array();
    try {
        $sql = " SELECT CONCAT(membre_famille.nom, '.', membre_famille.prenom) AS nom_client,facture_famille.N_facture,facture_famille.date_facture,facture_famille.total_paye,facture_famille.objet_facture,facture_famille.mode_paiement FROM facture_famille,membre_famille    ";
        $sql .= " WHERE facture_famille.code_famille=membre_famille.code_famille ";
        $sql .= " AND facture_famille.etat_facture='" . $etat_facture . "' ";
        if ($month != NULL) {
            $sql .=" AND ";
            switch ($month) {
                case "tomonth":
                    $sql .= " MONTH( date_facture ) = MONTH( NOW( ) ) ";
                    break;
                case "last":
                    $sql .= "MONTH( facture_famille.date_facture ) = MONTH(ADDDATE(CURDATE(),INTERVAL -1 MONTH))";
                    break;
                case "month3":
                    $sql .= "MONTH(ADDDATE(CURDATE(),INTERVAL -3 MONTH))<= MONTH( facture_famille.date_facture ) <= MONTH( NOW( ) )";
                    break;
                case "month6":
                    $sql .= "MONTH(ADDDATE(CURDATE(),INTERVAL -6 MONTH))<= MONTH( date_facture ) <= MONTH( NOW( ) )";
                    break;
                case "toyear":
                    $sql .= " YEAR( facture_famille.date_facture ) = YEAR( NOW( ) ) ";
                    break;
                case "lastyear":
                    $sql .= " YEAR( facture_famille.date_facture ) = YEAR( ADDDATE( CURDATE( ) , INTERVAL -1 YEAR ) ) ";
                    break;
                case "perso":
                    $sql .= " facture_famille.date_facture BETWEEN  '" . $from . "'  AND  '" . $to . "' ";
                    break;
            }
        }
        $resultat = $cxn->prepare($sql);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $liste[$i]['N_facture'] = $enregistrement['N_facture'];
            $liste[$i]['date_facture'] = $enregistrement['date_facture'];
            $liste[$i]['nom_client'] = $enregistrement['nom_client'];
            $liste[$i]['nature_prestation'] = $enregistrement['objet_facture'];
            $liste[$i]['montant'] = $enregistrement['total_paye'];
            $liste[$i]['mode_paiement'] = $enregistrement['mode_paiement'];
            $i++;
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $liste;
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

function total_recettes($month = NULL, $from = NULL, $to = NULL) {
    global $cxn;
    $etat_facture = ['regle' => 'regl&eacute;', 'attente' => 'attente', 'annule' => 'annule', 'non_regle' => 'non_regl&eacute;'];
    foreach ($etat_facture as $key => $value) {
        try {
            $sql = " SELECT  SUM(facture_famille.total_paye) AS total_recette FROM facture_famille    ";
            $sql .= " WHERE facture_famille.etat_facture='" . $value . "' ";
            if ($month != NULL) {
                $sql .=" AND ";
                switch ($month) {
                    case "tomonth":
                        $sql .= " MONTH( date_facture ) = MONTH( NOW( ) ) ";
                        break;
                    case "last":
                        $sql .= "MONTH( facture_famille.date_facture ) = MONTH(ADDDATE(CURDATE(),INTERVAL -1 MONTH))";
                        break;
                    case "month3":
                        $sql .= "MONTH(ADDDATE(CURDATE(),INTERVAL -3 MONTH))<= MONTH( facture_famille.date_facture ) <= MONTH( NOW( ) )";
                        break;
                    case "month6":
                        $sql .= "MONTH(ADDDATE(CURDATE(),INTERVAL -6 MONTH))<= MONTH( date_facture ) <= MONTH( NOW( ) )";
                        break;
                    case "toyear":
                        $sql .= " YEAR( facture_famille.date_facture ) = YEAR( NOW( ) ) ";
                        break;
                    case "lastyear":
                        $sql .= " YEAR( facture_famille.date_facture ) = YEAR( ADDDATE( CURDATE( ) , INTERVAL -1 YEAR ) ) ";
                        break;
                    case "perso":
                        $sql .= " facture_famille.date_facture BETWEEN  '" . $from . "'  AND  '" . $to . "' ";
                        break;
                }
            }
            $resultat = $cxn->prepare($sql);
            $resultat->execute();
            $enregistrement = $resultat->fetch();
            $total = ($enregistrement['total_recette'] == '') ? '0' : $enregistrement['total_recette'];
            $rapport[$key] = $total . '&euro;';
        } catch (Exception $e) {
            echo "Une erreur est survenue lors de la récupération des données";
        }
    }
    return $rapport;
}

function formatage_periode($month = NULL, $from = NULL, $to = NULL) {
    $array_mois = array('1' => 'Janvier', '2' => 'Fevrier', '3' => 'Mars', '4' => 'Avril', '5' => 'Mai', '6' => 'Juin', '7' => 'Juillet', '8' => 'Aout', '9' => 'Septembre', '10' => 'Octobre', '11' => 'Novembre', '12' => 'Decembre');
    $periode = '';
    $dateauj = date('d-m-Y');
    ////// date apres 3 mois /////////////   
    $mois = date('n');
    $year = date('Y');
    $lastyear=date('Y')-1;
    if ($month != NULL) {
        if ($month == 'perso') {
            $periode.='DU ' . $from . ' AU ' . $to;
        } elseif ($month == 'tomonth') {
            $periode.='DU ' . $array_mois[$mois] . ' ' . $year;
        } elseif ($month == 'last') {
            if ($mois == 1) {
                $year = $year - 1;
                $index_mois = 12;
            } else {
                $year = $year;
                $index_mois = $mois - 1;
            }
            $periode.='DU ' . $array_mois[$index_mois] . ' ' . $year;
        } elseif ($month == 'month3') {
            $dans_3_mois = mktime(0, 0, 0, date("m") - 3, date("d"), date("Y"));
            $date_3_m = date("d-m-Y", $dans_3_mois);
            $periode.=$date_3_m . '/' . $dateauj . ' [3 mois]';
        } elseif ($month == 'month6') {
            $dans_3_mois = mktime(0, 0, 0, date("m") - 6, date("d"), date("Y"));
            $date_3_m = date("d-m-Y", $dans_3_mois);
            $periode.=$date_3_m . '/' . $dateauj . ' [6 mois]';
        } elseif ($month == 'toyear') {
            $periode.='POUR ' . $year;
        } elseif ($month == 'lastyear') {
            $periode.='POUR ' . $lastyear;
        }
    } else {
        
    }

    return $periode;
}

?>
