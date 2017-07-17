<?php

require_once './connection/config.php';
ini_set('date.timezone', 'Europe/Paris');
$etat = TRUE;
$objet = array();
$id_exo = $_POST['id_exo'];

try {
    $sql = " SELECT COUNT( id_corrige ) AS nbr_reponses_reposte  FROM  Corrige_exercices_eleves  WHERE  keygen_exo = :param1 ";
    $resultat = $cxn->prepare($sql);
    $resultat->bindParam(':param1', $id_exo);
    $resultat->execute();
    $enregistrement = $resultat->fetch();
    $nbr_reponses = $enregistrement ['nbr_reponses_reposte'];
} catch (Exception $e) {
    echo "Une erreur est survenue lors de la récupération des données";
}

/**
 * ******************************
 */
$objet ['message'] = array(
    'reponse' => $etat,
    'contenu' => $nbr_reponses
);
header('Content-type: application/json');
echo json_encode($objet);
?>
