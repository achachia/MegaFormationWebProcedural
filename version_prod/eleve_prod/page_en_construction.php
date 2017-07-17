<div class="row">
    <div class="col-md-12" style="margin-top:5%;margin-left:20%">
        <img src="<?= url_media_global ?>/images/page_construction.jpg"/><br/>

    </div>
    <div class="col-md-12" style="margin-top:2%;margin-left:20%">       
        <div class="panel panel-default" style=" width:400px;margin-left: 14%; ">
            <div class="panel-body">
                <div class="lead" id="clock"  style="padding-left:10%;color:red "></div>
            </div>
        </div>

    </div>

    <script type="text/javascript">
        $('#clock').countdown('<?= $controle_debug['date_end'] ;?>', function (event) {
            $(this).html(event.strftime('%w semaines %d jours %H:%M:%S'));
        });
    </script>


</div>    

