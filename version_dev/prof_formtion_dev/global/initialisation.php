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


?>