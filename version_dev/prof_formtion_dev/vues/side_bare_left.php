
<div class="col-lg-12" style="margin-top: 20%">
    <div class="row">

        <div class="panel panel-primary">
            <div class="panel-heading">PROGRESSION GENERALE</div>
            <div class="panel-body">
                <h3 class="heading-xs">Progression travail effectué <span class="pull-right"><?= $_SESSION['progression_generale_travail']['taux']; ?>%</span></h3>
                <div class="progress progress-u progress-xxs">
                    <div style="width: <?= $_SESSION['progression_generale_travail']['taux']; ?>%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="<?= $_SESSION['progression_generale_travail']['taux']; ?>" role="progressbar" class="<?= $_SESSION['progression_generale_travail']['class']; ?>">
                    </div>
                </div>
                <h3 class="heading-xs">Progression réussite<span class="pull-right"><?= $_SESSION['progression_generale_reussite']['taux']; ?>%</span></h3>
                <div class="progress progress-u progress-xxs">
                    <div style="width: <?= $_SESSION['progression_generale_reussite']['taux']; ?>%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="<?= $_SESSION['progression_generale_reussite']['taux']; ?>" role="progressbar" class="<?= $_SESSION['progression_generale_reussite']['class']; ?>">
                    </div>
                </div>

            </div>
        </div>

    </div>
    <?php if ($action != 'mon_compte' && $action != 'messagerie') { ?>
        <div class="row">


            <div class="panel panel-primary">
                <div class="panel-heading">PROGRESSION  [<?= $nom_matiere; ?>]</div>
                <div class="panel-body">
                    <h3 class="heading-xs">Progression travail effectué <span class="pull-right"><?= $_SESSION['progression_matiere_travail']['taux']; ?>%</span></h3>
                    <div class="progress progress-u progress-xxs">
                        <div style="width: <?= $_SESSION['progression_matiere_travail']['taux']; ?>%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="<?= $_SESSION['progression_matiere_travail']['taux']; ?>" role="progressbar" class="<?= $_SESSION['progression_matiere_travail']['class']; ?>">
                        </div>
                    </div>
                    <h3 class="heading-xs">Progression réussite<span class="pull-right"><?= $_SESSION['progression_matiere_reussite']['taux']; ?>%</span></h3>
                    <div class="progress progress-u progress-xxs">
                        <div style="width: <?= $_SESSION['progression_matiere_reussite']['taux']; ?>%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="<?= $_SESSION['progression_matiere_reussite']['taux']; ?>" role="progressbar" class="<?= $_SESSION['progression_matiere_reussite']['class']; ?>">
                        </div>
                    </div>


                </div>
            </div>
        </div>
    <?php } ?>

    <div class="row">


        <div class="panel panel-primary">
            <div class="panel-heading">SUIVEZ NOTRE ACTUALITE</div>
            <div class="panel-body">
                <a href="https://www.facebook.com/abdel.maths" class="social-icon-lg si-border si-border-round si-facebook"  target="_blank">
                    <i class="fa fa-facebook"></i>
                    <i class="fa fa-facebook"></i>
                </a>
                <a class="social-icon-lg si-border si-twitter si-border-round" href="https://twitter.com/abdel_matheux" target="_blank">
                    <i class="fa fa-twitter"></i>
                    <i class="fa fa-twitter"></i>
                </a>

                <a class="social-icon-lg si-border si-g-plus si-border-round" href="https://plus.google.com/117253900389607721341" target="_blank">
                    <i class="fa fa-google-plus"></i>
                    <i class="fa fa-google-plus"></i>
                </a>
                <a class="social-icon-lg si-border si-tumblr si-border-round" href="http://megacours.tumblr.com" target="_blank">
                    <i class="fa fa-tumblr"></i>
                    <i class="fa fa-tumblr"></i>
                </a>
                <a class="social-icon-lg si-border si-g-plus si-border-round" href="https://www.youtube.com/channel/UCjNt0O1upHD8mlijbyFHGeQ" target="_blank">
                    <i class="fa fa-youtube"></i>
                    <i class="fa fa-youtube"></i>
                </a>
            </div>
        </div>
    </div>


</div>
<?php if ($action == 'list_themes_quiz' || $action == 'list_quiz_theme' || $action == 'quiz' || $action == 'exec_quiz' || $action == 'result_quiz') { ?>
    <div class="col-lg-1"></div>
<?php } ?>




