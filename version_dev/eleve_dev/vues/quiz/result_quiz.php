<?php include 'breadcrumb.php' ?>
<div class="row">
    <div class="col-lg-12" style="padding-top: 40px">
        <div class="ribbon">
            <div class="ribbon-stitches-top"></div>
            <strong class="ribbon-content"><h1><?= $_SESSION['quiz']['parametres']['titre_quiz']; ?></h1></strong>
            <div class="ribbon-stitches-bottom"></div>

        </div>
    </div> 
</div>
<div class="row">
    <div class="col-lg-12" style="padding-top: 40px">

        <div class="col-lg-8" style="padding-top: 40px">
            <div class="row">
                <div class="alert alert-info" role="alert" style="text-align:center;font-size: 30px">Les resultats de Quiz :</div>

                <div class="col-lg-12"  style="padding-left:30%">
                    <div class="circle multi-line">
                        <span style="font-size:25px">SCORE QUIZ</span><br/><span><?= $_SESSION['quiz']['score']; ?></span><hr/><?= $_SESSION['quiz']['parametres']['total_points_quiz']; ?> 
                    </div> 
                </div>
            </div>
            <div class="row">


                <div class="col-lg-4">
                    <div class="col-lg-12">
                        <h4  style="color:red;font-weight:bold;">Vous aimez ce quiz: </h4>
                    </div>
                    <div class="col-lg-12" id="arrondi1"  style="text-align:center; ">              
                        <div class="ratings">                       
                            <p>
                                <!-- Like Icon HTML -->
                                <i class="fa fa-thumbs-o-up"  onClick="cwRating('<?= $_SESSION['quiz']['parametres']['random_quiz']; ?>', 1, 'like_quiz_<?= $_SESSION['quiz']['parametres']['random_quiz']; ?>')"></i>&nbsp;&nbsp;&nbsp;                          
                                <!-- Like Counter -->
                                <span class="counter" id="like_quiz_<?= $_SESSION['quiz']['parametres']['random_quiz']; ?>"> <?= $infos_quiz_like['like']; ?> </span>&nbsp;&nbsp;      

                                <!-- Dislike Icon HTML -->
                                <i class="fa fa-thumbs-o-down"  onClick="cwRating('<?= $_SESSION['quiz']['parametres']['random_quiz']; ?>', 0, 'dislike_quiz_<?= $_SESSION['quiz']['parametres']['random_quiz']; ?>')"></i>&nbsp;
                                <!-- Dislike Counter -->
                                <span class="counter" id="dislike_quiz_<?= $_SESSION['quiz']['parametres']['random_quiz']; ?>"> <?= $infos_quiz_like['dislike']; ?> </span>

                            </p>
                            <div style="padding-top:2%"></div>
                        </div>


                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="col-lg-12">
                        <h4 style="color:red;font-weight:bold;">Votez sur ce quiz: </h4>
                    </div>
                    <div class="col-lg-12" id="arrondi1"  style="text-align:center;padding-left:20% ">              

                        <input name="rating" value="0" id="rating_star" type="hidden" random_quiz="<?= $_SESSION['quiz']['parametres']['random_quiz']; ?>" />
                        <div class="overall-rating">

                            ( Note moyenne <span id="avgrat"><?= $infos_votes_quiz['moy_votes']; ?></span>
                            Basée sur <span id="totalrat"><?= $infos_votes_quiz['nombre_votes']; ?></span> évaluation)                    
                        </div>


                    </div>
                </div> 
            </div>
            <div style="padding-top:2%"></div>
            <div class="row">
                <div class="col-lg-12" id="arrondi1">
                    <div class="container content"  style="padding-left:90px">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="testimonials">
                                    <div class="active item">
                                        <blockquote><p><?= $citation['citation'] ?></p></blockquote>
                                        <div class="carousel-info pull-right">
                                            <img alt="" src="<?= url_media_local . '/images/auteurs_citations/' . $citation['img'] ?>" class="pull-left">
                                            <div class="pull-right">
                                                <span class="testimonials-name"><?= $citation['nom'] ?></span>
                                                <span class="testimonials-post"><?= $citation['profil'] ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="padding-top:2%"></div>
            <div class="row">
                <div class="col-lg-8">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="color:red;font-size:19px;font-weight:bold;width:25%;text-align:center ">Détail</th>
                                <th style="color:red;font-size:19px;font-weight:bold ">Résultat</th>
                            </tr>
                        </thead>
                        <tbody>              
                            <tr>
                                <td style="color:blue;font-size:19px;font-weight:bold;text-align:center  ">Taux de réussite</td>
                                <td>

                                    <div class="progress">

                                        <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar"    aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:<?= $_SESSION['quiz']['progression_reussite'] ?>%">
                                            <?= $_SESSION['quiz']['progression_reussite'] ?>% Réussi
                                        </div>
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td style="color:blue;font-size:19px;font-weight:bold;text-align:center  ">Temps-effectuté</td>
                                <td>
                                    <button type="button" class="btn btn-info btn-md"  >
                                        <?= $duree_quiz; ?>

                                    </button>

                                </td>

                            </tr>



                        </tbody>
                    </table>
                </div>
                <div class="col-lg-3">
                    <a href="#scroll_add_comment">
                        <button type="button" class="btn btn-info btn-lg"   id="add_comment_button">
                            <i class="fa fa-comments-o" aria-hidden="true"></i> LAISSER UN COMMENTAIRE

                        </button>
                    </a>
                    <div style="padding-top:20%"></div>
                    <a href="<?= url_espace_eleve; ?>/index.php?module=quiz&action=exec_quiz&action_quiz=remake&random_quiz=<?= $_SESSION['quiz']['parametres']['random_quiz']; ?>">
                        <button type="button" class="btn btn-info btn-lg"  >
                            <i class="fa fa-refresh" aria-hidden="true"></i> RECOMMENCER LE QUIZ

                        </button>
                    </a>

                </div>

            </div>

            <div style="padding-top:2%"></div>

            <div class="row">
                <div class="ribbon">
                    <div class="ribbon-stitches-top"></div>
                    <strong class="ribbon-content"><h1>Correction de vos réponses</h1></strong>
                    <div class="ribbon-stitches-bottom"></div>

                </div>
            </div>
            <div style="padding-top:100px"></div>
            <div class="row">
                <div class="bs-example">
                    <div class="panel-group" id="accordion">
                        <?php
                        $j = 1;
                        foreach ($_SESSION['quiz']['listes_reponses'] as $key1 => $value1) {
                            $elements_question = data_question($key1);
                            $corrige_question = data_corrige_question($key1);
                            ?>
                            <!--------------------------------------------------->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title" >
                                        <a style="color: blue;" data-toggle="collapse" data-parent="#accordion" href="#collapse-<?= $j; ?>" >Question N°<?= $j; ?></a>
                                    </h4>
                                </div>
                                <div id="collapse-<?= $j; ?>" class="panel-collapse collapse <?php if ($j == 1) echo 'in'; ?>">
                                    <div class="panel-body">
                                        <table style="width:100%">

                                            <tbody>
                                                <tr>
                                                    <td  colspan="2">
                                                        <div id="arrondi" style="width:100%">



                                                            <div class="row">
                                                                <div class="col-lg-12" style="margin-left:10%;">
                                                                    <?= $elements_question['data']; ?> 
                                                                </div>
                                                            </div>
                                                            <?php if ($elements_question['source_img'] != '') { ?>
                                                                <div class="row">
                                                                    <div class="col-lg-12" style="margin-left:10%;">
                                                                        <?= $elements_question['source_img']; ?>
                                                                    </div>
                                                                </div>
                                                            <?php } ?>

                                                        </div>

                                                    </td>


                                                </tr>
                                                <tr>
                                                    <td  colspan="2" style="text-align: center;height: 50px;text-align: left" >
                                                        <h3 style="text-decoration : underline;color:green">Vos réponses: </h3>
                                                    </td>
                                                </tr>
                                                <?php
                                                $tr = '';
                                                $total_point = 0;
                                                $check = FALSE;
                                                foreach ($value1 as $key2 => $value2) {
                                                    $data_reponse = data_reponse($value2);
                                                    if ($data_reponse['point'] == 0) {
                                                        $check = TRUE;
                                                    }
                                                    $total_point = $total_point + $data_reponse['point'];

                                                    $tr.='<tr>

                                                            <td style="width:80px;text-align: center;">
                                                                <i class="fa ' . $data_reponse['fa'] . ' fa-3x" aria-hidden="true" style="color:' . $data_reponse['color_fa'] . '"></i>
                                                            </td>
                                                            <td style="text-align:left;">
                                                                <div id="arrondi"  style="padding-left:5%;">' . $data_reponse['data'] . '</div>
                                                            </td>


                                                    </tr>
                                                    <tr>
                                                        <td  colspan="2" style="text-align: center;height: 30px;text-align: left" ></td>
                                                    </tr>';
                                                }
                                                echo $tr;
                                                ?>

                                                <tr>
                                                    <td  colspan="3" style="text-align: left;height: 50px;text-align: left" >
                                                        <?php if ($check) { ?>
                                                            <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal-<?= $j . '-1'; ?>">
                                                                CONSULTER LES BONNES REPONSES <i class="fa fa-angle-double-up" aria-hidden="true"></i>

                                                            </button>
                                                        <?php } ?>
                                                        <?php if ($corrige_question != '') { ?>
                                                            <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal-<?= $j . '-2'; ?>">
                                                                CONSULTER LE CORRIGE <i class="fa fa-angle-double-up" aria-hidden="true"></i>

                                                            </button>
                                                        <?php } ?>
                                                        <button type="button" class="btn btn-success btn-md" data-toggle="modal" data-target="#myModal">
                                                            TOTAL POINTS RECUS: <?= $total_point; ?> POINTS
                                                        </button>
                                                        <?php if ($corrige_question != '') { ?>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="myModal-<?= $j . '-2'; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                            <h4 class="modal-title" id="myModalLabel">LE CORRIGE</h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div id="arrondi"  style="padding-left:5%;"><?= $corrige_question; ?></div>

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">FERMER</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                        <?php if ($check) { ?>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="myModal-<?= $j . '-1'; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                            <h4 class="modal-title" id="myModalLabel">LES BONNES REPONSES</h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <table style="width:100%">

                                                                                <tbody>
                                                                                    <?php
                                                                                    $tr = '';
                                                                                    $list_reponses_juste = list_reponses_juste($key1);
                                                                                    foreach ($list_reponses_juste as $key3 => $value3) {
                                                                                        $tr.=' <tr>
                                                                                                <td>
                                                                                                    <div id="arrondi" style="padding-left:5%;">' . $value3['data'] . '</div>
                                                                                                </td>


                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td  colspan="2" style="text-align: center;height: 30px;text-align: left" >

                                                                                                </td>
                                                                                            </tr>';
                                                                                    }
                                                                                    echo $tr;
                                                                                    ?>


                                                                                </tbody>
                                                                            </table>

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">FERMER</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    </td>
                                                </tr>


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $j++;
                        }
                        ?>

                    </div>

                </div>  

            </div>
            <br/><br/>

            <div style="padding-top:40px"></div>
            <div class="row">

                <div class="ribbon">
                    <div class="ribbon-stitches-top"></div>
                    <strong class="ribbon-content"><h1>LAISSER UN COMMENTAIRE A L'ENSEIGNANT</h1></strong>
                    <div class="ribbon-stitches-bottom"></div>

                </div>

                <div style="padding-top:100px"></div>
                <div id="scroll_add_comment"></div>
                <form action="<?= url_espace_eleve; ?>/controleurs/quiz/add_comment_quiz.php" method="POST" name="add_comment_quiz" id="add_comment_quiz">
                    <div class="row"> 
                        <div class="alert alert-success alert-dismissible" role="alert"  style="display:none"  id="result_succees">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Félicitation</strong>votre demande d'envoi a été enregistré avec succées.
                        </div>
                        <div class="alert alert-danger alert-dismissible" role="alert"  style="display:none"  id="result_echec">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Desolé!</strong> votre demande d'envoi a échoué.
                        </div>               
                        <div class="col-md-12">
                            <textarea class="form-control" rows="8" cols="100" id="text_comment" name="text_comment" placeholder="rediger un commentaire"></textarea>
                        </div>               
                        <div class="col-md-12">
                            <input id="bouton_submit" class="btn btn-success btn-lg btn-block" type="submit" value="ENVOYER VOTRE COMMENTAIRE >>" name="envoyer_comment">
                        </div>


                    </div> 
                </form>  

            </div> 
        </div>
        <div class="col-lg-4" style="padding-top: 40px">
            <?php if (sizeof($list_quiz_meme_theme_rand) > 0) { ?>
                <div class="list-group">
                    <a href="#" class="list-group-item active">

                        <h4> <i class="fa fa-bars" aria-hidden="true"></i> DES QUIZ ASSOCIE AU MEME THEME</h4>
                    </a>
                    <?php
                    $j = 1;
                    foreach ($list_quiz_meme_theme_rand as $key => $value) {
                        ?>
                        <a href="<?= url_espace_eleve; ?>/index.php?module=quiz&action=exec_quiz&source_quiz=page_result_quiz&random_quiz=<?= $key; ?>" class="list-group-item"  style="color:blue;font-size:18px ">
                            <?= $j . '. ' . $value; ?>
                            <?php
                            $div_progression_reussite = barre_progression_reussite_quiz($key, $_SESSION ['membre']['code_eleve']);
                            if ($div_progression_reussite != '') {
                                echo $div_progression_reussite;
                            }
                            ?>

                        </a>



                        <?php
                        $j++;
                    }
                    ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>






