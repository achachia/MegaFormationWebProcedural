<meta charset="utf-8" /><meta http-equiv="X-UA-Compatible" content="IE=edge" />

<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="description" />
<meta name="author" />

<title>Megacours Espace eleve</title>


<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="<?= url_media_local; ?>/css/bootstrap.min.css"  />

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous" />

<!-- Latest compiled and minified JavaScript -->
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>-->


<link href="<?= url_media_global; ?>/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

<!-- MetisMenu CSS -->
<link href="<?= url_media_local; ?>/css/metisMenu.min.css" rel="stylesheet" />

<!-- Custom CSS -->
<link href="<?= url_media_local; ?>/css/sb-admin-2.css" rel="stylesheet" />

<link href="<?= url_media_local; ?>/css/css_megaquiz.css" rel="stylesheet" />

<!-- jQuery -->
<script src="<?= url_media_local; ?>/js/jquery.min.js"></script>
<?php if ($action == 'result_quiz') { ?> 
    <script src='<?= url_librairie_global; ?>/tinymce/tinymce.min.js'></script>
<?php } ?>

<!-- Bootstrap Core JavaScript -->
<script src="<?= url_media_local; ?>/js/bootstrap.min.js"></script>
<script src="<?= url_media_local; ?>/js/bootstrap-modal.js" type="text/javascript"></script>

<script src="<?= url_media_global; ?>/plugin_js/bootbox.min.js" type="text/javascript"></script>

<script src="<?= url_media_global; ?>/plugin_js/jquery.countdown.js" type="text/javascript"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="<?= url_media_local; ?>/js/metisMenu.min.js"></script>
<?php if ($action == 'result_quiz') { ?>
    <script src="<?= url_media_local; ?>/js/rating.js"></script>
<?php } ?>
<!-- Custom Theme JavaScript -->
<script src="<?= url_media_local; ?>/js/sb-admin-2.js"></script> 
<!--<link href="<?= url_media_local; ?>/jquery-ui/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="<?= url_media_local; ?>/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>-->

<script src="<?= url_media_local; ?>/js/sb-admin-2.js"></script> 

<!------------- jQuery_tagEditor----------------------------->
<link href="<?= url_librairie_global; ?>/jQuery_tagEditor/jquery.tag-editor.css" rel="stylesheet" type="text/css"/>
<script src="<?= url_librairie_global; ?>/jQuery_tagEditor/jquery.caret.min.js" type="text/javascript"></script>
<script src="<?= url_librairie_global; ?>/jQuery_tagEditor/jquery.tag-editor.min.js" type="text/javascript"></script>
<!-------------------------------------------------------------------->
<script src="<?= url_media_local; ?>/js/circleDonutChart.js" type="text/javascript"></script>

<script src='<?= url_librairie_global; ?>/tinymce/tinymce.min.js'></script>
<!-------------------------------------------------------------------->
<link href="<?= url_media_global; ?>/plugin_js/Chart_jquery_css_pie/chart.css" rel="stylesheet" type="text/css"/>
<script src="<?= url_media_global; ?>/plugin_js/Chart_jquery_css_pie/jquery.chart.js" type="text/javascript"></script>
<!---   Fichiers datatables --------------------->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.dataTables.min.css">
<link  href="<?= url_media_global; ?>/datatable/extensions/ColVis/css/dataTables.colVis.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/1.0.3/js/dataTables.responsive.js"></script>
<script src="<?= url_media_global; ?>/datatable/extensions/ColVis/js/dataTables.colVis.min.js" type="text/javascript"></script>
<!-------------------------------------------------------------------->
<!-- start highcharts  -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<!-- end highcharts -->

<!--********************* chosen ***********************-->
<link href="<?= url_media_global; ?>/plugin_js/chosen/chosen.css" rel="stylesheet">
<script type="text/javascript" src="<?= url_media_global; ?>/plugin_js/chosen/chosen.jquery.js"></script>

<!-- Flat picker -->
<link  href="<?= url_media_global; ?>/plugin_js/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />
<script src="<?= url_media_global; ?>/plugin_js/flatpickr/flatpickr.min.js" type="text/javascript"></script>

