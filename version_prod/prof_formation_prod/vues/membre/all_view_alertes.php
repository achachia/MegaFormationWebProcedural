<div class="row"  style="margin-top:5%">
    <div class="btn-group" role="group">
        <a href="<?= url_espace_formateur_prod; ?>/index.php?module=membre&action=add_alerte" target="_blank">
            <button type="button" class="btn btn-primary"	>
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                Ajouter une alerte
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

    <table id="liste_alertes"   class="table"  style="width:100%;text-align:left">
        <thead>
            <tr>
                <th>IDENTIFIANT</th>
                <th>TITRE</th>
                <th>DESCRIPTION</th>
                <th>START</th>
                <th>END</th>
                <th>ETAT</th>
                <th>NOM ELEVE</th>
                <th>NOM GROUPE</th>
                <th>MODE AFFICHAGE</th>
                <th>PRIORITE</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $j = 1;
            foreach ($list_alertes as $value) {
                ?>

                <tr class="info">
                    <td><?= $value['keygen_alerte']; ?></td>
                    <td><?= $value['nom_alerte']; ?></td>
                    <td><?= $value['description_alerte']; ?></td>
                    <td><?= $value['date_start']; ?></td>
                    <td><?= $value['date_end']; ?></td>
                    <td><?= $value['etat_alerte']; ?></td>
                    <td><?= $value['identite_user']; ?></td>
                    <td><?= $value['nom_groupe']; ?></td>
                    <td><?= $value['mode_affichage']; ?></td>
                    <td><?= $value['priorite_alerte']; ?></td>
                    <td>
                        <a href="<?= url_espace_formateur; ?>/index.php?module=<?= $module; ?>&action=edit_devoir&token_devoir=<?= $value['keygen_dev']; ?>"   class="btn btn-primary">

                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            Editer l'alerte
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


