<?php

session_start();
session_regenerate_id();
require_once './../../connection/config.php';
require_once './../../librairie/fonctions_local.php';
ini_set('date.timezone', 'Europe/Paris');
$etat = TRUE;
$list_erreur = array();
$date_created = date("Y-m-d H:i:s");
$titre_alerte = unhtmlentities($_POST['titre_alerte']);
$contenu_alerte = unhtmlentities($_POST['contenu_alerte']);
$date_start = unhtmlentities($_POST['date_start']);
$date_end = unhtmlentities($_POST['date_end']);
$select_priorite_alerte = unhtmlentities($_POST['select_priorite_alerte']);
$select_mode_affichage = unhtmlentities($_POST['select_mode_affichage']);
$select_mode_groupe = unhtmlentities($_POST['select_mode_groupe']);

if (!empty($_POST['select_mode_affichage'])) {
    $select_mode_affichage = unhtmlentities($_POST['select_mode_affichage']);
} else {
    $select_mode_affichage = NULL;
}



if ($etat) {

    if (sizeof($_POST['select_code_user']) > 0) {

        foreach ($_POST['select_code_user'] as $key => $value) {
            $keygen_alerte = random(20);
            $select_keygen_groupe_users = NULL;
            $select_mode_groupe = '3';
            try {
                $sql = " INSERT INTO  Liste_alerts_users ( date_created,nom_alerte,keygen_alerte,description,date_start,date_end,fk_priorite_alerte,fk_mode_groupe_users,fk_keygen_groupe,code_user,mode_affichage)  VALUES (:param1,:param2,:param3,:param4,:param5,:param6,:param7,:param8,:param9,:param10,:param11)";
                $stmt = $cxn->prepare($sql);
                $stmt->bindParam(':param1', $date_created);
                $stmt->bindParam(':param2', $titre_alerte);
                $stmt->bindParam(':param3', $keygen_alerte);
                $stmt->bindParam(':param4', $contenu_alerte);
                $stmt->bindParam(':param5', $date_start);
                $stmt->bindParam(':param6', $date_end);
                $stmt->bindParam(':param7', $select_priorite_alerte);
                $stmt->bindParam(':param8', $select_mode_groupe);
                $stmt->bindParam(':param9', $select_keygen_groupe_users);
                $stmt->bindParam(':param10', $value);
                $stmt->bindParam(':param11', $select_mode_affichage);

                $stmt->execute();
            } catch (Exception $ex) {
                echo $ex->getMessage() . '/' . $sql;
                $etat = FALSE;
            }
        }
    }
    if (sizeof($_POST['select_id_groupe_users']) > 0) {

        foreach ($_POST['select_id_groupe_users'] as $key => $value) {
            $keygen_alerte = random(20);
            $select_code_user = NULL;
            $select_mode_groupe = '2';
            try {
                $sql = " INSERT INTO  Liste_alerts_users ( date_created,nom_alerte,keygen_alerte,description,date_start,date_end,fk_priorite_alerte,fk_mode_groupe_users,fk_keygen_groupe,code_user,mode_affichage)  VALUES (:param1,:param2,:param3,:param4,:param5,:param6,:param7,:param8,:param9,:param10,:param11)";
                $stmt = $cxn->prepare($sql);
                $stmt->bindParam(':param1', $date_created);
                $stmt->bindParam(':param2', $titre_alerte);
                $stmt->bindParam(':param3', $keygen_alerte);
                $stmt->bindParam(':param4', $contenu_alerte);
                $stmt->bindParam(':param5', $date_start);
                $stmt->bindParam(':param6', $date_end);
                $stmt->bindParam(':param7', $select_priorite_alerte);
                $stmt->bindParam(':param8', $select_mode_groupe);
                $stmt->bindParam(':param9', $value);
                $stmt->bindParam(':param10', $select_code_user);
                $stmt->bindParam(':param11', $select_mode_affichage);

                $stmt->execute();
            } catch (Exception $ex) {
                echo $ex->getMessage() . '/' . $sql;
                $etat = FALSE;
            }
        }
    }
    if ($select_mode_groupe == '1') {
        $keygen_alerte = random(20);
        $select_code_user = NULL;
        $select_keygen_groupe_users = NULL;
        try {
            $sql = " INSERT INTO  Liste_alerts_users ( date_created,nom_alerte,keygen_alerte,description,date_start,date_end,fk_priorite_alerte,fk_mode_groupe_users,fk_keygen_groupe,code_user,mode_affichage)  VALUES (:param1,:param2,:param3,:param4,:param5,:param6,:param7,:param8,:param9,:param10,:param11)";
            $stmt = $cxn->prepare($sql);
            $stmt->bindParam(':param1', $date_created);
            $stmt->bindParam(':param2', $titre_alerte);
            $stmt->bindParam(':param3', $keygen_alerte);
            $stmt->bindParam(':param4', $contenu_alerte);
            $stmt->bindParam(':param5', $date_start);
            $stmt->bindParam(':param6', $date_end);
            $stmt->bindParam(':param7', $select_priorite_alerte);
            $stmt->bindParam(':param8', $select_mode_groupe);
            $stmt->bindParam(':param9', $select_keygen_groupe_users);
            $stmt->bindParam(':param10', $select_code_user);
            $stmt->bindParam(':param11', $select_mode_affichage);

            $stmt->execute();
        } catch (Exception $ex) {
            echo $ex->getMessage() . '/' . $sql;
            $etat = FALSE;
        }
    }
}

if ($etat) {
    if (isset($_SESSION ['traitement_form_alerte'])) {
        unset($_SESSION ['traitement_form_alerte']);
    }
    $url = url_espace_formateur . '/index.php?module=membre&action=all_view_alertes&result=succees';
} else {
    $_SESSION ['traitement_form_alerte']['tableau_serialise'] = serialize($_POST);
    $_SESSION ['traitement_form_alerte']['list_erreur'] = $list_erreur;
    $url = url_espace_formateur . '/index.php?module=membre&action=all_view_alertes&result=echec';
}
header("Location:  $url");




