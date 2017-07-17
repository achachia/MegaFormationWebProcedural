
<div class="row">
    <div class="col-md-12" style="margin-top:3%">
        <?php $j=1; foreach ($list_snippets_html as $value) { ?>

            <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" href="#collapse_<?= $value['keygen_code']; ?>"><?= $j.'. '.$value['titre']; ?></a>
                        </h4>
                    </div>
                    <div id="collapse_<?= $value['keygen_code']; ?>" class="panel-collapse collapse">
                        <div class="panel-body">

                            <a href="#" data-fiddle="<?= $value['keygen_code']; ?>"  >Consulter le code</a>
                            <div class="modal fade" id="Modal_<?= $value['keygen_code']; ?>" role="dialog">
                                <div class="modal-dialog modal-lg">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title"><?= $value['titre']; ?></h4>
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
            </div>

        <?php  ++$j;} ?>
    </div> 
</div>








