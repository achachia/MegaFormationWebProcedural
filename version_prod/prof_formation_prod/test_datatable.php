<?php
require 'connection/config.php';
?>

<!DOCTYPE html>
<html>
    <title>Datatable Demo2 | CoderExample</title>
    <head>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
        <link  href="<?= url_media_global; ?>/datatable/custom-loader-css/dataTables.customLoader.walker.css" rel="stylesheet" type="text/css" /> 
        <link href="<?= url_media_local; ?>/jquery-ui/jquery-ui.css" rel="stylesheet" type="text/css"/>

        <link  href="<?= url_media_global; ?>/datatable/extensions/TableTools/css/dataTables.tableTools.css" rel="stylesheet" type="text/css" />
        <link  href="<?= url_media_global; ?>/datatable/extensions/ColVis/css/dataTables.colVis.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.dataTables.min.css">



        <script src="<?= url_media_local; ?>/js/jquery.min.js" type="text/javascript"></script>
        <script src="<?= url_media_local; ?>/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

        <script type="text/javascript" language="javascript" src="<?= url_media_global; ?>/datatable/extensions/TableTools/js/dataTables.tableTools.js"></script>
        <script src="<?= url_media_global; ?>/datatable/extensions/ColVis/js/dataTables.colVis.min.js" type="text/javascript"></script>





        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/1.0.3/js/dataTables.responsive.js"></script> 

        <script src="<?= url_media_global; ?>/datatable/media/js/dataTables.cellEdit.js" type="text/javascript"></script>
        <script src="<?= url_media_global; ?>/datatable/media/js/advanced.js" type="text/javascript"></script>







        <!-------------------------------------------------------------------->
        <script type="text/javascript" language="javascript" >
            $(document).ready(function () {
                var dataTable = $('#employee-grid').DataTable({
                    dom: 'C&gt,Tlfrtip',
                    tableTools: {
                        "sSwfPath": "<?= url_media_global; ?>/datatable/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
                        "sRowSelect": "multi",
                        "aButtons": [
                            "select_all",
                            "select_none",
                            {
                                "sExtends": "collection",
                                "sButtonText": "Export",
                                "aButtons": ["csv", "xls", "pdf", "print"]
                            }
                        ]
                    },
                    processing: true,
                    serverSide: true,
                    oLanguage: {
                        sSearch: 'Rechercher tous les colonnes:',
                        sLengthMenu: '_MENU_ enregistrements par page',
                        sInfo: 'Showing _START_ to _END_ of _TOTAL_ entrie',
                        info: 'Afficher la page _PAGE_ of _PAGES_',
                        zeroRecords: 'rien n\'a été trouvé - sorry',
                        infoEmpty: 'Aucun enregistrement disponible',
                        infoFiltered: '(filtré à partir de _MAX_ nombre total d\'enregistrements)',
                        sProcessing: "<div id='loader'></div>"
                    },
                    ajax: {
                        url: "employee-grid-data.php", // json datasource
                        type: "POST", // method  , by default get
                        error: function () {  // error handling
                            $(".employee-grid-error").html("");
                            $("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">Aucun resultat trouve</th></tr></tbody>');
                            $("#employee-grid_processing").css("display", "none");
                        }
                    },
                    colVis: {
                        order: "alfa",
                        "buttonText": "Afficher / Masquer les colonnes"
                    },
                });
                //  $("#employee-grid_filter").css("display", "none");  // hiding global search box
                $('.search-input-text').on('keyup click change', function () {

                    var i = $(this).attr('data-column'); // getting column index
                    var v = $(this).val(); // getting search input value
                    dataTable.columns(i).search(v).draw();
                });
                $("#bulkDelete").on('click', function () { // bulk checked
                    var status = this.checked;
                    $(".deleteRow").each(function () {
                        $(this).prop("checked", status);
                    });
                });
                dataTable.MakeCellsEditable({
                    "onUpdate": myCallbackFunction,
                    "inputCss": 'my-input-class',
                    "columns": [0, 1, 2, 3, 4, 5],
                    "allowNulls": {
                        "columns": [3],
                        "errorClass": 'error'
                    },
                    "confirmationButton": {// could also be true
                        "confirmCss": 'my-confirm-class',
                        "cancelCss": 'my-cancel-class'
                    },
                    "inputTypes": [
                        {
                            "column": 2,
                            "type": "text",
                            "options": null
                        },
                        {
                            "column": 3,
                            "type": "text",
                            "options": null
                        },
                        {
                            "column": 4,
                            "type": "list",
                            "options": [
                                {"value": "1", "display": "1"},
                                {"value": "2", "display": "2"}

                            ]
                        },
                        {
                            "column": 5,
                            "type": "datepicker", // requires jQuery UI: http://http://jqueryui.com/download/
                            "options": {
                                "icon": "http://jqueryui.com/resources/demos/datepicker/images/calendar.gif" // Optional
                            }
                        }
                        // Nothing specified for column 3 so it will default to text

                    ]
                });
                function myCallbackFunction(updatedCell, updatedRow, oldValue) {
                    console.log("The new value for the cell is: " + updatedCell.data());
                    console.log("The old value for that cell was: " + oldValue);
                    console.log("The values for each cell in that row are: " + updatedRow.data());
                    $.ajax({
                        type: "POST",
                        url: "update_donnee.php",
                        data: {data: updatedRow.data()},
                        success: function (result) {
                        },
                        async: false
                    });
                }

                $(".datepicker").datepicker({
                    dateFormat: "dd-mm-yy",
                    showOn: "button",
                    showAnim: 'slideDown',
                    showButtonPanel: true,
                    autoSize: true,
                    buttonImage: "//jqueryui.com/resources/demos/datepicker/images/calendar.gif",
                    buttonImageOnly: true,
                    buttonText: "Selectionner une date",
                    closeText: "Effacer"
                });
                $(document).on("click", ".ui-datepicker-close", function () {
                    $('.datepicker').val("");
                    dataTable.columns(4).search("").draw();
                });
                $('#deleteTriger').on("click", function (event) { // triggering delete one by one
                    if ($('.deleteRow:checked').length > 0) {  // at-least one checkbox checked
                        var ids = [];
                        $('.deleteRow').each(function () {
                            if ($(this).is(':checked')) {
                                ids.push($(this).val());
                            }
                        });
                        console.log(ids);
                        var ids_string = ids.toString(); // array to string conversion
                        $.ajax({
                            type: "POST",
                            url: "employee-delete.php",
                            data: {data_ids: ids_string},
                            success: function (result) {
                                dataTable.draw(); // redrawing datatable
                            },
                            async: false
                        });
                    }
                });
            });
        </script>
        <style>
            #loader {
                border: 16px solid #f3f3f3;
                border-radius: 50%;
                border-top: 16px solid #3498db;
                width: 120px;
                height: 120px;
                -webkit-animation: spin 2s linear infinite;
                animation: spin 2s linear infinite;
                margin-left:2%px;
                margin-top:60%px;
            }   


            @-webkit-keyframes spin {
                0% { -webkit-transform: rotate(0deg); }
                100% { -webkit-transform: rotate(360deg); }
            }

            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            } 
            /************************************/
            .my-input-class {
                padding: 3px 6px;
                border: 1px solid #ccc;
                border-radius: 4px;
            }

            .my-confirm-class {
                padding: 3px 6px;
                font-size: 12px;
                color: white;
                text-align: center;
                vertical-align: middle;
                border-radius: 4px;
                background-color: #337ab7;
                text-decoration: none;
            }

            .my-cancel-class {
                padding: 3px 6px;
                font-size: 12px;
                color: white;
                text-align: center;
                vertical-align: middle;
                border-radius: 4px;
                background-color: #a94442;
                text-decoration: none;
            }

            .error {
                border: solid 1px;
                border-color: #a94442;
            }

            .destroy-button{
                padding:5px 10px 5px 10px;
                border: 1px blue solid;
                background-color:lightgray;
            }


        </style>

    </head>
    <body>
        <div class="header"><h1>DataTable (Server side) Custom Column Search </h1></div>
        <div class="container">
            <table id="employee-grid"  cellpadding="0" cellspacing="0" border="0" class="display" width="100%"   style="text-align:center">
                <thead>
                    <tr>
                        <th>Action</th>
                        <th>CODE ELEVE</th>
                        <th>NOM</th>
                        <th>PRENOM</th>
                        <th>SEX</th>
                        <th>DATE CONNECTION</th>
                    </tr>
                </thead>
                <thead>
                    <tr>
                        <th><input type="checkbox"  id="bulkDelete"  /> <button id="deleteTriger">Delete</button></th>
                        <td><input type="text" data-column="0"  class="search-input-text"></td>
                        <td><input type="text" data-column="1"  class="search-input-text"></td>
                        <th><input type="text" data-column="2"  class="search-input-text"></td>
                        <td>
                            <select data-column="3"  class="search-input-text">
                                <option value="">(Select a range)</option>
                                <option value="1">homme</option>
                                <option value="2">femme</option>

                            </select>
                        </td>
                        <td><input  readonly="readonly" type="text" data-column="4" class="search-input-text datepicker" ></td>
                    </tr>
                </thead>
            </table>
        </div>


    </body>
</html>
