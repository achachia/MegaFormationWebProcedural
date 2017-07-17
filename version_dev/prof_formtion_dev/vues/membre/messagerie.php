
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Espace Eleves</h1>

        <ol class="breadcrumb">
            <li><a href="default.aspx"><i class="fa fa-home"></i></a><span class="separator"></span></li>
            <li class="active">Accueil</li>
        </ol>      
    </div>

</div>
<?php include './vues/side_bare_left.php'; ?>
<div class="container bootstrap snippets">
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <!--mail inbox start-->
                <div class="mail-box">
                    <aside class="sm-side">
                        <div class="user-head">
                            <a href="javascript:;" class="inbox-avatar">
                                <img src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="" class="img-responsive">
                            </a>
                            <div class="user-name">
                                <h5><a href="#">Jonathan Smith</a></h5>
                                <span><a href="#">jsmith@gmail.com</a></span>
                            </div>
                            <a href="javascript:;" class="mail-dropdown pull-right">
                                <i class="fa fa-chevron-down"></i>
                            </a>
                        </div>

                        <div class="row">
                            <div class="col-sm-12"  style="margin-top:30px;">
                                <a href="mail-compose.html" class="btn btn-danger btn-block btn-compose-email">Rediger un nouveau message</a>
                                <ul class="nav nav-pills nav-stacked nav-email shadow mb-20">
                                    <li class="active">
                                        <a href="#mail-inbox.html">
                                            <i class="fa fa-inbox"></i> Boite de réception  <span class="label pull-right">7</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#mail-compose.html"><i class="fa fa-envelope-o"></i> Envoyés</a>
                                    </li>                              
                                    <li><a href="#"> <i class="fa fa-trash-o"></i> Corbeille</a></li>
                                </ul><!-- /.nav -->


                            </div>
                        </div>


                    </aside>
                    <aside class="lg-side">
                        <div class="inbox-head">

                            <form class="pull-right position" action="#">
                                <div class="input-append">
                                    <input type="text" placeholder="Search Mail" class="sr-input">
                                    <button type="button" class="btn sr-btn" data-original-title="" title=""><i class="fa fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-12 col-sm-12" style="margin-top:30px;">
                            <div class="panel rounded shadow panel-teal">

                                <div class="panel-sub-heading inner-all">
                                    <div class="pull-left">
                                        <ul class="list-inline no-margin">
                                            <li>
                                                <div class="ckbox ckbox-theme">
                                                    <input id="checkbox-group" type="checkbox" class="mail-group-checkbox">
                                                    <label for="checkbox-group"></label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                                        Tous <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a href="#">None</a></li>
                                                        <li><a href="#">Read</a></li>
                                                        <li><a href="#">Unread</a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="btn-group">
                                                    <button class="btn btn-default btn-sm tooltips" type="button" data-toggle="tooltip" data-container="body" title="" data-original-title="Archive"><i class="fa fa-inbox"></i></button>                                               
                                                    <button class="btn btn-default btn-sm tooltips" type="button" data-toggle="tooltip" data-container="body" title="" data-original-title="Delete"><i class="fa fa-trash-o"></i></button>
                                                </div>
                                            </li>
                                            <li class="hidden-xs">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default btn-sm">...Plus</button>
                                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                                        <span class="caret"></span>
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a href="#"><i class="fa fa-edit"></i> Mark as read</a></li>
                                                        <li><a href="#"><i class="fa fa-ban"></i> Spam</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="#"><i class="fa fa-trash-o"></i> Delete</a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                <div class="clearfix"></div>
                                </div><!-- /.panel-sub-heading -->
                                <div class="panel-body no-padding">

                                    <div class="table-responsive">
                                        <table class="table table-hover table-email">
                                            <tbody>
                                                <tr class="unread selected">
                                                    <td>
                                                        <div class="ckbox ckbox-theme">
                                                            <input id="checkbox1" type="checkbox" checked="checked" class="mail-checkbox">
                                                            <label for="checkbox1"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="star star-checked"><i class="fa fa-star"></i></a>
                                                    </td>
                                                    <td>
                                                        <div class="media">
                                                            <a href="#" class="pull-left">
                                                                <img alt="..." src="http://bootdey.com/img/Content/avatar/avatar1.png" class="media-object">
                                                            </a>
                                                            <div class="media-body">
                                                                <h4 class="text-primary">John Kribo</h4>
                                                                <p class="email-summary"><strong>Commits pushed</strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit... <span class="label label-success">New</span> </p>
                                                                <span class="media-meta">Today at 6:16am</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="ckbox ckbox-theme">
                                                            <input id="checkbox2" type="checkbox" class="mail-checkbox">
                                                            <label for="checkbox2"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="star"><i class="fa fa-star"></i></a>
                                                    </td>
                                                    <td>
                                                        <div class="media">
                                                            <a href="#" class="pull-left">
                                                                <img alt="..." src="http://bootdey.com/img/Content/avatar/avatar2.png" class="media-object">
                                                            </a>
                                                            <div class="media-body">
                                                                <h4 class="text-primary">Jennifer Poiyem</h4>
                                                                <p class="email-summary"><strong>Send you gift</strong> Sed do eiusmod tempor incididunt...<span class="label label-success">New</span> </p>
                                                                <span class="media-meta">Today at 1:13am</span>
                                                                <span class="media-attach"><i class="fa fa-paperclip"></i></span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="unread">
                                                    <td>
                                                        <div class="ckbox ckbox-theme">
                                                            <input id="checkbox3" type="checkbox" checked="checked" class="mail-checkbox">
                                                            <label for="checkbox3"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="star star-checked"><i class="fa fa-star"></i></a>
                                                    </td>
                                                    <td>
                                                        <div class="media">
                                                            <a href="#" class="pull-left">
                                                                <img alt="..." src="http://bootdey.com/img/Content/avatar/avatar3.png" class="media-object">
                                                            </a>
                                                            <div class="media-body">
                                                                <h4 class="text-primary">Clara Wati</h4>
                                                                <p class="email-summary"><strong>Follow you</strong> Ut enim ad minim veniam, quis nostrud exercitation... </p>
                                                                <span class="media-meta">Jul 02</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="ckbox ckbox-theme">
                                                            <input id="checkbox4" type="checkbox" class="mail-checkbox">
                                                            <label for="checkbox4"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="star"><i class="fa fa-star"></i></a>
                                                    </td>
                                                    <td>
                                                        <div class="media">
                                                            <a href="#" class="pull-left">
                                                                <img alt="..." src="http://bootdey.com/img/Content/avatar/avatar4.png" class="media-object">
                                                            </a>
                                                            <div class="media-body">
                                                                <h4 class="text-primary">Toni Mriang</h4>
                                                                <p class="email-summary"><strong>Check out new template</strong> Laboris nisi ut aliquip ex ea commodo consequat... <span class="label label-warning">Urgent</span></p>
                                                                <span class="media-meta">Jul 02</span>
                                                                <span class="media-attach"><i class="fa fa-paperclip"></i><i class="fa fa-share"></i></span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="selected">
                                                    <td>
                                                        <div class="ckbox ckbox-theme">
                                                            <input id="checkbox5" type="checkbox" checked="checked" class="mail-checkbox">
                                                            <label for="checkbox5"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="star star-checked"><i class="fa fa-star"></i></a>
                                                    </td>
                                                    <td>
                                                        <div class="media">
                                                            <a href="#" class="pull-left">
                                                                <img alt="..." src="http://bootdey.com/img/Content/avatar/avatar5.png" class="media-object">
                                                            </a>
                                                            <div class="media-body">
                                                                <h4 class="text-primary">Bella negoro</h4>
                                                                <p class="email-summary"><strong>Monthly sales report</strong> Excepteur sint occaecat cupidatat non proident... </p>
                                                                <span class="media-meta">Jul 02</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="unread">
                                                    <td>
                                                        <div class="ckbox ckbox-theme">
                                                            <input id="checkbox6" type="checkbox" class="mail-checkbox">
                                                            <label for="checkbox6"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="star"><i class="fa fa-star"></i></a>
                                                    </td>
                                                    <td>
                                                        <div class="media">
                                                            <a href="#" class="pull-left">
                                                                <img alt="..." src="http://bootdey.com/img/Content/avatar/avatar6.png" class="media-object">
                                                            </a>
                                                            <div class="media-body">
                                                                <h4 class="text-primary">Kim Mbako</h4>
                                                                <p class="email-summary"><strong>1 New job</strong> Sed ut perspiciatis unde omnis iste natus error sit voluptatem... <span class="label label-danger">Promotion</span></p>
                                                                <span class="media-meta">Jul 01</span>
                                                                <span class="media-attach"><i class="fa fa-paperclip"></i></span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="ckbox ckbox-theme">
                                                            <input id="checkbox7" type="checkbox" class="mail-checkbox">
                                                            <label for="checkbox7"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="star"><i class="fa fa-star"></i></a>
                                                    </td>
                                                    <td>
                                                        <div class="media">
                                                            <a href="#" class="pull-left">
                                                                <img alt="..." src="http://bootdey.com/img/Content/avatar/avatar6.png" class="media-object">
                                                            </a>
                                                            <div class="media-body">
                                                                <h4 class="text-primary">Pack Suparman</h4>
                                                                <p class="email-summary"><strong>You sold a item!</strong> Ut enim ad minim veniam, quis nostrud exercitation... </p>
                                                                <span class="media-meta">Jul 01</span>
                                                                <span class="media-attach"><i class="fa fa-users"></i></span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="ckbox ckbox-theme">
                                                            <input id="checkbox8" type="checkbox" class="mail-checkbox">
                                                            <label for="checkbox8"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="star"><i class="fa fa-star"></i></a>
                                                    </td>
                                                    <td>
                                                        <div class="media">
                                                            <a href="#" class="pull-left">
                                                                <img alt="..." src="http://bootdey.com/img/Content/avatar/avatar6.png" class="media-object">
                                                            </a>
                                                            <div class="media-body">
                                                                <h4 class="text-primary">Jeddy Mentri</h4>
                                                                <p class="email-summary"><strong>IOS Developer</strong> Ut enim ad minim veniam, quis nostrud exercitation... </p>
                                                                <span class="media-meta">Jun 25</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="ckbox ckbox-theme">
                                                            <input id="checkbox9" type="checkbox" class="mail-checkbox">
                                                            <label for="checkbox9"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="star"><i class="fa fa-star"></i></a>
                                                    </td>
                                                    <td>
                                                        <div class="media">
                                                            <a href="#" class="pull-left">
                                                                <img alt="..." src="http://bootdey.com/img/Content/avatar/avatar1.png" class="media-object">
                                                            </a>
                                                            <div class="media-body">
                                                                <h4 class="text-primary">Daddy Botak</h4>
                                                                <p class="email-summary"><strong>User interface Status</strong> Ut enim ad minim veniam, quis nostrud exercitation... </p>
                                                                <span class="media-meta">Jun 23</span>
                                                                <span class="media-attach"><i class="fa fa-paperclip"></i></span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="unread">
                                                    <td>
                                                        <div class="ckbox ckbox-theme">
                                                            <input id="checkbox10" type="checkbox" class="mail-checkbox">
                                                            <label for="checkbox10"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="star"><i class="fa fa-star"></i></a>
                                                    </td>
                                                    <td>
                                                        <div class="media">
                                                            <a href="#" class="pull-left">
                                                                <img alt="..." src="http://bootdey.com/img/Content/avatar/avatar6.png" class="media-object">
                                                            </a>
                                                            <div class="media-body">
                                                                <h4 class="text-primary">Sarah Tingting</h4>
                                                                <p class="email-summary"><strong>Java Developer + 2 new jobs</strong> Nemo enim ipsam voluptatem quia voluptas sit aspernatur... </p>
                                                                <span class="media-meta">Jun 05</span>
                                                                <span class="media-attach"><i class="fa fa-warning"></i></span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div><!-- /.table-responsive -->

                                </div><!-- /.panel-body -->
                            </div><!-- /.panel -->
                        </div>
                    </aside>
                </div>
            </div>

        </div>
        <!--mail inbox end-->
    </div>
