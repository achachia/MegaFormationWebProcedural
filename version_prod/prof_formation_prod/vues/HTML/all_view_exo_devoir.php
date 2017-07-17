<div class="row"  style="margin-top:5%">
    <div class="col-lg-12">     
        <ol class="breadcrumb"  style="color:blue;font-size: 20px">
            <li><a href="index.php"><i class="fa fa-home"></i></a><span class="separator"></span></li>
            <li><i class="fa fa-code" aria-hidden="true"></i><span class="separator"></span> <?= $infos_module['nom_module']; ?></li>             
            <li><a href="<?= url_espace_formateur; ?>/index.php?module=<?= $module; ?>&action=all_view_devoirs"><i class="fa fa-list" aria-hidden="true"></i><span class="separator"></span> LISTE DES DEVOIRS</a></li>
            <li style="color:#831098;"> <?= $infos_dev['titre_dev']; ?></li>
            <li><i class="fa fa-list" aria-hidden="true"></i><span class="separator"></span> LISTE DES EXERCICES</li>

        </ol>      
    </div>    
</div>
<div class="col-md-12" style="height: 60px" ></div>
<div class="row">
    <?php if ($_GET['result'] == 'succees') { ?>
        <div class="alert alert-success" role="alert">
            <p><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                La fiche de l'exercice a été modifié avec succès</p>
        </div>
    <?php } ?>
    <div class="col-md-12" style="margin-top:3%">
        <?php
        $j = 1;
        foreach ($list_exercices as $value) {
            ?>

            <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" href="#collapse_<?= $value['keygen_exo']; ?>"><?= $j . '. ' . $value['titre_exo']; ?></a>  <?= $value['statut_code']; ?>&nbsp;&nbsp;<?= $value['etat_corrige_exo']; ?>
                            <?php if ($value['nbr_notification_non_lue'] > 0) { ?>
                                <i class="fa fa-commenting-o" aria-hidden="true"  style="color:red"></i>
                            <?php } ?>
             
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
                            <hr>
                            <a href="<?= url_espace_formateur; ?>/index.php?module=<?= $module; ?>&action=edit_fiche_exo_dev&token_dev=<?= $keygen_devoir; ?>&token_exo=<?= $value['keygen_exo']; ?>"><button type="text" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Modifier la fiche</button></a>
                            <a href="<?= $value['url_palte_forme'] . '/' . $value['code_fiddle_corrige_eleve']; ?>"  target="_blank" id="url_travail_<?= $value['keygen_exo']; ?>"><button type="text" class="btn btn-primary">La plate forme de travail : <?= $value['plate_forme']; ?></button></a>
                            <!------------------------------------------------------------>
                            <?php if ($value['aide_exo'] != '') { ?>
                                <a href="#" data-fiddle-aide="<?= $value['keygen_exo']; ?>"  >
                                    <button type="text" class="btn btn-primary"><i class="fa fa-unlock-alt" aria-hidden="true"></i> Méthodologie</button>
                                </a>
                                <div class="modal fade" id="Modal_aide_<?= $value['keygen_exo']; ?>" role="dialog">
                                    <div class="modal-dialog modal-lg">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>

                                                <h4 class="modal-title"><i class="fa fa-unlock-alt" aria-hidden="true"></i> Méthodologie : <?= $value['titre_exo']; ?></h4>
                                            </div>
                                            <div class="modal-body">                                            
                                                <?= $value['keygen_exo']; ?>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            <?php } ?>



                            <!------------------------------------------------------------------->
                            <?php if ($value['date_limite_depot_travail_user'] != '') { ?>
                                <button type="text" class="btn btn-danger"><i class="fa fa-calendar" aria-hidden="true"></i>  La date limite de depot : <?= $value['date_limite_depot_travail_user']; ?></button>
                            <?php } ?>      
                            <!--------------------------------------------------------------------->
                            <?php if (sizeof($value['liste_notification']) > 0) { ?>
                                <a href="#" data-fiddle-notif="<?= $value['keygen_exo']; ?>"  ><button type="text" class="btn btn-infos">Notifications <i class="fa fa-commenting-o" aria-hidden="true"></i></button></a>
                                <div class="modal fade" id="Modal_notif_<?= $value['keygen_exo']; ?>" role="dialog">
                                    <div class="modal-dialog modal-lg">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"><?= $value['titre_exo']; ?></h4>
                                            </div>
                                            <div class="modal-body">                                            
                                                <div class="chat-body row"  id="list_notif_<?= $value['keygen_exo']; ?>"> 
                                                    <?php
                                                    if (sizeof($value['liste_notification']) > 0) {
                                                        foreach ($value['liste_notification'] as $value4) {
                                                            ?>


                                                            <div class="answer left">                   

                                                                <div class="text">
                                                                    <?= $value4['contenu']; ?>
                                                                </div>
                                                                <div class="time"> <?= $value4['date_notif']; ?></div>
                                                            </div>


                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </div>  
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            <?php } ?>



                            <!--------------------------------------------------------------------->
                            <?php if ($value['code_fiddle_corrige_eleve'] != '') { ?>                        
                                <a href="#" data-fiddle-rep="<?= $value['keygen_exo']; ?>"  ><button type="text" class="btn btn-success"> <i class="fa fa-key" aria-hidden="true"></i> Identifiant de votre travail : <?= $value['code_fiddle_corrige_eleve']; ?></button></a>
                                <div class="modal fade" id="Modal_rep_<?= $value['keygen_exo']; ?>" role="dialog">
                                    <div class="modal-dialog modal-lg">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"><?= $value['titre_exo']; ?></h4>
                                            </div>
                                            <div class="modal-body"></div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!--------------------- Afficher la version de code -------------------------->
                                <?php if ($value['version_code_reponse'] != '') { ?>
                                    <button type="text" class="btn btn-success">Version : <?= $value['version_code_reponse']; ?></button>
                                <?php } ?>

                            <?php } ?>                      
                            <!--------------------------------------------------------------------->

                            <?php
                            $date_jour = date("Y-m-d H:i:s");

                            if ($value['date_limite_depot_travail_user'] > $date_jour) {

                                if ($value['code_fiddle_corrige_eleve'] != '') {
                                    ?>
                                    <!------------------------------------------------------------>
                                    <a href="#" data-fiddle="<?= $value['keygen_exo']; ?>"  ><button type="text" class="btn btn-success">Modifier identifiant de votre travail</button></a>
                                <?php } else { ?>
                                    <a href="#" data-fiddle="<?= $value['keygen_exo']; ?>"  ><button type="text" class="btn btn-success">Poster votre identifiant de votre travail</button></a>
                                <?php } ?>
                                <div class="modal fade" id="Modal_<?= $value['keygen_exo']; ?>" role="dialog">
                                    <div class="modal-dialog modal-lg">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"><?= $value['titre_exo']; ?></h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row"  id="show_succes_<?= $value['keygen_exo']; ?>"  style="display: none;width:70%;margin-left:7%">                     
                                                    <div class="alert alert-success" role="alert">
                                                        <p><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                                                            Votre identifiant a été enregistré avec succès</p>
                                                    </div>
                                                </div>
                                                <div class="row"  id="show_erreur_<?= $value['keygen_exo']; ?>"  style="display: none;width:70%;margin-left:7%">  
                                                    <div class="alert alert-danger" role="alert">
                                                        <p><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                                            Il y'a des erreurs dans la saisie.</p>
                                                    </div>
                                                </div>
                                                <form class="form-horizontal" id="form_add_id_exo_<?= $value['keygen_exo']; ?>" name="form_add_id_exo_<?= $value['keygen_exo']; ?>" method="POST" action="<?= url_espace_eleve ?>/poster_id_corrige.php">
                                                    <div class="col-md-offset-1  col-md-7">
                                                        <div class="form-group">
                                                            <label for="nom_code" class="control-label">Saisir un nom à votre code :</label>
                                                            <input type="text" class="form-control" id="nom_code_<?= $value['keygen_exo']; ?>" name="nom_code_<?= $value['keygen_exo']; ?>"  value="<?= $value['nom_code']; ?>">
                                                        </div> 
                                                    </div> 
                                                    <div class="col-md-offset-1  col-md-7">
                                                        <div class="form-group">
                                                            <label for="nom" class="control-label">Saisir un identifiant de votre travail :</label>
                                                            <input type="text" class="form-control" id="id_corrige_exo_<?= $value['keygen_exo']; ?>" name="id_corrige_exo_<?= $value['keygen_exo']; ?>"  value="<?= $value['code_fiddle_corrige_eleve']; ?>">
                                                        </div> 
                                                    </div>
                                                    <div class="col-md-offset-1  col-md-7">
                                                        <div class="form-group">
                                                            <label for="partage_code" class="control-label">Choisir un mode de partage :</label>
                                                            <select id="partage_code_<?= $value['keygen_exo']; ?>" name="partage_code_<?= $value['keygen_exo']; ?>" class="form-control">                                                                                                     

                                                                <option value="1" <?php
                                                                if ($value['id_mode_public'] == '1') {
                                                                    echo 'selected';
                                                                }
                                                                ?> >Public</option>
                                                                <option value="2"  <?php
                                                                if ($value['id_mode_public'] == '2') {
                                                                    echo 'selected';
                                                                }
                                                                ?> >Privé</option>

                                                            </select>
                                                        </div> 
                                                    </div>
                                                    <div class="col-md-offset-1  col-md-7">
                                                        <div class="form-group">
                                                            <label for="comment_code" class="control-label">Poster un commentaire :</label>
                                                            <textarea class="form-control  comment_code" rows="8" cols="100" id="comment_code_<?= $value['keygen_exo']; ?>" name="comment_code_<?= $value['keygen_exo']; ?>" placeholder="Poster un commentaire pour ce code"><?= $value['comment_code']; ?></textarea>
                                                        </div> 
                                                    </div>
                                                    <div class="col-md-offset-1  col-md-7">
                                                        <div class="form-group">
                                                            <label for="labels_code" class="control-label">Rédiger des mots clés pour identifier votre code :</label>
                                                            <input type="text" class="labels_code form-control" id="labels_code_<?= $value['keygen_exo']; ?>"  name="labels_code_<?= $value['keygen_exo']; ?>"  placeholder="Saisir les labels de votre code" value="<?= $value['labels_code']; ?>" >
                                                        </div> 
                                                    </div>


                                                    <input type="hidden" class="form-control" id="form_keygen_exo_<?= $value['keygen_exo']; ?>" name="form_keygen_exo_<?= $value['keygen_exo']; ?>" value="<?= $value['keygen_exo']; ?>'">
                                                    <div class="form-group">
                                                        <div class="col-md-offset-1  col-md-9">
                                                            <button type="submit" id="submit_id_exo_<?= $value['keygen_exo']; ?>" name="submit_id_exo_<?= $value['keygen_exo']; ?>" class="col-md-8 btn btn-primary">Enregistrer votre identifiant</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <?php
                            } else {
                                if ($value['corrige_exo_dispo'] == '1') {
                                    ?>
                                    <!-------------------------------  Corrige-------------------------------------->
                                    <a href="#" data-fiddle-corrige="<?= $value['keygen_exo']; ?>"  >
                                        <button type="text" class="btn btn-success"><i class="fa fa-key" aria-hidden="true"></i> La correction</button>
                                    </a>
                                    <!--*********************************************************-->
                                    <div class="modal fade" id="Modal_corrige_<?= $value['keygen_exo']; ?>" role="dialog">
                                        <div class="modal-dialog modal-lg">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">
                                                        <div class="media-main">                                                  
                                                            <div class="info">
                                                                <h4>La correction : <?= $value['titre_exo']; ?></h4>                                 
                                                            </div>

                                                        </div>

                                                    </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <!----------------------------------------------->
                                                    <ul class="nav nav-tabs">
                                                        <li class="active"><a href="#consult_corrige_<?= $value['keygen_exo']; ?>" data-toggle="tab">La correction</a></li>
                                                        <?php if ($value['etat_eval_corrige_exo'] == '0') { ?>
                                                            <li><a href="#post_eval_corrige_<?= $value['keygen_exo']; ?>" data-toggle="tab">Evaluer le corrigé</a></li>
                                                        <?php } ?>
                                                        <?php if ($value['etat_comment_corrige_exo'] == '0') { ?>
                                                            <li><a href="#post_comment_corrige_<?= $value['keygen_exo']; ?>" data-toggle="tab">Poster un commentaire</a></li> 
                                                        <?php } ?>
                                                        <?php if ($value['etat_vote_exo'] == '0') { ?>
                                                            <li><a href="#post_vote_exo_<?= $value['keygen_exo']; ?>" data-toggle="tab">Votez pour cette exercice</a></li> 
                                                        <?php } ?>

                                                    </ul>
                                                    <div id="myTabContent_<?= $value['keygen_exo']; ?>" class="tab-content">
                                                        <div class="tab-pane fade active in" id="consult_corrige_<?= $value['keygen_exo']; ?>">
                                                            <div  id="contenu_corrige_<?= $value['keygen_exo']; ?>"></div>
                                                        </div>
                                                        <?php if ($value['etat_eval_corrige_exo'] == '0') { ?>
                                                            <div class="tab-pane fade" id="post_eval_corrige_<?= $value['keygen_exo']; ?>">

                                                                <div class="row"  id="show_succes_eval_<?= $value['keygen_exo']; ?>"  style="display: none;width:70%;margin-left:7%">                     
                                                                    <div class="alert alert-success" role="alert">
                                                                        <p><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                                                                            Votre evaluation de code a été enregistré avec succès</p>
                                                                    </div>
                                                                </div>
                                                                <div class="row"  id="show_erreur_eval_<?= $value['keygen_exo']; ?>"  style="display: none;width:70%;margin-left:7%">  
                                                                    <div class="alert alert-danger" role="alert">
                                                                        <p><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                                                            Il y'a des erreurs dans la saisie.</p>
                                                                    </div>
                                                                </div>
                                                                <form class="form-horizontal" id="form_eval_corrige_<?= $value['keygen_exo']; ?>" name="form_eval_corrige_<?= $value['keygen_exo']; ?>" method="POST" action="<?= url_espace_eleve; ?>/eval_corrige.php">


                                                                    <div class="col-md-offset-1  col-md-7">
                                                                        <div class="form-group">
                                                                            <label for="nom" class="control-label">Choisissez le niveau de compréhension</label>
                                                                            <select id="id_eval_statut_<?= $value['keygen_exo']; ?>" name="id_eval_statut_<?= $value['keygen_exo']; ?>" class="form-control">
                                                                                <option value="">Choisir le niveau de compréhension</option>
                                                                                <?php foreach ($list_statut_eval_corrige as $value1) { ?>
                                                                                    <option value="<?= $value1['id_degre']; ?>"><?= $value1['nom_degre']; ?></option>   
                                                                                <?php } ?>                                     

                                                                            </select>
                                                                        </div> 
                                                                    </div>                                                   
                                                                    <div class="form-group">
                                                                        <div class="col-md-offset-1  col-md-9">
                                                                            <button type="submit" id="submit_id_statut_<?= $value['keygen_exo']; ?>" name="submit_id_statut_<?= $value['keygen_exo']; ?>" class="col-md-8 btn btn-primary">Enregistrer le statut de code</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        <?php } ?>
                                                        <?php if ($value['etat_comment_corrige_exo'] == '0') { ?>
                                                            <div class="tab-pane fade" id="post_comment_corrige_<?= $value['keygen_exo']; ?>">              
                                                                <hr/>
                                                                <div class="row"  id="show_succes_comment_<?= $value['keygen_exo']; ?>"  style="display: none;width:70%;margin-left:7%">                     
                                                                    <div class="alert alert-success" role="alert">
                                                                        <p><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                                                                            Le commentaire  a été enregistré avec succès</p>
                                                                    </div>
                                                                </div>
                                                                <div class="row"  id="show_erreur_comment_<?= $value['keygen_exo']; ?>"  style="display: none;width:70%;margin-left:7%">  
                                                                    <div class="alert alert-danger" role="alert">
                                                                        <p><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                                                            Il y'a des erreurs dans la saisie.</p>
                                                                    </div>
                                                                </div>
                                                                <form class="form-horizontal" id="form_add_comment_code_<?= $value['keygen_exo']; ?>" name="form_add_comment_code_<?= $value['keygen_exo']; ?>" method="POST" action="<?= url_espace_eleve; ?>/poster_comment_code.php">



                                                                    <div class="col-md-offset-1  col-md-7">
                                                                        <div class="form-group">
                                                                            <label for="comment_exo" class="control-label">Rédiger votre commentaire</label>
                                                                            <textarea class="form-control textera_comment_exo" rows="8" cols="100" id="contenu_comment_<?= $value['keygen_exo']; ?>" name="contenu_comment_<?= $value['keygen_exo']; ?>" placeholder="Rediger votre commentaire"></textarea>
                                                                        </div> 
                                                                    </div>                                                                                                               
                                                                    <div class="form-group">
                                                                        <div class="col-md-offset-1  col-md-9">
                                                                            <button type="submit" id="submit_comment_code_<?= $value['keygen_exo']; ?>" name="submit_comment_code_<?= $value['keygen_exo']; ?>" class="col-md-8 btn btn-primary">Enregistrer votre commentaire</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        <?php } ?>
                                                        <?php if ($value['etat_vote_exo'] == '0') { ?>
                                                            <div class="tab-pane fade" id="post_vote_exo_<?= $value['keygen_exo']; ?>">

                                                                <div class="row"  id="show_succes_vote_exo_<?= $value['keygen_exo']; ?>"  style="display: none;width:70%;margin-left:7%">                     
                                                                    <div class="alert alert-success" role="alert">
                                                                        <p><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                                                                            Votre vote de code a été enregistré avec succès</p>
                                                                    </div>
                                                                </div>
                                                                <div class="row"  id="show_erreur_vote_exo_<?= $value['keygen_exo']; ?>"  style="display: none;width:70%;margin-left:7%">  
                                                                    <div class="alert alert-danger" role="alert">
                                                                        <p><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                                                            Il y'a des erreurs dans la saisie.</p>
                                                                    </div>
                                                                </div>
                                                                <form class="form-horizontal" id="form_vote_exo_<?= $value['keygen_exo']; ?>" name="form_vote_exo_<?= $value['keygen_exo']; ?>" method="POST" action="<?= url_espace_eleve; ?>/poster_vote_difficulte_exo.php">


                                                                    <div class="col-md-offset-1  col-md-7">
                                                                        <div class="form-group">
                                                                            <label for="nom" class="control-label">Choisissez la difficulté de l'exercice</label>
                                                                            <select id="id_vote_exo_<?= $value['keygen_exo']; ?>" name="id_vote_exo_<?= $value['keygen_exo']; ?>" class="form-control">
                                                                                <option value="">Choisir la difficulté</option>
                                                                                <?php foreach ($list_difficulte_exo as $value2) { ?>
                                                                                    <option value="<?= $value2['id_difficulte']; ?>"><?= $value2['nom_difficulte']; ?></option>
                                                                                <?php } ?>                                     

                                                                            </select>
                                                                        </div> 
                                                                    </div>                                                   
                                                                    <div class="form-group">
                                                                        <div class="col-md-offset-1  col-md-9">
                                                                            <button type="submit" id="submit_vote_exo_<?= $value['keygen_exo']; ?>" name="submit_vote_exo_<?= $value['keygen_exo']; ?>" class="col-md-8 btn btn-primary">Enregistrer votre choix</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        <?php } ?>

                                                    </div>
                                                    <!----------------------------------------------->

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>



                                    <!--------------------------------------------------------------------->

                                    <?php
                                }
                            }
                            ?>

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





