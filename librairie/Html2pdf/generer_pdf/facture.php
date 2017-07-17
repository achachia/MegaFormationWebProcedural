<?php

session_start();
ob_start();


require "./../../../connection/config.php";
require "./../fonctions/facture_famille/infos_facture.php";
$infos_gerant = infos_gerant();

if (!empty($_GET ['N_facture']) && $_GET ['mode'] == 'print_all_factures') {
    $data_json = json_decode($_GET ['N_facture']);
    unset($data_json->undefined);
    foreach ($data_json as $key => $value) {
        $tab = explode("_", $value);
        $N_facture = $tab [1];
        $code_famille = $tab [0];
        $infos_facture = infos_facture($N_facture, $code_famille);       
        $infos_famille = infos_famille($code_famille,$N_facture);
        include (dirname(__FILE__) . '/res/facture.php');
    }
} else {
    if (!empty($_GET ['N_facture']) && $_GET ['mode'] != 'print_all_factures') {
        if (isset($_GET ['code_famille'])) {
            $code_client = $_GET ['code_famille'];
        }
        $infos_facture = infos_facture($_GET ['N_facture'], $code_client);
        $infos_famille = infos_famille($code_client,$_GET ['N_facture']);      
        include (dirname(__FILE__) . '/res/facture.php');
    }
}

$content = ob_get_clean();
// convert in PDF
require_once (dirname(__FILE__) . '/../html2pdf.class.php');

try {

    $html2pdf = new HTML2PDF('P', 'A4', 'fr');
    // $html2pdf->pdf->IncludeJS("print(true);");
    // $html2pdf->setModeDebug();
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content, isset($_GET ['vuehtml']));
    if (!empty($_GET ['N_facture']) && $_GET ['mode'] == 'print_all_factures') {
        $facture = 'liste_factures.pdf';
    }
    if (!empty($_GET ['N_facture']) && $_GET ['mode'] != 'print_all_factures') {
        // echo getcwd();

        $dossier = "/home/megacour/public_html/telechargement/factures/" . $code_client;      
        $facture = 'facture_N' . $_GET ['N_facture'] . '.pdf';
        $dossier_pdf = $dossier . '/' . $facture;
        // Sauvegarde des fichiers au niveau de serveur
        if (file_exists($dossier_pdf)) {
            unlink($dossier_pdf);
        }
        if (!is_dir($dossier)) {

            if (mkdir($dossier, 0777, true)) {
                $html2pdf->pdf->Output($dossier_pdf, "F");
            } else {
                die('Echec lors de la cration des r�pertoires...');
            }
        } else {

            $html2pdf->pdf->Output($dossier_pdf, "F");
        }
    }
    $html2pdf->Output($facture);
} catch (HTML2PDF_exception $e) {
    echo $e;
    exit();
}
?>

