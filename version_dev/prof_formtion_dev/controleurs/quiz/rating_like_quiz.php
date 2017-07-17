<?php
session_start();
session_regenerate_id();
$date = date("Y-m-d H:i:s");
$control = true;

/* * ************************************************* */
$random_quiz = $_POST['random_quiz'];
$val_like = $_POST['val_like'];
/* * *********************include les fichiers de travail *************** */
require_once './../../connection/config.php';
ini_set('date.timezone', 'Europe/Paris');
/* * ********************************************************* */
/* * *************** Recupere le total des like du quiz *********************** */
try {
    $sql = " SELECT    ";
    if ($val_like == 1) {
        $sql .= "  like_quiz  ";
    } else {
        $sql .= "  dislike_quiz ";
    }
    $sql .= "  AS totol_record   FROM  Quiz   WHERE  random=:param  ";
    $resultat = $cxn->prepare($sql);
    $resultat->bindParam(':param', $random_quiz);
    $resultat->execute();
    $enregistrement = $resultat->fetch();
    $total = $enregistrement['totol_record'];
} catch (Exception $e) {
    echo $e->getMessage();
    $control = FALSE;
}


/* * ****************** Verifier que le membre n'pas like encore sur le quiz ******************** */
try {
    $sql = "  SELECT id  FROM  Like_deslike_eleve   WHERE   code_eleve='" . $_SESSION ['membre']['code_eleve'] . "'   AND  random_quiz='" . $random_quiz . "'  ";
    $resultat = $cxn->query($sql);
    $nb = $resultat->rowCount();
} catch (Exception $e) {
    echo $e->getMessage();
    $control = FALSE;
}
/* * ****************** Les infos sur like de quiz ******************** */
if ($nb <= 0) {
    /*     * ****************** Incrementation de compteur like ************** */
    $total = $total + 1;
    /*     * ****************** mettre a jour la base de donne ************************* */
    try {
        $sql = " UPDATE  Quiz  SET  ";
        if ($val_like == 1) {
            $sql .= " like_quiz=:param1,  ";
        } else {
            $sql .= " dislike_quiz=:param1, ";
        }
        $sql .= " date_update_like=:param2   WHERE  random=:param3 ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $total);   
        $resultat->bindParam(':param2', $date);
        $resultat->bindParam(':param3', $random_quiz);
        $resultat->execute();
    } catch (Exception $e) {
        echo $e->getMessage();
        $control = FALSE;
    }
    /*     * ************* Intertion dans la base de donnne ********************** */
    try {
        $sql = " INSERT INTO  Like_deslike_eleve  (code_eleve,date_created,random_quiz,val_like) VALUES (:param1,:param2,:param3,:param4)  ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $_SESSION ['membre']['code_eleve']);
        $resultat->bindParam(':param2', $date);
        $resultat->bindParam(':param3', $random_quiz);
        $resultat->bindParam(':param4', $val_like);
        $resultat->execute();
    } catch (Exception $e) {
        echo $e->getMessage();
        $control = FALSE;
    }
}

/* * **************************************************** */
$objet ['message'] = array(
    'reponse' => $control,
    'total_like' => $total
);
header('Content-type: application/json');
echo json_encode($objet);

