<div class="row"  style="margin-top:5%">
    <div class="col-lg-12">     
        <ol class="breadcrumb"  style="color:blue;font-size: 20px">
            <li><a href="index.php"><i class="fa fa-home"></i></a><span class="separator"></span></li>
            <li><i class="fa fa-code" aria-hidden="true"></i><span class="separator"></span> <?= $infos_module['nom_module']; ?></li> 
            <li style="color:#831098;"> <?= $infos_dev['titre_dev']; ?></li>
            <li><a href="<?= url_espace_formateur; ?>/index.php?module=<?= $module; ?>&action=all_view_exo_devoir&token_devoir=<?= $keygen_dev; ?>"><i class="fa fa-list" aria-hidden="true"></i><span class="separator"></span> LISTE DES EXERCICES</a></li>
            <li style="color:#831098;">  <?= $infos_exo['nom_exo']; ?></li>
        </ol>      
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="bootstrap snippet"  style="margin-left:5%">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body p-t-0">
                    <div class="input-group">
                        <input type="text" id="example-input1-group2" name="example-input1-group2" class="form-control" placeholder="Rechercher">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-effect-ripple btn-primary"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <?php foreach ($list_eleves as $value) { ?>
            <div class="col-sm-6">
                <div class="panel">
                    <div class="panel-body p-t-10">
                        <div class="media-main">
                            <a class="pull-left" href="#">
                                <img class="thumb-lg img-circle bx-s" src="<?= $value['profil_img']; ?>" alt="">
                            </a>

                            <div class="info">
                                <h4><?= $value['identite_eleve']; ?></h4>
    <!--                                <p class="text-muted">Graphics Designer</p>-->
                            </div>
                        </div>
                        <div class="clearfix"></div><br>
                        <!--*********************************************************-->


                        <table class="table table-striped">                       
                            <tbody>
                                <tr>

                                    <td>ID code réponse</td>
                                    <td><?= $value['keygen_rep']; ?></td>

                                </tr>
                                <tr>

                                    <td>ID code plate forme</td>
                                    <td><?= $value['identifiant_code_reponse']; ?></td>

                                </tr>
                                <tr>

                                    <td>Date création</td>
                                    <td><?= $value['date_creation_code']; ?></td>                                
                                </tr>
                                <?php if ($value['nbr_points'] != '') { ?>
                                    <tr>

                                        <td>Nombre points</td>
                                        <td><span class="label label-info"><?= $value['nbr_points']; ?></span></td>

                                    </tr>
                                <?php } ?>
                                <tr>

                                    <td>Statut code</td>
                                    <td><?= $value['statut_code']; ?></td>

                                </tr>
                                <?php if ($value['date_update_code'] != '') { ?>
                                    <tr>

                                        <td>date update</td>
                                        <td><?= $value['date_update_code']; ?></td>

                                    </tr>
                                <?php } ?>
                                <tr>

                                    <td>Poster des infos</td>
                                    <td>
                                        <a href="#" data-fiddle="<?= $value['keygen_rep']; ?>"  >
                                            <button type="text" class="btn btn-success">Poster des infos sur le code</button>
                                        </a>
                                        <!--*********************************************************-->
                                        <div class="modal fade" id="Modal_<?= $value['keygen_rep']; ?>" role="dialog">
                                            <div class="modal-dialog modal-lg">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">
                                                            <div class="media-main">
                                                                <a class="pull-left" href="#">
                                                                    <img class="thumb-lg img-circle bx-s" src="<?= $value['profil_img']; ?>" alt="">
                                                                </a>

                                                                <div class="info">
                                                                    <h4><?= $value['identite_eleve']; ?></h4>
                                        <!--                                <p class="text-muted">Graphics Designer</p>-->
                                                                </div>
                                                                <div class="info">
                                                                    <h4><?= $infos_exo['titre_exo']; ?></h4>
                                        <!--                                <p class="text-muted">Graphics Designer</p>-->
                                                                </div>

                                                            </div>

                                                        </h4>
                                                    </div>
                                                    <div class="modal-body">


                                                        <!----------------------------------------------->
                                                        <ul class="nav nav-tabs">
                                                            <li class="active"><a href="#consult_reponse_<?= $value['keygen_rep']; ?>" data-toggle="tab">Consulter la reponse</a></li>
                                                            <li><a href="#modif_statu_code_<?= $value['keygen_rep']; ?>" data-toggle="tab">Modifier le statut code</a></li>
                                                            <li><a href="#poster_notification_code_<?= $value['keygen_rep']; ?>" data-toggle="tab">Poster une notification interne</a></li>
                                                            <?php if ($value['contenu_comment'] != '') { ?>
                                                                <li><a href="#list_comments_code_<?= $value['keygen_rep']; ?>" data-toggle="tab">Les commentaires postés par l'eleve</a></li>
                                                            <?php } ?>  

                                                        </ul>
                                                        <div id="myTabContent_<?= $value['keygen_rep']; ?>" class="tab-content">
                                                            <div class="tab-pane fade active in" id="consult_reponse_<?= $value['keygen_rep']; ?>">
                                                                <div  id="contenu_reponse_<?= $value['keygen_rep']; ?>">

                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="modif_statu_code_<?= $value['keygen_rep']; ?>">
                                                                <div class="col-md-offset-1  col-md-9">
                                                                    <span  style="font-size: 20px">Le statut actuel </span> : <span  id="statut_code_actuel_<?= $value['keygen_rep']; ?>"><?= $value['statut_code']; ?></span>
                                                                </div>
                                                                <div class="row"  id="show_succes_code_<?= $value['keygen_rep']; ?>"  style="display: none;width:70%;margin-left:7%">                     
                                                                    <div class="alert alert-success" role="alert">
                                                                        <p><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                                                                            Le statut de code a été enregistré avec succès</p>
                                                                    </div>
                                                                </div>
                                                                <div class="row"  id="show_erreur_code_<?= $value['keygen_rep']; ?>"  style="display: none;width:70%;margin-left:7%">  
                                                                    <div class="alert alert-danger" role="alert">
                                                                        <p><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                                                            Il y'a des erreurs dans la saisie.</p>
                                                                    </div>
                                                                </div>
                                                                <form class="form-horizontal" id="form_add_id_statut_<?= $value['keygen_rep']; ?>" name="form_add_id_statut_<?= $value['keygen_rep']; ?>" method="POST" action="<?= url_espace_formateur; ?>/change_statut_code.php">


                                                                    <div class="col-md-offset-1  col-md-7">
                                                                        <div class="form-group">
                                                                            <label for="nom" class="control-label">Choisissez le statut</label>
                                                                            <select id="id_statut_code_<?= $value['keygen_rep']; ?>" name="id_statut_code_<?= $value['keygen_rep']; ?>" class="form-control">
                                                                                <option value="">Changer le statut</option>
                                                                                <?php foreach ($list_statut_code as $value1) { ?>
                                                                                    <option value="<?= $value1['id_statut']; ?>"
                                                                                    <?php
                                                                                    if ($value1['id_statut'] == $value['id_statut_code']) {
                                                                                        echo "selected";
                                                                                    }
                                                                                    ?>    

                                                                                            >
                                                                                                <?= $value1['nom_statut']; ?>
                                                                                    </option>
                                                                                <?php } ?>                                     

                                                                            </select>
                                                                        </div> 
                                                                        <div class="form-group">
                                                                            <label for="nbr_points" class="control-label">Nombre de points</label>
                                                                            <input type="text" class="form-control" id="nbr_points_<?= $value['keygen_rep']; ?>"  name="nbr_points_<?= $value['keygen_rep']; ?>"  placeholder="Entrer le nombre de points" value="<?= $value['nbr_points']; ?>" >
                                                                        </div> 

                                                                    </div>                                                   
                                                                    <div class="form-group">
                                                                        <div class="col-md-offset-1  col-md-9">
                                                                            <button type="submit" id="submit_id_statut_<?= $value['keygen_rep']; ?>" name="submit_id_statut_<?= $value['keygen_rep']; ?>" class="col-md-8 btn btn-primary">Changer le statut de code</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="tab-pane fade" id="poster_notification_code_<?= $value['keygen_rep']; ?>">
                                                                <div class="chat-body row"  id="list_notif_<?= $value['keygen_rep']; ?>"> 
                                                                    <?php
                                                                    if (sizeof($value['liste_notification']) > 0) {
                                                                        foreach ($value['liste_notification'] as $value4) {
                                                                            ?>


                                                                            <div class="answer left">                   

                                                                                <div class="text">
                                                                                    <?= $value4['contenu']; ?>
                                                                                </div>
                                                                                <div class="time"> <?= $value4['date_notif']; ?>&nbsp;<?= $value4['degre_notif']; ?></div>
                                                                            </div>


                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <hr/>
                                                                <div class="row"  id="show_succes_notif_<?= $value['keygen_rep']; ?>"  style="display: none;width:70%;margin-left:7%">                     
                                                                    <div class="alert alert-success" role="alert">
                                                                        <p><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                                                                            La notification de code a été enregistré avec succès</p>
                                                                    </div>
                                                                </div>
                                                                <div class="row"  id="show_erreur_notif_<?= $value['keygen_rep']; ?>"  style="display: none;width:70%;margin-left:7%">  
                                                                    <div class="alert alert-danger" role="alert">
                                                                        <p><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                                                            Il y'a des erreurs dans la saisie.</p>
                                                                    </div>
                                                                </div>
                                                                <form class="form-horizontal" id="form_add_notif_code_<?= $value['keygen_rep']; ?>" name="form_add_notif_code_<?= $value['keygen_rep']; ?>" method="POST" action="<?= url_espace_formateur; ?>/poster_notification_code.php">



                                                                    <div class="col-md-offset-1  col-md-7">
                                                                        <div class="form-group">
                                                                            <label for="level_notif" class="control-label">Rédiger votre notification</label>
                                                                            <textarea class="form-control textera_notification" rows="8" cols="100" id="contenu_notif_<?= $value['keygen_rep']; ?>" name="contenu_notif_<?= $value['keygen_rep']; ?>" placeholder="Rediger votre notification"></textarea>
                                                                        </div> 
                                                                    </div>
                                                                    <div class="col-md-offset-1  col-md-7">
                                                                        <div class="form-group">
                                                                            <label for="level_notif" class="control-label">Choisissez l'importance de message</label>
                                                                            <select id="degre_notif_code_<?= $value['keygen_rep']; ?>" name="degre_notif_code_<?= $value['keygen_rep']; ?>" class="form-control">
                                                                                <option value="">Changer le degré</option>
                                                                                <?php foreach ($list_degre_message as $value2) { ?>
                                                                                    <option value="<?= $value2['id_level']; ?>"><?= $value2['nom_level']; ?></option>
                                                                                <?php } ?>                                     

                                                                            </select>
                                                                        </div> 
                                                                    </div>                                                   
                                                                    <div class="form-group">
                                                                        <div class="col-md-offset-1  col-md-9">
                                                                            <button type="submit" id="submit_notif_code_<?= $value['keygen_rep']; ?>" name="submit_notif_code_<?= $value['keygen_rep']; ?>" class="col-md-8 btn btn-primary">Enregistrer la ntification de code</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <?php if ($value['contenu_comment'] != '') { ?>
                                                                <div class="tab-pane fade  in" id="list_comments_code_<?= $value['keygen_rep']; ?>">
                                                                    <div class="chat-body row"  id="list_comments_reponse_<?= $value['keygen_rep']; ?>"> 
                                                                        <div class="answer left">                   

                                                                            <div class="text">
                                                                                <?= $value['contenu_comment']; ?>
                                                                            </div>
                                                                            <div class="time"> <?= $value['date_comment']; ?></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php } ?> 
                                                        </div>

                                                        <!----------------------------------------------->

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal"  id="close_<?= $value['keygen_rep']; ?>">Fermer</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <!--*********************************************************-->
                                    </td>

                                </tr>

                            </tbody>
                        </table>

                        <hr>

                        <!--*********************************************************-->

                    </div>
                </div>
            </div>
        <?php } ?>  
    </div>
</div>


/

