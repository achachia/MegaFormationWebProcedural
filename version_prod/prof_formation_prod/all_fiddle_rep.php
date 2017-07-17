<?php

session_start();
session_regenerate_id();
require_once './connection/config.php';
ini_set('date.timezone', 'Europe/Paris');
$etat = TRUE;
$objet = array();

$keygen_rep = $_POST['fiddleId'];

try {
    $sql = "   SELECT   Membre.code_jsfidlle,Exercices_themes.id_plate_forme,Corrige_exercices_eleves.code_fiddle,Corrige_exercices_eleves.version_code    FROM Corrige_exercices_eleves,Exercices_themes,Membre   "
            . "    WHERE   Corrige_exercices_eleves.keygen_exo=Exercices_themes.keygen_exo  "
            . "    AND  Corrige_exercices_eleves.code_eleve=Membre.code_user AND  Corrige_exercices_eleves.keygen_rep=:param1 ";
    $resultat = $cxn->prepare($sql);
    $resultat->bindParam(':param1', $keygen_rep);
    $resultat->execute();
    $enregistrement = $resultat->fetch();
    $code_snipppet = $enregistrement ['code_fiddle'];
    $version_code = $enregistrement ['version_code'];
    $identifiant_plate_forme = $enregistrement ['code_jsfidlle'];
    if ($enregistrement ['id_plate_forme'] == '1') {
        // compte Jsfiddle
        //requette pour extraire Tabscode

        $Tabs = $enregistrement ['nom_tab'];

        /*         * ************************************** */
        if($version_code!=''){
          $contenu = '<iframe width="100%" height="300" src="//jsfiddle.net/'.$identifiant_plate_forme.'/' . $code_snipppet . '/'.$version_code.'/embedded/' . $Tabs . '/" allowfullscreen="allowfullscreen" frameborder="0"></iframe>';  
        }else{
            $contenu = '<iframe width="100%" height="300" src="//jsfiddle.net/'.$identifiant_plate_forme.'/' . $code_snipppet . '/embedded/' . $Tabs . '/" allowfullscreen="allowfullscreen" frameborder="0"></iframe>';   
        }
        
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
/* * ******************* Mise a jour statut de code *********************** */
try {
    $sql = " SELECT   fk_statut_code    FROM Corrige_exercices_eleves  WHERE keygen_rep=:param1  ";

    $resultat = $cxn->prepare($sql);
    $resultat->bindParam(':param1', $keygen_rep);
    $resultat->execute();
    $enregistrement = $resultat->fetch();

    if ($enregistrement ['fk_statut_code'] == '1') {
        try {
            $sql = "   UPDATE  Corrige_exercices_eleves SET fk_statut_code='2'   WHERE keygen_rep=:param1  ";
            $resultat = $cxn->prepare($sql);
            $resultat->bindParam(':param1', $keygen_rep);
            $resultat->execute();
        } catch (Exception $e) {
            echo "Une erreur est survenue lors de la récupération des données";
        }
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




