

<div class="row" style="text-align: center;">
    <div class="col-lg-6">

        <?php if (sizeof($liste_alertes_user_home) > 0) { ?>
            <div class="panel panel-primary">
                <div class="panel-heading"><h3 class="panel-title">NOTIFICATIONS</h3></div>
                <div class="panel-body">
                    <?php
                    $j = 1;

                    foreach ($liste_alertes_user_home as $value) {
                        ?>
                        <div class="alert <?= $value['class_alerte']; ?>">
                            <strong class="default"><?= $value['class_icone']; ?> <?= $value['nom_alerte']; ?>,</strong><?= $value['description']; ?>
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        </div>                
                        <?php
                        ++$j;
                    }
                    ?>
                </div>


            </div>
        <?php } ?>

        <div class="panel panel-primary">
            <div class="panel-heading"><h3 class="panel-title">FLASH INFOS</h3></div>
            <div class="panel-body">
                <div class="row">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="mini-stat clearfix bg-facebook rounded">
                                <span class="mini-stat-icon"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                                <div class="mini-stat-info">
                                    <span><?= $_SESSION ['membre'] ['total_messages']; ?></span>
                                    Messages
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="mini-stat clearfix bg-twitter rounded">
                                <span class="mini-stat-icon"><i class="fa fa-commenting-o" aria-hidden="true"  style="color:red"></i></span>
                                <div class="mini-stat-info">
                                    <span><?= $nbr_notifications_non_lus; ?></span>
                                    Notifications
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="mini-stat clearfix bg-googleplus rounded">
                                <span class="mini-stat-icon"><i class="fa fa-university" aria-hidden="true"></i></span>
                                <div class="mini-stat-info">
                                    <span><?= $_SESSION ['membre'] ['total_points']; ?></span>
                                    TOTAL POINTS
                                </div>
                            </div>
                        </div>
                        <!--                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                                    <div class="mini-stat clearfix bg-bitbucket rounded">
                                                        <span class="mini-stat-icon"><i class="fa fa-bitbucket fg-bitbucket"></i></span>
                                                        <div class="mini-stat-info">
                                                            <span>8,932</span>
                                                            Repository
                                                        </div>
                                                    </div>
                                                </div>        -->
                    </div>
                </div>
            </div>


        </div>
        <div class="panel panel-primary">
            <div class="panel-heading"><h3 class="panel-title">UN APERCU GENERALE </h3></div>
            <div class="panel-body">
                <div class="row">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="mini-stat clearfix bg-facebook rounded">
                                <span class="mini-stat-genrale">HTML</span><br/><br/><br/>
                                <div class="mini-stat-info">
                                    <?= $nbr_exo_html_non_effectue; ?> Exercices non effectués

                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="mini-stat clearfix bg-facebook rounded">
                                <span class="mini-stat-genrale">CSS</span><br/><br/><br/>
                                <div class="mini-stat-info">
                                    <?= $nbr_exo_css_non_effectue; ?> Exercices non effectués

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="mini-stat clearfix bg-facebook rounded">
                                <span class="mini-stat-genrale">JS</span><br/><br/><br/>
                                <div class="mini-stat-info">
                                    <?= $nbr_exo_js_non_effectue; ?> Exercices non effectués

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="mini-stat clearfix bg-facebook rounded">
                                <span class="mini-stat-genrale">JAVA</span><br/><br/><br/>
                                <div class="mini-stat-info">
                                    <?= $nbr_exo_java_non_effectue; ?> Exercices non effectués

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </div>

        <div class="panel panel-primary">
            <div class="panel-heading"><h3 class="panel-title">SUIVEZ NOTRE ACTUALITE</h3></div>
            <div class="panel-body">
                <div class="row">
                    <div class="row">
                        <div class="col-lg-offset-3  col-lg-6">
                            <a href="https://www.facebook.com/abdel.maths" class="social-icon-lg si-border si-border-round si-facebook"  target="_blank">
                                <i class="fa fa-facebook"></i>
                                <i class="fa fa-facebook"></i>
                            </a>
                            <a class="social-icon-lg si-border si-twitter si-border-round" href="https://twitter.com/abdel_matheux" target="_blank">
                                <i class="fa fa-twitter"></i>
                                <i class="fa fa-twitter"></i>
                            </a>

                            <a class="social-icon-lg si-border si-g-plus si-border-round" href="https://plus.google.com/117253900389607721341" target="_blank">
                                <i class="fa fa-google-plus"></i>
                                <i class="fa fa-google-plus"></i>
                            </a>
                            <a class="social-icon-lg si-border si-tumblr si-border-round" href="http://megacours.tumblr.com" target="_blank">
                                <i class="fa fa-tumblr"></i>
                                <i class="fa fa-tumblr"></i>
                            </a>
                            <a class="social-icon-lg si-border si-g-plus si-border-round" href="https://www.youtube.com/channel/UCjNt0O1upHD8mlijbyFHGeQ" target="_blank">
                                <i class="fa fa-youtube"></i>
                                <i class="fa fa-youtube"></i>
                            </a>
                        </div>

                    </div>
                </div>
            </div>


        </div>



    </div><!--span8-->




</div><!--row-fluid-->