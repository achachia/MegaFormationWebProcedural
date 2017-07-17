<?php

// controleurs

redirection_membre($_SESSION ['membre']['code_formateur']);
require root_dossier_modeles . '/' . $module . '/' . $action . '.php';
$keygen_theme=$_GET['token_theme'];
$list_exercices=list_exercices($keygen_theme);
$infos_module=get_infos_module($module,$action);
$infos_theme=get_infos_theme($keygen_theme);


?>