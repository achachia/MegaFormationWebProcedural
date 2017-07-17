<?php
session_start();
if (isset($_SESSION ['membre'] ['code_admin'])) {
    ob_start();
    require "./../../../connection/config.php";
    require "./../fonctions/attestation_fiscale/infos_attestation.php";
    require "./../fonctions/attestation_fiscale/liste_prestation_annuel.php";
    $infos = array();
    $infos['code_famille'] = $_POST['choix_famille'];
    $infos['date_attestation'] = $_POST['date_attestation'];
    $infos['annee_fiscale'] = $_POST['choix_annee'];
    $infos_famille = infos_famille($infos['code_famille']);
    $infos_gerant = infos_gerant();
    $infos_attestation = infos_attestation($infos['date_attestation'], $infos['annee_fiscale'], $infos['code_famille']);
    $infos['montant'] = $infos_attestation['total_regle'];
    $infos['Nbre_heure'] = $infos_attestation['total_h'];
    $liste_interventions = liste_interventions($infos['annee_fiscale'], $infos['code_famille']);
    $liste_prestations_annuel = liste_prestation_annuel($infos['annee_fiscale'], $infos['code_famille']);
    $id_attestation = insert_info_attestation($infos);
    include (dirname(__FILE__) . '/res/attestation_fiscale.php');
    include (dirname(__FILE__) . '/res/liste_prestation_annuel.php');
    $content = ob_get_clean();   

// convert in PDF
    
    require_once (dirname(__FILE__) . '/../html2pdf.class.php');
    try {
        $html2pdf = new HTML2PDF('P', 'A4', 'fr');      
        if (isset($_GET ['mode']) && !empty($_GET ['mode'])) {
            $html2pdf->pdf->IncludeJS("print(true);");
        }
        // $html2pdf->setModeDebug();
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($content, isset($_GET ['vuehtml']));
        $dossier = '/home/megacour/public_html/telechargement/attestation_fiscale/' . $infos['code_famille'];
        $attestation_fiscale = 'attestation_fiscale_' . $infos['code_famille'] . '_' . $infos['annee_fiscale'] . '.pdf';
        $attestation_pdf = $dossier . '/' . $attestation_fiscale;
       
        // Sauvegarde des fichiers au niveau de serveur
        if (file_exists($attestation_pdf)) {         
            unlink($attestation_pdf);
        }
        if (!is_dir($dossier)) {       
            if (mkdir($dossier, 0777, true)) {
                $html2pdf->pdf->Output($attestation_pdf, "F");
            } else {
                die('Echec lors de la cration des r�pertoires...');
            }
        } else {
            $html2pdf->pdf->Output($attestation_pdf, "F");            
        }
        //$html2pdf->Output($attestation_fiscale);
        $url = "http://mega-cours.fr/espaceadmin/index.php?module=adminstration&action=view_attestation_fiscale&id_attestation=" . $id_attestation;
        header("Location:   $url");
    } catch (HTML2PDF_exception $e) {
        echo $e;
        exit();
    }
}
