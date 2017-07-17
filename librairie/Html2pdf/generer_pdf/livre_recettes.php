<?php

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
require "./../../../connection/config.php";
require './../fonctions/livres/livres.php';
$infos_gerant = infos_gerant();
if (isset($_GET ['month']) && $_GET ['month'] == 'perso') {
    $liste = rapport_recettes($_GET ['month'], $_GET ['from'], $_GET ['to']);
    $detail_recettes = total_recettes($_GET ['month'], $_GET ['from'], $_GET ['to']);
    $periode=formatage_periode($_GET ['month'], $_GET ['from'], $_GET ['to']);
} elseif ( isset($_GET ['month']) && $_GET ['month'] != 'perso') {
    $liste = rapport_recettes($_GET ['month']);
    $detail_recettes = total_recettes($_GET ['month']);
    $periode=formatage_periode($_GET ['month']);
} else {
    $liste = rapport_recettes();
    $detail_recettes = total_recettes();
    $periode=formatage_periode();
}

include(dirname(__FILE__) . '/res/livre_recettes.php');
$content = ob_get_clean();

// convert in PDF
require_once(dirname(__FILE__) . '/../html2pdf.class.php');
try {
    $html2pdf = new HTML2PDF('P', 'A4', 'fr');
    //      $html2pdf->setModeDebug();
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('livre_recettes.pdf');
} catch (HTML2PDF_exception $e) {
    echo $e;
    exit;
}
?>
