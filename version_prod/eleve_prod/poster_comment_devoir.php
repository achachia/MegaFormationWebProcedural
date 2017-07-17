<?php

session_start();
session_regenerate_id();
require_once './connection/config.php';
require_once './librairie/fonctions_local.php';
ini_set('date.timezone', 'Europe/Paris');
$date_created = date("Y-m-d H:i:s");
$etat = TRUE;
$objet = array();
$infos = array();
if($_SESSION ['membre']['user_banni']){
    $etat = FALSE;
}




if ($etat) {
    $keygen_dev = $_POST['keygen_dev'];
    $comment = $_POST['comment'];
    $code_eleve = $_SESSION ['membre']['code_eleve'];
    $keygen_comment = random(20);
    try {
        $sql = " SELECT  id_comment  FROM  Liste_comments_devoir  WHERE  fk_code_user='" . $_SESSION ['membre']['code_eleve'] . "'   AND  fk_devoir_user='" . $keygen_dev . "'  ";
        $select = $cxn->query($sql);
        $nb = $select->rowCount();
        if ($nb <= 0) {
            try {
                $sql = " INSERT INTO    Liste_comments_devoir (date_created,fk_code_user,fk_devoir_user,contenu_comment,keygen_comment)  VALUES (:param1,:param2,:param3,:param4,:param5)";
                $stmt = $cxn->prepare($sql);
                $stmt->bindParam(':param1', $date_created);
                $stmt->bindParam(':param2', $code_eleve);
                $stmt->bindParam(':param3', $keygen_dev);
                $stmt->bindParam(':param4', $comment);
                $stmt->bindParam(':param5', $keygen_comment);
                $stmt->execute();
            } catch (Exception $ex) {
                echo $ex->getMessage() . '/' . $sql;
                $etat = FALSE;
            }
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
    'infos_objet' => $infos
);
header('Content-type: application/json');
echo json_encode($objet);
?>
