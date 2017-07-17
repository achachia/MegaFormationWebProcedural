<?php
$dns='mysql:host=localhost;dbname=megacour_formation_web';
$user='megacour_megaweb';
$password='7130chachia';
// Constantes a definir .Chemins à utiliser pour accéder aux vues/controleur/fonctions
define ( 'root_web',getcwd());

/************** Url redirection de l'espace admin  { fichier traitement de login }   *************************/
define ( 'url_espace_formateur_prod', 'http://mega-cours.fr/projet_formation_web/version_prod/prof_formation_prod' );
define ( 'url_espace_formateur_dev', 'http://mega-cours.fr/projet_formation_web/version_dev/prof_formation_dev' );

/************** espace adminstrateur *************************/
define ( 'url_espace_formateur', 'http://mega-cours.fr/projet_formation_web/version_prod/prof_formation_prod' );


/******************************** Url Dossier  ************************/

define ( 'url_dossier_media', 'http://mega-cours.fr/media' );


/******************************** Root Dossier  ************************/

define ( 'root_dossier_controleurs', '/home/megacour/public_html/projet_formation_web/version_prod/prof_formation_prod/controleurs' );
define ( 'root_dossier_global', '/home/megacour/public_html/projet_formation_web/version_prod/prof_formation_prod/global' );
define ( 'root_dossier_modeles', '/home/megacour/public_html/projet_formation_web/version_prod/prof_formation_prod/modeles' );
define ( 'root_dossier_vues', '/home/megacour/public_html/projet_formation_web/version_prod/prof_formation_prod/vues' );
define ( 'root_dossier_librairie_local', '/home/megacour/public_html/projet_formation_web/version_prod/prof_formation_prod/librairie' ); 
define ( 'root_dossier_librairie', '/home/megacour/public_html/projet_formation_web/librairie' ); 
define ( 'root_templates_email','/home/megacour/public_html/projet_formation_web/version_prod/prof_formation_prod/templates_email' );
define ( 'root_dir_img_user', '/home/megacour/public_html/projet_formation_web/version_prod/prof_formation_prod/media_local/images/images_user' );
define ( 'root_dir_fichier_exercices', '/home/megacour/public_html/projet_formation_web/version_prod/telechargement/fiches_exercices' );


define ( 'initialisation', 'initialisation.php' );
define ( 'url_librairie_global', 'http://mega-cours.fr/librairie' ); 
define ( 'url_media_local', 'http://mega-cours.fr/projet_formation_web/version_prod/prof_formation_prod/media_local' );
define ( 'url_media_global', 'http://mega-cours.fr/media' ); 
define ( 'url_media_local_template','http://mega-cours.fr/projet_formation_web/version_prod/prof_formation_prod/media_local/images/template_email' );
define ( 'url_fiches_cours','http://mega-cours.fr/projet_formation_web/version_prod/telechargement/fiches_cours' );
define ( 'url_dir_img_eleves', 'http://mega-cours.fr/projet_formation_web/version_prod/eleve_prod/media_local/images/images_user' ); 
define ( 'url_dir_fichier_exercices', 'http://mega-cours.fr/projet_formation_web/version_prod/telechargement/fiches_exercices' );

//define ( 'url_librairie_global', 'http://mega-cours.fr/librairie' ); 
define ( 'url_dir_img_user', 'http://mega-cours.fr/projet_formation_web/version_prod/prof_formation_prod/media_local/images/images_user' ); 
define ( 'fa_warring', '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>' );


$item_per_page = 2;
$item_per_page_comments=4;
// Options de connection
$options = array (
		PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION 
);
try {
	$cxn = new PDO ( $dns, $user, $password, $options );
} catch ( Exception $e ) {
	 echo "Connection à Mysql imposible : " . $e->getMessage ();
	 die ();
}
?>