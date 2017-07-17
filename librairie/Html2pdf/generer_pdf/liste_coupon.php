<?php

ob_start();
if (isset($_GET['N_facture']) && !empty($_GET['N_facture'])) {
    $N_facture = $_GET['N_facture'];
    require "./../../../connection/config.php";    
    require './../fonctions/coupon_famille/coupon_famille.php';
    if (isset($_SESSION['membre']['code_famille'])) {
        $user = $_SESSION['membre']['code_famille'];
    } elseif (isset($_GET['code_famille'])) {
        $user = $_GET['code_famille'];
    }
            /*         * ************** Comptage nbre de cours ********************* */
        try {
            $sql="  SELECT COUNT(id_coupon) AS Nbre_cours FROM  e_coupon WHERE  N_facture=:param";
//            $sql = "   SELECT model_coupon.dure AS dure_cours,facture_famille.Qte AS nb_heure "
//                    . "FROM facture_famille,model_coupon ";
//            $sql.= "   WHERE  facture_famille.id_model=model_coupon.id_model  "
//                    . "AND N_facture=:param ";
            $stmt = $cxn->prepare($sql);
            $stmt->bindParam(':param', $param);
            $param = $N_facture;
            $stmt->execute();
            $enregistrement = $stmt->fetch();
            $nb_cours=$enregistrement ['Nbre_cours'];
//            $nb_cours = $enregistrement ['nb_heure'] / $enregistrement ['dure_cours'];
//            $nb_cours = intval($nb_cours);
//            if (!is_int($nb_cours)) {
//                $etat = FALSE;
//                $liste_erreurs [] = 'Le nombre de cours n\est pas un entier';
//                $liste_erreurs [] = $nb_cours;
//            }
        } catch (Exception $ex) {
            $etat = FALSE;
            $liste_erreurs [] = 'requette4';
        }
        /*         * *********************************** */
//    if (!empty($_GET['nb_cours'])) {
//        $nb_cours = $_GET['nb_cours'];
//    } else {
//
//  
//    }
    $liste_coupon = liste_coupon($_GET['N_facture']);
    $infos = infos_coupon($user, $_GET['N_facture'], $nb_cours);  
    $coupon = 'e_coupon_' . $_GET['N_facture'] . '.pdf';
}
include(dirname(__FILE__) . '/res/liste_coupon.php');
$content = ob_get_clean();

// convert in PDF
require_once(dirname(__FILE__) . '/../html2pdf.class.php');
try {
    $html2pdf = new HTML2PDF('P', 'A4', 'fr');
    //      $html2pdf->setModeDebug();
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $dossier = "/home/megacour/public_html/telechargement/liste_coupon/" . $user;
    $liste_coupon = 'liste_coupon_N' . $_GET ['N_facture'] . '.pdf';
    $dossier_pdf = $dossier . '/' . $liste_coupon;
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
    /*     * ******************************* */
   $html2pdf->Output($coupon);
} catch (HTML2PDF_exception $e) {
    echo $e;
    exit;
}
?>
