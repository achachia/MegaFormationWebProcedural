<?php

session_start();
session_regenerate_id();
require_once './../../connection/config.php';
require_once './../../librairie/fonctions_local.php';
ini_set('date.timezone', 'Europe/Paris');
$etat = TRUE;
$list_erreur = array();
$date_update = date("Y-m-d H:i:s");

if($_SESSION ['membre']['user_banni']){
    $etat = FALSE;
}

if ($etat) {
    $email = unhtmlentities($_POST['email']);
    $select_niveau = unhtmlentities($_POST['id_niv_peda_user']);
    if (isset($_POST['id_js_fiddle']) && !empty($_POST['id_js_fiddle'])) {
        $id_js_fiddle = unhtmlentities($_POST['id_js_fiddle']);
    }
    if (isset($_POST['id_php_fiddle']) && !empty($_POST['id_php_fiddle'])) {
        $id_php_fiddle = unhtmlentities($_POST['id_php_fiddle']);
    }



    /*     * ********************************************************** */

    if ($email == '' || $select_niveau == '') {

        if ($email == '') {
            $list_erreur['email'] = fa_warring . ' Le champ email ne doit pas etre vide';
        }

        if ($select_niveau == '') {
            $list_erreur['select_niveau'] = fa_warring . 'Le champ niveau doit etre selectionné';
        }

        $etat = FALSE;
    }



    if ($email != '') {
        if (!preg_match("$[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\.[a-z]{2,4}$", $email)) {
            $list_erreur['email'] = fa_warring . 'Le format de email  n\'est pas valide.';
            $etat = FALSE;
        } else {
            try {
                $select = $cxn->query(" SELECT  id_membre   FROM  Membre  WHERE email='" . $email . "'  AND  code_user!='" . $_SESSION ['membre']['code_eleve'] . "'  ");
                $nb = $select->rowCount();
                if ($nb > 0) {
                    $list_erreur['email'] = fa_warring . 'Cette adresse mail n\'est pas valide.';
                    $etat = FALSE;
                }
            } catch (Exception $e) {
                $numargs = func_num_args();
                debug_function(debug_backtrace(), $numargs, $e, $sql);
            }
        }
    }
}



/* * ************************************************************************ */
if ($etat && !empty($_FILES['img_user']['name'])) {

    $imgExt = strtolower(pathinfo($_FILES['img_user']['name'], PATHINFO_EXTENSION));

    /*     * ******** recuperation ancienne fichier de la base de donnée en cas si existe ********************** */
    try {
        $sql = " SELECT LEFT( Membre.profil_img, 20 ) AS random_img,profil_img  FROM Membre  WHERE  code_user=:param1 ";
        $stmt = $cxn->prepare($sql);
        $stmt->bindParam(':param1', $_SESSION ['membre']['code_eleve']);
        $stmt->execute();
        $enregistrement = $stmt->fetch();
        $random_img = $enregistrement['random_img'];
        $precedant_fichier = $enregistrement['profil_img'];
        //   echo $random_img.'<br/>';
        //  echo $precedant_fichier;
    } catch (Exception $ex) {
        echo $ex->getMessage();
        $etat = FALSE;
    }
    /*     * ****************** Faire les test de controls ********************** */


    if ($precedant_fichier == 'avatar_h.png' || $precedant_fichier == 'avatar_f.png') {
        $random_img = random(20);
        $etat = upload_img_profil($_FILES['img_user'], $random_img);
    } else {
        $etat = upload_img_profil($_FILES['img_user'], $random_img, $precedant_fichier);
    }
    $profil_img = $random_img . '.' . $imgExt;
}
/* * ************************** INtertion dans la base de donnee ************************* */
if ($etat) {
    try {
        $sql = ' UPDATE  Membre  SET  id_niveau=:param1,email=:param2,date_update=:param7';

        if (!empty($_FILES['img_user']['name'])) {
            $sql .=',profil_img=:param3  ';
        }
        if (isset($_POST['id_js_fiddle']) && !empty($_POST['id_js_fiddle'])) {
            $sql .= ',code_jsfidlle=:param4 ';
        }
        if (isset($_POST['id_php_fiddle']) && !empty($_POST['id_php_fiddle'])) {
            $sql .= ',code_phpfiddle=:param5  ';
        }

        $sql .= ' WHERE  code_user=:param6  ';
        $stmt = $cxn->prepare($sql);
        $stmt->bindParam(':param1', $select_niveau);
        $stmt->bindParam(':param2', $email);

        if (!empty($_FILES['img_user']['name'])) {
            $stmt->bindParam(':param3', $profil_img);
        }
        if (isset($_POST['id_js_fiddle']) && !empty($_POST['id_js_fiddle'])) {
            $stmt->bindParam(':param4', $id_js_fiddle);
        }
        if (isset($_POST['id_php_fiddle']) && !empty($_POST['id_php_fiddle'])) {
            $stmt->bindParam(':param5', $id_php_fiddle);
        }
        $stmt->bindParam(':param6', $_SESSION ['membre']['code_eleve']);
        $stmt->bindParam(':param7', $date_update);
        $stmt->execute();
    } catch (Exception $ex) {
        echo $ex->getMessage();
        $etat = FALSE;
    }
}

/* * ********************************************** */
//var_dump($list_erreur);  //debug

/* * **************************************************** */

try {
    $sql = " SELECT  profil_img,sex AS id_sex  FROM  Membre  WHERE  code_user=:param1";
    $resultat = $cxn->prepare($sql);
    $resultat->bindParam(':param1', $_SESSION ['membre']['code_eleve']);
    $resultat->execute();
    $enregistrement = $resultat->fetch();
    if ($enregistrement['profil_img'] != 'avatar_h.png' && $enregistrement['profil_img'] != 'avatar_f.png') {
        $_SESSION ['membre']['profil_img'] = url_dir_img_user . '/' . $enregistrement['profil_img'];
    }
} catch (Exception $e) {
    $parametres_sql = array($_SESSION ['membre']['code_eleve']);
    $numargs = func_num_args();
    debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
}

/* * *************************************** */

if ($etat) {
    if (isset($_SESSION ['traitement_form_compte'])) {
        unset($_SESSION ['traitement_form_compte']);
    }
    /*     * ******************** Mise ajour le niveau eleve  ***************************** */
    try {
        $sql = " SELECT   id_niveau  FROM  Membre  WHERE  code_user=:param1";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $_SESSION ['membre']['code_eleve']);
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $_SESSION ['membre']['id_niveau_eleve'] = $enregistrement['id_niveau'];
    } catch (Exception $e) {
        $parametres_sql = array($_SESSION ['membre']['code_eleve']);
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
    }

    /*     * **************************************************************************** */
    $url = url_espace_eleve . '/index.php?module=membre&action=mon_compte&mode=consultation&&result=succees';
} else {
    $_SESSION ['traitement_form_compte']['tableau_serialise'] = serialize($_POST);
    $_SESSION ['traitement_form_compte']['list_erreur'] = $list_erreur;
    $url = url_espace_eleve . '/index.php?module=membre&action=mon_compte&mode=edition&result=echec';
}
header("Location:  $url");
