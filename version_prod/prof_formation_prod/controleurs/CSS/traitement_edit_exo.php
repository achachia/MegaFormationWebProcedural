<?php

session_start();
session_regenerate_id();
require_once './../../connection/config.php';
require_once './../../librairie/fonctions_local.php';
ini_set('date.timezone', 'Europe/Paris');
$etat = TRUE;
$list_erreur = array();
$keygen_exo = unhtmlentities($_POST['keygen_exo']);
$date_update = date("Y-m-d H:i:s");
$titre_exo = $_POST['titre_exo'];
$contenu_exo = unhtmlentities($_POST['contenu_exo']);
$date_publication = $_POST['date_publication'];
if (!empty($_POST['aide_exo'])) {
    $aide_exo = unhtmlentities($_POST['aide_exo']);
} else {
    $aide_exo = NULL;
}

if (!empty($_POST['corrige_text_exo'])) {
    $corrige_text_exo = unhtmlentities($_POST['corrige_text_exo']);
} else {
    $corrige_text_exo = NULL;
}
//echo $corrige_text_exo;
if (!empty($_POST['ID_plate_forme_corrige'])) {
    $ID_plate_forme_corrige = unhtmlentities($_POST['ID_plate_forme_corrige']);
} else {
    $ID_plate_forme_corrige = NULL;
}
if (!empty($_POST['codefiddle_corrige'])) {
    $codefiddle_corrige = unhtmlentities($_POST['codefiddle_corrige']);
} else {
    $codefiddle_corrige = NULL;
}
$select_etat_exo = unhtmlentities($_POST['select_etat_exo']);
$id_plate_forme = unhtmlentities($_POST['select_plate_forme']);
if (isset($_POST['date_limite_depot']) && !empty($_POST['date_limite_depot'])) {
    $date_limite_depot = $_POST['date_limite_depot'];
} else {
    $date_limite_depot = NULL;
}

if ($etat) {    
    if (!empty($_FILES['img_exo']['name'])) {
        $imgExt = strtolower(pathinfo($_FILES['img_exo']['name'], PATHINFO_EXTENSION));
        $random_img = random(20);
        $img_exo = $random_img . '.' . $imgExt;
    } else {
        $img_exo = NULL;
    }
    try {
        $sql = " UPDATE  Exercices_themes  SET  titre_exo=:param1,contenu_exo=:param2,aide_exo=:param3,Corrige_text=:param4,ID_plate_forme_corrige=:param5,Codefiddle_Corrige=:param6,exercice_actif=:param7,img_exo=:param8,id_plate_forme=:param9,date_update=:param10,date_limite_depot=:param11,date_publication=:param12   WHERE  keygen_exo=:param13";
        $stmt = $cxn->prepare($sql);
        $stmt->bindParam(':param1', $titre_exo);
        $stmt->bindParam(':param2', $contenu_exo);
        $stmt->bindParam(':param3', $aide_exo);
        $stmt->bindParam(':param4', $corrige_text_exo);
        $stmt->bindParam(':param5', $ID_plate_forme_corrige);
        $stmt->bindParam(':param6', $codefiddle_corrige);
        $stmt->bindParam(':param7', $select_etat_exo);
        $stmt->bindParam(':param8', $img_exo);
        $stmt->bindParam(':param9', $id_plate_forme);
        $stmt->bindParam(':param10', $date_update);
        $stmt->bindParam(':param11', $date_limite_depot);
        $stmt->bindParam(':param12', $date_publication);
        $stmt->bindParam(':param13', $keygen_exo);
        $stmt->execute();
    } catch (Exception $ex) {
        echo $ex->getMessage() . '/' . $sql;
        $etat = FALSE;
    }

    /*     * ***************** Upload fichier image ***************************** */
    if (!empty($_FILES['img_exo']['name'])) {
        $etat = upload_fichier_exercices($_FILES['img_exo'], $keygen_exo, $random_img);
    }
}
if ($etat) {
    if (isset($_SESSION ['traitement_form_exo'])) {
        unset($_SESSION ['traitement_form_exo']);
    }
    $url = url_espace_formateur . '/index.php?module=CSS&action=all_view_exercices&result=succees';
} else {
    $_SESSION ['traitement_form_exo']['tableau_serialise'] = serialize($_POST);
    $_SESSION ['traitement_form_exo']['list_erreur'] = $list_erreur;
    $url = url_espace_formateur . '/index.php?module=CSS&action=all_view_exercices&result=echec';
}
//var_dump($etat);
header("Location:  $url");



