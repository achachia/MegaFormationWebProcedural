<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="<?= url_espace_eleve; ?>/index.php">
        <img src="<?= url_media_global; ?>/images/logo_header.png" style="max-height: 45px; width: auto;" />
    </a>
</div>



<!-- /.navbar-header -->

<ul class="nav navbar-top-links navbar-right">

    <!-- /.dropdown Notifications -->




    <?php if ($_SESSION ['membre']['last_connection'] != '0000-00-00 00:00:00') { ?>
        <li class="dropdown">


            <a  href="#">
                <i class="fa fa-usb" aria-hidden="true"></i>
                <span class="badge">Derniére connection <span id="LabelAlertBadge"><?= $_SESSION ['membre']['last_connection']; ?></span></span>  
            </a>
        </li>
    <?php } ?>   


    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-user fa-fw"></i>
            <span id="user_name"><?= $_SESSION ['membre']['prenom']; ?></span>
            <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">       
            <li><a href="<?= url_espace_eleve; ?>/index.php?module=membre&action=mon_compte"><i class="fa fa-user fa-fw"></i> Mon compte</a>
            </li>                            
            <li class="divider"></li>
            <li>
                <a href="<?= url_espace_eleve_prod; ?>/deconnection.php"><i class="fa fa-sign-out fa-fw"></i> Se déconnecter</a>
            </li>
        </ul>
        <!-- /.dropdown-user -->
    </li>
    <!-- /.dropdown -->
</ul>
<!-- /.navbar-top-links -->

<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>                
                <div  style="padding-left:20%;margin-top:20px; ">
                    <img   style="border-radius:50%;max-width: 60%;height: auto;" src="<?= $_SESSION ['membre']['profil_img']; ?>" alt="profile">                           
                </div>
                <div    style="color:blue;padding-left:20%"><?= $_SESSION ['membre']['identite_eleve']; ?></div>   



            </li>
            <li class="active"><a href="<?= url_espace_eleve; ?>/index.php">Accueil</a></li>
            <li class=""><a href="#">HTML<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li ><a href="<?= url_espace_eleve; ?>/index.php?module=HTML&action=all_view_snippets">Snippet</a></li>

                </ul>
            </li>
            <li class=""><a href="#">CSS<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li ><a href="<?= url_espace_eleve; ?>/index.php?module=CSS&action=all_view_snippets">Snippet</a></li>

                </ul>
            </li>
            <li class=""><a href="#">JAVA SCRIPT<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li ><a href="<?= url_espace_eleve; ?>/index.php?module=JAVA_SCRIPT&action=all_view_snippets">Snippet</a></li>

                </ul>
            </li> 




        </ul>
    </div>

    <?php
    if ($action != 'home') {
        include './vues/side_bare_left.php';
    }
    ?>
</div>
<!-- /.navbar-static-side -->

