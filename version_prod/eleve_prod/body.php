<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Espace Eleve-Cnam-PROD</h1>    
        </div>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-home"></i></a><span class="separator"></span></li>
            <li class="active"><?= $breadcrumb; ?></li>
        </ol>  


    </div>
    <?php if ($action != 'home') {  ?>

        <?php if (sizeof($liste_alertes_user_bordereau) > 0) { ?>
            <?php
            $j = 1;

            foreach ($liste_alertes_user_bordereau as $value) {
                ?>
                <div class="alert <?= $value['class_alerte']; ?>">
                    <strong class="default"><?= $value['class_icone']; ?> <?= $value['nom_alerte']; ?>,</strong><?= $value['description']; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                </div>                
                <?php
                ++$j;
            }
            ?>
        <?php } ?>
    <?php } ?>

    <?php echo $content_body; ?>
    <?php if ($_SESSION ['membre']['code_eleve'] == 'CE2') { ?>
        <!-------------- get alertes ------------------->
        <div class="modal fade" id="Modal_get_alertes" role="dialog">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                        <h4 class="modal-title"><i class="fa fa-unlock-alt" aria-hidden="true"></i> Méthodologie :</h4>
                    </div>
                    <div class="modal-body">                                            

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    </div>
                </div>

            </div>
        </div>
    <?php } ?>
</div>
<!-- /.container-fluid -->


<div class="footer">
    <div class="footer-left">
        <span>&copy; 2014-2016.Megacours. V.1.0.0</span>
    </div>
</div>
<!--footer-->

