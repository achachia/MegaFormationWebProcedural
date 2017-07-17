<?php

session_start();
session_regenerate_id();
/* * *********** inculude script config ************ */
require_once './connection/config.php';
require_once './librairie/fonctions_local.php';
require root_dossier_global . '/initialisation.php';
ob_start();
/* * ****************** Verification le module et l'action **************************** */

if (!isset($module) || !isset($action) || !is_file(root_dossier_vues . '/' . $module . '/' . $action . '.php')) {
    require 'page_introuvable.php';
} else {
    require root_dossier_controleurs . '/' . $module . '/' . $action . '.php';
    //$breadcrumb = breadcrumb($module, $action);
    $breadcrumb='';
    
    include root_dossier_vues . '/' . $module . "/" . $action . ".php";
}

$content_body = ob_get_clean();
?>

<!DOCTYPE html>
<html lang="fr">

    <head> <?php include root_dossier_global .'/headers.php'; ?> </head> 

    <body>     

        <div id="wrapper">

            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">


                <?php include root_dossier_global .'/nav.php'; ?>

            </nav>


            <div id="page-wrapper">

                <?php include 'body.php'; ?>

            </div>


        </div>


    </body>

</html>

