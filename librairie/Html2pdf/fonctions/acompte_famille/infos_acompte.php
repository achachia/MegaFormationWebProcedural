<?php

  function infos_acompte($id_acompte, $code_famille) {
        global $cxn;
        $infos = array();
        // Récupération des données
        try {
            // requete prepare
            $sql = " SELECT date_facture,N_acompte,mode_paiement,total_acompte,objet_acompte  FROM acompte  WHERE   N_acompte=:param1  AND code_famille=:param2 ";
            $resultat = $cxn->prepare($sql);
            $resultat->bindParam(':param1', $param1);
            $resultat->bindParam(':param2', $param2);
            $param1 = $id_acompte;
            $param2 = $code_famille;
            $resultat->execute();
            $enregistrement = $resultat->fetch();
            $infos['date_facture'] = $enregistrement['date_facture'];
            $infos['N_acompte'] = $enregistrement['N_acompte'];
            $infos['mode_paiement'] = $enregistrement['mode_paiement'];
            $infos['total_acompte'] = $enregistrement['total_acompte']; 
            $infos['objet_acompte'] = $enregistrement['objet_acompte']; 
        } catch (Exception $e) {
            echo "Une erreur est survenue lors de la récupération des données";
        }
        return $infos;
    }
function infos_famille($code_famille) {
    global $cxn;
    $infos = array();
    // Récupération des données
    try {
        // requete prepare
        $sql = " SELECT statut,civilite,nom,prenom,telephone_fixe,telephone_portable,telephone_travail,email,fax,adresse,adresse_suite,site_web,code_postale,ville,pays FROM membre_famille WHERE code_famille=:param ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param', $param);
        $param = $code_famille;
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $infos['civilité'] = $enregistrement['civilite'];
        $infos['nom'] = $enregistrement['nom'];
        $infos['prenom'] = $enregistrement['prenom'];
        $infos['adresse'] = $enregistrement['adresse'];
        $infos['adresse_suite'] = $enregistrement['adresse_suite'];
        $infos['code_postale'] = $enregistrement['code_postale'];
        $infos['ville'] = $enregistrement['ville'];
        $infos['pays'] = $enregistrement['pays'];
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $infos;
}

?>