<script src="<?= url_media_global; ?>/js/jquery.bootpag.min.js" type="text/javascript"></script>
<!-------------              SyntaxHighlighter                    ----->
<script type="text/javascript" src="<?= url_media_global; ?>/plugin_js/syntaxhighlighter/scripts/shCore.js"></script>
<script type="text/javascript" src="<?= url_media_global; ?>/plugin_js/syntaxhighlighter/scripts/shBrushJava.js"></script>
<script type="text/javascript" src="<?= url_media_global; ?>/plugin_js/syntaxhighlighter/scripts/shBrushJScript.js"></script>
<script type="text/javascript" src="<?= url_media_global; ?>/plugin_js/syntaxhighlighter/scripts/shBrushCss.js"></script>
<script type="text/javascript" src="<?= url_media_global; ?>/plugin_js/syntaxhighlighter/scripts/shBrushPhp.js"></script>
<script type="text/javascript" src="<?= url_media_global; ?>/plugin_js/syntaxhighlighter/scripts/shBrushPlain.js"></script>
<!--<pre class="brush: php; html-script: true"> -->
<link type="text/css" rel="stylesheet" href="<?= url_media_global; ?>/plugin_js/syntaxhighlighter/styles/shCoreDefault.css"/>
<script type="text/javascript">SyntaxHighlighter.all();</script>
<!-------------------------------------------------------------------->
<?php if ($action == 'my_calendar') { ?>
    <link href="<?= url_media_local; ?>/jquery-ui/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <link href='<?= url_media_global; ?>/css/fullcalendar.print.css' rel='stylesheet' media='print' />
    <link href="<?= url_media_local; ?>/css/calendar.css" rel="stylesheet" />
    <link href='<?= url_media_global; ?>/css/fullcalendar.css' rel='stylesheet' />
    <script src='<?= url_media_global; ?>/js/moment.min.js'></script>
    <script src='<?= url_media_global; ?>/js/fullcalendar.min.js'></script>
    <script src='<?= url_media_global; ?>/js/lang-all.js'></script>   
<?php } ?>
<!-- Custom Fonts
<link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" /> -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css" />
<link href="<?= url_media_local; ?>/css/StyleSheetAnacours.css" rel="stylesheet" />
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<style>
<?php if ($action == 'home') { ?>
        .panel-default > .panel-heading {
            color: #333;
            background-color: #fcfcfc;
            border-color: #ddd;
            border-color: rgba(221,221,221,0.85);
        }
<?php } ?>  
</style>

<script>
    tinymce.init({
        selector: '.comment_code,.textera_comment_exo,.textera_comment_dev',
        language: 'fr_FR',
        height: 300,
        theme: 'modern',
        plugins: [
            'advlist autolink lists  charmap  preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code  sh4tinymce'
        ],
        toolbar: 'insertfile undo redo | | sh4tinymce |  styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent ',
        content_css: [
            '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
            '//www.tinymce.com/css/codepen.min.css'
        ]

    });</script>
