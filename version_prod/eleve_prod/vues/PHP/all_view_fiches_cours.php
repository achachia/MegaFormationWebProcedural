

    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            N° 
                        </th>
                        <th>
                            Le titre
                        </th>
                    
                    </tr>
                </thead>
                <tbody>
                   <?php $j=1; foreach ($list_fiches_cours_php as $value) { ?> 
                    <tr class="active">
                        <td>
                           <?= $j; ?>
                        </td>
                        <td>
                            <h4><a href="<?= url_espace_eleve; ?>/index.php?module=PHP&action=view_fiche_cours&id_fiche=<?= $value['id_fiche'] ?>"><?= $value['titre']; ?></a></h4>
                        </td>
                      
                    </tr>
                <?php  ++$j;} ?>
                </tbody>
            </table>
        </div>
    </div>

