<?php

session_start();
session_regenerate_id();
require_once './connection/config.php';
ini_set('date.timezone', 'Europe/Paris');
$etat = TRUE;
$objet = array();
if($_SESSION ['membre']['user_banni']){
    $etat = FALSE;
}
if ($etat) {
    $keygen_exo = $_POST['keygen_exo'];

    try {
        $sql = "SELECT keygen_rep  FROM   Corrige_exercices_eleves   WHERE  keygen_exo=:param1    AND   code_eleve=:param2  ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $keygen_exo);
        $resultat->bindParam(':param2', $_SESSION ['membre']['code_eleve']);
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $keygen_rep = $enregistrement['keygen_rep'];
    } catch (Exception $e) {
        $etat = FALSE;
        echo "Une erreur est survenue lors de la récupération des données";
    }
    /****************************************************/

    try {
        $sql = "   UPDATE  Notifications_codes_eleves SET  consultation_eleve='1'  WHERE keygen_rep=:param1  ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $keygen_rep);
        $resultat->execute();
    } catch (Exception $e) {
        $etat = FALSE;
        echo "Une erreur est survenue lors de la récupération des données";
    }
}


/**
 * ******************************
 */
$objet ['message'] = array(
    'reponse' => $etat
);
header('Content-type: application/json');
echo json_encode($objet);
?>

