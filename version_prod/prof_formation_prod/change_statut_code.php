<?php

require_once './connection/config.php';
ini_set('date.timezone', 'Europe/Paris');
$etat = TRUE;
$objet = array();
$statut_code = '';

$keygen_rep = $_POST['keygen_rep'];
$id_statut_code = $_POST['id_statut_code'];



try {
    if (!empty($_POST['type_exo']) && $_POST['type_exo'] == 'exo_devoir') {
        $nbr_points = $_POST['nbr_points'];
        $sql = "   UPDATE  Corrige_devoirs_users   SET   fk_statut_code=:param1,nbr_points=:param3   WHERE keygen_rep=:param2  ";
    } else {
        $sql = "   UPDATE  Corrige_exercices_eleves   SET   fk_statut_code=:param1   WHERE keygen_rep=:param2  ";
    }

    $resultat = $cxn->prepare($sql);
    $resultat->bindParam(':param1', $id_statut_code);
    $resultat->bindParam(':param2', $keygen_rep);
    if (!empty($_POST['type_exo']) && $_POST['type_exo'] == 'exo_devoir') {
        $resultat->bindParam(':param3', $nbr_points);
    }
    $resultat->execute();
    /*     * ************************************************** */
    if ($id_statut_code == '1') {
        $statut_code = '<span class="label label-info">Attente</span>';
    } else if ($id_statut_code == '2') {
        $statut_code = '<span class="label label-primary">En cours de traitement</span>';
    } else if ($id_statut_code == '3') {
        $statut_code = '<span class="label label-success">Code correct</span>';
    } else if ($id_statut_code == '4') {
        $statut_code = '<span class="label label-danger">Code non correct</span>';
    } else if ($id_statut_code == '5') {
        $statut_code = '<span class="label label-warning">Code inaccessible</span>';
    }
} catch (Exception $e) {
    $etat = FALSE;
    echo "Une erreur est survenue lors de la récupération des données";
}

/**
 * ******************************
 * 
 */
$objet ['message'] = array(
    'reponse' => $etat,
    'statut_code' => $statut_code
);
header('Content-type: application/json');
echo json_encode($objet);
?>