</div>
</div>
</div>
<style>
    .mail-box {
        border-collapse: collapse;
        border-spacing: 0;
        display: table;
        table-layout: fixed;
        width: 100%;
    }

    .mail-box aside {
        display: table-cell;
        float: none;
        height: 100%;
        padding: 0;
        vertical-align: top;
    }

    .mail-box .sm-side {
        width: 25%;
        background: #ecf0f1;
        border-radius: 4px 0 0 4px;
        -webkit-border-radius: 4px 0 0 4px;
    }


    .mail-box .sm-side .user-head {
        background: #2980b9;
        border-radius: 4px 0px 0px 0;
        -webkit-border-radius: 4px 0px 0px 0;
        padding: 10px;
        color: #fff;
        min-height: 80px;
    }

    .user-head .inbox-avatar {
        width: 65px;
        float: left;
    }

    .user-head .inbox-avatar img {
        border-radius: 4px;
        -webkit-border-radius: 4px;
    }
    .user-head .user-name {
        display: inline-block;
        margin:0 0 0 10px;
    }

    .user-head .user-name h5 {
        font-size: 14px;
        margin-top: 15px;
        margin-bottom: 0;
        font-weight: 300;
    }
    .user-head .user-name h5 a {
        color: #fff;
    }

    .user-head .user-name span a {
        font-size: 12px;
        color: #87e2e7;
    }

    a.mail-dropdown {
        background: #1abc9c;
        padding:3px 5px;
        font-size: 10px;
        color: #ddd;
        border-radius: 2px;
        margin-top: 20px;
    }
    .mail-box .lg-side {
        width: 75%;
        background: #fff;
        border-radius: 0px 4px 4px 0;
        -webkit-border-radius: 0px 4px 4px 0;
    }


    .inbox-body {
        padding: 20px;
    }

    .btn-compose {
        background: #9b59b6;
        padding: 12px 0;
        text-align: center;
        width: 100%;
        color: #fff;
    }
    .btn-compose:hover {
        background: #8e44ad;
        color: #fff;
    }

    ul.inbox-nav  {
        display: inline-block;
        width: 100%;
        margin: 0;
        padding: 0;
    }

    .inbox-divider {
        border-bottom: 1px solid #d5d8df;
    }



    .inbox-head {
        padding:20px;
        background: #3498db;
        color: #fff;
        border-radius: 0 4px 0 0;
        -webkit-border-radius: 0 4px 0 0;
        min-height: 80px;
    }

    .inbox-head  h3 {
        margin: 0;
        display: inline-block;
        padding-top: 6px;
        font-weight: 300;
    }

    .inbox-head  .sr-input {
        height: 40px;
        border: none;
        box-shadow: none;
        padding: 0 10px;
        float: left;
        border-radius: 4px 0 0 4px;
        color: #8a8a8a;
    }
    .inbox-head  .sr-btn {
        height: 40px;
        border: none;
        background: #2980b9;
        color: #fff;
        padding: 0 20px;
        border-radius: 0 4px 4px 0;
        -webkit-border-radius: 0 4px 4px 0;
    }

