<?php

// controleurs

redirection_membre($_SESSION ['membre']['code_formateur']);
require root_dossier_modeles . '/' . $module . '/' . $action . '.php';
$keygen_exo=$_GET['keygen_exo'];
$liste_plate_forme_travail=liste_plate_forme_travail();
$infos_exo=infos_exo($keygen_exo);


?>
