<?php
require_once './connection/config.php';
$etat = FALSE;
$code_activation_mail = $_GET['code_activation_mail'];
try {
    $select = $cxn->query(" SELECT  id_membre   FROM  Membre  WHERE code_activation_mail='" . $code_activation_mail . "'    AND   emailactivated='0' ");
    $nb = $select->rowCount();
    if ($nb > 0) {

        $etat = TRUE;

        $sql = " UPDATE  Membre SET emailactivated='1'  WHERE  code_activation_mail='" . $code_activation_mail . "'  ";
        $select = $cxn->query($sql);
    }
} catch (Exception $e) {
    $numargs = func_num_args();
    debug_function(debug_backtrace(), $numargs, $e, $sql);
}

?>


<!DOCTYPE HTML>
<html>
    <head>
        <title>Activation compte [Eleves] </title>
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
                                <li><a href="#">STAGES ET FORMATIONS</a></li>
                                <li><a href="http://mega-cours.fr/formules_tarifs.html">FORMULES ET TARIFS</a></li>
                                <li class='active'><a href="http://mega-cours.fr/contact.html">NOUS CONTACTER</a></li>
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
                        <p  style="color:#3276B1;">
                            <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                            F&eacute;licitations, votre compte a &eacute;t&eacute; cr&eacute;e.

                            Votre inscription est maintenant termin&eacute;e.<br/><br/>
                            <a class="btn btn-primary btn-lg" href="<?= url_espace_eleve; ?>/login.php" role="button">CLIQUEZ ICI POUR IDENTIFIER</a>

                        </p> 
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




