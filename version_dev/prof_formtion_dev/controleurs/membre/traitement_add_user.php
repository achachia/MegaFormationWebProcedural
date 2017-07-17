<?php

session_start();
session_regenerate_id();
require_once './../../connection/config.php';
require_once './../../librairie/fonctions_local.php';
ini_set('date.timezone', 'Europe/Paris');
$etat = TRUE;
$list_erreur = array();
$_SESSION ['traitement_form_compte']['result'] = '';
$nom = unhtmlentities($_POST['nom_user']);
$prenom = unhtmlentities($_POST['prenom_user']);
$pseudo = unhtmlentities($_POST['pseudo']);
$date_naissance = unhtmlentities($_POST['date_naissance']);
$select_sex = unhtmlentities($_POST['id_sex_user']);
$email = unhtmlentities($_POST['email']);
$password = unhtmlentities($_POST['password']);
$select_statut = unhtmlentities($_POST['id_statut_user']);
$select_niveau = unhtmlentities($_POST['id_niv_peda_user']);
$check_newsletter = (unhtmlentities($_POST['check_newsletter']) == '1') ? unhtmlentities($_POST ['check_newsletter']) : '0';


if ($nom == '' || $prenom == '' || $pseudo == '' || $date_naissance == '' || $select_sex == '' || $email == '' || $select_statut == '' || $select_niveau == '' || $password == '') {
    if ($nom == '') {
        $list_erreur['nom_user'] = fa_warring . ' Le champ Nom  ne doit pas etre vide';
    }
    if ($prenom == '') {
        $list_erreur['prenom_user'] = fa_warring . ' Le champ Pr&eacute;nom ne doit pas etre vide';
    }
    if ($pseudo == '') {
        $list_erreur['pseudo'] = fa_warring . ' Le champ Pseudo ne doit pas etre vide';
    }
    if ($date_naissance == '') {
        $list_erreur['date_naissance'] = fa_warring . ' Le champ date de naissance ne doit pas etre vide';
    }
    if ($select_sex == '') {
        $list_erreur['select_sex'] = fa_warring . ' Le champ Sex doit etre selectionn&eacute;';
    }

    if ($email == '') {
        $list_erreur['email'] = fa_warring . ' Le champ email ne doit pas etre vide';
    }

    if ($select_statut == '') {
        $list_erreur['select_statut'] = fa_warring . ' Le champ statut doit etre selectionn&eacute;';
    }
    if ($select_niveau == '') {
        $list_erreur['select_niveau'] = fa_warring . 'Le champ niveau doit etre selectionn&eacute;';
    }
    if ($password == '') {
        $list_erreur['password'] = fa_warring . 'Le champ mot de passe doit etre saisi';
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

    try {
        $sql = ' INSERT INTO  Membre (nom,prenom,pseudo,date_naissance,id_niveau,email,statut,sex,password,newsletter,date_inscription,code_affiliation,jeton_adhesion,code_activation_mail,code_referent) VALUES (:param1,:param2,:param3,:param4,:param5,:param6,:param7,:param8,:param9,:param10,:param11,:param12,:param13,:param14,:param15)';

        $stmt = $cxn->prepare($sql);
        $stmt->bindParam(':param1', $nom);
        $stmt->bindParam(':param2', $prenom);
        $stmt->bindParam(':param3', $pseudo);
        $stmt->bindParam(':param4', $date_naissance);
        $stmt->bindParam(':param5', $select_niveau);
        $stmt->bindParam(':param6', $email);
        $stmt->bindParam(':param7', $select_statut);
        $stmt->bindParam(':param8', $select_sex);
        $stmt->bindParam(':param9', $password);
        $stmt->bindParam(':param10', $check_newsletter);
        $stmt->bindParam(':param11', $date_inscription);
        $stmt->bindParam(':param12', $code_affiliation);
        $stmt->bindParam(':param13', $_SESSION ['traitement_form_compte']['code_adhesion_mail']);
        $stmt->bindParam(':param14', $code_activation_mail);
        $stmt->bindParam(':param15', $_SESSION ['traitement_form_compte']['code_affiliation']);

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
    include url_templates_email.'/TemplateMoka/mail_activation_inscription_template.php';
    $message = ob_get_clean();

//    $message = "<html>";
//    // $message.="<titre>Votre identifiant de connexion &agrave; l'espace famille </titre>";
//    $message .= "<head></head>";
//    $message .= "<body>Bonjour,<br/><br/><br/>";
//    $message .= "Voici les informations vous permettant de vous identifier sur votre Espace famille de mega-cours,<br/>";
//    $message .= "Votre e-mail : " . $email . " <br/>";
//    $message .= "Votre mot de passe : " . $mot_passe . " <br/><br/>";
//    $message .= "Pour vous connecter,<br/>";
//    $message .= "veuillez utiliser le lien ci-dessous : <br/>";
//    $message .= "<a href = 'http://mega-cours.fr/espacefamille/login.php' >http://mega-cours.fr/espacefamille/login.php</a><br/><br/>";
//    $message .= " Pour rappel dans cet espace qui vous est r&eacute;serv&eacute;, vous pourrez notamment :,<br/>";
//    $message .= " - consulter les comptes-rendus<br/>";
//    $message .= " - consulter vos factures<br/>";
//    $message .= " - acc&eacute;der &aacute; une base de supports p&eacute;dagogiques.<br/><br/>";
//    $message .= "Bonne d&eacute;couverte et utilisation.<br/>";
//    $message .= "Mega-cours.";


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
    try {
        $sql = " UPDATE  Codes_invitations_mail  SET  statut='1' WHERE code='" . $_SESSION ['traitement_form_compte']['code_adhesion_mail'] . "' ";
        $select = $cxn->query($sql);
    } catch (Exception $e) {

        echo $e->getTraceAsString();
    }


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

