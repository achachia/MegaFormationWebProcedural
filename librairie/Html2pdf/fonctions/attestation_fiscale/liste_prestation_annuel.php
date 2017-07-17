<?php
function liste_prestation_annuel($annee_fiscale, $code_famille) {
    global $cxn;
    $infos = array();
    try {
        $sql = " SELECT CONCAT( intervenants.nom, ' ', intervenants.prenom ) AS identite_intervenant, model_coupon.dure,DATE_FORMAT( compte_rendu.date_cours, '%d-%m-%Y' ) AS date_cours ";
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

        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $annee_fiscale);
        $resultat->bindParam(':param2', $code_famille);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $infos [$i] ['identite_intervenant'] = $enregistrement ['identite_intervenant'];
            $infos [$i] ['date_cours'] = $enregistrement ['date_cours'];
            $infos [$i] ['dure_cours'] = ($enregistrement ['dure'] == '1.50') ? '1.30 H' : $enregistrement ['dure'] . 'H';
            $i ++;
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données1";
    }
    return $infos;
}
?>


