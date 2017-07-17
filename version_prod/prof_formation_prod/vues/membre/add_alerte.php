<div class="col-md-12" style="height: 60px" ></div>
<div class="col-md-12 column">

    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 id="css_titre">
                <span class=" glyphicon glyphicon-pencil"></span> Création une nouvelle alerte
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
            <form class="form-horizontal" id="form_add_alerte" name="form_add_alerte" method="POST" enctype="multipart/form-data"  action="<?= url_espace_formateur_prod; ?>/controleurs/membre/traitement_add_alerte.php">                  
                <div class="form-group"  style="padding-top:1%">
                    <label class="control-label col-lg-3 col-md-3 col-sm-4" for="titre_alerte" style="color:blue;font-size:16px">Titre : <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="titre_alerte"  name="titre_alerte"  placeholder="Entrer un titre" value="<?= $infos_alerte['titre_alerte']; ?>" >
                        <span class="label label-danger"  style="font-size:12px "><?= $list_erreur['titre_alerte']; ?></span>
                    </div>
                </div>
                <div class="form-group"  style="padding-top:20px ">
                    <label class="control-label col-lg-3 col-md-3 col-sm-4"  for="contenu_alerte"  style="color:blue;font-size:16px">Contenu alerte: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                    <div class="col-sm-8">
                        <textarea class="form-control" rows="8" cols="100" id="contenu_alerte" name="contenu_alerte" placeholder="Entrer le contenu de l'alerte"><?= $infos_alerte['contenu_alerte']; ?></textarea>
                        <span class="label label-danger"  style="font-size:12px "><?= $list_erreur['contenu_alerte']; ?></span>

                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-3 col-md-3 col-sm-4" for="date_start" style="color:blue;font-size:16px">Date debut : <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                    <input type="text" class="flatpickr"  data-enable-time=true data-enable-seconds=true  data-inline=true  id="date_start"  name="date_start"   value="<?= $infos_alerte['date_start']; ?>" >

                    <span class="label label-danger"  style="font-size:12px "><?= $list_erreur['date_start']; ?></span>

                </div>
                <div class="form-group">
                    <label class="control-label col-lg-3 col-md-3 col-sm-4" for="date_end" style="color:blue;font-size:16px">date fin : <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                    <input type="text" class="flatpickr"  data-enable-time=true data-enable-seconds=true  data-inline=true  id="date_end"  name="date_end"   value="<?= $infos_alerte['date_end']; ?>" >
                    <span class="label label-danger"  style="font-size:12px "><?= $list_erreur['date_end']; ?></span>

                </div>

                <div class="form-group" style="padding-top:20px ">
                    <label class="control-label col-lg-3 col-md-3 col-sm-4" for="priorite_alerte" style="color:blue;font-size:16px">Priorité alerte: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                    <div class="col-sm-8">

                        <select class="form-control" data-style="btn-primary" data-placeholder="Selectionnez une priorite" 	id="select_priorite_alerte" name="select_priorite_alerte">                                       
                            <?php foreach ($liste_priorite_alerte as $value) { ?>

                                <option value="<?= $value['id_priorite']; ?>"><?= $value['nom_priorite']; ?></option>                        


                            <?php } ?>
                        </select>
                        <span class="label label-danger"  style="font-size:12px "><?= $list_erreur['select_priorite_alerte']; ?></span>

                    </div>
                </div>
                <div class="form-group" style="padding-top:20px ">
                    <label class="control-label col-lg-3 col-md-3 col-sm-4" for="mode_affichage" style="color:blue;font-size:16px">Mode affichage: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                    <div class="col-sm-8">

                        <select class="form-control" data-style="btn-primary" data-placeholder="Selectionnez un mode d'affichage" 	id="select_mode_affichage" name="select_mode_affichage">                                       

                            <option value="">Choisir votre mode affichage</option>
                            <option value="fenetre">Mode Pop up</option>
                            <option value="page">Mode bordereaux</option>

                        </select>
                        <span class="label label-danger"  style="font-size:12px "><?= $list_erreur['select_mode_affichage']; ?></span>

                    </div>
                </div> 
                <div class="form-group" style="padding-top:20px ">
                    <label class="control-label col-lg-3 col-md-3 col-sm-4" for="mode_groupe" style="color:blue;font-size:16px">Mode de groupe: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                    <div class="col-sm-8">

                        <select class="form-control" data-style="btn-primary" data-placeholder="Selectionnez un mode de groupe" 	id="select_mode_groupe" name="select_mode_groupe"> 
                            <option value="">Choisir mode groupe</option>
                            <?php foreach ($liste_mode_groupe_users as $value) { ?>

                                <option value="<?= $value['id_groupe']; ?>"><?= $value['mode_groupe']; ?></option>                        


                            <?php } ?>
                        </select>
                        <span class="label label-danger"  style="font-size:12px "><?= $list_erreur['select_mode_groupe']; ?></span>

                    </div>
                </div>
                <div class="form-group" id="div_list_groupe_users">
                    <label class="control-label col-lg-3 col-md-3 col-sm-4" for="mode_groupe" style="color:blue;font-size:16px">Liste groupe eleves: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                    <div class="col-sm-8">

                        <select class="form-control  chosen-select" data-style="btn-primary" data-placeholder="Selectionnez un groupe eleves" 	id="select_id_groupe_users" name="select_id_groupe_users[]"  multiple="true"  style="width:600px ">                                       
                            <option value="">Choisir groupe d'eleves</option> 
                            <?php foreach ($liste_groupe_users as $value) { ?>

                                <option value="<?= $value['keygen_groupe']; ?>"><?= $value['nom_groupe']; ?></option>                        


                            <?php } ?>
                        </select>
                        <span class="label label-danger"  style="font-size:12px "><?= $list_erreur['select_id_groupe_users']; ?></span>

                    </div>
                </div>
                <div class="form-group" id="div_list_users">
                    <label class="control-label col-lg-3 col-md-3 col-sm-4" for="code_user" style="color:blue;font-size:16px">Liste  eleves: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                    <div class="col-sm-8">

                        <select class="form-control  chosen-select" data-style="btn-primary" data-placeholder="Selectionnez un eleve" 	id="select_code_user" name="select_code_user[]"  multiple="true"  style="width:600px ">                                       
                            <option value="">Choisir eleve</option> 
                            <?php foreach ($liste_users as $value) { ?>

                                <option value="<?= $value['code_user']; ?>"><?= $value['nom_user']; ?></option>                        


                            <?php } ?>
                        </select>
                        <span class="label label-danger"  style="font-size:12px "><?= $list_erreur['select_code_user']; ?></span>

                    </div>
                </div>

                <hr/>
                <div class="form-group" style="padding-top:20px ">
                    <div class="col-lg-offset-8 col-lg-5  col-sm-offset-4 col-sm-5">
                        <button type="submit" class="btn btn-success">Enregistrer votre alerte</button>
                    </div>
                </div>
            </form>

