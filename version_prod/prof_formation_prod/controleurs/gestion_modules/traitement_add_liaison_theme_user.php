<?php

session_start();
session_regenerate_id();
require_once './../../connection/config.php';
require_once './../../librairie/fonctions_local.php';
ini_set('date.timezone', 'Europe/Paris');
$etat = TRUE;
$list_erreur = array();
$date_created = date("Y-m-d H:i:s");
$keygen_theme = unhtmlentities($_POST['token_theme']);
$date_publication = unhtmlentities($_POST['date_publication_user']);
$select_mode_groupe = unhtmlentities($_POST['select_mode_groupe']);
$code_intervenant = $_SESSION ['membre']['code_intervenant'];
$nom_module = unhtmlentities($_POST['nom_module']);


if ($etat) {

    if (sizeof($_POST['select_code_user']) > 0) {

        foreach ($_POST['select_code_user'] as $key => $value) {
            $keygen_liaison = random(20);
            try {
                $sql = " INSERT INTO  Liaison_themes_users (keygen_liaison,date_created,fk_theme,fk_mode_groupe_users,fk_code_user,date_publication_user)  VALUES (:param1,:param2,:param3,:param4,:param5,:param6)";
                $stmt = $cxn->prepare($sql);
                $stmt->bindParam(':param1', $keygen_liaison);
                $stmt->bindParam(':param2', $date_created);
                $stmt->bindParam(':param3', $keygen_theme);
                $stmt->bindParam(':param4', $select_mode_groupe);
                $stmt->bindParam(':param5', $value);
                $stmt->bindParam(':param6', $date_publication);

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
                $sql = " INSERT INTO  Liaison_themes_users (keygen_liaison,date_created,fk_theme,fk_mode_groupe_users,fk_keygen_groupe,date_publication_user)  VALUES (:param1,:param2,:param3,:param4,:param5,:param6)";
                $stmt = $cxn->prepare($sql);
                $stmt->bindParam(':param1', $keygen_liaison);
                $stmt->bindParam(':param2', $date_created);
                $stmt->bindParam(':param3', $keygen_theme);
                $stmt->bindParam(':param4', $select_mode_groupe);
                $stmt->bindParam(':param5', $value);
                $stmt->bindParam(':param6', $date_publication);

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
            $sql = " INSERT INTO  Liaison_themes_users (keygen_liaison,date_created,fk_theme,fk_mode_groupe_users,date_publication_user)  VALUES (:param1,:param2,:param3,:param4,:param5)";
            $stmt = $cxn->prepare($sql);
            $stmt->bindParam(':param1', $keygen_liaison);
            $stmt->bindParam(':param2', $date_created);
            $stmt->bindParam(':param3', $keygen_theme);
            $stmt->bindParam(':param4', $select_mode_groupe);       
            $stmt->bindParam(':param5', $date_publication);

            $stmt->execute();
        } catch (Exception $ex) {
            echo $ex->getMessage() . '/' . $sql;
            $etat = FALSE;
        }
    }
}

if ($etat) {
    if (isset($_SESSION ['traitement_form_theme'])) {
        unset($_SESSION ['traitement_form_theme']);
    }
    $url = url_espace_formateur . '/index.php?module=' . $nom_module . '&action=add_liaison_theme_user&token_theme=' . $keygen_theme . '&result=succees';
} else {
    $_SESSION ['traitement_form_theme']['tableau_serialise'] = serialize($_POST);
    $_SESSION ['traitement_form_theme']['list_erreur'] = $list_erreur;
    $url = url_espace_formateur . '/index.php?module=' . $nom_module . '&action=add_liaison_theme_user&token_theme=' . $keygen_theme . '&result=echec';
}
header("Location:  $url");

