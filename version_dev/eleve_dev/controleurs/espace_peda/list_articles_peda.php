<?php

// controleurs

redirection_membre($_SESSION ['membre']['code_eleve']);
require root_dossier_modeles . '/' . $module . '/' . $action . '.php';
?>
