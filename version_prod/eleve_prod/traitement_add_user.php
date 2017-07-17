<?php

session_start();
session_regenerate_id();
require_once './connection/config.php';
require_once './librairie/fonctions_local.php';
ini_set('date.timezone', 'Europe/Paris');
$etat = TRUE;
$list_erreur = array();
$_SESSION ['traitement_form_compte']['result'] = '';
$nom = unhtmlentities($_POST['nom_user']);
$prenom = unhtmlentities($_POST['prenom_user']);
$pseudo = unhtmlentities($_POST['pseudo']);
$date_naissance = unhtmlentities($_POST['date_naissance']);
$select_niveau = unhtmlentities($_POST['id_niv_peda_user']);
$select_sex = unhtmlentities($_POST['id_sex_user']);
$email = unhtmlentities($_POST['email']);
$password = unhtmlentities($_POST['password']);

$quest1_projet = unhtmlentities($_POST['quest1_projet']);
$contenu_projet_pro = unhtmlentities($_POST['contenu_projet_pro']);
$quest2_dev = unhtmlentities($_POST['quest2_dev']);
$liste_langage = unhtmlentities($_POST['liste_langage']);
$contenu_attente = unhtmlentities($_POST['contenu_attente']);
$quest4_formation = unhtmlentities($_POST['quest4_formation']);
$contenu_formation = unhtmlentities($_POST['contenu_formation']);



if ($nom == '' || $prenom == '' || $pseudo == '' || $date_naissance == '' || $select_sex == '' || $email == '' || $select_niveau == '' || $password == '' || $contenu_attente == '' ) {
    if ($nom == '') {
        $list_erreur['nom_user'] = fa_warring . ' Le champ Nom  doit etre rempli';
    }
    if ($prenom == '') {
        $list_erreur['prenom_user'] = fa_warring . ' Le champ Pr&eacute;nom doit etre rempli';
    }
    if ($pseudo == '') {
        $list_erreur['pseudo'] = fa_warring . ' Le champ Pseudo doit etre rempli';
    }
    if ($date_naissance == '') {
        $list_erreur['date_naissance'] = fa_warring . ' Le champ date de naissance doit etre rempli';
    }
    if ($select_sex == '') {
        $list_erreur['select_sex'] = fa_warring . ' Le champ Sex doit etre selectionn&eacute;';
    }

    if ($email == '') {
        $list_erreur['email'] = fa_warring . ' Le champ email doit etre rempli';
    }

    if ($select_niveau == '') {
        $list_erreur['select_niveau'] = fa_warring . 'Le champ niveau doit etre selectionn&eacute;';
    }
    if ($password == '') {
        $list_erreur['password'] = fa_warring . 'Le champ mot de passe doit etre rempli';
    } 
    if ($contenu_attente == '') {
        $list_erreur['contenu_attente'] = fa_warring . 'Le champ  doit etre rempli';
    }  

    $etat = FALSE;
}


if ($quest1_projet == ''  || $quest2_dev == '' ||   $quest4_formation == '') {

    if ($quest1_projet == '') {
        $list_erreur['quest1_projet'] = fa_warring . 'Le champ  doit etre rempli';
    }

    if ($quest2_dev == '') {
        $list_erreur['quest2_dev'] = fa_warring . 'Le champ  doit etre rempli';
    } 
    if ($quest4_formation == '') {
        $list_erreur['quest4_formation'] = fa_warring . 'Le champ  doit etre rempli';
    }

    $etat = FALSE;
} else {
    if ($contenu_projet_pro == '' && $quest1_projet == '1') {
        $list_erreur['contenu_projet_pro'] = fa_warring . 'Le champ  doit etre rempli';
        $etat = FALSE;
    }
    if ($liste_langage == '' && $quest2_dev == '1') {
        $list_erreur['liste_langage'] = fa_warring . 'Le champ  doit etre rempli';
        $etat = FALSE;
    }
    if ($contenu_formation == '' && $quest4_formation == '1') {
        $list_erreur['contenu_formation'] = fa_warring . 'Le champ  doit etre rempli';
        $etat = FALSE;
    }
}



