<?php

require_once './connection/config.php';
ini_set('date.timezone', 'Europe/Paris');
$etat = TRUE;
$objet = array();

$keygen_code = $_POST['fiddleId'];

try {
    $sql = " SELECT  Snippet.code_fiddle,Tabs_code.nom_tab  FROM  Snippet,Tabs_code     WHERE  Snippet.tab_code=Tabs_code.id_tab  AND    Snippet.keygen_code=:param1 ";
    $resultat = $cxn->prepare($sql);
    $resultat->bindParam(':param1', $keygen_code);
    $resultat->execute();
    $enregistrement = $resultat->fetch();
    $code_snipppet = $enregistrement ['code_fiddle'];
    $Tabs = $enregistrement ['nom_tab'];
} catch (Exception $e) {
    echo "Une erreur est survenue lors de la récupération des données";
}

/* * ********************************* */

//$wikipediaURL = 'http://www.google.fr';
//$ch = curl_init();
//curl_setopt($ch, CURLOPT_URL, $wikipediaURL);
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($ch, CURLOPT_USERAGENT, 'Le blog de Samy Dindane (www.dinduks.com)');
//$contenu = curl_exec($ch);
//curl_close($ch);




/* * ********************************** */


$contenu = '<iframe width="100%" height="300" src="//jsfiddle.net/achachia/' . $code_snipppet . '/embedded/' . $Tabs . '/" allowfullscreen="allowfullscreen" frameborder="0"></iframe>';
// $contenu = '<iframe src="//pastebin.com/embed_iframe/RNTxNvcx" style="border:none;width:100%"></iframe>';







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

