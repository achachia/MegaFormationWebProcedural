<?php

// controleurs

redirection_membre($_SESSION ['membre']['code_eleve']);
require root_dossier_modeles . '/' . $module . '/' . $action . '.php';
$nbr_notifications_non_lus = nbr_notifications_non_lus();
$nbr_exo_html_non_effectue=nbr_exo_non_effectue('1');
$nbr_exo_css_non_effectue=nbr_exo_non_effectue('2');
$nbr_exo_js_non_effectue=nbr_exo_non_effectue('3');
$nbr_exo_java_non_effectue=nbr_exo_non_effectue('7');  
$liste_alertes_user_home=liste_alertes_user($_SESSION ['membre']['code_eleve'],$_SESSION ['membre']['keygen_groupe'],'public',NULL,'all');
?>