if ($nom != '') {
    if (!ctype_alnum($nom)) {
        $list_erreur['nom_user'] = fa_warring . 'Le nom ne contient pas que des chiffres ou des lettres.';
        $etat = FALSE;
    }
}
if ($prenom != '') {
    if (!ctype_alnum($prenom)) {
        $list_erreur['prenom_user'] = fa_warring . 'Le pr&eacute;nom ne contient pas que des chiffres ou des lettres.';
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
            $select = $cxn->query(" SELECT  id_membre   FROM  Membre  WHERE   email='" . $email . "'  ");
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



/* * ************************** Intertion dans la base de donnee ************************* */

if ($etat) {
    $password = md5($password);
    $date_inscription = date("Y-m-d H:i:s");
    $code_affiliation = random(6);
    $code_activation_mail = random(20);
    if ($select_sex == '1') {
        $profil_img = 'avatar_h.png';
    } else {
        $profil_img = 'avatar_f.png';
    }
    try {
        $sql = ' INSERT INTO  Membre (nom,prenom,pseudo,date_naissance,id_niveau,email,password,date_inscription,profil_img,sex,code_affiliation,code_activation_mail,projet_prof,contenu_projet_prof,deja_programme,langages_dev,attentes,deja_avoir_formation,contenu_formation) VALUES (:param1,:param2,:param3,:param4,:param5,:param6,:param7,:param8,:param9,:param10,:param11,:param12,:param13,:param14,:param15,:param16,:param17,:param18,:param19)';

        $stmt = $cxn->prepare($sql);
        $stmt->bindParam(':param1', $nom);
        $stmt->bindParam(':param2', $prenom);
        $stmt->bindParam(':param3', $pseudo);
        $stmt->bindParam(':param4', $date_naissance);
        $stmt->bindParam(':param5', $select_niveau);
        $stmt->bindParam(':param6', $email);
        $stmt->bindParam(':param7', $password);
        $stmt->bindParam(':param8', $date_inscription);
        $stmt->bindParam(':param9', $profil_img);
        $stmt->bindParam(':param10', $select_sex);
        $stmt->bindParam(':param11', $code_affiliation);
        $stmt->bindParam(':param12', $code_activation_mail);
        $stmt->bindParam(':param13', $quest1_projet);
        $stmt->bindParam(':param14', $contenu_projet_pro);
        $stmt->bindParam(':param15', $quest2_dev);
        $stmt->bindParam(':param16', $liste_langage);
        $stmt->bindParam(':param17', $contenu_attente);
        $stmt->bindParam(':param18', $quest4_formation);
        $stmt->bindParam(':param19', $contenu_formation);

        $stmt->execute();
    } catch (Exception $ex) {
        echo $ex->getMessage();
        $etat = FALSE;
    }
}
/* * ****************** Mise ajour le code user ************************************************ */
$stmt = $cxn->prepare(" SELECT id_membre FROM Membre  WHERE nom=:param1 AND  prenom=:param2 ");
$stmt->bindParam(':param1', $nom);
$stmt->bindParam(':param2', $prenom);
$stmt->execute();
$enregistrement = $stmt->fetch();
$id_membre = $enregistrement ['id_membre'];
// Mettre a jour le code de famille
$code = 'CE' . $id_membre;
$sql = " UPDATE  Membre SET code_user='" . $code . "'  WHERE  nom='" . $nom . "' AND  prenom='" . $prenom . "' ";
$select = $cxn->query($sql);

/* * ***************  Envoi mail  pour activer le processus inscription ******************************* */
if ($etat) {
    $entetedate = date("D, j M Y H:i:s -0600"); // Offset horaire
    $headers = "From: \"espace-eleve@mega-cours.fr\"<espace-eleve@mega-cours.fr>\n";
    $headers .= "Reply-To: espace-eleve@mega-cours.fr\n";
    $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
    ob_start();
    include root_templates_email . '/TemplateMoka/mail_activation_inscription_template.php';
    $message = ob_get_clean();  

    if (!mail($email, "Activation de votre compte megacours", $message, $headers)) {
        $etat = FALSE;
        $objet ['message_erreur'] [] = "desole l'inscrption a echoué.";
        $objet ['etapes_creation'] [] = '<span class="glyphicon glyphicon-remove"></span> Envoi le mail de connection au client a echoue.';
    } else {
        $objet ['etapes_creation'] [] = '<span class="glyphicon glyphicon-ok"></span> Envoi le mail de connection au client.';
    }
}


/* * ***************************************** */
//var_dump($list_erreur);  //debug

/* * **************************************************** */

if ($etat) {

    $_SESSION ['traitement_form_compte']['result'] = 'succees';
    //************************ Mettre a jour ******************************/
//    try {
//        $sql = " UPDATE  Codes_invitations_mail  SET  statut='1' WHERE code='" . $_SESSION ['traitement_form_compte']['code_adhesion_mail'] . "' ";
//        $select = $cxn->query($sql);
//    } catch (Exception $e) {
//
//        echo $e->getTraceAsString();
//    }


    /*     * ****************************************************************** */
    if (isset($_SESSION ['traitement_form_compte'])) {
        unset($_SESSION ['traitement_form_compte']['tableau_serialise']);
        unset($_SESSION ['traitement_form_compte']['list_erreur']);
    }
    $url = url_espace_eleve . '/inscription.php';
} else {
    $_SESSION ['traitement_form_compte']['tableau_serialise'] = serialize($_POST);
    $_SESSION ['traitement_form_compte']['list_erreur'] = $list_erreur;
    $_SESSION ['traitement_form_compte']['result'] = 'echec';
    $url = url_espace_eleve . '/inscription.php';
}
header("Location:  $url");

