<div class="row"  style="margin-top:5%">
    <div class="col-lg-12">     
        <ol class="breadcrumb"  style="color:blue;font-size: 20px">
            <li><a href="index.php"><i class="fa fa-home"></i></a><span class="separator"></span></li>
            <li><i class="fa fa-code" aria-hidden="true"></i><span class="separator"></span> <?= $infos_module['nom_module']; ?></li>
            <li><a href="<?= url_espace_formateur; ?>/index.php?module=<?= $module; ?>&action=all_view_devoirs"><i class="fa fa-list" aria-hidden="true"></i><span class="separator"></span> LISTE DES DEVOIRS</a></li>
            <li style="color:#831098;"> <?= $infos_dev['titre_dev']; ?></li>
            <li style="color:#831098;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> MODIFIER LA FICHE DU DEVOIR</li>
        </ol>      
    </div>    
</div>
<div class="col-md-12" style="height: 60px" ></div>
<div class="col-md-12 column">

    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 id="css_titre">
                <span class=" glyphicon glyphicon-pencil"></span> Modifier la fiche
            </h3>
        </div>
        <div class="panel-body">
      
            <?php if ($_GET['result'] == 'echec') { ?>
                <div class="alert alert-danger" role="alert">
                    <p><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                        Il y'a des erreurs dans la saisie.</p>
                </div>
            <?php } ?>
            <form class="form-horizontal" id="form_add_dev" name="form_add_dev" method="POST"   action="<?= url_espace_formateur_prod; ?>/controleurs/<?= $module; ?>/traitement_edit_dev.php">                  
                <div class="form-group"  style="padding-top:1%">
                    <label class="control-label col-lg-3 col-md-3 col-sm-4" for="titre_dev" style="color:blue;font-size:16px">Titre : <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="titre_dev"  name="titre_dev"  placeholder="Entrer un titre" value="<?= $infos_dev['titre_dev']; ?>" >
                        <span class="label label-danger"  style="font-size:12px "><?= $list_erreur['titre_dev']; ?></span>
                    </div>
                </div>
                <div class="form-group"  style="padding-top:20px ">
                    <label class="control-label col-lg-3 col-md-3 col-sm-4"  for="description_dev"  style="color:blue;font-size:16px">Description: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                    <div class="col-sm-8">
                        <textarea class="form-control" rows="8" cols="100" id="description_dev" name="description_dev" placeholder="Entrer une description"><?= $infos_dev['description_dev']; ?></textarea>
                        <span class="label label-danger"  style="font-size:12px "><?= $list_erreur['description_dev']; ?></span>

                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-3 col-md-3 col-sm-4" for="date_publication" style="color:blue;font-size:16px">Date publication : <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                    <input type="text" class="flatpickr"  data-enable-time=true data-enable-seconds=true  data-inline=true  id="date_publication"  name="date_publication"   value="<?= $infos_dev['date_publication']; ?>" >
                    <span class="label label-danger"  style="font-size:12px "><?= $list_erreur['date_publication']; ?></span>

                </div>


                <hr/>         


                <input type="hidden"   value="<?= $keygen_devoir; ?>"   name="token_dev"    id="token_dev">
                 <input type="hidden"   value="<?= $module; ?>"   name="nom_module"    id="nom_module">
               

                <hr/>
                <div class="form-group" >
                    <div class="col-lg-offset-8 col-lg-12   col-sm-12">
                        <button type="submit" class="btn btn-success">Modifier la fiche</button>
                    </div>
                </div>
            </form>



