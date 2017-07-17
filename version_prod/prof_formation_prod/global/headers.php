<meta charset="utf-8" /><meta http-equiv="X-UA-Compatible" content="IE=edge" />

<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="description" />
<meta name="author" />

<title>Megacours Espace formateur</title>


<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="<?= url_media_local; ?>/css/bootstrap.min.css"  />

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous" />

<!-- Latest compiled and minified JavaScript -->
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>-->



<!-- MetisMenu CSS -->
<link href="<?= url_media_local; ?>/css/metisMenu.min.css" rel="stylesheet" />

<!-- Custom CSS -->
<link href="<?= url_media_local; ?>/css/sb-admin-2.css" rel="stylesheet" />

<link href="<?= url_media_local; ?>/css/css_megaquiz.css" rel="stylesheet" />

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

<!-- jQuery -->
<script src="<?= url_media_local; ?>/js/jquery.min.js"></script>
<?php if ($action == 'result_quiz') { ?> 
    <script src='<?= url_librairie_global; ?>/tinymce/tinymce.min.js'></script>
<?php } ?>

<!-- Bootstrap Core JavaScript -->
<script src="<?= url_media_local; ?>/js/bootstrap.min.js"></script>
<!--<script src="<?= url_media_local; ?>/js/bootstrap-modal.js" type="text/javascript"></script>-->

<!-- Metis Menu Plugin JavaScript -->
<script src="<?= url_media_local; ?>/js/metisMenu.min.js"></script>
<?php if ($action == 'result_quiz') { ?>
    <script src="<?= url_media_local; ?>/js/rating.js"></script>
<?php } ?>
<!-- Custom Theme JavaScript -->
<script src="<?= url_media_local; ?>/js/sb-admin-2.js"></script> 
<link href="<?= url_media_local; ?>/jquery-ui/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="<?= url_media_local; ?>/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>

<script src="<?= url_media_local; ?>/js/sb-admin-2.js"></script> 

<!------------- jQuery_tagEditor----------------------------->
<link href="<?= url_librairie_global; ?>/jQuery_tagEditor/jquery.tag-editor.css" rel="stylesheet" type="text/css"/>
<script src="<?= url_librairie_global; ?>/jQuery_tagEditor/jquery.caret.min.js" type="text/javascript"></script>
<script src="<?= url_librairie_global; ?>/jQuery_tagEditor/jquery.tag-editor.min.js" type="text/javascript"></script>
<!-------------------------------------------------------------------->
<script src="<?= url_media_local; ?>/js/circleDonutChart.js" type="text/javascript"></script>


<!-------------------------------------------------------------------->
<link href="<?= url_media_global; ?>/plugin_js/Chart_jquery_css_pie/chart.css" rel="stylesheet" type="text/css"/>
<script src="<?= url_media_global; ?>/plugin_js/Chart_jquery_css_pie/jquery.chart.js" type="text/javascript"></script>

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
<script src='<?= url_librairie_global; ?>/tinymce/tinymce.min.js'></script>
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
<!-------------------------------------------------------------------->
<!---   Fichiers datatables --------------------->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.dataTables.min.css">
<link  href="<?= url_media_global; ?>/datatable/extensions/ColVis/css/dataTables.colVis.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/1.0.3/js/dataTables.responsive.js"></script>
<script src="<?= url_media_global; ?>/datatable/extensions/ColVis/js/dataTables.colVis.min.js" type="text/javascript"></script>
<!-------------------------------------------------------------------->
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
    /************** Style pour image de profil de l'eleve '*********************/
    .thumb-lg {
        height: 84px;
        width: 84px;
    }


</style>
<!--<script type="text/javascript">SyntaxHighlighter.all();</script>-->
<script>


    tinymce.init({
        selector: '#contenu_exo,#aide_exo,#corrige_text_exo,.textera_notification,#contenu_alerte,#description_dev',
        language: 'fr_FR',
        height: 300,
        theme: 'modern',
        overwriteValidElements: false,
        plugins: [
            'advlist autolink lists link charmap  preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu paste code  directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools codesample  preview sh4tinymce wordcount',
            'tiny_bootstrap_elements_light'
        ],
        toolbar1: 'bootstrap | undo redo | | sh4tinymce | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | tiny_bootstrap_elements_light',
        toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
        content_css: [
            '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
            '//www.tinymce.com/css/codepen.min.css'
        ]

    });



