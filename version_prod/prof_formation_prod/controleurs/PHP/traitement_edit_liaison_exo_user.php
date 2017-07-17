<?php

session_start();
session_regenerate_id();
require_once './../../connection/config.php';
require_once './../../librairie/fonctions_local.php';
ini_set('date.timezone', 'Europe/Paris');
$etat = TRUE;
$list_erreur = array();
$date_created = date("Y-m-d H:i:s");
$keygen_theme=$_POST['token_theme'];
$keygen_exo=$_POST['token_exo'];
$keygen_liaison = $_POST['token_liaison'];
$code_intervenant = $_SESSION ['membre']['code_intervenant'];
$select_mode_groupe = unhtmlentities($_POST['select_mode_groupe']);


if (isset($_POST['date_publication_user']) && !empty($_POST['date_publication_user'])) {
    $date_publication_user = $_POST['date_publication_user'];
} else {
    $date_publication_user = NULL;
}
if (isset($_POST['date_limite_depot_user_travail']) && !empty($_POST['date_limite_depot_user_travail'])) {
    $date_limite_depot = $_POST['date_limite_depot_user_travail'];
} else {
    $date_limite_depot = NULL;
}
if (isset($_POST['date_publication_corrige']) && !empty($_POST['date_publication_corrige'])) {
    $date_publication_corrige = $_POST['date_publication_corrige'];
} else {
    $date_publication_corrige = NULL;
}
if (isset($_POST['select_id_groupe_users']) && !empty($_POST['select_id_groupe_users'])) {
    $fk_keygen_groupe = $_POST['select_id_groupe_users'];
} else {
    $fk_keygen_groupe = NULL;
}
if (isset($_POST['select_code_user']) && !empty($_POST['select_code_user'])) {
    $fk_code_user = $_POST['select_code_user'];
} else {
    $fk_code_user = NULL;
}

$nom_module = unhtmlentities($_POST['nom_module']);




if ($etat) {

    try {
        $sql = "UPDATE  Liaison_exo_theme_user  SET  date_update=:param1,fk_mode_groupe_users=:param2,fk_code_user=:param3,fk_keygen_groupe=:param4,date_limite_depot_user_travail=:param5,date_publication_user=:param6,date_publication_corrige=:param7   WHERE   keygen_liaison=:param8 ";
        $stmt = $cxn->prepare($sql);
        $stmt->bindParam(':param1', $date_created);
        $stmt->bindParam(':param2', $select_mode_groupe);
        $stmt->bindParam(':param3', $fk_code_user);
        $stmt->bindParam(':param4', $fk_keygen_groupe);        
        $stmt->bindParam(':param5', $date_limite_depot);
        $stmt->bindParam(':param6', $date_publication_user);
        $stmt->bindParam(':param7', $date_publication_corrige);
        $stmt->bindParam(':param8', $keygen_liaison);

        $stmt->execute();
    } catch (Exception $ex) {
        echo $ex->getMessage() . '/' . $sql;
        $etat = FALSE;
    }
}

if ($etat) {
    if (isset($_SESSION ['traitement_form_liaison'])) {
        unset($_SESSION ['traitement_form_liaison']);
    }
    $url = url_espace_formateur . '/index.php?module=' . $nom_module . '&action=all_view_liaisons_exo_users&token_theme=' . $keygen_theme . '&token_exo=' . $keygen_exo . '&result=succees';
} else {
    $_SESSION ['traitement_form_liaison']['tableau_serialise'] = serialize($_POST);
    $_SESSION ['traitement_form_liaison']['list_erreur'] = $list_erreur;
    $url = url_espace_formateur . '/index.php?module=' . $nom_module . '&action=add_liaison_liaisonoir_user&token_liaisonoir=' . $keygen_liaison . '&token_liaison=' . $keygen_liaison . '&result=echec';
}
header("Location:  $url");





