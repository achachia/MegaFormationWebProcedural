<?php

// controleurs

redirection_membre($_SESSION ['membre']['code_formateur']);
require root_dossier_modeles . '/' . $module . '/' . $action . '.php';
$keygen_devoir=$_GET['token_devoir'];
$infos_dev=get_infos_dev($keygen_devoir);
$infos_module=get_infos_module($module,$action);




?>


