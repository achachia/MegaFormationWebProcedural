<?php include 'breadcrumb.php' ?>
<div class="col-lg-12" style="padding-top: 40px">
    <div class="row">
        <div class="ribbon">
            <div class="ribbon-stitches-top"></div>
            <strong class="ribbon-content"><h1><?= $_SESSION['quiz']['parametres']['titre_quiz']; ?></h1></strong>
            <div class="ribbon-stitches-bottom"></div>

        </div>

    </div>
    <br><br>
    <div style="height:50px"></div>
    <div class="col-lg-12" id="arrondi1">

        <form action="<?= url_espace_eleve; ?>/controleurs/quiz/traitement_quiz.php" method="POST" name="form_quiz" id="form_quiz">



            <!--------- Barre de progression ---------------------->
            <div style="font-weight : bold;">Progression travail effectué :</div>
            <div class="progress">
                <div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar"    aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:<?= $_SESSION['quiz']['progression_travail'] ?>%">
                    <?= $_SESSION['quiz']['progression_travail'] ?>% Effectué
                </div>
            </div>
            <div style="font-weight : bold;">Progression réussite :</div>
            <div class="progress">

                <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar"    aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:<?= $_SESSION['quiz']['progression_reussite'] ?>%">
                    <?= $_SESSION['quiz']['progression_reussite'] ?>% Réussi
                </div>
            </div>

            <!--------- Barre de progression ---------------------->

            <div class="row">
                <div class="col-lg-offset-1 col-lg-4  col-sm-offset-1 col-sm-4 col-xs-12" style="padding-top:2% ">
                    <button type="button" class="btn btn-success btn-md">
                        <i class="fa fa-check-square-o" aria-hidden="true"></i> <?= $_SESSION['quiz']['parametres']['texte_quiz']; ?> 

                    </button>
                </div>
                <div class="col-lg-offset-2 col-lg-3  col-sm-offset-2 col-sm-4 col-xs-12"  style="padding-top:2% ">
                    <button class="btn btn-primary" type="button">
                        Question N° <span class="badge"><?= $_SESSION['quiz'] ['compteur']; ?> /<?= $_SESSION['quiz']['parametres']['nbre_question']; ?></span>
                    </button>
                </div>

            </div>
            <?php if (isset($_GET['code_erreur'])) { ?>
                <br><br>
                <div class="alert alert-warning alert-white rounded">
                    <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
                    <div class="icon">
                        <i class="fa fa-warning"></i>
                    </div>
                    <strong>Attention!</strong> 
                    Vous dever choisir au moins une réponse.
                </div> 
                <!--                <br><br>
                                    <div class="alert alert-danger" role="alert">
                                        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                        Vous dever choisir au moins une réponse.</div>-->
            <?php } ?>


            <hr><br><br>
            <!----------------------- question ---------------------------->
            <div id="arrondi"  style="background-color:rgb(255,255,255)">
                <div class="row">
                    <div class="col-lg-12" style="margin-left:10%;">
                        <?= $quiz ['question']['data']; ?>
                    </div>
                </div>
                <?php if ($quiz ['question']['source_img'] != '') { ?>
                    <div class="row">
                        <div class="col-lg-12" style="margin-left:10%;">
                            <?= $quiz ['question']['source_img']; ?>
                        </div>
                    </div>
                <?php } ?>

            </div>
            <div style="height:50px"></div>
            <!----------------------- Liste des reponses ---------------------------->
            <?php
            $tr = '';
            $i = 0;
            $j = 1;
            foreach ($quiz['reponses'] as $value) {
                $tr.='<div class="funkyradio">
                                <div class="funkyradio-success">
                                    <input type="' . $_SESSION['quiz']['parametres']['type_quiz'] . '"  name="' . $_SESSION['quiz']['parametres']['name_quiz'] . '" id="checkbox' . $j . '"  value="' . $quiz['reponses'][$i]['id_reponse'] . '"   />
                                    <label for="checkbox' . $j . '">'
                        . $quiz['reponses'][$i]['data'] . '
                                    </label>
                                </div>

                           </div>
                           <div style="height:45px"></div>';
                $i++;
                $j++;
            }
            echo $tr;
            ?>

            <hr>
            <!----------------------- Bouton submit---------------------------->
            <table style="width:100%">
                <?php if ($quiz['question']['formule'] != '') { ?>
                    <tr>
                        <td style="width:25%;text-align: right">
                            <button type="button" class="btn btn-info"  data-toggle="modal" data-target="#myModal-1">
                                FORMULES <i class="fa fa-hand-o-left" aria-hidden="true"></i>
                            </button>
                        </td>
                        <td>
                            <div class="modal fade" id="myModal-1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">FORMULES</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div id="arrondi">
                                                <a href="http://www.codecogs.com/eqnedit.php?latex=<?= $quiz['question']['latex']; ?>" target="_blank"><img  src="http://latex.codecogs.com/gif.latex?<?= $quiz['question']['formule']; ?>" title="formule" style="margin-left: 40px"/></a>

                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">FERMER</button>                                                       
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    <?php } ?>
                    <?php if ($quiz['question']['astuce_data'] != '') { ?>
                        <td style="width:25%;text-align: center">
                            <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#myModal-2">
                                METHODOLOGIE <i class="fa fa-flag-o" aria-hidden="true"></i>
                            </button>
                        </td>
                        <td>
                            <div class="modal fade" id="myModal-2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">METHODOLOGIE</h4>

                                        </div>
                                        <div class="modal-body">
                                            <div id="arrondi"  style="padding-left:5%">
                                                <?= $quiz['question']['astuce_data']; ?>

                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">FERMER</button>                                                       
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    <?php } ?>
                    <td style="width:50%;">
                         <input id="bouton_submit" class="btn btn-success  btn-block" type="submit" value="VALIDER VOTRE REPONSE >>" name="envoyer">

                    </td>
                </tr>
            </table>
            <br><br>


        </form>



        <!--            </div>
                </div>-->


    </div>


</div>