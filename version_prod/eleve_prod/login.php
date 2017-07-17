<?php require_once './connection/config.php'; ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
        <meta content="IE=edge" http-equiv="X-UA-Compatible" />
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <title>MEGACOURS Espace Eleve</title>
        <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" href="http://mega-cours.fr/media/css/bootstrap.css" media="screen">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
            <![endif]-->
        <!-- jQuery Version 1.11.0 -->
        <script src="http://mega-cours.fr/media/js/jquery.js"></script>
        <script src="http://mega-cours.fr/media/js/bootstrap.min.js"></script>
        <style>

            body {
                background: #2E95EF;
                background-image: -moz-radial-gradient(center 45deg,circle cover, #9BD1FF, #2E95EF);
                background-image: -webkit-gradient(radial, 50% 50%, 0, 50% 50%,800, from(#9BD1FF), to(#2E95EF));
                padding-top: 15%;
            }

            .img-home {
                padding-top: 16%;

            }

            /*            .img-content{
                            margin-right:40px;
                        }*/

            .title {
                color: #fff;
                text-shadow: 1px 1px 0 #888;
                line-height: normal;
                font-weight: 1em;
                font-family: serif;          
                margin-bottom: 10px;
                font-weight:bold;
            }

            .colorgraph {
                height: 5px;
                border-top: 0;
                background: #c4e17f;
                border-radius: 5px;
                background-image: -webkit-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
                background-image: -moz-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
                background-image: -o-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
                background-image: linear-gradient(to right, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
            }

        </style>
    </head>
    <body>


        <div class="row">

            <div class="col-lg-offset-2 col-lg-3"  style="padding-top:3%">
                <img class="img-responsive" src="http://mega-cours.fr/media/images/img_formation.jpg"  style="width:80%">
            </div>
            <div class="col-lg-5">
                <!--------------------------------------------------------->
                <div id="loginbox"  class="mainbox"> 
                    <h3 class="hidden-sm hidden-md hidden-lg  title">Espace connection élève.</h3>  
                    <h1 class="hidden-xs title">Espace connection élève.</h1>

                    <?php if (isset($_GET['message_deconnection'])) { ?>
                        <div class="row">
                            <div class="alert alert-success" role="alert" style="text-align:center">
                                <a href="#" class="alert-link"  >Déconnection effectuée avec  succés.</a>
                            </div>
                        </div> 
                    <?php } ?>  
                    <?php if (isset($_GET['message_inactivite_session'])) { ?>
                        <div class="row"><br/>
                            <div class="alert alert-success" role="alert" style="text-align:center">
                                Votre session a expiré suite à une inactivité<br/>.

                                L'ensemble des données saisies a malheureusement été perdu.<br/>. 
                                Merci de bien vouloir vous reconnecter 
                            </div>
                        </div> 
                    <?php } ?> 
                    <div class="panel panel-info">

                        <div class="panel-heading"  >                                
                            <img src="http://mega-cours.fr/media/images/img_login.png"  class="img-responsive" alt="espace eleve"  style="margin-left:37%  " />

                        </div>



                        <div style="padding-top:5px" class="panel-body" >
                            <?php if (isset($_GET['message_erreur'])) { ?>
                                <div  id="login-alert" class="alert alert-danger col-sm-12"><span> <strong>Valeur incorrecte d'identifiant ou/et de mot de passe.</strong></span></div>
                            <?php } ?>          

                            <form name="identification" id="identification"  class="form-signin" method="POST"  role="form"	action="<?= url_espace_eleve ?>/traitement_login_eleve.php">

                                <div style="margin-bottom: 25px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input id="email" type="text" class="form-control" name="email" value="" placeholder="Votre adresse email" required autofocus>                                        
                                </div>

                                <div style="margin-bottom: 25px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input id="password" type="password" class="form-control" name="password" required  placeholder="Votre mot de passe">
                                </div>

                                <hr class="colorgraph">
                                <div class="row">                              
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <input type="submit" class="btn btn-lg btn-success btn-block"   name="identification" id="identification"   value="Identification">
                                    </div>

                                </div>                        

                            </form>
                        </div>  
                    </div>
                    <h4 class="hidden-sm hidden-md hidden-lg  title">Copyright &copy; MEGACOURS 2014-2016.</h4>  
                    <h3 class="hidden-xs title">Copyright &copy; MEGACOURS 2014-2016.</h3>

                </div>
            </div>
        </div> 


    </body>
</html>

