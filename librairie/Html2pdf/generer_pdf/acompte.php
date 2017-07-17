<?php

session_start();
/**
 * HTML2PDF Librairy - example
 *
 * HTML => PDF convertor
 * distributed under the LGPL License
 *
 * @author      Laurent MINGUET <webmaster@html2pdf.fr>
 *
 * isset($_GET['vuehtml']) is not mandatory
 * it allow to display the result in the HTML format
 */
// get the HTML
ob_start();
if (isset($_GET['N_acompte']) && !empty($_GET['N_acompte'])) {
    require "./../../../connection/config.php";
    require "./../fonctions/acompte_famille/infos_acompte.php";
    $infos_acompte = infos_acompte($_GET['N_acompte'], $_SESSION['membre']['code_famille']);
    $infos_famille = infos_famille($_SESSION['membre']['code_famille']);
}
include(dirname(__FILE__) . '/res/acompte.php');
$content = ob_get_clean();

// convert in PDF
require_once(dirname(__FILE__) . '/../html2pdf.class.php');
try {
    $html2pdf = new HTML2PDF('P', 'A4', 'fr');
    if(isset($_GET['mode']) && !empty($_GET['mode'])){
      $html2pdf->pdf->IncludeJS("print(true);");   
    }   
    //      $html2pdf->setModeDebug();
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $acompte='acompte_N'.$_GET['N_acompte'].'.pdf';
    $html2pdf->Output($acompte);
} catch (HTML2PDF_exception $e) {
    echo $e;
    exit;
}

