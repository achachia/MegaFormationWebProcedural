<?php

// controleurs

redirection_membre($_SESSION ['membre']['code_formateur']);
require root_dossier_modeles . '/' . $module . '/' . $action . '.php';
$liste_priorite_alerte=liste_priorite_alerte();
$liste_mode_groupe_users=liste_mode_groupe_users();
$liste_groupe_users=liste_groupe_users();
$liste_users=liste_users();


?>