</script>
<script>
    $(document).ready(function () {

        $(".flatpickr").flatpickr();
        $('.chosen-select').chosen();
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
                        }



                    },
                    error: function (jqXHR, error, errorThrown) {

                    }
                });
            });
<?php } ?>
<?php if ($action == 'all_view_exercices') { ?>


            function requette_ajax_get_nbres_reponses(id_exo) {

                $.ajax({
                    method: "POST",
                    url: "get_nbres_reponses.php",
                    data: {'id_exo': id_exo},
                    dataType: 'json',
                    cache: false,
                    success: function (data) {
                        objet_message = data.message;
                        objet_message.reponse = Boolean(objet_message.reponse);
                        if (objet_message.reponse) {
                            id = '#nbr_reponses_exo_' + id_exo;
                            $(id).text(objet_message.contenu);

                        }
                    },
                    error: function (jqXHR, error, errorThrown) {

                    }
                });
            }

            var auto_refresh = setInterval(
                    function () {
                        $("span[id^='nbr_reponses_exo_']").each(function () {
                            id_exo = $(this).attr("id").substring(17);
                            /************* lancer une requette ajax pour recuperer le nombre de reponses ***************/
                            nbr_reponses = requette_ajax_get_nbres_reponses(id_exo);

                        });
                        /***************  5min * 60 =300s*1000=300000 *******************************/
                    }, 300000);

            /******************************************/
            //            $('a[data-toggle]').click(function () {
            //                var data_href = $(this).attr("href");
            //                data_href = data_href.substring(10)
            //                console.log(data_href);
            //
            //
            //            });

            /**********************************************************/
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
                        }



                    },
                    error: function (jqXHR, error, errorThrown) {

                    }
                });

            });