<script>
    $(document).ready(function () {
<?php if ($_SESSION ['membre']['code_eleve'] == 'CE2') { ?>
            $.ajax({
                method: "POST",
                url: "get_alertes_ajax.php",
                dataType: 'json',
                cache: false,
                success: function (data) {
                    objet_message = data.message;
                    objet_message.reponse = Boolean(objet_message.reponse);
                    if (objet_message.reponse) {
                        id_mondal1 = "#Modal_get_alertes .modal-body";
                        $(id_mondal1).html(objet_message.contenu);
                        id_mondal2 = "#Modal_get_alertes";
                        $(id_mondal2).modal();
                    }

                },
                error: function (jqXHR, error, errorThrown) {

                }
            });

<?php } ?>
<?php if ($action == 'all_view_snippets') { ?>
            $('a[data-fiddle]').click(function () {
                var fiddleId = $(this).data('fiddle');
                $.ajax({
                    method: "POST",
                    url: "all_fiddle.php",
                    data: {'fiddleId': fiddleId},
                    dataType: 'json',
                    cache: false,
                    beforeSend: function () {

                    },
                    success: function (data) {
                        objet_message = data.message;
                        objet_message.reponse = Boolean(objet_message.reponse);
                        if (objet_message.reponse) {
                            id_mondal1 = "#Modal_" + fiddleId + " .modal-body"
                            $(id_mondal1).html(objet_message.contenu);
                            id_mondal2 = "#Modal_" + fiddleId;
                            $(id_mondal2).modal();
                            SyntaxHighlighter.highlight();
                        }



                    },
                    error: function (jqXHR, error, errorThrown) {

                    }
                });
            });
<?php } ?>
<?php if ($action == 'all_view_exercices') { ?>

            $('.labels_code').tagEditor({
                delimiter: ',; ', /* space and comma */
                placeholder: 'html,variables,php'
            });
            /********************************************/
            $('a[data-fiddle-aide]').click(function () {
                var fiddleId = $(this).data('fiddle-aide');
                $.ajax({
                    method: "POST",
                    url: "get_aide_exo.php",
                    data: {'keygen_exo': fiddleId},
                    dataType: 'json',
                    cache: false,
                    beforeSend: function () {

                    },
                    success: function (data) {
                        objet_message = data.message;
                        objet_message.reponse = Boolean(objet_message.reponse);
                        if (objet_message.reponse) {
                            id_mondal1 = "#Modal_aide_" + fiddleId + " .modal-body";
                            $(id_mondal1).html(objet_message.contenu);
                            id_mondal2 = "#Modal_aide_" + fiddleId;
                            $(id_mondal2).modal();
                            SyntaxHighlighter.highlight();
                        }

                    },
                    error: function (jqXHR, error, errorThrown) {

                    }
                });
            });
            /*************************************/
            $('a[data-fiddle-notif]').click(function () {
                var fiddleId = $(this).data('fiddle-notif');
                $.ajax({
                    method: "POST",
                    url: "mettre_jour_notifications_lus.php",
                    data: {'keygen_exo': fiddleId},
                    dataType: 'json',
                    cache: false,
                    beforeSend: function () {

                    },
                    success: function (data) {
                        objet_message = data.message;
                        objet_message.reponse = Boolean(objet_message.reponse);
                        if (objet_message.reponse) {
                            id_mondal1 = "#Modal_notif_" + fiddleId + " .modal-body";
                            id_mondal2 = "#Modal_notif_" + fiddleId;
                            $(id_mondal2).modal();
                            SyntaxHighlighter.highlight();
                        }

                    },
                    error: function (jqXHR, error, errorThrown) {

                    }
                });
            });
            /***************************************************/
            $('a[data-fiddle-corrige]').click(function () {
                var keygen_exo = $(this).data('fiddle-corrige');
                $.ajax({
                    method: "POST",
                    url: "get_corrige_exo.php",
                    data: {'keygen_exo': keygen_exo},
                    dataType: 'json',
                    cache: false,
                    success: function (data) {
                        objet_message = data.message;
                        objet_message.reponse = Boolean(objet_message.reponse);
                        if (objet_message.reponse) {
                            id_mondal1 = "#contenu_corrige_" + keygen_exo;
                            $(id_mondal1).html(objet_message.contenu);
                            id_mondal2 = "#Modal_corrige_" + keygen_exo;
                            $(id_mondal2).modal();
                            SyntaxHighlighter.highlight();

                        }

                    },
                    error: function (jqXHR, error, errorThrown) {

                    }
                });
                /************** poster formulaire evaluation corrige *********************/
                id_form = "#form_eval_corrige_" + keygen_exo;
                $(id_form).on('submit', function () {

                    var identifiant_eval_statut = "#id_eval_statut_" + keygen_exo,
                            id_eval_statut = $(identifiant_eval_statut).val(),
                            id_show_succes = "#show_succes_eval_" + keygen_exo,
                            id_show_erreur = "#show_erreur_eval_" + keygen_exo;
                    $.ajax({
                        method: "POST",
                        url: "poster_eval_corrige.php",
                        data: {'keygen_exo': keygen_exo, 'id_eval_statut': id_eval_statut},
                        dataType: 'json',
                        cache: false,
                        beforeSend: function () {
                            $(id_show_succes).hide();
                            $(id_show_erreur).hide();
                        },
                        success: function (data) {
                            objet_message = data.message;
                            objet_message.reponse = Boolean(objet_message.reponse);
                            if (objet_message.reponse) {
                                $(id_show_succes).show();
                                $(id_show_erreur).hide();
                            } else {
                                $(id_show_erreur).show();
                                $(id_show_succes).hide();
                            }

                        },
                        error: function (jqXHR, error, errorThrown) {

                        }
                    });
                    return false;
                });
                /******************************************/
                /************** poster formulaire commentaire corrige *********************/
                id_form = "#form_add_comment_code_" + keygen_exo;
                $(id_form).on('submit', function () {

                    var identifiant_contenu_comment = "#contenu_comment_" + keygen_exo,
                            contenu_comment = $(identifiant_contenu_comment).val(),
                            id_show_succes = "#show_succes_comment_" + keygen_exo,
                            id_show_erreur = "#show_erreur_comment_" + keygen_exo;
                    $.ajax({
                        method: "POST",
                        url: "poster_comment_corrige.php",
                        data: {'keygen_exo': keygen_exo, 'comment': contenu_comment},
                        dataType: 'json',
                        cache: false,
                        beforeSend: function () {
                            $(id_show_succes).hide();
                            $(id_show_erreur).hide();
                        },
                        success: function (data) {
                            objet_message = data.message;
                            objet_message.reponse = Boolean(objet_message.reponse);
                            if (objet_message.reponse) {
                                $(id_show_succes).show();
                                $(id_show_erreur).hide();
                            } else {
                                $(id_show_erreur).show();
                                $(id_show_succes).hide();
                            }

                        },
                        error: function (jqXHR, error, errorThrown) {

                        }
                    });
                    return false;
                });
                /******************************************/
                /************** poster formulaire vote exercice *********************/
                id_form = "#form_vote_exo_" + keygen_exo;
                $(id_form).on('submit', function () {

                    var identifiant_vote_exo = "#id_vote_exo_" + keygen_exo,
                            id_vote_exo = $(identifiant_vote_exo).val(),
                            id_show_succes = "#show_succes_vote_exo_" + keygen_exo,
                            id_show_erreur = "#show_erreur_vote_exo_" + keygen_exo;
                    $.ajax({
                        method: "POST",
                        url: "poster_vote_difficulte_exo.php",
                        data: {'keygen_exo': keygen_exo, 'id_vote_exo': id_vote_exo},
                        dataType: 'json',
                        cache: false,
                        beforeSend: function () {
                            $(id_show_succes).hide();
                            $(id_show_erreur).hide();
                        },
                        success: function (data) {
                            objet_message = data.message;
                            objet_message.reponse = Boolean(objet_message.reponse);
                            if (objet_message.reponse) {
                                $(id_show_succes).show();
                                $(id_show_erreur).hide();
                            } else {
                                $(id_show_erreur).show();
                                $(id_show_succes).hide();
                            }

                        },
                        error: function (jqXHR, error, errorThrown) {

                        }
                    });
                    return false;
                });
                /******************************************/
            });
            /******************************************/

            $('a[data-fiddle-rep]').click(function () {
                var fiddleId = $(this).data('fiddle-rep');
                $.ajax({
                    method: "POST",
                    url: "all_fiddle_rep.php",
                    data: {'fiddleId': fiddleId},
                    dataType: 'json',
                    cache: false,
                    beforeSend: function () {

                    },
                    success: function (data) {
                        objet_message = data.message;
                        objet_message.reponse = Boolean(objet_message.reponse);
                        if (objet_message.reponse) {
                            id_mondal1 = "#Modal_rep_" + fiddleId + " .modal-body"
                            $(id_mondal1).html(objet_message.contenu);
                            id_mondal2 = "#Modal_rep_" + fiddleId;
                            $(id_mondal2).modal();
                        }



                    },
                    error: function (jqXHR, error, errorThrown) {

                    }
                });
            });
            /**********************************************/

            $('a[data-fiddle]').click(function () {
                var keygen_exo = $(this).data('fiddle'),
                        id_mondal2 = "#Modal_" + keygen_exo,
                        id_form = "#form_add_id_exo_" + keygen_exo;
                $(id_mondal2).modal();
                /************** poster formulaire *********************/
                $(id_form).on('submit', function () {

                    var identifiant_corrige_exo = "#id_corrige_exo_" + keygen_exo,
                            identifiant_nom_code = "#nom_code_" + keygen_exo,
                            identifiant_partage_code = "#partage_code_" + keygen_exo,
                            identifiant_comment_code = "#comment_code_" + keygen_exo,
                            identifiant_labels_code = "#labels_code_" + keygen_exo,
                            id_fiddle_exo = $(identifiant_corrige_exo).val(),
                            nom_code = $(identifiant_nom_code).val(),
                            comment_code = $(identifiant_comment_code).val(),
                            partage_code = $(identifiant_partage_code).val(),
                            labels_code = $(identifiant_labels_code).val(),
                            id_show_succes = "#show_succes_" + keygen_exo,
                            id_show_erreur = "#show_erreur_" + keygen_exo;
                    $.ajax({
                        method: "POST",
                        url: "poster_id_corrige.php",
                        data: {'id_fiddle_exo': id_fiddle_exo, 'keygen_exo': keygen_exo, 'nom_code': nom_code, 'partage_code': partage_code, 'comment_code': comment_code, "labels_code": labels_code},
                        dataType: 'json',
                        cache: false,
                        beforeSend: function () {
                            $(id_show_succes).hide();
                            $(id_show_erreur).hide();
                        },
                        success: function (data) {
                            objet_message = data.message;
                            objet_message.reponse = Boolean(objet_message.reponse);
                            if (objet_message.reponse) {
                                $(id_show_succes).show();
                                $(id_show_erreur).hide();
                            } else {
                                $(id_show_erreur).show();
                                $(id_show_succes).hide();
                            }
                            /*******************************************/
                            id_url = "#url_travail_" + keygen_exo;
                            //   $(id_url).attr("href", "ahmad");
                            /*******************************************/

                        },
                        error: function (jqXHR, error, errorThrown) {

                        }
                    });
                    return false;
                });
                /************** poster formulaire *********************/
            });
<?php } ?>
<?php if ($action == 'view_exos_devoirs') { ?>
            $('.labels_code').tagEditor({
                delimiter: ',; ', /* space and comma */
                placeholder: 'html,variables,php'
            });
            /********************************************/
            $('a[data-fiddle-aide]').click(function () {
                var fiddleId = $(this).data('fiddle-aide');
                $.ajax({
                    method: "POST",
                    url: "get_aide_exo.php",
                    data: {'keygen_exo': fiddleId},
                    dataType: 'json',
                    cache: false,
                    beforeSend: function () {

                    },
                    success: function (data) {
                        objet_message = data.message;
                        objet_message.reponse = Boolean(objet_message.reponse);
                        if (objet_message.reponse) {
                            id_mondal1 = "#Modal_aide_" + fiddleId + " .modal-body";
                            $(id_mondal1).html(objet_message.contenu);
                            id_mondal2 = "#Modal_aide_" + fiddleId;
                            $(id_mondal2).modal();
                            SyntaxHighlighter.highlight();
                        }

                    },
                    error: function (jqXHR, error, errorThrown) {

                    }
                });
            });
            /*************************************/
            $('a[data-fiddle-notif]').click(function () {
                var fiddleId = $(this).data('fiddle-notif');
                $.ajax({
                    method: "POST",
                    url: "mettre_jour_notifications_lus.php",
                    data: {'keygen_exo': fiddleId},
                    dataType: 'json',
                    cache: false,
                    beforeSend: function () {

                    },
                    success: function (data) {
                        objet_message = data.message;
                        objet_message.reponse = Boolean(objet_message.reponse);
                        if (objet_message.reponse) {
                            id_mondal1 = "#Modal_notif_" + fiddleId + " .modal-body";
                            id_mondal2 = "#Modal_notif_" + fiddleId;
                            $(id_mondal2).modal();
                            SyntaxHighlighter.highlight();
                        }

                    },
                    error: function (jqXHR, error, errorThrown) {

                    }
                });
            });
            /***************************************************/
            $('a[data-fiddle-corrige]').click(function () {
                var keygen_exo = $(this).data('fiddle-corrige');
                $.ajax({
                    method: "POST",
                    url: "get_corrige_exo_dev.php",
                    data: {'keygen_exo': keygen_exo},
                    dataType: 'json',
                    cache: false,
                    success: function (data) {
                        objet_message = data.message;
                        objet_message.reponse = Boolean(objet_message.reponse);
                        if (objet_message.reponse) {
                            id_mondal1 = "#contenu_corrige_" + keygen_exo;
                            $(id_mondal1).html(objet_message.contenu);
                            id_mondal2 = "#Modal_corrige_" + keygen_exo;
                            $(id_mondal2).modal();
                            SyntaxHighlighter.highlight();

                        }

                    },
                    error: function (jqXHR, error, errorThrown) {

                    }
                });
                /************** poster formulaire evaluation corrige *********************/
                id_form = "#form_eval_corrige_" + keygen_exo;
                $(id_form).on('submit', function () {

                    var identifiant_eval_statut = "#id_eval_statut_" + keygen_exo,
                            id_eval_statut = $(identifiant_eval_statut).val(),
                            id_show_succes = "#show_succes_eval_" + keygen_exo,
                            id_show_erreur = "#show_erreur_eval_" + keygen_exo;
                    $.ajax({
                        method: "POST",
                        url: "poster_eval_corrige_exo_dev.php",
                        data: {'keygen_exo': keygen_exo, 'id_eval_statut': id_eval_statut},
                        dataType: 'json',
                        cache: false,
                        beforeSend: function () {
                            $(id_show_succes).hide();
                            $(id_show_erreur).hide();
                        },
                        success: function (data) {
                            objet_message = data.message;
                            objet_message.reponse = Boolean(objet_message.reponse);
                            if (objet_message.reponse) {
                                $(id_show_succes).show();
                                $(id_show_erreur).hide();
                            } else {
                                $(id_show_erreur).show();
                                $(id_show_succes).hide();
                            }

                        },
                        error: function (jqXHR, error, errorThrown) {

                        }
                    });
                    return false;
                });
                /******************************************/
                /************** poster formulaire commentaire corrige *********************/
                id_form = "#form_add_comment_code_" + keygen_exo;
                $(id_form).on('submit', function () {

                    var identifiant_contenu_comment = "#contenu_comment_" + keygen_exo,
                            contenu_comment = $(identifiant_contenu_comment).val(),
                            id_show_succes = "#show_succes_comment_" + keygen_exo,
                            id_show_erreur = "#show_erreur_comment_" + keygen_exo;
                    $.ajax({
                        method: "POST",
                        url: "poster_comment_corrige_exo_dev.php",
                        data: {'keygen_exo': keygen_exo, 'comment': contenu_comment},
                        dataType: 'json',
                        cache: false,
                        beforeSend: function () {
                            $(id_show_succes).hide();
                            $(id_show_erreur).hide();
                        },
                        success: function (data) {
                            objet_message = data.message;
                            objet_message.reponse = Boolean(objet_message.reponse);
                            if (objet_message.reponse) {
                                $(id_show_succes).show();
                                $(id_show_erreur).hide();
                            } else {
                                $(id_show_erreur).show();
                                $(id_show_succes).hide();
                            }

                        },
                        error: function (jqXHR, error, errorThrown) {

                        }
                    });
                    return false;
                });
                /******************************************/
                /************** poster formulaire vote exercice *********************/
                id_form = "#form_vote_exo_" + keygen_exo;
                $(id_form).on('submit', function () {

                    var identifiant_vote_exo = "#id_vote_exo_" + keygen_exo,
                            id_vote_exo = $(identifiant_vote_exo).val(),
                            id_show_succes = "#show_succes_vote_exo_" + keygen_exo,
                            id_show_erreur = "#show_erreur_vote_exo_" + keygen_exo;
                    $.ajax({
                        method: "POST",
                        url: "poster_vote_difficulte_exo_devoir.php",
                        data: {'keygen_exo': keygen_exo, 'id_vote_exo': id_vote_exo},
                        dataType: 'json',
                        cache: false,
                        beforeSend: function () {
                            $(id_show_succes).hide();
                            $(id_show_erreur).hide();
                        },
                        success: function (data) {
                            objet_message = data.message;
                            objet_message.reponse = Boolean(objet_message.reponse);
                            if (objet_message.reponse) {
                                $(id_show_succes).show();
                                $(id_show_erreur).hide();
                            } else {
                                $(id_show_erreur).show();
                                $(id_show_succes).hide();
                            }

                        },
                        error: function (jqXHR, error, errorThrown) {

                        }
                    });
                    return false;
                });
                /******************************************/
            });
            /******************************************/

            $('a[data-fiddle-rep]').click(function () {
                var fiddleId = $(this).data('fiddle-rep');
                $.ajax({
                    method: "POST",
                    url: "all_fiddle_rep.php",
                    data: {'fiddleId': fiddleId},
                    dataType: 'json',
                    cache: false,
                    beforeSend: function () {

                    },
                    success: function (data) {
                        objet_message = data.message;
                        objet_message.reponse = Boolean(objet_message.reponse);
                        if (objet_message.reponse) {
                            id_mondal1 = "#Modal_rep_" + fiddleId + " .modal-body"
                            $(id_mondal1).html(objet_message.contenu);
                            id_mondal2 = "#Modal_rep_" + fiddleId;
                            $(id_mondal2).modal();
                        }



                    },
                    error: function (jqXHR, error, errorThrown) {

                    }
                });
            });
            /**********************************************/

            $('a[data-fiddle]').click(function () {
                var keygen_exo = $(this).data('fiddle'),
                        id_mondal2 = "#Modal_" + keygen_exo,
                        id_form = "#form_add_id_exo_" + keygen_exo;
                $(id_mondal2).modal();
                /************** poster formulaire *********************/
                $(id_form).on('submit', function () {

                    var identifiant_corrige_exo = "#id_corrige_exo_" + keygen_exo,
                            identifiant_nom_code = "#nom_code_" + keygen_exo,
                            identifiant_partage_code = "#partage_code_" + keygen_exo,
                            identifiant_comment_code = "#comment_code_" + keygen_exo,
                            identifiant_labels_code = "#labels_code_" + keygen_exo,
                            id_fiddle_exo = $(identifiant_corrige_exo).val(),
                            nom_code = $(identifiant_nom_code).val(),
                            comment_code = $(identifiant_comment_code).val(),
                            partage_code = $(identifiant_partage_code).val(),
                            labels_code = $(identifiant_labels_code).val(),
                            id_show_succes = "#show_succes_" + keygen_exo,
                            id_show_erreur = "#show_erreur_" + keygen_exo;
                    $.ajax({
                        method: "POST",
                        url: "poster_corrige_exo_dev.php",
                        data: {'id_fiddle_exo': id_fiddle_exo, 'keygen_exo': keygen_exo, 'nom_code': nom_code, 'partage_code': partage_code, 'comment_code': comment_code, "labels_code": labels_code},
                        dataType: 'json',
                        cache: false,
                        beforeSend: function () {
                            $(id_show_succes).hide();
                            $(id_show_erreur).hide();
                        },
                        success: function (data) {
                            objet_message = data.message;
                            objet_message.reponse = Boolean(objet_message.reponse);
                            if (objet_message.reponse) {
                                $(id_show_succes).show();
                                $(id_show_erreur).hide();
                            } else {
                                $(id_show_erreur).show();
                                $(id_show_succes).hide();
                            }
                            /*******************************************/
                            id_url = "#url_travail_" + keygen_exo;
                            //   $(id_url).attr("href", "ahmad");
                            /*******************************************/

                        },
                        error: function (jqXHR, error, errorThrown) {

                        }
                    });
                    return false;
                });
                /************** poster formulaire *********************/
            });
<?php } ?>
<?php if ($action == 'my_codes') { ?>
            $('.labels_code').tagEditor({
                delimiter: ',; ', /* space and comma */
                placeholder: 'html,variables,test'
            });
            /*****************************************************/
            dtInstance1 = $('#liste_my_codes').dataTable({
                'paging': true, // Table pagination
                'ordering': true, // Column ordering 
                'info': true, // Bottom left status text
                // Text translation options
                // Note the required keywords between underscores (e.g _MENU_)
                oLanguage: {
                    sSearch: 'Rechercher tous les colonnes:',
                    sLengthMenu: '_MENU_ enregistrements par page',
                    sInfo: 'Showing _START_ to _END_ of _TOTAL_ entrie',
                    info: 'Afficher la page _PAGE_ of _PAGES_',
                    zeroRecords: 'rien n\'a été trouvé - sorry',
                    infoEmpty: 'Aucun enregistrement disponible',
                    infoFiltered: '(filtré à partir de _MAX_ nombre total d\'enregistrements)'
                },
                sDom: 'C<"clear">lfrtip',
                colVis: {
                    order: "alfa",
                    "buttonText": "Afficher / Masquer les colonnes"
                }
            });
            var inputSearchClass = 'datatable_input_col_search';
            var columnInputs = $('tfoot .' + inputSearchClass);
            // On input keyup trigger filtering
            columnInputs.keyup(function () {
                dtInstance1.fnFilter(this.value, columnInputs.index(this));
            });
            /**************************************************/
            $(document).on('click', 'a[data-fiddle-rep]', function () {

                var fiddleId = $(this).data('fiddle-rep');
                $.ajax({
                    method: "POST",
                    url: "all_fiddle_rep.php",
                    data: {'fiddleId': fiddleId},
                    dataType: 'json',
                    cache: false,
                    beforeSend: function () {

                    },
                    success: function (data) {
                        objet_message = data.message;
                        objet_message.reponse = Boolean(objet_message.reponse);
                        if (objet_message.reponse) {
                            id_mondal1 = "#Modal_rep_" + fiddleId + " .modal-body"
                            $(id_mondal1).html(objet_message.contenu);
                            id_mondal2 = "#Modal_rep_" + fiddleId;
                            $(id_mondal2).modal();
                        }

                    },
                    error: function (jqXHR, error, errorThrown) {

                    }
                });
            });
            /**********************************************/
            $(document).on('click', 'a[data-fiddle]', function () {

                var keygen_exo = $(this).data('fiddle'),
                        id_mondal2 = "#Modal_" + keygen_exo,
                        id_form = "#form_add_id_exo_" + keygen_exo;
                $(id_mondal2).modal();
                /************** poster formulaire *********************/
                $(id_form).on('submit', function () {

                    var identifiant_corrige_exo = "#id_corrige_exo_" + keygen_exo,
                            identifiant_nom_code = "#nom_code_" + keygen_exo,
                            identifiant_partage_code = "#partage_code_" + keygen_exo,
                            identifiant_comment_code = "#comment_code_" + keygen_exo,
                            identifiant_labels_code = "#labels_code_" + keygen_exo,
                            id_fiddle_exo = $(identifiant_corrige_exo).val(),
                            nom_code = $(identifiant_nom_code).val(),
                            comment_code = $(identifiant_comment_code).val(),
                            partage_code = $(identifiant_partage_code).val(),
                            labels_code = $(identifiant_labels_code).val(),
                            id_show_succes = "#show_succes_" + keygen_exo,
                            id_show_erreur = "#show_erreur_" + keygen_exo;
                    // console.log(nom_code);
                    $.ajax({
                        method: "POST",
                        url: "poster_id_corrige.php",
                        data: {'id_fiddle_exo': id_fiddle_exo, 'keygen_exo': keygen_exo, 'nom_code': nom_code, 'partage_code': partage_code, 'comment_code': comment_code, "labels_code": labels_code},
                        dataType: 'json',
                        cache: false,
                        beforeSend: function () {
                            $(id_show_succes).hide();
                            $(id_show_erreur).hide();
                        },
                        success: function (data) {
                            //  var speed = 10,
                            //    id_sroll="#Modal_"+keygen_exo; 
                            objet_message = data.message;
                            objet_message.reponse = Boolean(objet_message.reponse);
                            if (objet_message.reponse) {
                                infos_rep = objet_message.infos_objet;
                                id_nom_code = "#nom_code_td_" + keygen_exo,
                                        id_ID_code = "#ID_code_td_" + keygen_exo,
                                        id_statut_code = "#statut_code_td_" + keygen_exo,
                                        id_partage_code = "#partage_code_td_" + keygen_exo,
                                        id_comment_code = "#comment_code_td_" + keygen_exo,
                                        id_labels_code = "#labels_code_td_" + keygen_exo;
                                $(id_nom_code).text(infos_rep.nom_code);
                                $(id_ID_code).text(infos_rep.ID_code);
                                $(id_statut_code).html(infos_rep.statut_code);
                                $(id_partage_code).text(infos_rep.mode_partage);
                                $(id_comment_code).html(infos_rep.comment_code);
                                $(id_labels_code).html(infos_rep.labels_code);
                                $(id_show_succes).show();
                                $(id_show_erreur).hide();
                                //  $('html, body').animate( { scrollTop: $(id_sroll).offset().top }, speed );

                            } else {
                                $(id_show_erreur).show();
                                $(id_show_succes).hide();
                            }


                        },
                        error: function (jqXHR, error, errorThrown) {

                        }
                    });
                    return false;
                });
            });
<?php } ?>
<?php if ($action == 'my_calendar') { ?>
            function updateEvent(event, dayDelta, minuteDelta, allDay)

            {

                $.ajax({'url': 'ajax.php?action=update', 'type': 'POST',
                    'data': {'id': event.id, 'dayDelta': dayDelta, 'minuteDelta': minuteDelta, 'allDay': allDay},
                    success: function (data) {

                        if (data.error)
                            alert(data.error);
                    },
                    error: function (data) {

                        alert('Une erreur est survenue.');
                    }

                });
            }



            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'

                },
                editable: false,
                theme: true,
                lang: 'fr',
                eventSources: [
                    'get_events_ajax.php'

                ],
                eventClick: function (event, jsEvent, view) {
                    $('#modalTitle').html(event.title);
                    $('#modalBody').html(event.description);
                    $('#eventUrl').attr('href', event.url);
                    $('#fullCalModal').modal();
                }

            });
