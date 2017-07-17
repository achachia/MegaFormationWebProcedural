<?php

session_start();
session_regenerate_id();
require_once './../../connection/config.php';
require_once './../../librairie/fonctions_local.php';
ini_set('date.timezone', 'Europe/Paris');
$etat = TRUE;
$list_erreur = array();
$date_created = date("Y-m-d H:i:s");
$titre_exo = unhtmlentities($_POST['titre_exo']);
$contenu_exo = unhtmlentities($_POST['contenu_exo']);
$date_publication = unhtmlentities($_POST['date_publication']);
$code_intervenant = $_SESSION ['membre']['code_intervenant'];
$id_plate_forme = unhtmlentities($_POST['select_plate_forme']);
$keygen_theme = unhtmlentities($_POST['token_theme']);
$nom_module = unhtmlentities($_POST['nom_module']);
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


if ($etat) {
    $keygen_exo = random(20);
    if (!empty($_FILES['img_exo']['name'])) {
        $imgExt = strtolower(pathinfo($_FILES['img_exo']['name'], PATHINFO_EXTENSION));
        $random_img = random(20);
        $img_exo = $random_img . '.' . $imgExt;
    } else {
        $img_exo = NULL;
    }
    try {
        $sql = " INSERT INTO  Exercices_themes (titre_exo,contenu_exo,keygen_exo,img_exo,id_plate_forme,date_created,date_publication,aide_exo,Corrige_text,ID_plate_forme_corrige,Codefiddle_Corrige,fk_theme)  VALUES (:param1,:param2,:param3,:param4,:param5,:param6,:param7,:param8,:param9,:param10,:param11,:param12)";
        $stmt = $cxn->prepare($sql);
        $stmt->bindParam(':param1', $titre_exo);
        $stmt->bindParam(':param2', $contenu_exo);
        $stmt->bindParam(':param3', $keygen_exo);      
        $stmt->bindParam(':param4', $img_exo);
        $stmt->bindParam(':param5', $id_plate_forme);
        $stmt->bindParam(':param6', $date_created);     
        $stmt->bindParam(':param7', $date_publication);
        $stmt->bindParam(':param8', $aide_exo);
        $stmt->bindParam(':param9', $corrige_text_exo);
        $stmt->bindParam(':param10', $ID_plate_forme_corrige);
        $stmt->bindParam(':param11', $codefiddle_corrige);
        $stmt->bindParam(':param12', $keygen_theme);
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
    $url = url_espace_formateur . '/index.php?module='.$nom_module.'&action=all_view_exercices&result=succees';
} else {
    $_SESSION ['traitement_form_exo']['tableau_serialise'] = serialize($_POST);
    $_SESSION ['traitement_form_exo']['list_erreur'] = $list_erreur;
    $url = url_espace_formateur . '/index.php?module='.$nom_module.'&action=add_exo_theme&result=echec';
}
header("Location:  $url");


