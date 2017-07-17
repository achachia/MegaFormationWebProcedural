<div class="row">
    <div class="col-md-12" style="margin-top:3%">

        <table class="table">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>TITRE</th>                  
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $j = 1;
                foreach ($list_themes as $value) {
                    ?>

                    <tr class="info">
                        <td><?= $j; ?></td>
                        <td><?= $value['nom_theme']; ?></td>                       
                        <td>
                            <a href="<?= url_espace_eleve; ?>/index.php?module=<?= $module;?>&action=all_view_exercices&token_theme=<?= $value['keygen_theme']; ?>"   class="btn btn-primary">

                                <i class="fa fa-eye" aria-hidden="true"></i>
                                Consulter les exercices
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
</div>




