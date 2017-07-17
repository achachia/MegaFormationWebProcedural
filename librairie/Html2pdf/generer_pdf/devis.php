<?php

session_start();
ob_start();


require "./../../../connection/config.php";
require "./../fonctions/facture_famille/infos_facture.php";
$infos_gerant = infos_gerant();

include (dirname(__FILE__) . '/res/devis1.php');

$content = ob_get_clean();
// convert in PDF
require_once (dirname(__FILE__) . '/../html2pdf.class.php');

try {

    $html2pdf = new HTML2PDF('P', 'A4', 'fr');
    // $html2pdf->pdf->IncludeJS("print(true);");
    // $html2pdf->setModeDebug();
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content, isset($_GET ['vuehtml']));
    $devis = 'devis.pdf';
    $html2pdf->Output($devis);
} catch (HTML2PDF_exception $e) {
    echo $e;
    exit();
}
?>

