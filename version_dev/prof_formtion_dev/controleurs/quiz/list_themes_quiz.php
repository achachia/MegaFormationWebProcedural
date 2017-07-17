<?php

// controleurs

redirection_membre($_SESSION ['membre']['code_eleve']);
require root_dossier_modeles . '/' . $module . '/' . $action . '.php';
//$code_matiere=$_GET['code_matiere'];
$check_list_quiz = check_list_quiz($_SESSION ['membre']['id_niveau_eleve'], $_SESSION['code_matiere'], $_SESSION ['membre']['code_eleve']);
$list_section = list_section($_SESSION ['membre']['id_niveau_eleve'], $_SESSION['code_matiere']);
if (isset($_SESSION['quiz'])) {
    $_SESSION['quiz']['parametres']=array();
    $_SESSION['quiz']=array();
    unset($_SESSION['quiz']);
}


?>

