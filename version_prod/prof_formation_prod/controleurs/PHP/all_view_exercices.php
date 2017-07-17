<?php

// controleurs

redirection_membre($_SESSION ['membre']['code_formateur']);
require root_dossier_modeles . '/' . $module . '/' . $action . '.php';
$keygen_module=get_keygen_module($module,$action);
$list_themes=list_themes($keygen_module);
$infos_module=get_infos_module($module,$action);


?>