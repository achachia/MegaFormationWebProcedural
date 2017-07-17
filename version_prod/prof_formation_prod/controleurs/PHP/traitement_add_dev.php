<?php

session_start();
session_regenerate_id();
require_once './../../connection/config.php';
require_once './../../librairie/fonctions_local.php';
ini_set('date.timezone', 'Europe/Paris');
$etat = TRUE;
$list_erreur = array();
$date_created = date("Y-m-d H:i:s");
$titre_dev = unhtmlentities($_POST['titre_dev']);
$description_dev = unhtmlentities($_POST['description_dev']);
$date_publication = unhtmlentities($_POST['date_publication']);
$code_intervenant = $_SESSION ['membre']['code_intervenant'];
$fk_module = unhtmlentities($_POST['fk_module']);
$nom_module = unhtmlentities($_POST['nom_module']);








if ($etat) {
    $keygen_dev = random(20);
    try {
        $sql = " INSERT INTO  Liste_devoirs_users (keygen_dev,titre_dev,fk_module,description_dev,date_created,date_publication_devoir)  VALUES (:param1,:param2,:param3,:param4,:param5,:param6)";
        $stmt = $cxn->prepare($sql);
        $stmt->bindParam(':param1', $keygen_dev);
        $stmt->bindParam(':param2', $titre_dev);
        $stmt->bindParam(':param3', $fk_module);
        $stmt->bindParam(':param4', $description_dev);
        $stmt->bindParam(':param5', $date_created);
        $stmt->bindParam(':param6', $date_publication);
        $stmt->execute();
    } catch (Exception $ex) {
        echo $ex->getMessage() . '/' . $sql;
        $etat = FALSE;
    }
}


if ($etat) {
    if (isset($_SESSION ['traitement_form_dev'])) {
        unset($_SESSION ['traitement_form_dev']);
    }
    $url = url_espace_formateur . '/index.php?module=' . $nom_module . '&action=all_view_devoirs&result=succees';
} else {
    $_SESSION ['traitement_form_dev']['tableau_serialise'] = serialize($_POST);
    $_SESSION ['traitement_form_dev']['list_erreur'] = $list_erreur;
    $url = url_espace_formateur . '/index.php?module=' . $nom_module . '&action=all_view_devoirs&result=echec';
}
header("Location:  $url");

