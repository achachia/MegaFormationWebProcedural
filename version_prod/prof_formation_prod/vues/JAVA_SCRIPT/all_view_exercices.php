<div class="row"  style="margin-top:5%">
    <div class="col-lg-12">     
        <ol class="breadcrumb"  style="color:blue;font-size: 20px">
            <li><a href="index.php"><i class="fa fa-home"></i></a><span class="separator"></span></li>
            <li><i class="fa fa-code" aria-hidden="true"></i><span class="separator"></span> JAVA SCRIPT</li>
            <li  style="color:#831098;"><i class="fa fa-list" aria-hidden="true"></i><span class="separator"></span> LISTE DES EXERCICES</li>
          
        </ol>      
    </div>    
</div>
<div class="row"  style="margin-top:5%">
    <div class="btn-group" role="group">
        <a href="<?= url_espace_formateur_prod; ?>/index.php?module=JAVA_SCRIPT&action=add_exo_js">
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
        foreach ($list_exercices_js as $value) {
            ?>

            <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" href="#collapse_<?= $value['keygen_exo']; ?>"><?= $j . '. ' . $value['titre_exo']; ?>&nbsp;&nbsp;<span id="nbr_reponses_exo_<?= $value['keygen_exo']; ?>"   class="badge" style="font-size:18px"> <?= $value['nbr_reponses']; ?></span> <?= $value['etat_depot_rep']; ?>&nbsp;&nbsp;<?= $value['etat_corrige_exo']; ?></a>
                        </h4>
                    </div>
                    <div id="collapse_<?= $value['keygen_exo']; ?>" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12"  style="margin-left:2%">
                                    <?= $value['contenu_exo']; ?>
                                </div>

                            </div>
                            <div class="row">
                                <img src="<?= $value['img_exo']; ?>"  style="width:600px"/>
                            </div>

                            <div class="row">
                                       <div class=" col-lg-6  col-sm-12">
                                    <a class="btn btn-success"  href="<?= url_espace_formateur; ?>/index.php?module=JAVA_SCRIPT&action=edit_fiche_exo&keygen_exo=<?= $value['keygen_exo']; ?>">

                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Modifier la fiche</a>
                                    <a class="btn btn-success" href="<?= url_espace_formateur; ?>/index.php?module=JAVA_SCRIPT&action=all_view_reponses_eleves&keygen_exo=<?= $value['keygen_exo']; ?>">
                                        <i class="fa fa-list-ol" aria-hidden="true"></i>  La liste des reponses postés</a>
                                    <button type="text" class="btn btn-info">
                                        <i class="fa fa-calendar" aria-hidden="true"></i> Date limite de depots : <?= $value['date_limite_depot']; ?></button>
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

