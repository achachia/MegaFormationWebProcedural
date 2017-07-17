
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container bootstrap snippet"  style="margin-left:5%">
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-body p-t-0">
                    <div class="input-group">
                        <input type="text" id="example-input1-group2" name="example-input1-group2" class="form-control" placeholder="Search">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-effect-ripple btn-primary"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <?php foreach ($list_eleves as $value) { ?>



            <div class="col-sm-6">
                <div class="panel">
                    <div class="panel-body p-t-10">
                        <div class="media-main">
                            <a class="pull-left" href="#">
                                <img class="thumb-lg img-circle bx-s" src="<?= $value['profil_img']; ?>" alt="">
                            </a>
                            <div class="pull-right btn-group-sm">
                                <a href="<?= url_espace_formateur; ?>/index.php?module=membre&action=view_fiche_eleve&code_eleve=<?= $value['code_eleve']; ?>" class="btn btn-success tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Edit">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="#" class="btn btn-danger tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Delete">
                                    <i class="fa fa-pencil"></i>  

                                </a>
                            </div>
                            <div class="info">
                                <h4><?= $value['identite_eleve']; ?></h4>
    <!--                                <p class="text-muted">Graphics Designer</p>-->
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <a href="#" data-fiddle="<?= $value['keygen_rep']; ?>"  >Consulter la reponse</a>
                        <div class="modal fade" id="Modal_<?= $value['keygen_rep']; ?>" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title"></h4>
                                    </div>
                                    <div class="modal-body"></div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>  
    </div>
</div>
<style>


    body{
        margin-top:20px;
        background-color: #edf0f0;    
    }
    .btn-primary, 
    .btn-primary:hover, 
    .btn-primary:focus, 
    .btn-primary:active, 
    .btn-primary.active, 
    .btn-primary.focus, 
    .btn-primary:active, 
    .btn-primary:focus, 
    .btn-primary:hover, 
    .open>.dropdown-toggle.btn-primary {
        background-color: #3bc0c3;
        border: 1px solid #3bc0c3;
    }
    .p-t-10 {
        padding-top: 10px !important;
    }
    .media-main a.pull-left {
        width: 100px;
    }
    .thumb-lg {
        height: 84px;
        width: 84px;
    }
    .media-main .info {
        overflow: hidden;
        color: #000;
    }
    .media-main .info h4 {
        padding-top: 10px;
        margin-bottom: 5px;
    }
    .social-links li a {
        background: #EFF0F4;
        width: 30px;
        height: 30px;
        line-height: 30px;
        text-align: center;
        display: inline-block;
        border-radius: 50%;
        -webkit-border-radius: 50%;
        color: #7A7676;
    }
</style>

