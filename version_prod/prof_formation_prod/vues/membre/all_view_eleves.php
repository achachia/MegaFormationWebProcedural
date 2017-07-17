
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
                                <img class="thumb-lg img-circle bx-s" src="<?= $value['profil_img'];   ?>" alt="">
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
                                <h4><?= $value['identite_eleve'];   ?></h4>
<!--                                <p class="text-muted">Graphics Designer</p>-->
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <ul class="social-links list-inline p-b-10">
                            <li>
                                <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="Facebook"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="Twitter"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="LinkedIn"><i class="fa fa-linkedin"></i></a>
                            </li>
                            <li>
                                <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="Skype"><i class="fa fa-skype"></i></a>
                            </li>
                            <li>
                                <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="Message"><i class="fa fa-envelope-o"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        <?php } ?>  
        <!--        <div class="col-sm-6">
                    <div class="panel">
                        <div class="panel-body p-t-10">
                            <div class="media-main">
                                <a class="pull-left" href="#">
                                    <img class="thumb-lg img-circle bx-s" src="http://bootdey.com/img/Content/user_2.jpg" alt="">
                                </a>
                                <div class="pull-right btn-group-sm">
                                    <a href="#" class="btn btn-success tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Edit">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Delete">
                                        <i class="fa fa-close"></i>
                                    </a>
                                </div>
                                <div class="info">
                                    <h4>Jonathan Smith</h4>
                                    <p class="text-muted">Graphics Designer</p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <hr>
                            <ul class="social-links list-inline p-b-10">
                                <li>
                                    <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="Facebook"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="Twitter"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="LinkedIn"><i class="fa fa-linkedin"></i></a>
                                </li>
                                <li>
                                    <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="Skype"><i class="fa fa-skype"></i></a>
                                </li>
                                <li>
                                    <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="Message"><i class="fa fa-envelope-o"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
        
        
                <div class="col-sm-6">
                    <div class="panel">
                        <div class="panel-body p-t-10">
                            <div class="media-main">
                                <a class="pull-left" href="#">
                                    <img class="thumb-lg img-circle bx-s" src="http://bootdey.com/img/Content/user_3.jpg" alt="">
                                </a>
                                <div class="pull-right btn-group-sm">
                                    <a href="#" class="btn btn-success tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Edit">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Delete">
                                        <i class="fa fa-close"></i>
                                    </a>
                                </div>
                                <div class="info">
                                    <h4>Jonathan Smith</h4>
                                    <p class="text-muted">Graphics Designer</p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <hr>
                            <ul class="social-links list-inline p-b-10">
                                <li>
                                    <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="Facebook"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="Twitter"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="LinkedIn"><i class="fa fa-linkedin"></i></a>
                                </li>
                                <li>
                                    <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="Skype"><i class="fa fa-skype"></i></a>
                                </li>
                                <li>
                                    <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="Message"><i class="fa fa-envelope-o"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
        
        
                <div class="col-sm-6">
                    <div class="panel">
                        <div class="panel-body p-t-10">
                            <div class="media-main">
                                <a class="pull-left" href="#">
                                    <img class="thumb-lg img-circle bx-s" src="http://bootdey.com/img/Content/user_1.jpg" alt="">
                                </a>
                                <div class="pull-right btn-group-sm">
                                    <a href="#" class="btn btn-success tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Edit">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Delete">
                                        <i class="fa fa-close"></i>
                                    </a>
                                </div>
                                <div class="info">
                                    <h4>Jonathan Smith</h4>
                                    <p class="text-muted">Graphics Designer</p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <hr>
                            <ul class="social-links list-inline p-b-10">
                                <li>
                                    <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="Facebook"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="Twitter"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="LinkedIn"><i class="fa fa-linkedin"></i></a>
                                </li>
                                <li>
                                    <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="Skype"><i class="fa fa-skype"></i></a>
                                </li>
                                <li>
                                    <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="Message"><i class="fa fa-envelope-o"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
        
        
                <div class="col-sm-6">
                    <div class="panel">
                        <div class="panel-body p-t-10">
                            <div class="media-main">
                                <a class="pull-left" href="#">
                                    <img class="thumb-lg img-circle bx-s" src="http://bootdey.com/img/Content/user_2.jpg" alt="">
                                </a>
                                <div class="pull-right btn-group-sm">
                                    <a href="#" class="btn btn-success tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Edit">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Delete">
                                        <i class="fa fa-close"></i>
                                    </a>
                                </div>
                                <div class="info">
                                    <h4>Jonathan Smith</h4>
                                    <p class="text-muted">Graphics Designer</p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <hr>
                            <ul class="social-links list-inline p-b-10">
                                <li>
                                    <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="Facebook"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="Twitter"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="LinkedIn"><i class="fa fa-linkedin"></i></a>
                                </li>
                                <li>
                                    <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="Skype"><i class="fa fa-skype"></i></a>
                                </li>
                                <li>
                                    <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="Message"><i class="fa fa-envelope-o"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
        
        
                <div class="col-sm-6">
                    <div class="panel">
                        <div class="panel-body p-t-10">
                            <div class="media-main">
                                <a class="pull-left" href="#">
                                    <img class="thumb-lg img-circle bx-s" src="http://bootdey.com/img/Content/user_3.jpg" alt="">
                                </a>
                                <div class="pull-right btn-group-sm">
                                    <a href="#" class="btn btn-success tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Edit">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Delete">
                                        <i class="fa fa-close"></i>
                                    </a>
                                </div>
                                <div class="info">
                                    <h4>Jonathan Smith</h4>
                                    <p class="text-muted">Graphics Designer</p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <hr>
                            <ul class="social-links list-inline p-b-10">
                                <li>
                                    <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="Facebook"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="Twitter"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="LinkedIn"><i class="fa fa-linkedin"></i></a>
                                </li>
                                <li>
                                    <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="Skype"><i class="fa fa-skype"></i></a>
                                </li>
                                <li>
                                    <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="Message"><i class="fa fa-envelope-o"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>-->
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