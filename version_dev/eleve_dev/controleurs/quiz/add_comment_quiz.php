<?php
session_start();
session_regenerate_id();
require_once './../../connection/config.php';
ini_set('date.timezone', 'Europe/Paris');
$date = date("Y-m-d H:i:s");
$etat = TRUE;
$objet = array();
$comment = $_POST['comment'];
if ($comment != '') {
    /*     * ********************** Enregistrement au niveau la table ****************************** */
    try {

        $sql = ' INSERT INTO  Comment_quiz_eleve(code_user,comment,random_quiz,date_created) VALUES (:param1,:param2,:param3,:param4)';
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $_SESSION ['membre']['code_eleve']);
        $resultat->bindParam(':param2', $comment);
        $resultat->bindParam(':param3', $_SESSION['quiz']['parametres']['random_quiz']);
        $resultat->bindParam(':param4', $date);
        $resultat->execute();
    } catch (Exception $e) {
        $etat = FALSE;
        echo $e->getMessage();
    }
} else {
    $etat = FALSE;
}

/* * ************************************** */
$objet ['message'] = array(
    'reponse' => $etat
);
header('Content-type: application/json');
echo json_encode($objet);
?>

