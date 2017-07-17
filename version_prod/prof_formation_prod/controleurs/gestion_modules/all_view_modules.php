<?php

// controleurs

redirection_membre($_SESSION ['membre']['code_formateur']);
require root_dossier_modeles . '/' . $module . '/' . $action . '.php';
$list_modules=list_modules();
$infos_module=get_infos_module($module,$action);


?>
