<?php

// controleurs

redirection_membre($_SESSION ['membre']['code_eleve']);
require root_dossier_modeles . '/' . $module . '/' . $action . '.php';
$code_matiere = $_GET['code_matiere'];
$check_form = check_formulaire($_SESSION ['membre']['id_niveau_eleve'], $code_matiere);
$list_section = list_section($_SESSION ['membre']['id_niveau_eleve'], $code_matiere);
if (isset($_SESSION['quiz'])) {
    unset($_SESSION['quiz']);
}

?>

