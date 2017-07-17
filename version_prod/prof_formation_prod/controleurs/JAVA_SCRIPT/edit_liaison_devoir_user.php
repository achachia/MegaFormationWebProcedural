<?php

// controleurs

redirection_membre($_SESSION ['membre']['code_formateur']);
require root_dossier_modeles . '/' . $module . '/' . $action . '.php';
$keygen_dev=$_GET['token_devoir'];
$keygen_liaison=$_GET['token_liaison'];
$liste_mode_groupe_users=liste_mode_groupe_users();
$liste_groupe_users=liste_groupe_users();
$liste_users=liste_users();
$infos_liaison=get_infos_liaison_dev($keygen_liaison);
$infos_module=get_infos_module($module,$action);



?>
