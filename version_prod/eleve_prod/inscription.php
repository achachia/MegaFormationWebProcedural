<?php
session_start();
session_regenerate_id();
require_once './connection/config.php';
require_once './librairie/fonctions_local.php';
require root_dossier_modeles . "/membre/mon_compte.php";
ini_set('date.timezone', 'Europe/Paris');
if (!empty($_GET['code_adhesion_mail'])) {
    $code_adhesion_mail = $_GET['code_adhesion_mail'];
}
if (empty($_GET['code_adhesion_mail']) && !empty($_SESSION ['traitement_form_compte']['code_adhesion_mail'])) {
    $code_adhesion_mail = $_SESSION ['traitement_form_compte']['code_adhesion_mail'];
}

$check_code_adhesion = check_code_adhesion($code_adhesion_mail);
$check_code_adhesion = FALSE; // pour tester le code 

if (!$check_code_adhesion) {
    $liste_sex = liste_sex();
    $liste_niveaux = liste_niveaux();


    if (!empty($_GET['code_adhesion_mail']) && !empty($_GET['code_affiliation'])) {
        if (isset($_SESSION ['traitement_form_compte'])) {
            unset($_SESSION ['traitement_form_compte']);
        }
    }
    if (isset($_GET['code_affiliation']) && !empty($_GET['code_affiliation'])) {

        $_SESSION ['traitement_form_compte']['code_affiliation'] = $_GET['code_affiliation'];
    }
    if (isset($_GET['code_adhesion_mail']) && !empty($_GET['code_adhesion_mail'])) {

        $_SESSION ['traitement_form_compte']['code_adhesion_mail'] = $_GET['code_adhesion_mail'];
    }
    if (isset($_SESSION ['traitement_form_compte']['result']) && $_SESSION ['traitement_form_compte']['result'] == 'echec') {
        $infos_user = unserialize($_SESSION ['traitement_form_compte']['tableau_serialise']);
        $list_erreur = $_SESSION ['traitement_form_compte']['list_erreur'];
    }

    /*     * **************************************** */

    $search = array('é', 'è', 'É', 'È', 'ô');
    $replace = array('&eacute;', '&egrave;', '&Eacute;', '&Egrave;', '&acute;', '&ocirc;');
}
var_dump($_SESSION ['traitement_form_compte']['list_erreur']);
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Formulaire inscription [Eleves] </title>
        <link href="http://mega-cours.fr/media/css/bootstrap.css" rel='stylesheet' type='text/css' />
        <link href="<?= url_espace_eleve; ?>/media_local/css/css_megaquiz.css" rel='stylesheet' type='text/css' /> 
        <meta name="viewport" content="width=device-width, initial-scale=1">      
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.web/js/1.4.2/respond.min.js"></script>
       <![endif]-->
        <link href="http://mega-cours.fr/media/css/style.css" rel="stylesheet" type="text/css" media="all" />
        <link href="http://mega-cours.fr/media/fontawesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <!-- start plugins -->
        <script type="text/javascript" src="http://mega-cours.fr/media/js/jquery.min.js"></script>
        <script type="text/javascript" src="http://mega-cours.fr/media/js/bootstrap.js"></script>  
        <script type="text/javascript" src="http://mega-cours.fr/media/js/modernizr.custom.28468.js"></script> 
        <!--********************* chosen ***********************-->
        <link href="<?= url_media_global; ?>/plugin_js/chosen/chosen.css" rel="stylesheet">
        <script type="text/javascript" src="<?= url_media_global; ?>/plugin_js/chosen/chosen.jquery.js"></script>
        <script src='<?= url_librairie_global; ?>/tinymce/tinymce.min.js'></script>

        <!-- Flat picker -->
        <link  href="<?= url_media_global; ?>/plugin_js/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />
        <script src="<?= url_media_global; ?>/plugin_js/flatpickr/flatpickr.min.js" type="text/javascript"></script>
        <script>
            tinymce.init({
                selector: '#liste_langage,#contenu_projet_pro,#contenu_attente,#contenu_formation',
                language: 'fr_FR',
                height: 300,
                theme: 'modern',
                plugins: [
                    'advlist autolink lists  charmap  preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table contextmenu paste code'
                ],
                toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent ',
                content_css: [
                    '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
                    '//www.tinymce.com/css/codepen.min.css'
                ]

            });</script>

        <script type="text/javascript">
            $(document).ready(function () {

                jQuery("#id_niv_peda_user").chosen();
                $(".flatpickr").flatpickr();
            });
        </script>   
    </head>
    <body>
        <div class="header_bg1">
            <div class="container">
                <div class="row header">
                    <div class="logo navbar-left" style="margin-top:-40px;margin-bottom: -35px">
                        <h1><a href="http://mega-cours.fr/index.html"><img src="http://mega-cours.fr/media/images/logo.png"  style="width:120px;height:120px" alt=""/></a></h1>
                    </div>

                    <div class="clearfix"></div>
                </div>
                <div class="row h_menu" style="width:1260px">
                    <nav class="navbar navbar-default navbar-left" role="navigation">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li ><a href="http://mega-cours.fr/index.html">Accueil</a></li>
                                <li><a href="http://mega-cours.fr/cours_particulier.html">COURS PARTICULIERS</a></li>
                                <li><a href="http://mega-cours.fr/cours_collectifs.html">COURS COLLECTIFS</a></li>
                                <li   class='active'><a href="#">STAGES ET FORMATIONS</a></li>
                                <li><a href="http://mega-cours.fr/formules_tarifs.html">FORMULES ET TARIFS</a></li>
                                <li><a href="http://mega-cours.fr/contact.html">NOUS CONTACTER</a></li>
                            </ul>
                        </div><!-- /.navbar-collapse -->
                        <!-- start soc_icons -->
                    </nav>

                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="main_btm"><!-- start main_btm -->
            <div class="container">
                <div class="main row">

                    <div class="col-md-12">

                        <div class="contact-form">

                            <h2 style="color:#82358B;font-weight: bold"><u>FORMULAIRE D'INSCRIPTION : [ ESPACE ELEVE ]</u></h2>
                            <?php if ( $_SESSION ['traitement_form_compte']['result'] == 'echec') { ?>
                                <div class="alert alert-danger alert-white rounded">
                                    <button type="button" data-dismiss="alert" aria-hidden="true" class="close"><i class="fa fa-times" aria-hidden="true"></i></button>
                                    <div class="icon">
                                        <i class="fa fa-times-circle"></i>
                                    </div>
                                    <strong>D&eacute;sol&eacute;. </strong> 
                                    Il y'a des erreurs dans la saisie de formmulaire.
                                </div>

                            <?php } ?>
                            <?php if ( $_SESSION ['traitement_form_compte']['result'] == 'succees') { ?>


                                <div class="alert alert-success alert-white rounded">
                                    <button type="button" data-dismiss="alert" aria-hidden="true" class="close"><i class="fa fa-times" aria-hidden="true"></i></button>
                                    <div class="icon">
                                        <i class="fa fa-check"></i>
                                    </div>
                                    <strong>Félicitation! </strong> 
                                    L'enregistrement a &eacute;t&eacute; effectue par succ&egrave;s.vous recevez un mail d'activation.
                                </div>


                            <?php } ?>
                            <?php if (!$check_code_adhesion) { ?>
                                <form class="form-horizontal"     action="<?= url_espace_eleve; ?>/traitement_add_user.php" method="POST" name="add_user" id="add_user">
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="textinput">Nom</label>
                                            <div class="col-md-8">
                                                <input id="nom_user" name="nom_user" type="text"  class="form-control input-md"  value="<?= $infos_user['nom_user']; ?>">
                                                <span  style="font-size:12px;color:#FF5454 "><strong><?= $list_erreur['nom_user']; ?></strong></span>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="textinput">Pr&eacute;nom</label>  
                                            <div class="col-md-8">
                                                <input id="prenom_user" name="prenom_user" type="text"  class="form-control input-md"  value="<?= $infos_user['prenom_user']; ?>">
                                                <span  style="font-size:12px;color:#FF5454 "><strong><?= $list_erreur['prenom_user']; ?></strong></span>


                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="textinput">Pseudo</label>  
                                            <div class="col-md-8">
                                                <input id="pseudo" name="pseudo" type="text"  class="form-control input-md"  value="<?= $infos_user['pseudo']; ?>">
                                                <span  style="font-size:12px;color:#FF5454 "><strong><?= $list_erreur['pseudo']; ?></strong></span>


                                            </div>
                                        </div>                             


                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="textinput">Date de naissance</label>  
                                            <div class="col-md-8">
                                                <input id="date_naissance" name="date_naissance" type="text"  class="flatpickr form-control input-md"   value="<?= $infos_user['date_naissance']; ?>">
                                                <span  style="font-size:12px;color:#FF5454 "><strong><?= $list_erreur['date_naissance']; ?></strong></span>

                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="selectsex">Sex</label>
                                            <div class="col-md-8">
                                                <select id="id_sex_user" name="id_sex_user" class="form-control">
                                                    <option value="">Choisir votre sex</option>
                                                    <?php foreach ($liste_sex as $value) { ?>

                                                        <option value="<?= $value['id_sex']; ?>"  <?php
                                                        if ($value['id_sex'] == $infos_user['id_sex_user']) {
                                                            echo 'selected';
                                                        }
                                                        ?> > <?= $value['type_sex']; ?> </option>

                                                    <?php } ?>

                                                </select>
                                                <span  style="font-size:12px;color:#FF5454 "><strong><?= $list_erreur['select_sex']; ?></strong></span>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="textinput">Email</label>  
                                            <div class="col-md-8">
                                                <input id="email" name="email" type="text"  class="form-control input-md"  value="<?= $infos_user['email']; ?>">
                                                <span  style="font-size:12px;color:#FF5454 "><strong><?= $list_erreur['email']; ?></strong></span>

                                            </div>
                                        </div>                                                                                                          
                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="textinput">Mot de passe</label>  
                                            <div class="col-md-8">
                                                <input id="password" name="password" type="password"  class="form-control input-md">
                                                <span  style="font-size:12px;color:#FF5454 "><strong><?= $list_erreur['password']; ?></strong></span>

                                            </div>
                                        </div>



                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="selectniveau">Niveau p&eacute;dagogique</label>
                                            <div class="col-md-8">
                                                <select id="id_niv_peda_user" name="id_niv_peda_user" class="form-control">
                                                    <option value="">Choisir votre niveau scolaire</option>
                                                    <?php foreach ($liste_niveaux as $value) { ?>
                                                        <optgroup label="<?= str_replace($search, $replace, $value['nom_groupe']); ?>">
                                                            <?php foreach ($value['liste_niveaux'] as $value1) { ?>
                                                                <option value="<?= $value1['id_niveau']; ?>"  <?php
                                                                if ($value1['id_niveau'] == $infos_user['id_niv_peda_user']) {
                                                                    echo 'selected';
                                                                }
                                                                ?> ><?= str_replace($search, $replace, $value1['nom_niveau']); ?></option>
                                                                    <?php } ?>
                                                        </optgroup>
                                                    <?php } ?>                                     

                                                </select>
                                                <span  style="font-size:12px;color:#FF5454 "><strong><?= $list_erreur['select_niveau']; ?></strong></span>

                                            </div>
                                        </div>
                                        <!---------------------------------------------------------------------->
                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="question1">Avez vous un projet professionnel lié au domaine de web?</label>
                                            <div class="col-md-8">
                                                <select id="quest1_projet" name="quest1_projet" class="form-control">
                                                    <option value="">Choisir votre réponse</option>                                                

                                                    <option value="1"  <?php
                                                    if ($infos_user['quest1_projet'] == '1') {
                                                        echo 'selected';
                                                    }
                                                    ?> >OUI</option>
                                                    <option value="0" <?php
                                                    if ($infos_user['quest1_projet'] == '0') {
                                                        echo 'selected';
                                                    }
                                                    ?> >NON</option>

                                                </select>
                                                <span  style="font-size:12px;color:#FF5454 "><strong><?= $list_erreur['quest1_projet'] ?></strong></span>                                            

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  col-sm-7 col-lg-2 text-left "  for="contenu_projet">Si oui, precisez votre projet professionnel :</label>
                                            <div class="col-md-8 col-sm-12">
                                                <textarea class="form-control" rows="8" cols="100" id="contenu_projet_pro" name="contenu_projet_pro" placeholder="Precisez votre projet professionnel"><?= $infos_user['contenu_projet_pro']; ?></textarea>
                                                <span  style="font-size:12px;color:#FF5454 "><strong><?= $list_erreur['contenu_projet_pro'] ?></strong></span>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="question2">Avez vous déja programmé ?</label>
                                            <div class="col-md-8">
                                                <select id="quest2_dev" name="quest2_dev" class="form-control">
                                                    <option value="">Choisir votre réponse</option>                                                

                                                    <option value="1"  <?php
                                                    if ($infos_user['quest2_dev'] == '1') {
                                                        echo 'selected';
                                                    }
                                                    ?> >OUI</option>
                                                    <option value="0" <?php
                                                    if ($infos_user['quest2_dev'] == '0') {
                                                        echo 'selected';
                                                    }
                                                    ?> >NON</option>

                                                </select>
                                                <span  style="font-size:12px;color:#FF5454 "><strong><?= $list_erreur['quest2_dev'] ?></strong></span>                                               

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  col-sm-7 col-lg-2 text-left "  for="contenu">Si oui, precisez les langages de programmation que vous déja utilisé :</label>
                                            <div class="col-md-8 col-sm-12">
                                                <textarea class="form-control" rows="8" cols="100" id="liste_langage" name="liste_langage" placeholder="La listes des langages de programmation"><?= $infos_user['liste_langage']; ?></textarea>
                                                <span  style="font-size:12px;color:#FF5454 "><strong><?= $list_erreur['liste_langage'] ?></strong></span> 

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label  col-sm-7 col-lg-2 text-left "  for="contenu_projet">Quelles sont vos attentes par rapport cette formation ?</label>
                                            <div class="col-md-8 col-sm-12">
                                                <textarea class="form-control" rows="8" cols="100" id="contenu_attente" name="contenu_attente" ><?= $infos_user['contenu_attente']; ?></textarea>                                             
                                                <span  style="font-size:12px;color:#FF5454 "><strong><?= $list_erreur['contenu_attente'] ?></strong></span> 

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="question4">Avez vous déja eu des formations dans le domaine du web ?</label>
                                            <div class="col-md-8">
                                                <select id="quest4_formation" name="quest4_formation" class="form-control">
                                                    <option value="">Choisir votre réponse</option>                                                

                                                    <option value="1"  <?php
                                                    if ($infos_user['quest4_formation'] == '1') {
                                                        echo 'selected';
                                                    }
                                                    ?> >OUI</option>
                                                    <option value="0" <?php
                                                    if ($infos_user['quest4_formation'] == '0') {
                                                        echo 'selected';
                                                    }
                                                    ?> >NON</option>

                                                </select>
                                                <span  style="font-size:12px;color:#FF5454 "><strong><?= $list_erreur['quest4_formation']; ?></strong></span>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  col-sm-7 col-lg-2 text-left "  for="contenu">Si oui, precisez le contenu de la formation en quelques lignes :</label>
                                            <div class="col-md-8 col-sm-12">
                                                <textarea class="form-control" rows="8" cols="100" id="contenu_formation" name="contenu_formation" ><?= $infos_user['contenu_formation']; ?></textarea>
                                                  <span  style="font-size:12px;color:#FF5454 "><strong><?= $list_erreur['contenu_formation']; ?></strong></span>                                            

                                            </div>
                                        </div>

                                        <!---------------------------------------------------------------------->

                                        <!-- Button -->
                                        <div class="form-group">

                                            <div class="col-md-offset-3  col-md-9">
                                                <button type="submit" id="singlebutton" name="singlebutton" class="col-md-8 btn btn-primary">VALIDER</button>
                                            </div>
                                        </div>


                                        </div>
                                    </fieldset>
                                </form>  
                            <?php } ?>
                            <?php if ($check_code_adhesion && !empty($_GET['code_adhesion_mail'])) { ?>

                                <p class="link">Le jeton d'invitation a &eacute;t&eacute; expir&eacute;.</p>


                            <?php } ?>



                        </div>

                    </div>		
                    <div class="clearfix"></div>		
                </div> 
            </div>
        </div>
        <div class="footer_bg"><!-- start footer -->
            <div class="container">
                <div class="row  footer">
                    <div class="copy text-center">
                        <p class="link"><span>Copyright &copy; MEG@COURS 2014-2016</span></p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

