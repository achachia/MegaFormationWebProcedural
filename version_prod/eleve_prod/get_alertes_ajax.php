<?php

session_start();
session_regenerate_id();
require_once './connection/config.php';
require_once './librairie/fonctions_local.php';
ini_set('date.timezone', 'Europe/Paris');
$date_actuel = date("Y-m-d H:i:s");
$etat = TRUE;
$objet = array();
$contenu = '';

if($_SESSION ['membre']['user_banni']){
    $etat = FALSE;
}

if ($etat) {
    try {
        $sql = " SELECT   id_alerte    FROM Liste_alerts_users  WHERE ( code_user = '" . $_SESSION ['membre']['code_eleve'] . "'  OR fk_keygen_groupe = '" . $_SESSION ['membre']['keygen_groupe'] . "'  OR  fk_mode_groupe_users='1' ) AND ( date_start <= '" . $date_actuel . "')  AND  ('" . $date_actuel . "' <= date_end) AND  mode_affichage='fenetre'  ";
        $select = $cxn->query($sql);
        $nb = $select->rowCount();
        if ($nb > 0) {
            $contenu.=$nb;
        } else {
            $etat = FALSE;
        }
    } catch (Exception $e) {
        echo $ex->getMessage() . '/' . $sql;
        $etat = FALSE;
    }
}


/**
 * ******************************
 */
$objet ['message'] = array(
    'reponse' => $etat,
    'contenu' => $contenu
);
header('Content-type: application/json');
echo json_encode($objet);
?>