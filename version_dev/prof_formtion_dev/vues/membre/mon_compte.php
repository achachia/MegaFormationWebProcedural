<?php include 'breadcrumb.php' ?>

<div class = "row">
    <div class="col-lg-12">
        <div class="bootstrap snippet">
            <div class="col-md-12">

                <ul class="list-group sidebar-nav-v1" id="sidebar-nav-1">
                    <li class="list-group-item">
                        <a href="index.php?module=membre&action=mon_compte&mode=consultation"><i class="fa fa-eye" aria-hidden="true"></i> Mon profil</a>
                    </li>
                    <li class="list-group-item">
                        <a href="index.php?module=membre&action=mon_compte&mode=edition"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Modifier mon profil</a>
                    </li>     
                </ul> 

                <hr>
                <?php if ($mode == 'consultation') { ?>
                    <h2 class="text-primary">Mon profil</h2>
                    <hr/>

                    <div class="row">

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12  toppad" >


                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><?= $infos_user['identite_user']; ?></h3>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="<?= $infos_user['profil_img']; ?>" class="img-circle img-responsive"> </div>


                                        <div class=" col-md-9 col-lg-9 ">
                                            <?php if ($_GET['result'] == 'succees') { ?>

                                                <div class="alert alert-success alert-white rounded">
                                                    <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
                                                    <div class="icon">
                                                        <i class="fa fa-check"></i>
                                                    </div>
                                                    <strong>Félicitation! </strong> 
                                                    Votre  profil a été mis a jour avec succées
                                                </div>
                                            <?php } ?>

                                            <table class="table table-user-information">
                                                <tbody>
                                                    <tr>
                                                        <td>Pseudo :</td>
                                                        <td  class="user_profil"><?= $infos_user['pseudo']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Email</td>
                                                        <td  class="user_profil"><?= $infos_user['email']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Date naissance</td>
                                                        <td class="user_profil"><?= $infos_user['date_naissance_view_profil']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Date inscription</td>
                                                        <td class="user_profil"><?= $infos_user['date_inscription']; ?></td>
                                                    </tr>                                              
                                                    <tr>
                                                        <td>Sex</td>
                                                        <td  class="user_profil"><?= $infos_user['sex_user']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Niveau pédagogique</td>
                                                        <td  class="user_profil"><?= $infos_user['niv_peda_user']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Inscription a newsletter</td>
                                                        <td  class="user_profil"><?= $infos_user['option_newsletter']; ?></td>
                                                    </tr>


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>                    

                            </div>
                        </div>
                    </div>

                <?php } ?>
                <?php if ($mode == 'edition') { ?>
                    <h2 class="text-primary">Modification mon profil</h2>
                    <hr/>            
                    <?php if ($_GET['result'] == 'echec') { ?>
                        <div class="alert alert-danger alert-white rounded">
                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
                            <div class="icon">
                                <i class="fa fa-times-circle"></i>
                            </div>
                            <strong>Désolé. </strong> 
                            Il y'a des erreurs dans la saisie de formmulaire.
                        </div>

                    <?php } ?>
                    <form class="form-horizontal"   enctype="multipart/form-data"  action="<?= url_espace_eleve; ?>/controleurs/membre/traitement_edit_profil.php" method="POST" name="edit_profil" id="edit_profil">
                  
                        <fieldset>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="textinput">Nom</label>  
                                <div class="col-md-8">
                                    <input id="nom_user" name="nom_user" type="text"  class="form-control input-md"  value="<?= $infos_user['nom_user']; ?>">
                                    <span class="label label-danger"  style="font-size:12px "><?= $list_erreur['nom_user']; ?></span>

                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-2 control-label" for="textinput">Prénom</label>  
                                <div class="col-md-8">
                                    <input id="prenom_user" name="prenom_user" type="text"  class="form-control input-md"  value="<?= $infos_user['prenom_user']; ?>">
                                    <span class="label label-danger"  style="font-size:12px "><?= $list_erreur['prenom_user']; ?></span>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="textinput">Pseudo</label>  
                                <div class="col-md-8">
                                    <input id="pseudo" name="pseudo" type="text"  class="form-control input-md"  value="<?= $infos_user['pseudo']; ?>">
                                    <span class="label label-danger"  style="font-size:12px "><?= $list_erreur['pseudo']; ?></span>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="filebutton">Photo profil</label>
                                <div class="col-md-8">
                                    <input id="img_user" name="img_user" class="input-file" type="file">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-2 control-label" for="textinput">Date de naissance</label>  
                                <div class="col-md-8">
                                    <input id="date_naissance" name="date_naissance" type="text"  class="flatpickr form-control input-md"   value="<?= $infos_user['date_naissance']; ?>">
                                    <span class="label label-danger"  style="font-size:12px "><?= $list_erreur['date_naissance']; ?></span>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-2 control-label" for="selectsex">Sex</label>
                                <div class="col-md-8">
                                    <select id="id_sex_user" name="id_sex_user" class="form-control">
                                        <option value="">Choisir votre sex</option>
                                        <?php foreach ($liste_sex as $value) { ?>

                                            <option value="<?= $value['id_sex']; ?>"  <?php
                                            if ($value['id_sex'] == $infos_user['id_sex_user']) {
                                                echo 'selected';
                                            }
                                            ?> > <?= $value['type_sex']; ?> </option>

                                        <?php } ?>

                                    </select>
                                    <span class="label label-danger"  style="font-size:12px "><?= $list_erreur['select_sex']; ?></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="textinput">Email</label>  
                                <div class="col-md-8">
                                    <input id="email" name="email" type="text"  class="form-control input-md"  value="<?= $infos_user['email']; ?>">
                                    <span class="label label-danger"  style="font-size:12px "><?= $list_erreur['email']; ?></span>
                                </div>
                            </div>                      

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="selectniveau">Niveau pédagogique</label>
                                <div class="col-md-8">
                                    <select id="id_niv_peda_user" name="id_niv_peda_user" class="form-control">
                                        <option value="">Choisir votre niveau scolaire</option>
                                        <?php foreach ($liste_niveaux as $value) { ?>
                                            <optgroup label="<?= $value['nom_groupe']; ?>">
                                                <?php foreach ($value['liste_niveaux'] as $value1) { ?>
                                                    <option value="<?= $value1['id_niveau']; ?>"  <?php
                                                    if ($value1['id_niveau'] == $infos_user['id_niv_peda_user']) {
                                                        echo 'selected';
                                                    }
                                                    ?> ><?= $value1['nom_niveau']; ?></option>
                                                        <?php } ?>
                                            </optgroup>
                                        <?php } ?>                                     

                                    </select>
                                    <span class="label label-danger"  style="font-size:12px "><?= $list_erreur['select_niveau']; ?></span>
                                </div>
                            </div>                    

                            <!-- Button -->
                            <div class="form-group">

                                <div class="col-md-offset-3  col-md-9">
                                    <button type="submit" id="singlebutton" name="singlebutton" class="col-md-8 btn btn-primary">VALIDER</button>
                                </div>
                            </div>


                        </fieldset>
                    </form>




                <?php } ?>
            </div>


        </div>
    </div>
</div>
