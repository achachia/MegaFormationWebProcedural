<?php 
redirection_membre($_SESSION ['membre']['code_eleve']);
require root_dossier_modeles . '/' . $module . '/' . $action . '.php';
$id_fiche=$_GET['id_fiche'];
$infos_cours=get_url_fiche_cours($id_fiche);
