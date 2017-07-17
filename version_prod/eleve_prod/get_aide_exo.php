<?php

session_start();
session_regenerate_id();
require_once './connection/config.php';
ini_set('date.timezone', 'Europe/Paris');
$etat = TRUE;
$objet = array();
$contenu = '';
if($_SESSION ['membre']['user_banni']){
    $etat = FALSE;
}
if ($etat) {
    $keygen_code = $_POST['keygen_exo'];

    try {
        $sql = "   SELECT   aide_exo  FROM  Exercices_themes   WHERE  keygen_exo=:param1 ";

        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $keygen_code);
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $contenu = html_entity_decode(stripslashes($enregistrement['aide_exo']), ENT_QUOTES);
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
}


/**
 * ******************************
 */
$objet ['message'] = array(
    'reponse' => $etat,
    'contenu' => $contenu
);
header('Content-type: application/json');
echo json_encode($objet);
?>
