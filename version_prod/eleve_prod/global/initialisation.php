<?php

redirection_membre($_SESSION ['membre'] ['code_eleve']);

if (empty($_GET['action']) && empty($_GET['module'])) {
    $module = 'home';
    $action = 'home';
}

if (isset($_GET['action']) && !empty($_GET['action']) && isset($_GET['module']) && !empty($_GET['module']) && is_file(root_dossier_vues . '/' . $_GET['module'] . '/' . $_GET['action'] . '.php')) {

    $module = unhtmlentities($_GET['module']);
    $action = unhtmlentities($_GET['action']);
}

$nbr_notification_non_lus_java = nbr_notifications_non_lus_par_theme('7');
$nbr_notification_non_lus_html = nbr_notifications_non_lus_par_theme('1');
$nbr_notification_non_lus_css = nbr_notifications_non_lus_par_theme('2');
$nbr_notification_non_lus_js = nbr_notifications_non_lus_par_theme('3');

$liste_alertes_user_bordereau=liste_alertes_user_bordereau($_SESSION ['membre']['code_eleve'],$_SESSION ['membre']['keygen_groupe']);


?>