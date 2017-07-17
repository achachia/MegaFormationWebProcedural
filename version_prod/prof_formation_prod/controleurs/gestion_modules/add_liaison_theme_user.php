<?php

// controleurs

redirection_membre($_SESSION ['membre']['code_formateur']);
require root_dossier_modeles . '/' . $module . '/' . $action . '.php';
$keygen_theme=$_GET['token_theme'];
$liste_mode_groupe_users=liste_mode_groupe_users();
$liste_groupe_users=liste_groupe_users();
$liste_users=liste_users();
$list_liaisons_theme=list_liaisons_theme($keygen_theme);
$infos_module=get_infos_module($module,$action);



?>