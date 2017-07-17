<?php include 'breadcrumb.php' ?>
<!------------------------------------------------------------------------------>
<div class = "row">
    <div class="col-lg-12"> 
        <div class="btn-group btn-group-justified btn-group-sm" role="group">
            <div class="btn-group" role="group">
                <a href="<?= url_espace_eleve; ?>/index.php?module=quiz&action=statistique_matiere_travail&mod_statistique=section"><button type="button" class="btn btn-info"><i class="fa fa-hand-o-down" aria-hidden="true"></i> PROGRESSION DE TRAVAIL PAR SECTION</button> </a>

            </div>
            <div class="btn-group" role="group">
                <a href="<?= url_espace_eleve; ?>/index.php?module=quiz&action=statistique_matiere_travail&mod_statistique=theme"><button type="button" class="btn btn-info"><i class="fa fa-hand-o-down" aria-hidden="true"></i> PROGRESSION DE TRAVAIL PAR THEME</button> </a>

            </div>      
         
        </div>
        <?php if ((!empty($mod_statistique)) && $mod_statistique=='section') { ?>
            <div id="progression_travail" class="panel-body">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <?= $title; ?>
                        </h3>    
                    </div>     
                    <div class="panel-body">

                        <div id="Main">
                            <?php foreach ($list_sujets as $value) { ?>

                                <a name="poll_bar"><?= $value['nom_sujet'] ?> </a> <span name="poll_val"><?= $value['taux_progression']; ?>% </span><br/>
                            <?php } ?>

                        </div>   

                    </div>  
                </div>
            </div>
        <?php } ?>
        <?php if ((!empty($mod_statistique)) && $mod_statistique=='theme') { ?>
                      <div id="progression_travail" class="panel-body">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <?= $title; ?>
                        </h3>    
                    </div>     
                    <div class="panel-body">

                        <div id="Main">
                            <?php foreach ($list_sujets as $key => $val) { ?>

                                <a name="poll_bar"><?= $key ?> </a> <span name="poll_val"><?= $val; ?>% </span><br/>
                            <?php } ?>

                        </div>   

                    </div>  
                </div>
            </div>
        <?php } ?>


    </div>

</div>  




