<?php

// controleurs

redirection_membre($_SESSION ['membre']['code_formateur']);
require root_dossier_modeles . '/' . $module . '/' . $action . '.php';
$infos_quiz['select_etat_exo']='0';
$liste_plate_forme_travail=liste_plate_forme_travail();


?>
