
<div class="row"  style="margin-top:5%">
    <div class="col-lg-12">     
        <ol class="breadcrumb"  style="color:blue;font-size: 20px">
            <li><a href="index.php"><i class="fa fa-home"></i></a><span class="separator"></span></li>
            <li><i class="fa fa-code" aria-hidden="true"></i><span class="separator"></span> <?= $infos_module['nom_module']; ?></li>
            <li><a href="<?= url_espace_formateur; ?>/index.php?module=<?= $module; ?>&action=all_view_modules"><i class="fa fa-list" aria-hidden="true"></i><span class="separator"></span> LISTE DES MODULES</a></li>
            <li style="color:#831098;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> AJOUTER UNE LIAISON THEME|GROUPE|USER</li>
        </ol>      
    </div>    
</div>
<div class="col-md-12" style="height: 60px" ></div>
<div class="row"  style="margin-top:5%">
    <?php if ($_GET['result'] == 'succees') { ?>
        <div class="alert alert-success" role="alert">
            <p><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                La fiche de liaison a été enregistré avec succès</p>
        </div>
    <?php } ?>
    <?php if ($_GET['result'] == 'echec') { ?>
        <div class="alert alert-danger" role="alert">
            <p><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                Il y'a des erreurs dans la saisie.</p>
        </div>
    <?php } ?>
    <table id="liste_liaisons_theme" class="table"  style="width:100%;text-align:left">
        <thead>
            <tr>
                <th>N°</th>
                <th>IDENTIFIANT</th>
                <th>NOM</th>
                <th>ACTION</th>
            </tr>
        </thead>

        <tbody>

            <?php
            $j = 1;
            foreach ($list_liaisons_theme as $value) {
                ?>



                <tr class="info">
                    <td><?= $j; ?></td>
                    <td><?= $value['keygen_liaison']; ?></td>
                    <td></td>
                    <td>
                        <a href="<?= url_espace_formateur; ?>/index.php?module=<?= $module; ?>&action=edit_liaison_theme_user&token_module=<?= $keygen_dev; ?>&token_liaison=<?= $value['keygen_liaison']; ?>"   class="btn btn-primary">

                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            Modifier une liaison groupe | user
                        </a>

                    </td>

                </tr>




                <?php
                ++$j;
            }
            ?>
        </tbody>
    </table>

</div>
<div class="col-md-12" style="height: 60px" ></div>
<div class="col-md-8 column">

    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 id="css_titre">
                <span class=" glyphicon glyphicon-pencil"></span> Création une nouvelle liaison  theme - groupe | user
            </h3>
        </div>
        <div class="panel-body">
            <?php if ($_GET['result'] == 'succees') { ?>
                <div class="alert alert-success" role="alert">
                    <p><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                        Le thème a été enregistré avec succès</p>
                </div>
            <?php } ?>
            <?php if ($_GET['result'] == 'echec') { ?>
                <div class="alert alert-danger" role="alert">
                    <p><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                        Il y'a des erreurs dans la saisie.</p>
                </div>
            <?php } ?>
            <form class="form-horizontal" id="form_add_liaison_theme_user" name="form_add_liaison_theme_user" method="POST"   action="<?= url_espace_formateur_prod; ?>/controleurs/<?= $module; ?>/traitement_add_liaison_theme_user.php">                  


                <div class="form-group">
                    <label class="control-label col-lg-3 col-md-3 col-sm-4" for="date_publication_user" style="color:blue;font-size:16px">Date publication (groupe|user): <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                    <input type="text" class="flatpickr"  data-enable-time=true data-enable-seconds=true  data-inline=true  id="date_publication_user"  name="date_publication_user"   value="<?= $infos_liaison['date_publication_user']; ?>" >
                    <span class="label label-danger"  style="font-size:12px "><?= $list_erreur['date_publication_user']; ?></span>

                </div>       


                <div class="form-group  col-md-10" style="padding-top:20px ">
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




                <input type="hidden"   value="<?= $keygen_theme; ?>"   name="token_theme"    id="token_theme">
                <input type="hidden"   value="<?= $module; ?>"   name="nom_module"    id="nom_module">

                <hr/>
                <div class="form-group" style="padding-top:20px ">
                    <div class="col-lg-offset-8 col-lg-5  col-sm-offset-4 col-sm-5">
                        <button type="submit" class="btn btn-success">Enregistrer votre liaison</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
