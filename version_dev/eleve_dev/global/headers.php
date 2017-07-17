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

<link href="<?= url_media_local; ?>/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

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

<script src="<?= url_media_global; ?>/js/jquery.bootpag.min.js" type="text/javascript"></script>
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
<script>
    $(document).ready(function () {

        $('a[data-fiddle]').click(function () {
            var fiddleId = $(this).data('fiddle');
            $.ajax({
                method: "POST",
                url: "jsfiddle.php",
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

//              
//        $(this).attr('data-controls-modal', 'fiddle-modal-' + fiddleId);
//        var content = '<div class="modal fade" id="fiddle-modal-' + fiddleId+ '">\
//              <div class="modal-header">\
//                <a href="#" class="close">x</a>\
//                <h3>Example</h3>\
//              </div>\
//              <div class="modal-body">\
//                  <iframe\
//                    style="width: 100%; height: 500px"\
//                    src="http://jsfiddle.net/' + fiddleId + '/embedded/result,html,js/">\
//                  </iframe>\
//              </div>\
//            </div>';
//                     var  id_div="#mondal_"+fiddleId;
//                      $(id_div).html(content);
//        
//       // $('body').append(content);
//        
//       $('#fiddle-modal- + fiddleId+ ').modal();
//       // $('fiddle-modal-' + fiddleId).remove();

        });
    });

</script>