<div class="row"  style="margin-top:5%">
    <div class="btn-group" role="group">
        <a href="<?= url_espace_formateur_prod; ?>/index.php?module=JAVA_SCRIPT&action=add_exo_js" target="_blank">
            <button type="button" class="btn btn-primary"	>
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                Ajouter un nouveau exercice
            </button>
        </a>
    </div>
</div>
<div class="row">
    <div class="col-md-12" style="margin-top:3%">
        <?php
        $j = 1;
        foreach ($list_exercices_java as $value) {
            ?>

            <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" href="#collapse_<?= $value['keygen_exo']; ?>"><?= $j . '. ' . $value['titre_exo']; ?></a>
                        </h4>
                    </div>
                    <div id="collapse_<?= $value['keygen_exo']; ?>" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-4 col-sm-6 col-xs-12"  style="margin-left:2%">
                                    <?= $value['contenu_exo']; ?>
                                </div>

                            </div>
                            <div class="row">
                                <img src="<?= $value['img_exo']; ?>"  style="width:600px"/>
                            </div>

                            <div class="row">                             
                                <div class="col-lg-offset-8 col-lg-5  col-sm-offset-4 col-sm-5">
                                     <a href="#"><button type="text" class="btn btn-success">La plate forme de travail : <?= $value['plate_forme']; ?></button></a>
                                    <a href="<?= url_espace_formateur; ?>/index.php?module=JAVA_SCRIPT&action=all_view_reponses_eleves&keygen_exo=<?= $value['keygen_exo']; ?>"><button type="text" class="btn btn-success">La liste des reponses des eleves  <span class="badge" style="font-size:18px"> <?= $value['nbr_reponses']; ?></span></button></a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <?php
            ++$j;
        }
        ?>
    </div> 
</div>

