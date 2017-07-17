<div class="row"  style="margin-top:5%">
    <div class="col-lg-12">     
        <ol class="breadcrumb"  style="color:blue;font-size: 20px">
            <li><a href="index.php"><i class="fa fa-home"></i></a><span class="separator"></span></li>
            <li><i class="fa fa-code" aria-hidden="true"></i><span class="separator"></span> JAVA</li>
            <li><a href="<?= url_espace_formateur; ?>/index.php?module=JAVA&action=all_view_exercices"><i class="fa fa-list" aria-hidden="true"></i><span class="separator"></span> LISTE DES EXERCICES</a></li>
            <li style="color:#831098;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> AJOUTER UN NOUVEAU EXERCICE</li>
        </ol>      
    </div>    
</div>
<div class="col-md-12" style="height: 60px" ></div>
<div class="col-md-12 column">

    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 id="css_titre">
                <span class=" glyphicon glyphicon-pencil"></span> Création un nouveau exercice
            </h3>
        </div>
        <div class="panel-body">
            <?php if ($_GET['result'] == 'succees') { ?>
                <div class="alert alert-success" role="alert">
                    <p><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                        L'exercice a été enregistré avec succès</p>
                </div>
            <?php } ?>
            <?php if ($_GET['result'] == 'echec') { ?>
                <div class="alert alert-danger" role="alert">
                    <p><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                        Il y'a des erreurs dans la saisie.</p>
                </div>
            <?php } ?>
            <form class="form-horizontal" id="form_add_exo" name="form_add_exo" method="POST" enctype="multipart/form-data"  action="<?= url_espace_formateur_prod; ?>/controleurs/JAVA/traitement_add_exo.php">                  
                <div class="form-group"  style="padding-top:1%">
                    <label class="control-label col-lg-3 col-md-3 col-sm-4" for="titre_exo" style="color:blue;font-size:16px">Titre : <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="titre_exo"  name="titre_exo"  placeholder="Entrer un titre" value="<?= $infos_exo['titre_exo']; ?>" >
                        <span class="label label-danger"  style="font-size:12px "><?= $list_erreur['titre_exo']; ?></span>
                    </div>
                </div>

                <div class="form-group"  style="padding-top:20px ">
                    <label class="control-label col-lg-3 col-md-3 col-sm-4"  for="contenu_exo"  style="color:blue;font-size:16px">Contenu exo: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                    <div class="col-sm-8">
                        <textarea class="form-control" rows="8" cols="100" id="contenu_exo" name="contenu_exo" placeholder="Entrer le contenu de l'exercice"><?= $infos_exo['contenu_exo']; ?></textarea>
                        <span class="label label-danger"  style="font-size:12px "><?= $list_erreur['contenu_exo']; ?></span>

                    </div>
                </div>

                <div class="form-group" style="padding-top:20px ">
                    <label class="control-label col-lg-3 col-md-3 col-sm-4" for="etat" style="color:blue;font-size:16px">Activation: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                    <div class="col-sm-8">

                        <select class="form-control" data-style="btn-primary" data-placeholder="Selectionnez un etat de l'exercice" 	id="select_etat_exo" name="select_etat_exo">                                       
                            <option value="1" <?php
                            if ($infos_exo['select_etat_exo'] == '1') {
                                echo 'selected';
                            }
                            ?> >Actif</option>
                            <option value="0"  <?php
                            if ($infos_exo['select_etat_exo'] == '0') {
                                echo 'selected';
                            }
                            ?> >Inactif</option>
                        </select>
                        <span class="label label-danger"  style="font-size:12px "><?= $list_erreur['select_etat_quiz']; ?></span>

                        <span  style="color:red"> L'etat du  l'exercice est inactif par defaut.</span>

                    </div>
                </div>
                <div class="form-group" style="padding-top:20px ">
                    <label class="control-label col-lg-3 col-md-3 col-sm-4" for="etat" style="color:blue;font-size:16px">Plate de forme de travail: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                    <div class="col-sm-8">

                        <select class="form-control" data-style="btn-primary" data-placeholder="Selectionnez une plate forme" 	id="select_plate_forme" name="select_plate_forme">                                       
                            <?php foreach ($liste_plate_forme_travail as $value) { ?>


                                <option value="<?= $value['id_plate_forme']; ?>">
                                    <?= $value['nom_plate_forme']; ?>
                                </option>
                            <?php } ?>
                        </select>
                        <span class="label label-danger"  style="font-size:12px "><?= $list_erreur['select_etat_quiz']; ?></span>

                        <span  style="color:red"> L'etat du  l'exercice est inactif par defaut.</span>

                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-3 col-md-3 col-sm-4" for="date_publication" style="color:blue;font-size:16px">Date publication : <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                    <input type="text" class="flatpickr"  data-enable-time=true data-enable-seconds=true  data-inline=true  id="date_publication"  name="date_publication"   value="<?= $infos_exo['date_publication']; ?>" >
                    <span class="label label-danger"  style="font-size:12px "><?= $list_erreur['date_publication']; ?></span>

                </div>
                <div class="form-group">
                    <label class="control-label col-lg-3 col-md-3 col-sm-4" for="date_limite_depot" style="color:blue;font-size:16px">date limite depot des corrigés : <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                    <input type="text" class="flatpickr"  data-enable-time=true data-enable-seconds=true  data-inline=true  id="date_limite_depot"  name="date_limite_depot"   value="<?= $infos_exo['date_limite_depot']; ?>" >
                    <span class="label label-danger"  style="font-size:12px "><?= $list_erreur['date_limite_depot']; ?></span>

                </div>
                <div class="form-group">
                    <input type="file" name="img_exo" id="img_exo"   style="margin-left: 14%"/>
                    <div  style="padding-top:20px;padding-left: 27%; "  id="preview_image"></div>
                </div> 
                <div class="form-group"  style="padding-top:20px ">
                    <label class="control-label col-lg-3 col-md-3 col-sm-4"  for="aide_exo"  style="color:blue;font-size:16px">Point méthode: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                    <div class="col-sm-8">
                        <textarea class="form-control" rows="8" cols="100" id="aide_exo" name="aide_exo" placeholder="Entrer le contenu de l'aide"><?= $infos_exo['aide_exo']; ?></textarea>
                        <span class="label label-danger"  style="font-size:12px "><?= $list_erreur['aide_exo']; ?></span>

                    </div>
                </div>
                <hr/>
                <div class="form-group"  style="padding-top:20px ">
                    <label class="control-label col-lg-3 col-md-3 col-sm-4"  for="corrige_text_exo"  style="color:blue;font-size:16px">Editer le corrigé: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                    <div class="col-sm-8">
                        <textarea class="form-control" rows="8" cols="100" id="corrige_text_exo" name="corrige_text_exo" placeholder="Entrer le corrige de l'exercice"><?= $infos_exo['corrige_text_exo']; ?></textarea>
                        <span class="label label-danger"  style="font-size:12px "><?= $list_erreur['corrige_text_exo']; ?></span>

                    </div>
                </div>
                <div class="form-group" style="padding-top:20px ">
                    <label class="control-label col-lg-3 col-md-3 col-sm-4" for="etat" style="color:blue;font-size:16px">Plate de forme de travail de corrigé: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                    <div class="col-sm-8">

                        <select class="form-control" data-style="btn-primary" data-placeholder="Selectionnez une plate forme de corrigé" 	id="ID_plate_forme_corrige" name="ID_plate_forme_corrige">                                       
                            <?php foreach ($liste_plate_forme_travail as $value) { ?>


                                <option value="<?= $value['id_plate_forme']; ?>"  
                                <?php
                                if ($infos_exo['id_plate_forme_corrige'] == $value['id_plate_forme']) {
                                    echo 'selected';
                                }
                                ?>                                  
                                        >
                                            <?= $value['nom_plate_forme']; ?>
                                </option>
                            <?php } ?>
                        </select>
                        <span class="label label-danger"  style="font-size:12px "><?= $list_erreur['select_id_plate_forme_corrige']; ?></span>


                    </div>
                </div>
                <div class="form-group"  style="padding-top:1%">
                    <label class="control-label col-lg-3 col-md-3 col-sm-4" for="codefiddle_corrige" style="color:blue;font-size:16px">Code fiddle de corrigé : <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="codefiddle_corrige"  name="codefiddle_corrige"  placeholder="Entrer votre code fiddle" value="<?= $infos_exo['codefiddle_corrige']; ?>" >
                        <span class="label label-danger"  style="font-size:12px "><?= $list_erreur['codefiddle_corrige']; ?></span>
                    </div>
                </div>

                <input type="hidden"   value="7"   name="id_theme"    id="id_theme">

                <hr/>
                <div class="form-group" style="padding-top:20px ">
                    <div class="col-lg-offset-8 col-lg-5  col-sm-offset-4 col-sm-5">
                        <button type="submit" class="btn btn-success">Enregistrer votre exercice</button>
                    </div>
                </div>
            </form>
