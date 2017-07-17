<?php
//// modele
//if (!isset($_SESSION  ['membre']['code_eleve']) || empty($_SESSION  ['membre']['code_eleve'])) {
//    $lien = $lien = "http://" . $_SERVER['HTTP_HOST'] . rtrim(dirname(dirname($_SERVER['PHP_SELF'])), '/\\') . "/index.php";
//    header("Location: $lien");
//    exit();
//}
//
//function infos_page($action) {
//    global $cxn;
//    $infos = array();
//    // Récupération des données
//    try {
//        // requete prepare
//        $sql = " SELECT title_page,breadcrumb FROM infos_page WHERE action=:param ";
//        $resultat = $cxn->prepare($sql);
//        $resultat->bindParam(':param', $param);
//        $param = $action;
//        $resultat->execute();
//        $enregistrement = $resultat->fetch();
//        $infos['title_page'] = $enregistrement['title_page'];
//        $infos['breadcrumb'] = $enregistrement['breadcrumb'];
//       
//    } catch (Exception $e) {
//        echo "Une erreur est survenue lors de la récupération des données";
//    }
//    return $infos;
//}

?>
