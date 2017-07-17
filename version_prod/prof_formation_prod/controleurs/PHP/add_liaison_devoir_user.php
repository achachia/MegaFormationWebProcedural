<?php

// controleurs

redirection_membre($_SESSION ['membre']['code_formateur']);
require root_dossier_modeles . '/' . $module . '/' . $action . '.php';
$keygen_dev=$_GET['token_devoir'];
$liste_mode_groupe_users=liste_mode_groupe_users();
$liste_groupe_users=liste_groupe_users();
$liste_users=liste_users();
$list_liaisons_devoir=list_liaisons_devoir($keygen_dev);
$infos_module=get_infos_module($module,$action);



?>