<?php
session_start();
session_regenerate_id();
require_once './../../connection/config.php';
require_once './../../librairie/fonctions_local.php';
ini_set('date.timezone', 'Europe/Paris');
$etat = TRUE;
$list_erreur = array();
$date_created = date("Y-m-d H:i:s");
$nom = unhtmlentities($_POST['nom_user']);
$prenom = unhtmlentities($_POST['prenom_user']);
$pseudo = unhtmlentities($_POST['pseudo']);
$date_naissance = unhtmlentities($_POST['date_naissance']);
$select_sex = unhtmlentities($_POST['id_sex_user']);
$email = unhtmlentities($_POST['email']);
$select_statut = unhtmlentities($_POST['id_statut_user']);
$select_niveau = unhtmlentities($_POST['id_niv_peda_user']);
$check_newsletter = (unhtmlentities($_POST['check_newsletter']) == '1') ? unhtmlentities($_POST ['check_newsletter']) : '0';


/* * ********************************************************** */

if ($nom == '' || $prenom == '' || $pseudo == '' || $date_naissance == '' || $select_sex == '' || $email == '' || $select_statut == '' || $select_niveau == '') {
    if ($nom == '') {
        $list_erreur['nom_user'] = fa_warring . ' Le champ Nom  ne doit pas etre vide';
    }
    if ($prenom == '') {
        $list_erreur['prenom_user'] = fa_warring . ' Le champ Prenom ne doit pas etre vide';
    }
    if ($pseudo == '') {
        $list_erreur['pseudo'] = fa_warring . ' Le champ Pseudo ne doit pas etre vide';
    }
    if ($date_naissance == '') {
        $list_erreur['date_naissance'] = fa_warring . ' Le champ date de naissance ne doit pas etre vide';
    }
    if ($select_sex == '') {
        $list_erreur['select_sex'] = fa_warring . ' Le champ Sex doit etre selectionné';
    }

    if ($email == '') {
        $list_erreur['email'] = fa_warring . ' Le champ email ne doit pas etre vide';
    }

    if ($select_statut == '') {
        $list_erreur['select_statut'] = fa_warring . ' Le champ statut doit etre selectionné';
    }
    if ($select_niveau == '') {
        $list_erreur['select_niveau'] = fa_warring . 'Le champ niveau doit etre selectionné';
    }

    $etat = FALSE;
}


if ($nom != '') {
    if (!ctype_alnum($nom)) {
        $list_erreur['nom_user'] = fa_warring . 'Le nom ne contient pas que des chiffres ou des lettres.';
        $etat = FALSE;
    }
}
if ($prenom != '') {
    if (!ctype_alnum($prenom)) {
        $list_erreur['prenom_user'] = fa_warring . 'Le prenom ne contient pas que des chiffres ou des lettres.';
        $etat = FALSE;
    }
}
if ($pseudo != '') {
    if (!ctype_alnum($pseudo)) {
        $list_erreur['pseudo'] = fa_warring . 'Le pseudo ne contient pas que des chiffres ou des lettres.';
        $etat = FALSE;
    }
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
    } catch (Exception $ex) {
        echo $ex->getMessage();
        $etat = FALSE;
    }
    /*     * ****************** Faire les test de controls ********************** */
    if ($precedant_fichier == '') {
        $random_img = random(20);
    }
    $profil_img = $random_img . '.' . $imgExt;
    if ($precedant_fichier == '') {
        $etat = upload_img_profil($_FILES['img_user'], $random_img);
    } else {
        $etat = upload_img_profil($_FILES['img_user'], $random_img, $precedant_fichier);
    }
}
/* * ************************** INtertion dans la base de donnee ************************* */
if ($etat) {
    try {
        $sql = ' UPDATE  Membre  SET  nom=:param1,prenom=:param2,pseudo=:param3,date_naissance=:param4,id_niveau=:param5,email=:param6,statut=:param7,';

        if (!empty($_FILES['img_user']['name'])) {
            $sql .='profil_img=:param8,  ';
        }

        $sql .= 'sex=:param9,newsletter=:param10   WHERE  code_user=:param11  ';
        $stmt = $cxn->prepare($sql);
        $stmt->bindParam(':param1', $nom);
        $stmt->bindParam(':param2', $prenom);
        $stmt->bindParam(':param3', $pseudo);
        $stmt->bindParam(':param4', $date_naissance);
        $stmt->bindParam(':param5', $select_niveau);
        $stmt->bindParam(':param6', $email);
        $stmt->bindParam(':param7', $select_statut);

        if (!empty($_FILES['img_user']['name'])) {
            $stmt->bindParam(':param8', $profil_img);
        }

        $stmt->bindParam(':param9', $select_sex);
        $stmt->bindParam(':param10', $check_newsletter);
        $stmt->bindParam(':param11', $_SESSION ['membre']['code_eleve']);
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
    if ($enregistrement['profil_img'] != '') {
        $_SESSION ['membre']['profil_img'] = url_dir_img_user . '/' . $enregistrement['profil_img'];
    } else {
        if ($enregistrement['id_sex'] == '1') {
            $_SESSION ['membre']['profil_img'] = url_dir_img_user . '/avatar_h.png';
        }
        if ($enregistrement['id_sex'] == '2') {
            $_SESSION ['membre']['profil_img'] = url_dir_img_user . '/avatar_f.png';
        }
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
