<?php

require_once './connection/config.php';
ini_set('date.timezone', 'Europe/Paris');
$etat = TRUE;
$objet = array();

$keygen_code = $_POST['fiddleId'];

try {
    $sql = " SELECT   Snippet.id_plate_forme,Snippet.code_fiddle,Tabs_code.nom_tab  FROM Snippet  LEFT JOIN Tabs_code ON Snippet.tab_code = Tabs_code.id_tab     WHERE     Snippet.keygen_code=:param1 ";
    $resultat = $cxn->prepare($sql);
    $resultat->bindParam(':param1', $keygen_code);
    $resultat->execute();
    $enregistrement = $resultat->fetch();
    $code_snipppet = $enregistrement ['code_fiddle'];
    $id_tab_code = $enregistrement ['tab_code'];
    if ($enregistrement ['id_plate_forme'] == '1') {
        // compte Jsfiddle
        //requette pour extraire Tabscode

           $Tabs = $enregistrement ['nom_tab'];

        /*         * ************************************** */

        $contenu = '<iframe width="100%" height="300" src="//jsfiddle.net/achachia/' . $code_snipppet . '/embedded/' . $Tabs . '/" allowfullscreen="allowfullscreen" frameborder="0"></iframe>';
    } else if ($enregistrement ['id_plate_forme'] == '2') {
        //compte Ideone
        $contenu = '<iframe src="https://ideone.com/embed/' . $code_snipppet . '" width="100%" height="600px" frameborder="0" style="border: 1px solid #c0c0c0; overflow-x: hidden;"></iframe>';
    } else if ($enregistrement ['id_plate_forme'] == '3') {
        //compte PHP fiddle
    } else if ($enregistrement ['id_plate_forme'] == '4') {
        //compte Pastbein
        
        // $contenu = '<iframe src="//pastebin.com/embed_iframe/RNTxNvcx" style="border:none;width:100%"></iframe>';
    }    
} catch (Exception $e) {
    echo "Une erreur est survenue lors de la récupération des données";
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