</style>
<style>
    body{margin-top:20px;
         background:#eee;
    }

    .btn-compose-email {
        padding: 10px 0px;
        margin-bottom: 20px;
    }

    .btn-danger {
        background-color: #E9573F;
        border-color: #E9573F;
        color: white;
    }

    .panel-teal .panel-heading {
        background-color: #37BC9B;
        border: 1px solid #36b898;
        color: white;
    }

    .panel .panel-heading {
        padding: 5px;
        border-top-right-radius: 3px;
        border-top-left-radius: 3px;
        border-bottom: 1px solid #DDD;
        -moz-border-radius: 0px;
        -webkit-border-radius: 0px;
        border-radius: 0px;
    }

    .panel .panel-heading .panel-title {
        padding: 10px;
        font-size: 17px;
    }

    form .form-group {
        position: relative;
        margin-left: 0px !important;
        margin-right: 0px !important;
    }

    .inner-all {
        padding: 10px;
    }

    /* ========================================================================
     * MAIL
     * ======================================================================== */
    .nav-email > li:first-child + li:active {
        margin-top: 0px;
    }
    .nav-email > li + li {
        margin-top: 1px;
    }
    .nav-email li {
        background-color: white;
    }
    .nav-email li.active {
        background-color: transparent;
    }
    .nav-email li.active .label {
        background-color: white;
        color: black;
    }
    .nav-email li a {
        color: black;
        -moz-border-radius: 0px;
        -webkit-border-radius: 0px;
        border-radius: 0px;
    }
    .nav-email li a:hover {
        background-color: #EEEEEE;
    }
    .nav-email li a i {
        margin-right: 5px;
    }
    .nav-email li a .label {
        margin-top: -1px;
    }

    .table-email tr:first-child td {
        border-top: none;
    }
    .table-email tr td {
        vertical-align: top !important;
    }
    .table-email tr td:first-child, .table-email tr td:nth-child(2) {
        text-align: center;
        width: 35px;
    }
    .table-email tr.unread, .table-email tr.selected {
        background-color: #EEEEEE;
    }
    .table-email .media {
        margin: 0px;
        padding: 0px;
        position: relative;
    }
    .table-email .media h4 {
        margin: 0px;
        font-size: 14px;
        line-height: normal;
    }
    .table-email .media-object {
        width: 35px;
        -moz-border-radius: 2px;
        -webkit-border-radius: 2px;
        border-radius: 2px;
    }
    .table-email .media-meta, .table-email .media-attach {
        font-size: 11px;
        color: #999;
        position: absolute;
        right: 10px;
    }
    .table-email .media-meta {
        top: 0px;
    }
    .table-email .media-attach {
        bottom: 0px;
    }
    .table-email .media-attach i {
        margin-right: 10px;
    }
    .table-email .media-attach i:last-child {
        margin-right: 0px;
    }
    .table-email .email-summary {
        margin: 0px 110px 0px 0px;
    }
    .table-email .email-summary strong {
        color: #333;
    }
    .table-email .email-summary span {
        line-height: 1;
    }
    .table-email .email-summary span.label {
        padding: 1px 5px 2px;
    }
    .table-email .ckbox {
        line-height: 0px;
        margin-left: 8px;
    }
    .table-email .star {
        margin-left: 6px;
    }
    .table-email .star.star-checked i {
        color: goldenrod;
    }

    .nav-email-subtitle {
        font-size: 15px;
        text-transform: uppercase;
        color: #333;
        margin-bottom: 15px;
        margin-top: 30px;
    }

    .compose-mail {
        position: relative;
        padding: 15px;
    }
    .compose-mail textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #DDD;
    }

    .view-mail {
        padding: 10px;
        font-weight: 300;
    }

    .attachment-mail {
        padding: 10px;
        width: 100%;
        display: inline-block;
        margin: 20px 0px;
        border-top: 1px solid #EFF2F7;
    }
    .attachment-mail p {
        margin-bottom: 0px;
    }
    .attachment-mail a {
        color: #32323A;
    }
    .attachment-mail ul {
        padding: 0px;
    }
    .attachment-mail ul li {
        float: left;
        width: 200px;
        margin-right: 15px;
        margin-top: 15px;
        list-style: none;
    }
    .attachment-mail ul li a.atch-thumb img {
        width: 200px;
        margin-bottom: 10px;
    }
    .attachment-mail ul li a.name span {
        float: right;
        color: #767676;
    }

    @media (max-width: 640px) {
        .compose-mail-wrapper .compose-mail {
            padding: 0px;
        }
    }
    @media (max-width: 360px) {
        .mail-wrapper .panel-sub-heading {
            text-align: center;
        }
        .mail-wrapper .panel-sub-heading .pull-left, .mail-wrapper .panel-sub-heading .pull-right {
            float: none !important;
            display: block;
        }
        .mail-wrapper .panel-sub-heading .pull-right {
            margin-top: 10px;
        }
        .mail-wrapper .panel-sub-heading img {
            display: block;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 10px;
        }
        .mail-wrapper .panel-footer {
            text-align: center;
        }
        .mail-wrapper .panel-footer .pull-right {
            float: none !important;
            margin-left: auto;
            margin-right: auto;
        }
        .mail-wrapper .attachment-mail ul {
            padding: 0px;
        }
        .mail-wrapper .attachment-mail ul li {
            width: 100%;
        }
        .mail-wrapper .attachment-mail ul li a.atch-thumb img {
            width: 100% !important;
        }
        .mail-wrapper .attachment-mail ul li .links {
            margin-bottom: 20px;
        }

        .compose-mail-wrapper .search-mail input {
            width: 130px;
        }
        .compose-mail-wrapper .panel-sub-heading {
            padding: 10px 7px;
        }
    }



</style>