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
    $keygen_exo = $_POST['keygen_exo'];
    $id_eval_statut = $_POST['id_eval_statut'];
    $code_eleve = $_SESSION ['membre']['code_eleve'];
    try {
        $sql = " SELECT  id_post  FROM  List_post_degre_comprehension_corrige  WHERE  code_eleve='" . $_SESSION ['membre']['code_eleve'] . "'   AND  keygen_exo='" . $keygen_exo . "'  ";
        $select = $cxn->query($sql);
        $nb = $select->rowCount();
        if ($nb <= 0) {
            try {
                $sql = " INSERT INTO   List_post_degre_comprehension_corrige(date_created,code_eleve,id_degre,keygen_exo)  VALUES (:param1,:param2,:param3,:param4)";
                $stmt = $cxn->prepare($sql);
                $stmt->bindParam(':param1', $date_created);
                $stmt->bindParam(':param2', $code_eleve);
                $stmt->bindParam(':param3', $id_eval_statut);
                $stmt->bindParam(':param4', $keygen_exo);
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
