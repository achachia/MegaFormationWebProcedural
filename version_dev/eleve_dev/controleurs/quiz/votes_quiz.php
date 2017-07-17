<?php

session_start();
session_regenerate_id();
$date = date("Y-m-d H:i:s");
$check = TRUE;
require_once './../../connection/config.php';
require_once root_dossier_modeles.'/quiz/result_quiz.php';
ini_set('date.timezone', 'Europe/Paris');

if (!empty($_POST['ratingPoints'])) {
    $random_quiz = $_POST['random_quiz'];
    $ratingNum = 1;
    $ratingPoints = $_POST['ratingPoints'];
    /*     * ********************** verifier si utilisateur a deja vote *************************** */
    try {
        $sql = "  SELECT id FROM  Historiques_votes_quiz_eleve   WHERE code_user =  '" . $_SESSION ['membre']['code_eleve'] . "'   AND  random_quiz='" . $random_quiz . "' ";
        $select = $cxn->query($sql);
        $nb = $select->rowCount();
        if ($nb <= 0) {
            /*             * *************************verifier les valeurs de vote dans la table************************** */
            try {
                $sql = "  SELECT nombre_votes,total_point  FROM Votes_quiz_eleve WHERE random_quiz =  '" . $random_quiz . "' ";
                $select = $cxn->query($sql);
                $nb = $select->rowCount();
                if ($nb <= 0) {
                    /*                     * **************** Intertion les donnes dans la table ******************** */
                    try {
                        $nombre_votes = 1;
                        $sql = ' INSERT INTO  Votes_quiz_eleve (nombre_votes,date_cretead,total_point,random_quiz) VALUES (:param1,:param2,:param3,:param4)';
                        $resultat = $cxn->prepare($sql);
                        $resultat->bindParam(':param1', $nombre_votes);
                        $resultat->bindParam(':param2', $date);
                        $resultat->bindParam(':param3', $ratingPoints);
                        $resultat->bindParam(':param4', $random_quiz);
                        $resultat->execute();
                    } catch (Exception $e) {
                        $check = FALSE;
                        echo $e->getMessage() . '1';
                    }
                } else {
                    $enregistrement = $select->fetch();
                    $nombre_votes = $enregistrement['nombre_votes'] + $ratingNum;
                    $total_points = $enregistrement['total_points'] + $ratingPoints;
                    /*                     * ************ Mise a jour la table ********************** */
                    try {
                        $sql = ' UPDATE  Votes_quiz_eleve  SET  nombre_votes=:param1,date_update=:param2,total_point=:param3   WHERE  random_quiz=:param4';
                        $resultat = $cxn->prepare($sql);
                        $resultat->bindParam(':param1', $nombre_votes);
                        $resultat->bindParam(':param2', $date);
                        $resultat->bindParam(':param3', $total_points);
                        $resultat->bindParam(':param4', $random_quiz);
                        $resultat->execute();
                    } catch (Exception $e) {
                        $check = FALSE;
                        echo $e->getMessage() . '2';
                    }
                }
            } catch (Exception $e) {
                $check = FALSE;
                echo $e->getMessage() . '3';
            }
            /*             * *************************** Intertion vote du membre dans l'historique de votes de quiz *********************** */
            try {
                $sql = ' INSERT INTO  Historiques_votes_quiz_eleve  (code_user,date_vote,total_point,random_quiz) VALUES (:param1,:param2,:param3,:param4)';
                $resultat = $cxn->prepare($sql);
                $resultat->bindParam(':param1', $_SESSION ['membre']['code_eleve']);
                $resultat->bindParam(':param2', $date);
                $resultat->bindParam(':param3', $ratingPoints);
                $resultat->bindParam(':param4', $random_quiz);
                $resultat->execute();
            } catch (Exception $e) {
                $check = FALSE;
                echo $e->getMessage() . '4';
            }
        }
    } catch (Exception $e) {
        $check = FALSE;
        echo $e->getMessage() . '3';
    }


    /*     * ********************* recuperer totalpoint et nombre de votes ***************************** */
    try {
        $sql = " SELECT nombre_votes, FORMAT( (total_point / nombre_votes), 1 ) AS moy_votes
                     FROM Votes_quiz_eleve
                     WHERE random_quiz=:param1  ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $random_quiz);
        $resultat->execute();
        $ratingRow = $resultat->fetch();
    } catch (Exception $e) {
        $check = FALSE;
        echo $e->getMessage() . '5';
    }
    /*     * ********************************************************** */

    if ($check) {
        $ratingRow['status'] = 'ok';
    } else {
        $ratingRow['status'] = 'err';
    }

    echo json_encode($ratingRow);
}