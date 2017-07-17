<div class="row">
    <div class="col-md-12" style="margin-top:3%">
        <?php
        $j = 1;
        foreach ($list_devoirs as $value) {
            ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>TITRE</th>
                        <th>DATE LIMITE DEPOT</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>

                    <tr class="info">
                        <td><?= $j; ?></td>
                        <td><?= $value['titre_dev']; ?></td>
                        <td><?= $value['date_limite_depot']; ?></td>
                        <td>
                            <a href="<?= url_espace_eleve; ?>/index.php?module=HTML&action=view_exos_devoirs&token_devoir=<?= $value['keygen_dev']; ?>"   class="btn btn-primary">

                                <i class="fa fa-eye" aria-hidden="true"></i>
                                Consulter le devoir
                            </a>
                             <?php  if ($value['etat_comment_dev'] == '0') {  ?>
                            <a href="#" data-fiddle-comment="<?= $value['keygen_dev']; ?>" class="btn btn-success" >
                                <i class="fa fa-commenting-o" aria-hidden="true"></i>  Laisser un commentaire pour ce devoir
                            </a>
                               <?php  }  ?>
                              <?php  if ($value['etat_vote_dev'] == '0') {  ?>
                            <a href="#" data-fiddle-vote="<?= $value['keygen_dev']; ?>" class="btn btn-success" >
                                <i class="fa fa-star-o" aria-hidden="true"></i>  Votez pour ce devoir
                            </a>
                              <?php  }  ?>


                        </td>





                    </tr>

                </tbody>
            </table>
            <?php  if ($value['etat_comment_dev'] == '0') {  ?>


            <div class="modal fade" id="post_comment_corrige_<?= $value['keygen_dev']; ?>" role="dialog">
                <div class="modal-dialog modal-lg">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                            <h4 class="modal-title"><i class="fa fa-unlock-alt" aria-hidden="true"></i>Laisser un commentaire</h4>
                        </div>
                        <div class="modal-body">                                            
                            <div class="row"  id="show_succes_comment_<?= $value['keygen_dev']; ?>"  style="display: none;width:70%;margin-left:7%">                     
                                <div class="alert alert-success" role="alert">
                                    <p><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                                        Le commentaire  a été enregistré avec succès</p>
                                </div>
                            </div>
                            <div class="row"  id="show_erreur_comment_<?= $value['keygen_dev']; ?>"  style="display: none;width:70%;margin-left:7%">  
                                <div class="alert alert-danger" role="alert">
                                    <p><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                        Il y'a des erreurs dans la saisie.</p>
                                </div>
                            </div>
                            <form class="form-horizontal" id="form_add_comment_code_<?= $value['keygen_dev']; ?>" name="form_add_comment_code_<?= $value['keygen_dev']; ?>" method="POST" action="<?= url_espace_eleve; ?>/poster_comment_devoir.php">



                                <div class="col-md-offset-1  col-md-7">
                                    <div class="form-group">
                                        <label for="comment_dev" class="control-label">Rédiger votre commentaire</label>
                                        <textarea class="form-control textera_comment_dev" rows="8" cols="100" id="contenu_comment_<?= $value['keygen_dev']; ?>" name="contenu_comment_<?= $value['keygen_dev']; ?>" placeholder="Rediger votre commentaire"></textarea>
                                    </div> 
                                </div>                                                                                                               
                                <div class="form-group">
                                    <div class="col-md-offset-1  col-md-9">
                                        <button type="submit" id="submit_comment_code_<?= $value['keygen_dev']; ?>" name="submit_comment_code_<?= $value['keygen_dev']; ?>" class="col-md-8 btn btn-primary">Enregistrer votre commentaire</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        </div>
                    </div>

                </div>
            </div>



            <?php  }  ?>
            <?php  if ($value['etat_vote_dev'] == '0') {  ?>

            <div class="modal fade" id="post_vote_dev_<?= $value['keygen_dev']; ?>" role="dialog">
                <div class="modal-dialog modal-lg">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                            <h4 class="modal-title"><i class="fa fa-unlock-alt" aria-hidden="true"></i>Votez pour ce devoir</h4>
                        </div>
                        <div class="modal-body">                                            
                            <div class="row"  id="show_succes_vote_dev_<?= $value['keygen_dev']; ?>"  style="display: none;width:70%;margin-left:7%">                     
                                <div class="alert alert-success" role="alert">
                                    <p><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                                        Votre vote de devoir a été enregistré avec succès</p>
                                </div>
                            </div>
                            <div class="row"  id="show_erreur_vote_dev_<?= $value['keygen_dev']; ?>"  style="display: none;width:70%;margin-left:7%">  
                                <div class="alert alert-danger" role="alert">
                                    <p><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                        Il y'a des erreurs dans la saisie.</p>
                                </div>
                            </div>
                            <form class="form-horizontal" id="form_vote_dev_<?= $value['keygen_dev']; ?>" name="form_vote_dev_<?= $value['keygen_dev']; ?>" method="POST" action="<?= url_espace_eleve; ?>/poster_vote_difficulte_dev.php">


                                <div class="col-md-offset-1  col-md-7">
                                    <div class="form-group">
                                        <label for="nom" class="control-label">Choisissez la difficulté de l'exercice</label>
                                        <select id="id_vote_dev_<?= $value['keygen_dev']; ?>" name="id_vote_dev_<?= $value['keygen_dev']; ?>" class="form-control">
                                            <option value="">Choisir la difficulté</option>
                                            <?php foreach ($list_difficulte_dev as $value2) { ?>
                                                <option value="<?= $value2['id_difficulte']; ?>"><?= $value2['nom_difficulte']; ?></option>
                                            <?php } ?>                                     

                                        </select>
                                    </div> 
                                </div>                                                   
                                <div class="form-group">
                                    <div class="col-md-offset-1  col-md-9">
                                        <button type="submit" id="submit_vote_dev_<?= $value['keygen_dev']; ?>" name="submit_vote_dev_<?= $value['keygen_dev']; ?>" class="col-md-8 btn btn-primary">Enregistrer votre choix</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        </div>
                    </div>

                </div>
            </div>


            <?php  }  ?>

            <?php
            ++$j;
        }
        ?>


    </div> 
</div>


