<?php

require_once './connection/config.php';
require_once './librairie/fonctions_local.php';
ini_set('date.timezone', 'Europe/Paris');
$etat = TRUE;
$objet = array();
$liste_notification = array();
$contenu_list_notif = '';


$keygen_rep = $_POST['keygen_rep'];
$degre_notif_code = $_POST['degre_notif_code'];
$contenu_notif_code = $_POST['contenu_notif_code'];
$date_created = date("Y-m-d H:i:s");
$keygen_notif = random(20);
try {
    $sql = "  INSERT INTO  Notifications_codes_eleves (keygen_notif,keygen_rep,degre_notif,contenu_notif,date_created) VALUES (:param1,:param2,:param3,:param4,:param5)  ";
    $resultat = $cxn->prepare($sql);
    $resultat->bindParam(':param1', $keygen_notif);
    $resultat->bindParam(':param2', $keygen_rep);
    $resultat->bindParam(':param3', $degre_notif_code);
    $resultat->bindParam(':param4', $contenu_notif_code);
    $resultat->bindParam(':param5', $date_created);
    $resultat->execute();
    /*     * ***************** Recuperation la liste des notifications posté *********************** */
    try {
        $sql = " SELECT DISTINCT Notifications_codes_eleves.contenu_notif,Notifications_codes_eleves.date_created,Notifications_codes_eleves.degre_notif,Liste_degre_message.code_span"
                . "  FROM  Notifications_codes_eleves,Liste_degre_message"
                . "   WHERE Notifications_codes_eleves.degre_notif=Liste_degre_message.id_level "
                . "   AND  Notifications_codes_eleves.keygen_rep=:param1 ";

        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $keygen_rep);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $liste_notification[$i]['degre_notif'] = $enregistrement['code_span'];
            $liste_notification[$i]['contenu'] = $enregistrement['contenu_notif'];
            $liste_notification[$i]['date_notif'] = $enregistrement['date_created'];
            $i++;
        }
    } catch (Exception $e) {
        $parametres_sql = array($enregistrement['keygen_rep']);
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql1, $parametres_sql);
    }

    if (sizeof($liste_notification) > 0) {
        foreach ($liste_notification as $value) {



            $contenu_list_notif.='   <div class="answer left"> ';

            $contenu_list_notif.='  <div class="text">' . $value['contenu'] . ' </div>';

            $contenu_list_notif.='<div class="time">' . $value['date_notif'] . '&nbsp;' . $value['degre_notif'] . '</div>';

            $contenu_list_notif.= '</div>';
        }
    }
} catch (Exception $e) {
    $etat = FALSE;
    echo "Une erreur est survenue lors de la récupération des données" . $keygen_rep . $degre_notif_code . $contenu_notif_code . $date_created . $keygen_notif;
}

/**
 * ******************************
 */
$objet ['message'] = array(
    'reponse' => $etat,
    'contenu_list_notif' => $contenu_list_notif
);
header('Content-type: application/json');
echo json_encode($objet);
?>


