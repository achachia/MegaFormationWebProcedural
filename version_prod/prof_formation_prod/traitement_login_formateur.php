<?php

session_start();
session_regenerate_id();
require_once './connection/config.php';
$etat = TRUE;
$email = htmlentities(addslashes(trim($_POST ['email'])), ENT_QUOTES);
$password = htmlentities(addslashes(trim($_POST ['password'])), ENT_QUOTES);
$pass_crypte = md5($password);

if (empty($email) || !preg_match("$[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\.[a-z]{2,4}$", $email)) {
    $etat = FALSE;
}
if (empty($pass_crypte)) {
    $etat = FALSE;
}

if ($etat) { 


    /*     * ************************* compte eleve ********************************* */
    try {
        $sql = " SELECT code_user,nom,prenom,last_connection,type_compte,profil_img FROM Formateurs  WHERE email='" . $email . "'  AND  password='" . $pass_crypte . "'  ";
        $select = $cxn->query($sql);
        $nb = $select->rowCount();
        if ($nb > 0) {            
            $enregistrement = $select->fetch();
            $type_compte_formateur = $enregistrement ['type_compte'];
            $_SESSION ['membre'] = array();
            $_SESSION ['membre'] ['code_formateur'] = $enregistrement ['code_user'];
            //$_SESSION ['membre']['id_niveau_eleve'] = $enregistrement ['id_niveau'];
            $_SESSION ['membre']['nom'] = ucfirst($enregistrement ['nom']);
            $_SESSION ['membre']['prenom'] = ucfirst($enregistrement ['prenom']);
            //$_SESSION ['membre']['email'] = $enregistrement ['email'];
            // $_SESSION ['membre']['identite_eleve'] = ucfirst($enregistrement ['nom']) . '.' . ucfirst($enregistrement ['prenom']);
            $_SESSION ['membre']['last_connection'] = $enregistrement ['last_connection'];
            /*             * *********** Initialiser le temps de la session ****************** */
            if (!isset($_SESSION ['membre']['sessionX'])) {
                $ctime = strtotime("now"); # Create a time from a string
                # create session time
                $_SESSION ['membre']['sessionX'] = $ctime;
            }
            /*             * *********************************** */
            $_SESSION ['membre']['profil_img'] = url_dir_img_user . '/' . $enregistrement['profil_img'];

            /*             * ********************************************************************** */
            $_SESSION ['membre'] ['total_messages'] = 0;
            $_SESSION ['membre'] ['total_notifications'] = 0;
            $_SESSION ['membre'] ['total_points'] = 0;

            if ($type_compte_formateur == '2') {
                $url_redirection = url_espace_formateur_dev;
            } elseif ($type_compte_formateur == '1') {
                $url_redirection = url_espace_formateur_prod;
            }


            /*             * ************* Mise ajour la derniere connection ********************* */

            $date_connection = date("Y-m-d H:i:s");
            try {
                $sql = "UPDATE Formateurs SET  last_connection='" . $date_connection . "'  WHERE    email='" . $email . "'  AND  password='" . $pass_crypte . "' ";

                $select = $cxn->query($sql);
            } catch (Exception $e) {
                $etat = FALSE;
                echo "Une erreur est survenue lors de la récupération des données1";
            }
        }else{
            $etat = FALSE;
        }
    } catch (Exception $e) {
        $etat = FALSE;
        echo "Une erreur est survenue lors de la récupération des données 2";
    }
    /*     * ******************************************************* */
}


if ($etat) {

    $lien = $url_redirection . '/index.php';
  
}

if (!$etat) {
    $lien = url_espace_formateur_prod.'/login.php?message_erreur=erreur';
}

header("Location:  $lien");
exit();
?>