<?php } ?>
<?php if ($action == 'all_view_reponses_eleves') { ?>


            function test() {

                $('a[data-fiddle]').click(function () {
                    var keygen_rep = $(this).data('fiddle'),
                            id_mondal2 = "#Modal_" + keygen_rep,
                            id_form1 = "#form_add_id_statut_" + keygen_rep;
                    id_form2 = "#form_add_notif_code_" + keygen_rep;
                    /***************************************/

                    $.ajax({
                        method: "POST",
                        url: "all_fiddle_rep.php",
                        data: {'fiddleId': keygen_rep},
                        dataType: 'json',
                        cache: false,
                        beforeSend: function () {

                        },
                        success: function (data) {
                            objet_message = data.message;
                            objet_message.reponse = Boolean(objet_message.reponse);
                            if (objet_message.reponse) {
                                id_contenu = "#contenu_reponse_" + keygen_rep;

                                $(id_contenu).html(objet_message.contenu);

                            }
                        },
                        error: function (jqXHR, error, errorThrown) {

                        }
                    });



                    /******************************************/
                    $(id_mondal2).modal();
                    /********** recharger la page apres la fermeture de pop-up ********************/
                    id_button_close = "#close_" + keygen_rep;
                    $(id_button_close).on('click', function () {

                        window.location.reload(true);
                    });
                    /************** poster formulaire  pour changer le statut de code *********************/
                    $(id_form1).on('submit', function () {

                        var identifiant_statut_code = "#id_statut_code_" + keygen_rep,
                                id_statut_code = $(identifiant_statut_code).val(),
                                id_show_succes = "#show_succes_code_" + keygen_rep,
                                id_show_erreur = "#show_erreur_code_" + keygen_rep;
                        $.ajax({
                            method: "POST",
                            url: "change_statut_code.php",
                            data: {'id_statut_code': id_statut_code, 'keygen_rep': keygen_rep},
                            dataType: 'json',
                            cache: false,
                            beforeSend: function () {
                                $(id_show_succes).hide();
                                $(id_show_erreur).hide();
                            },
                            success: function (data) {
                                objet_message = data.message;
                                objet_message.reponse = Boolean(objet_message.reponse);
                                statut_code = objet_message.statut_code;
                                if (objet_message.reponse) {
                                    $(id_show_succes).show();
                                    $(id_show_erreur).hide();
                                    id_statut_actuel = "#statut_code_actuel_" + keygen_rep;
                                    $(id_statut_actuel).html(statut_code);
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
                    /******************  Formulaire pour poster une notification *******************/

                    $(id_form2).on('submit', function () {

                        var identifiant_contenu_notif_code = "#contenu_notif_" + keygen_rep,
                                identifiant_degre_notif_code = "#degre_notif_code_" + keygen_rep,
                                contenu_notif_code = $(identifiant_contenu_notif_code).val(),
                                degre_notif_code = $(identifiant_degre_notif_code).val(),
                                id_show_succes = "#show_succes_notif_" + keygen_rep,
                                id_show_erreur = "#show_erreur_notif_" + keygen_rep;
                        $.ajax({
                            method: "POST",
                            url: "poster_notification_code.php",
                            data: {'contenu_notif_code': contenu_notif_code, 'degre_notif_code': degre_notif_code, 'keygen_rep': keygen_rep},
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
                                    contenu_list_notif = objet_message.contenu_list_notif;
                                    id_list_notif = "#list_notif_" + keygen_rep;
                                    $(id_list_notif).html(contenu_list_notif);
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
            }
             test();

            $("#barre_search").on('keyup', function () {
                var tag = $("#barre_search").val();

                $("#liste_reponses").html('').load("get_reponses_exo_eleves.php", {'tag': tag, 'token_exo': '<?= $_GET['keygen_exo']; ?>'}, function () {

                    test();

                });
            });
            $("#select_etat_code").on('change', function () {
                var etat_code = $(this).val();

                $("#liste_reponses").html('').load("get_reponses_exo_eleves.php", {'etat_code': etat_code, 'token_exo': '<?= $_GET['keygen_exo']; ?>'}, function () {

                    test();
          

                });
            });
            /******************************************/

            //            $('a[data-fiddle-rep]').click(function () {
            //                var fiddleId = $(this).data('fiddle-rep');
            //                $.ajax({
            //                    method: "POST",
            //                    url: "all_fiddle_rep.php",
            //                    data: {'fiddleId': fiddleId},
            //                    dataType: 'json',
            //                    cache: false,
            //                    beforeSend: function () {
            //
            //                    },
            //                    success: function (data) {
            //                        objet_message = data.message;
            //                        objet_message.reponse = Boolean(objet_message.reponse);
            //                        if (objet_message.reponse) {
            //                            id_mondal1 = "#Modal_rep_" + fiddleId + " .modal-body"
            //                            $(id_mondal1).html(objet_message.contenu);
            //                            id_mondal2 = "#Modal_rep_" + fiddleId;
            //                            $(id_mondal2).modal();
            //                        }
            //
            //
            //
            //                    },
            //                    error: function (jqXHR, error, errorThrown) {
            //
            //                    }
            //                });
            //
            //            });

           
            /**********************************************/
            //            $('a[data-fiddle]').click(function () {
            //                var keygen_rep = $(this).data('fiddle'),
            //                        id_mondal2 = "#Modal_" + keygen_rep,
            //                        id_form1 = "#form_add_id_statut_" + keygen_rep;
            //                id_form2 = "#form_add_notif_code_" + keygen_rep;
            //                /***************************************/
            //
            //                $.ajax({
            //                    method: "POST",
            //                    url: "all_fiddle_rep.php",
            //                    data: {'fiddleId': keygen_rep},
            //                    dataType: 'json',
            //                    cache: false,
            //                    beforeSend: function () {
            //
            //                    },
            //                    success: function (data) {
            //                        objet_message = data.message;
            //                        objet_message.reponse = Boolean(objet_message.reponse);
            //                        if (objet_message.reponse) {
            //                            id_contenu = "#contenu_reponse_" + keygen_rep;
            //
            //                            $(id_contenu).html(objet_message.contenu);
            //
            //                        }
            //                    },
            //                    error: function (jqXHR, error, errorThrown) {
            //
            //                    }
            //                });
            //
            //
            //
            //                /******************************************/
            //                $(id_mondal2).modal();
            //                /********** recharger la page apres la fermeture de pop-up ********************/
            //                id_button_close = "#close_" + keygen_rep;
            //                $(id_button_close).on('click', function () {
            //
            //                    window.location.reload(true);
            //                });
            //                /************** poster formulaire  pour changer le statut de code *********************/
            //                $(id_form1).on('submit', function () {
            //
            //                    var identifiant_statut_code = "#id_statut_code_" + keygen_rep,
            //                            id_statut_code = $(identifiant_statut_code).val(),
            //                            id_show_succes = "#show_succes_code_" + keygen_rep,
            //                            id_show_erreur = "#show_erreur_code_" + keygen_rep;
            //                    $.ajax({
            //                        method: "POST",
            //                        url: "change_statut_code.php",
            //                        data: {'id_statut_code': id_statut_code, 'keygen_rep': keygen_rep},
            //                        dataType: 'json',
            //                        cache: false,
            //                        beforeSend: function () {
            //                            $(id_show_succes).hide();
            //                            $(id_show_erreur).hide();
            //                        },
            //                        success: function (data) {
            //                            objet_message = data.message;
            //                            objet_message.reponse = Boolean(objet_message.reponse);
            //                            statut_code = objet_message.statut_code;
            //                            if (objet_message.reponse) {
            //                                $(id_show_succes).show();
            //                                $(id_show_erreur).hide();
            //                                id_statut_actuel = "#statut_code_actuel_" + keygen_rep;
            //                                $(id_statut_actuel).html(statut_code);
            //                            } else {
            //                                $(id_show_erreur).show();
            //                                $(id_show_succes).hide();
            //                            }
            //
            //                        },
            //                        error: function (jqXHR, error, errorThrown) {
            //
            //                        }
            //                    });
            //                    return false;
            //                });
            //                /******************  Formulaire pour poster une notification *******************/
            //
            //                $(id_form2).on('submit', function () {
            //
            //                    var identifiant_contenu_notif_code = "#contenu_notif_" + keygen_rep,
            //                            identifiant_degre_notif_code = "#degre_notif_code_" + keygen_rep,
            //                            contenu_notif_code = $(identifiant_contenu_notif_code).val(),
            //                            degre_notif_code = $(identifiant_degre_notif_code).val(),
            //                            id_show_succes = "#show_succes_notif_" + keygen_rep,
            //                            id_show_erreur = "#show_erreur_notif_" + keygen_rep;
            //                    $.ajax({
            //                        method: "POST",
            //                        url: "poster_notification_code.php",
            //                        data: {'contenu_notif_code': contenu_notif_code, 'degre_notif_code': degre_notif_code, 'keygen_rep': keygen_rep},
            //                        dataType: 'json',
            //                        cache: false,
            //                        beforeSend: function () {
            //                            $(id_show_succes).hide();
            //                            $(id_show_erreur).hide();
            //                        },
            //                        success: function (data) {
            //                            objet_message = data.message;
            //                            objet_message.reponse = Boolean(objet_message.reponse);
            //                            if (objet_message.reponse) {
            //                                $(id_show_succes).show();
            //                                $(id_show_erreur).hide();
            //                                contenu_list_notif = objet_message.contenu_list_notif;
            //                                id_list_notif = "#list_notif_" + keygen_rep;
            //                                $(id_list_notif).html(contenu_list_notif);
            //                            } else {
            //                                $(id_show_erreur).show();
            //                                $(id_show_succes).hide();
            //                            }
            //
            //                        },
            //                        error: function (jqXHR, error, errorThrown) {
            //
            //                        }
            //                    });
            //                    return false;
            //                });
            //
            //
            //
            //
            //            });
            /**********************************************/



<?php } ?>
<?php if ($action == 'all_view_reponses_dev_eleves') { ?>

            /******************************************/

            $('a[data-fiddle-rep]').click(function () {
                var fiddleId = $(this).data('fiddle-rep');
                $.ajax({
                    method: "POST",
                    url: "all_fiddle_dev_rep.php",
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
                var keygen_rep = $(this).data('fiddle'),
                        id_mondal2 = "#Modal_" + keygen_rep,
                        id_form1 = "#form_add_id_statut_" + keygen_rep;
                id_form2 = "#form_add_notif_code_" + keygen_rep;
                /***************************************/

                $.ajax({
                    method: "POST",
                    url: "all_fiddle_dev_rep.php",
                    data: {'fiddleId': keygen_rep},
                    dataType: 'json',
                    cache: false,
                    beforeSend: function () {

                    },
                    success: function (data) {
                        objet_message = data.message;
                        objet_message.reponse = Boolean(objet_message.reponse);
                        if (objet_message.reponse) {
                            id_contenu = "#contenu_reponse_" + keygen_rep;

                            $(id_contenu).html(objet_message.contenu);

                        }
                    },
                    error: function (jqXHR, error, errorThrown) {

                    }
                });



                /******************************************/
                $(id_mondal2).modal();
                /********** recharger la page apres la fermeture de pop-up ********************/
                id_button_close = "#close_" + keygen_rep;
                $(id_button_close).on('click', function () {

                    window.location.reload(true);
                });
                /************** poster formulaire  pour changer le statut de code *********************/
                $(id_form1).on('submit', function () {

                    var identifiant_statut_code = "#id_statut_code_" + keygen_rep,
                            identifiant_nbr_points = "#nbr_points_" + keygen_rep,
                            id_statut_code = $(identifiant_statut_code).val(),
                            nbr_points = $(identifiant_nbr_points).val(),
                            id_show_succes = "#show_succes_code_" + keygen_rep,
                            id_show_erreur = "#show_erreur_code_" + keygen_rep;
                    $.ajax({
                        method: "POST",
                        url: "change_statut_code.php",
                        data: {'id_statut_code': id_statut_code, 'nbr_points': nbr_points, 'keygen_rep': keygen_rep, 'type_exo': 'exo_devoir'},
                        dataType: 'json',
                        cache: false,
                        beforeSend: function () {
                            $(id_show_succes).hide();
                            $(id_show_erreur).hide();
                        },
                        success: function (data) {
                            objet_message = data.message;
                            objet_message.reponse = Boolean(objet_message.reponse);
                            statut_code = objet_message.statut_code;
                            if (objet_message.reponse) {
                                $(id_show_succes).show();
                                $(id_show_erreur).hide();
                                id_statut_actuel = "#statut_code_actuel_" + keygen_rep;
                                $(id_statut_actuel).html(statut_code);
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
                /******************  Formulaire pour poster une notification *******************/

                $(id_form2).on('submit', function () {

                    var identifiant_contenu_notif_code = "#contenu_notif_" + keygen_rep,
                            identifiant_degre_notif_code = "#degre_notif_code_" + keygen_rep,
                            contenu_notif_code = $(identifiant_contenu_notif_code).val(),
                            degre_notif_code = $(identifiant_degre_notif_code).val(),
                            id_show_succes = "#show_succes_notif_" + keygen_rep,
                            id_show_erreur = "#show_erreur_notif_" + keygen_rep;
                    $.ajax({
                        method: "POST",
                        url: "poster_notification_code.php",
                        data: {'contenu_notif_code': contenu_notif_code, 'degre_notif_code': degre_notif_code, 'keygen_rep': keygen_rep},
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
                                contenu_list_notif = objet_message.contenu_list_notif;
                                id_list_notif = "#list_notif_" + keygen_rep;
                                $(id_list_notif).html(contenu_list_notif);
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
            /**********************************************/



<?php } ?>
<?php if ($action == 'add_alerte') { ?>
            $("#select_mode_groupe").on('change', function () {
                if ($(this).val() == 1) {
                    $('#div_list_groupe_users').hide();
                    $('#div_list_users').hide();

                } else if ($(this).val() == 3) {
                    $('#div_list_groupe_users').show();
                    $('#div_list_users').show();
                } else if ($(this).val() == 2) {
                    $('#div_list_groupe_users').show();
                    $('#div_list_users').show();
                }
            });
<?php } ?>
<?php if ($action == 'add_liaison_devoir_user') { ?>
            dtInstance1 = $('#liste_liaisons_devoir').dataTable({
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
<?php } ?>
<?php if ($action == 'all_view_alertes') { ?>
            /*****************************************************/
            dtInstance1 = $('#liste_alertes').dataTable({
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

<?php } ?>
<?php if ($action == 'all_view_liaisons_exo_users') { ?>
            /*****************************************************/
            dtInstance1 = $('#liste_liaisons_exo').dataTable({
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

<?php } ?>

    });

</script>