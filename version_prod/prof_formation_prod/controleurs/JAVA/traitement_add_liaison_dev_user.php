<?php

session_start();
session_regenerate_id();
require_once './../../connection/config.php';
require_once './../../librairie/fonctions_local.php';
ini_set('date.timezone', 'Europe/Paris');
$etat = TRUE;
$list_erreur = array();
$date_created = date("Y-m-d H:i:s");
$keygen_dev = $_POST['keygen_dev'];
$code_intervenant = $_SESSION ['membre']['code_intervenant'];
$select_mode_groupe = unhtmlentities($_POST['select_mode_groupe']);

if (isset($_POST['date_limite_depot']) && !empty($_POST['date_limite_depot'])) {
    $date_limite_depot = $_POST['date_limite_depot'];
} else {
    $date_limite_depot = NULL;
}
if (isset($_POST['date_publication_corrige']) && !empty($_POST['date_publication_corrige'])) {
    $date_publication_corrige = $_POST['date_publication_corrige'];
} else {
    $date_publication_corrige = NULL;
}
if (isset($_POST['date_publication_user']) && !empty($_POST['date_publication_user'])) {
    $date_publication_user = $_POST['date_publication_user'];
} else {
    $date_publication_user = NULL;
}
$nom_module = unhtmlentities($_POST['nom_module']);





if ($etat) {

    if (sizeof($_POST['select_code_user']) > 0) {

        foreach ($_POST['select_code_user'] as $key => $value) {
            $keygen_liaison = random(20);
            try {
                $sql = " INSERT INTO   Liaison_devoir_users(keygen_liaison,date_created,fk_mode_groupe_users,fk_code_user,fk_keygen_devoir,date_limite_depot_user_travail,date_publication_user,date_publication_corrige)  VALUES (:param1,:param2,:param3,:param4,:param5,:param6,:param7,:param8)";
                $stmt = $cxn->prepare($sql);
                $stmt->bindParam(':param1', $keygen_liaison);
                $stmt->bindParam(':param2', $date_created);
                $stmt->bindParam(':param3', $select_mode_groupe);
                $stmt->bindParam(':param4', $value);
                $stmt->bindParam(':param5', $keygen_dev);
                $stmt->bindParam(':param6', $date_limite_depot);
                $stmt->bindParam(':param7', $date_publication_user);
                $stmt->bindParam(':param8', $date_publication_corrige);

                $stmt->execute();
            } catch (Exception $ex) {
                echo $ex->getMessage() . '/' . $sql;
                $etat = FALSE;
            }
        }
    }
    if (sizeof($_POST['select_id_groupe_users']) > 0) {

        foreach ($_POST['select_id_groupe_users'] as $key => $value) {
            $keygen_liaison = random(20);
            try {
                $sql = " INSERT INTO   Liaison_devoir_users(keygen_liaison,date_created,fk_mode_groupe_users,fk_keygen_groupe,fk_keygen_devoir,date_limite_depot_user_travail,date_publication_user,date_publication_corrige)  VALUES (:param1,:param2,:param3,:param4,:param5,:param6,:param7,:param8)";
                $stmt = $cxn->prepare($sql);
                $stmt->bindParam(':param1', $keygen_liaison);
                $stmt->bindParam(':param2', $date_created);
                $stmt->bindParam(':param3', $select_mode_groupe);
                $stmt->bindParam(':param4', $value);
                $stmt->bindParam(':param5', $keygen_dev);
                $stmt->bindParam(':param6', $date_limite_depot);
                $stmt->bindParam(':param7', $date_publication_user);
                $stmt->bindParam(':param8', $date_publication_corrige);

                $stmt->execute();
            } catch (Exception $ex) {
                echo $ex->getMessage() . '/' . $sql;
                $etat = FALSE;
            }
        }
    }
    if ($select_mode_groupe == '1') {
        $keygen_liaison = random(20);
        try {
            $sql = " INSERT INTO   Liaison_devoir_users(keygen_liaison,date_created,fk_mode_groupe_users,fk_keygen_devoir,date_limite_depot_user_travail,date_publication_user,date_publication_corrige)  VALUES (:param1,:param2,:param3,:param4,:param5,:param6,:param7)";
            $stmt = $cxn->prepare($sql);
            $stmt->bindParam(':param1', $keygen_liaison);
            $stmt->bindParam(':param2', $date_created);
            $stmt->bindParam(':param3', $select_mode_groupe);
            $stmt->bindParam(':param4', $keygen_dev);
            $stmt->bindParam(':param5', $date_limite_depot);
            $stmt->bindParam(':param6', $date_publication_user);
            $stmt->bindParam(':param7', $date_publication_corrige);

            $stmt->execute();
        } catch (Exception $ex) {
            echo $ex->getMessage() . '/' . $sql;
            $etat = FALSE;
        }
    }
}

if ($etat) {
    if (isset($_SESSION ['traitement_form_dev'])) {
        unset($_SESSION ['traitement_form_dev']);
    }
    $url = url_espace_formateur . '/index.php?module=' . $nom_module . '&action=add_liaison_devoir_user&token_devoir='.$keygen_dev.'&result=succees';
} else {
    $_SESSION ['traitement_form_dev']['tableau_serialise'] = serialize($_POST);
    $_SESSION ['traitement_form_dev']['list_erreur'] = $list_erreur;
    $url = url_espace_formateur . '/index.php?module=' . $nom_module . '&action=add_liaison_devoir_user&token_devoir='.$keygen_dev.'&result=echec';
}
header("Location:  $url");


