<?php

session_start();
session_regenerate_id();
require_once './connection/config.php';
ini_set('date.timezone', 'Europe/Paris');
$etat = TRUE;
$objet = array();
$contenu = '';

if($_SESSION ['membre']['user_banni']){
    $etat = FALSE;
}
if ($etat) {
    $keygen_exo = $_POST['keygen_exo'];

    try {
        $sql = "SELECT  Corrige_text,ID_plate_forme_corrige,Codefiddle_Corrige  FROM  Exercices_themes  WHERE  keygen_exo=:param1 ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $keygen_exo);
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        //  $code_snipppet = $enregistrement ['code_fiddle'];
        //$id_tab_code = $enregistrement ['tab_code'];
        $contenu = '<div class="row">';
        if ($enregistrement ['Corrige_text'] != '') {
            $contenu.='<div class="col-lg-12" style="margin-top:3%">' . html_entity_decode(stripslashes($enregistrement ['Corrige_text']), ENT_QUOTES) . '</div>';
        }
        if ($enregistrement ['Codefiddle_Corrige'] != '') {
            $contenu.='<div class="col-lg-12" style="margin-top:3%">';
            if ($enregistrement ['ID_plate_forme_corrige'] == '1') {
                // compte Jsfiddle
                //requette pour extraire Tabscode

                $Tabs = 'html,css,js,result';

                /*                 * ************************************** */

                $contenu .= '<iframe width="100%" height="300" src="//jsfiddle.net/achachia/' . $enregistrement ['Codefiddle_Corrige'] . '/embedded/' . $Tabs . '/" allowfullscreen="allowfullscreen" frameborder="0"></iframe>';
            } else if ($enregistrement ['ID_plate_forme_corrige'] == '2') {
                //compte Ideone
                $contenu .= '<iframe src="https://ideone.com/embed/' . $enregistrement ['Codefiddle_Corrige'] . '" width="100%" height="600px" frameborder="0" style="border: 1px solid #c0c0c0; overflow-x: hidden;"></iframe>';
            } else if ($enregistrement ['ID_plate_forme_corrige'] == '3') {
                //compte PHP fiddle
            } else if ($enregistrement ['ID_plate_forme_corrige'] == '4') {
                //compte Pastbein
                // $contenu = '<iframe src="//pastebin.com/embed_iframe/RNTxNvcx" style="border:none;width:100%"></iframe>';
            }
            $contenu.='</div>';
        }
        $contenu .= '</div>';
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
}

/**
 * ******************************
 */
$objet ['message'] = array(
    'reponse' => $etat,
    'contenu' => $contenu
);
header('Content-type: application/json');
echo json_encode($objet);
?>
