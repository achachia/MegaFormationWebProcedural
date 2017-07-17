<?php

// controleurs

redirection_membre($_SESSION ['membre']['code_eleve']);
require root_dossier_modeles . '/' . $module . '/' . $action . '.php';
$infos_user = infos_user($_SESSION ['membre']['code_eleve']);
$liste_sex = liste_sex();
$liste_niveaux = liste_niveaux();

if (isset($_GET['result']) && $_GET['result'] == 'echec') {
    $infos_user = unserialize($_SESSION ['traitement_form_compte']['tableau_serialise']);  
    $list_erreur = $_SESSION ['traitement_form_compte']['list_erreur'];
}
if (!isset($_GET['mode'])) {
    $mode = 'consultation';
} else {
    $mode = $_GET['mode'];
}
/* * ****************************** */


/* * **************************************** */
if (isset($_SESSION['quiz'])) {
    unset($_SESSION['quiz']);
}
?>
