

    <div class="row">
        <div class="col-md-12">
               <h2>Les Cours : </h2>
            <hr/>
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
                    <?php $j = 1;
                    foreach ($list_fiches_cours_html as $value) {
                        ?> 
                        <tr class="active"> 
                            <td>
    <?= $j; ?>
                            </td>
                            <td>
                                <h4><a href="<?= url_espace_eleve; ?>/index.php?module=HTML&action=view_fiche_cours&id_fiche=<?= $value['id_fiche'] ?>"><?= $value['titre']; ?></a></h4>
                            </td>

                        </tr>
                        <?php ++$j;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

    <div class="row">
        <div class="col-md-12">
            <h2>Les Dossiers de travail : </h2>
            <hr/>
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            Le cours 
                        </th>
                        <th>
                            Telecharger
                        </th>

                    </tr>
                </thead>
                <tbody>

                    <tr class="active"> 
                        <td>
                            1. Les Liens
                        </td>
                        <td>
                            <h4><a href="<?= url_fiches_cours; ?>/Les_liens_html.rar">Telecharger le dossier</a></h4>
                        </td>

                    </tr>
                    <tr class="active"> 
                        <td>
                            2. Les images
                        </td>
                        <td>
                            <h4><a href="<?= url_fiches_cours; ?>/images_html.rar">Telecharger le dossier</a></h4>
                        </td>

                    </tr>
                    <tr class="active"> 
                        <td>
                            3. Les ancres
                        </td>
                        <td>
                            <h4><a href="<?= url_fiches_cours; ?>/Les_ancres_html.rar">Telecharger le dossier</a></h4>
                        </td>

                    </tr>

                </tbody>
            </table>
        </div>
    </div>



