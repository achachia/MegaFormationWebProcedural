<?php

// controleurs

redirection_membre($_SESSION ['membre']['code_eleve']);
require root_dossier_modeles . '/' . $module . '/' . $action . '.php';
$liste_codes = liste_codes();
set_historique_consultation_lien($module, $action, $_SESSION ['membre']['code_eleve']);
?>

