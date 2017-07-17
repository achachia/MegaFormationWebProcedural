<div class="row"  style="margin-top:5%"> 
    <div class="col-lg-12">     
        <ol class="breadcrumb"  style="color:blue;font-size: 20px">
            <li><a href="index.php"><i class="fa fa-home"></i></a><span class="separator"></span></li>
            <li><i class="fa fa-code" aria-hidden="true"></i><span class="separator"></span> HTML</li>
            <li><a href="<?= url_espace_formateur; ?>/index.php?module=HTML&action=all_view_fiches_cours"><i class="fa fa-list" aria-hidden="true"></i><span class="separator"></span> LISTE DES FICHES DE COURS</a></li>
            <li style="color:#831098;">  <?= $infos_cours['titre_cours']; ?></li>
        </ol>      
    </div>    
</div>
<div class="row" style="margin-top: 5%" >
    
    <div class="row" style="margin-top: 3%" >
        <iframe src="<?= url_fiches_cours . '/' . $infos_cours['url_cours']; ?>" height="1000px" width="100%"></iframe>       

    </div>
</div>
