<div class="row"  style="margin-top:5%">
    <div class="col-lg-12">     
        <ol class="breadcrumb"  style="color:blue;font-size: 20px">
            <li><a href="index.php"><i class="fa fa-home"></i></a><span class="separator"></span></li>
            <li><i class="fa fa-code" aria-hidden="true"></i><span class="separator"></span> <?= $infos_module['nom_module']; ?></li>
            <li  style="color:#831098;"><i class="fa fa-list" aria-hidden="true"></i><span class="separator"></span> LISTE DES THEMES</li>
          
        </ol>      
    </div>    
</div>
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
                            <a href="<?= url_espace_formateur; ?>/index.php?module=<?= $module; ?>&action=view_exos_theme&token_theme=<?= $value['keygen_theme']; ?>"   class="btn btn-primary">

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