<?php } ?>
<?php if ($action == 'all_view_devoirs') { ?>
            $('a[data-fiddle-comment]').click(function () {
                var keygen_dev = $(this).data('fiddle-comment');
                id_mondal = "#post_comment_corrige_" + keygen_dev;
                $(id_mondal).modal();
                /**************************************/
                id_form = "#form_add_comment_code_" + keygen_dev;
                $(id_form).on('submit', function () {

                    var identifiant_contenu_comment = "#contenu_comment_" + keygen_dev,
                            contenu_comment = $(identifiant_contenu_comment).val(),
                            id_show_succes = "#show_succes_comment_" + keygen_dev,
                            id_show_erreur = "#show_erreur_comment_" + keygen_dev;
                    $.ajax({
                        method: "POST",
                        url: "poster_comment_devoir.php",
                        data: {'keygen_dev': keygen_dev, 'comment': contenu_comment},
                        dataType: 'json',
                        cache: false,
                        beforeSend: function () {
                            $(id_show_succes).hide();
                            $(id_show_erreur).hide();
                        },
                        success: function (data) {
                            objet_message = data.message;
                            objet_message.reponse = Boolean(objet_message.reponse);
                            if (objet_message.reponse) {
                                $(id_show_succes).show();
                                $(id_show_erreur).hide();
                            } else {
                                $(id_show_erreur).show();
                                $(id_show_succes).hide();
                            }

                        },
                        error: function (jqXHR, error, errorThrown) {

                        }
                    });
                    return false;
                });
                /*************************************/
            });

            /***************************************************/
            $('a[data-fiddle-vote]').click(function () {
                var keygen_dev = $(this).data('fiddle-vote');
                id_mondal = "#post_vote_dev_" + keygen_dev;
                $(id_mondal).modal();
                        /************** poster formulaire vote devoir *********************/
                id_form = "#form_vote_dev_" + keygen_dev;
                $(id_form).on('submit', function () {

                    var identifiant_vote_dev = "#id_vote_dev_" + keygen_dev,
                            id_vote_dev = $(identifiant_vote_dev).val(),
                            id_show_succes = "#show_succes_vote_dev_" + keygen_dev,
                            id_show_erreur = "#show_erreur_vote_dev_" + keygen_dev;
                    $.ajax({
                        method: "POST",
                        url: "poster_vote_difficulte_dev.php",
                        data: {'keygen_dev': keygen_dev, 'id_vote_dev': id_vote_dev},
                        dataType: 'json',
                        cache: false,
                        beforeSend: function () {
                            $(id_show_succes).hide();
                            $(id_show_erreur).hide();
                        },
                        success: function (data) {
                            objet_message = data.message;
                            objet_message.reponse = Boolean(objet_message.reponse);
                            if (objet_message.reponse) {
                                $(id_show_succes).show();
                                $(id_show_erreur).hide();
                            } else {
                                $(id_show_erreur).show();
                                $(id_show_succes).hide();
                            }

                        },
                        error: function (jqXHR, error, errorThrown) {

                        }
                    });
                    return false;
                });
                /******************************************/
            });

            /***********************************/




<?php } ?>
    });

</script>