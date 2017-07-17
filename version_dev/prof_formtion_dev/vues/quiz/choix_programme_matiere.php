<?php include 'breadcrumb.php' ?>
<div class = "row">
    <div class="col-lg-12">
        <?php if (!empty($_GET['action_traitement']) && $_GET['action_traitement'] == 'select_choix_programme') { ?>
            <div class="alert alert-warning alert-white rounded">
                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
                <div class="icon">
                    <i class="fa fa-warning"></i>
                </div>
                <strong>Attention!</strong> 
                Vous devez choisir vos  thèmes de votre programme scolaire.
            </div>   

        <?php } ?>

        <?php if ($check_form) { ?>
            <?php if ($_GET['result'] == 'succees') { ?>

                <div class="alert alert-success alert-white rounded">
                    <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
                    <div class="icon">
                        <i class="fa fa-check"></i>
                    </div>
                    <strong>Félicitation! </strong> 
                    Votre choix de selections a été enregistré avec succées
                </div>
            <?php } ?>
            <?php if ($_GET['result'] == 'echec') { ?>
                <div class="alert alert-danger alert-white rounded">
                    <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
                    <div class="icon">
                        <i class="fa fa-times-circle"></i>
                    </div>
                    <strong>Désolé. </strong> 
                    <?= $_SESSION['form_choix_programme']['erreur']; ?>.
                </div>

            <?php } ?>
            <form action="<?= url_espace_eleve; ?>/controleurs/quiz/traitement_choix_programme.php" method="POST" name="form_choix_programme" id="form_choix_programme">

                <?php
                foreach ($list_section as $key => $value) {
                    $list_themes = list_themes($_SESSION ['membre']['id_niveau_eleve'], $value['id_section']);

                    if (sizeof($list_themes) != 0) {
                        ?>    
                        <div class="panel panel-default">
                            <!-- Default panel contents -->
                            <div class="panel-heading" style=" color:green;font-size:22px"><?php echo $value['nom_section']; ?></div>


                            <!-- List group -->
                            <ul class="list-group">
                                <?php
                                $tr = '';
                                $j = 1;
                                foreach ($list_themes as $value) {
                                    if (!$value['disabled_theme']) {
                                        $disabled = '';
                                        $style = 'style=" color:blue;font-size:22px"';
                                    } else {
                                        $disabled = 'DISABLED';
                                        $style = 'style=" color:red;font-size:22px"';
                                    }
                                    $tr.= ' <li class="list-group-item"  ' . $style . '> 
                                                       ' . $j . '. ' . $value['nom_theme'] . '
                                                  
                                                    <div class="material-switch pull-right">
                                                       <input id="choix_programme_matiere_' . $value['random_theme'] . '" name="choix_programme_matiere[]" type="checkbox"  value="' . $value['random_theme'] . '"   ' . $disabled . '/>
                                                       <label for="choix_programme_matiere_' . $value['random_theme'] . '" class="label-primary"></label>
                                                   </div>
                                                </li>';
                                    $j++;
                                } echo $tr;
                                ?>                                       
                            </ul>

                        </div> 

                        <?php
                    }
                }
                ?>  
                <input type="hidden" name="code_matiere" id="code_matiere"  value="<?= $code_matiere; ?>" >
                <input id="bouton_submit" class="btn btn-success btn-lg btn-block" type="submit" value="VALIDER VOS CHOIX >>" name="envoyer">
            </form>
        </div>
    <?php } else { ?>
        <div class="alert alert-danger alert-white rounded">
            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
            <div class="icon">
                <i class="fa fa-times-circle"></i>
            </div>
            <strong>Désolé. </strong> 
            Aucun programme trouvé.
        </div>
    <?php } ?>
</div>    

