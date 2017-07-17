<div class="row"  style="margin-top:5%">
    <div class="col-lg-12">     
        <ol class="breadcrumb"  style="color:blue;font-size: 20px">
            <li><a href="index.php"><i class="fa fa-home"></i></a><span class="separator"></span></li>
            <li><i class="fa fa-code" aria-hidden="true"></i><span class="separator"></span> <?= $infos_module['nom_module']; ?></li>
            <li  style="color:#831098;"><i class="fa fa-list" aria-hidden="true"></i><span class="separator"></span> LISTE DES DEVOIRS</li>

        </ol>      
    </div>    
</div>
<div class="row"  style="margin-top:5%">
    <div class="btn-group" role="group">
        <a href="<?= url_espace_formateur_prod; ?>/index.php?module=<?= $module; ?>&action=add_devoir">
            <button type="button" class="btn btn-primary"	>
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                Ajouter un nouveau devoir
            </button>
        </a>
    </div>
</div>
<div class="row"  style="margin-top:5%">
    <?php if ($_GET['result'] == 'succees') { ?>
        <div class="alert alert-success" role="alert">
            <p><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                La fiche a été enregistré avec succès</p>
        </div>
    <?php } ?>

    <table class="table"  style="width:100%;text-align:left">
        <thead>
            <tr>
                <th>N°</th>
                <th>TITRE</th>
                <th>DATE LIMITE DEPOT</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $j = 1;
            foreach ($list_devoirs as $value) {
                ?>

                <tr class="info">
                    <td><?= $j; ?></td>
                    <td><?= $value['titre_dev']; ?></td>
                    <td><?= $value['date_limite_depot']; ?></td>
                    <td>
                        <a href="<?= url_espace_formateur; ?>/index.php?module=<?= $module; ?>&action=edit_devoir&token_devoir=<?= $value['keygen_dev']; ?>"   class="btn btn-primary">

                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            Editer la fiche
                        </a>
                        <a href="<?= url_espace_formateur; ?>/index.php?module=<?= $module; ?>&action=add_liaison_devoir_user&token_devoir=<?= $value['keygen_dev']; ?>"   class="btn btn-primary">

                            <i class="fa fa-plus" aria-hidden="true"></i>
                            Ajouter une liaison groupe | user
                        </a>
                        <a href="<?= url_espace_formateur; ?>/index.php?module=<?= $module; ?>&action=add_exo_devoir&token_devoir=<?= $value['keygen_dev']; ?>"   class="btn btn-primary">

                            <i class="fa fa-plus" aria-hidden="true"></i>
                            Ajouter un exercice
                        </a>
                        <a href="<?= url_espace_formateur; ?>/index.php?module=<?= $module; ?>&action=all_view_exo_devoir&token_devoir=<?= $value['keygen_dev']; ?>"   class="btn btn-primary">

                            <i class="fa fa-list" aria-hidden="true"></i>
                            La liste des exercices
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

