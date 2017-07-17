<div class="row"  style="margin-top:5%">
    <div class="col-lg-12">     
        <ol class="breadcrumb"  style="color:blue;font-size: 20px">
            <li><a href="index.php"><i class="fa fa-home"></i></a><span class="separator"></span></li>
            <li><i class="fa fa-code" aria-hidden="true"></i><span class="separator"></span> JAVA</li>
            <li  style="color:#831098;"><i class="fa fa-list" aria-hidden="true"></i><span class="separator"></span> LISTE DES FICHES DES COURS</li>
          
        </ol>      
    </div>    
</div>

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
                   <?php $j=1; foreach ($list_fiches_cours_java as $value) { ?> 
                    <tr class="active">
                        <td>
                           <?= $j; ?>
                        </td>
                        <td>
                            <h4><a href="<?= url_espace_formateur; ?>/index.php?module=JAVA&action=view_fiche_cours&id_fiche=<?= $value['id_fiche'] ?>"><?= $value['titre']; ?></a></h4>
                        </td>
                      
                    </tr>
                <?php  ++$j;} ?>
                </tbody>
            </table>
        </div>
    </div>

