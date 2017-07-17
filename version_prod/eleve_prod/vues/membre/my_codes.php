    
<div class="row"  style="margin-top: 2%">
    <table id="liste_my_codes"  class="display  table table-striped table-bordered" width="100%" cellspacing="0" >
        <thead>
            <tr>                               
                <th style="text-align: center;">Date création</th>
                <th style="text-align: center;">Nom</th>
                <th style="text-align: center;">Identifiant/version</th> 
                <th style="text-align: center;">Statut code </th>
                <th style="text-align: center;">Thème</th>
                <th style="text-align: center;">Mode de partage</th>
                <th style="text-align: center;">Commentaires</th>
                <th style="text-align: center;">Tags</th>
                <th style="text-align: center;">Action</th>
            </tr>
        </thead>
        <tbody>

            <?php
            if (isset($liste_codes) && sizeof($liste_codes) > 0) {

                $tr = '';
                foreach ($liste_codes as $value) {
                    $tr .= '<tr>';
                    $tr .= '<td style="color:rgb(41,97,147);">' . $value ['date_created'] . '</td>';
                    $tr .= '<td style="text-align: center;" id="nom_code_td_'.$value['keygen_exo'].'">' . $value ['nom_code'] . '</td>';
                    $tr .= '<td style="text-align: center;"  id="ID_code_td_'.$value['keygen_exo'].'">' . $value ['ID_code'] . '</td>';
                    $tr .= '<td style="text-align: center;"  id="statut_code_td_'.$value['keygen_exo'].'">' . $value ['statut_code'] . '</td>';
                    $tr .= '<td  style="text-align: center;">' . $value ['nom_theme'] . '</td>';
                    $tr .= '<td  style="text-align: center;"  id="partage_code_td_'.$value['keygen_exo'].'">' . $value ['mode_partage'] . '</td>';
                    $tr .= '<td  style="width:5%;text-align: center;"  id="comment_code_td_'.$value['keygen_exo'].'">' . $value ['comment_code'] . '</td>';
                    $tr .= '<td  style="width:5%;text-align: center;"  id="labels_code_td_'.$value['keygen_exo'].'">' . $value ['labels_code_formate'] . '</td>';
                    $tr .= '<td>';
                    $tr .= '<div class="btn-group"  style="width:200px">';
                    $tr .= '<button type="button" class="btn btn-success"> Action </button>';
                    $tr .= '<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>';
                    $tr .= '<ul class="dropdown-menu">';
                    $tr .= '<li style="margin-left:10%;">'
                            . '<a href="#" data-fiddle-rep="' . $value['keygen_exo'] . '"  ><button type="text" class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i>Consulter le code</button></a>
                                                </li>';
                    $tr .= '<li>'
                            . ' <a href="#" data-fiddle="' . $value['keygen_exo'] . '"  ><button type="text" class="btn btn-success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                        Modifier la fiche de code </button></a>
                                                    </a>
                                               </li>';

                    $tr .= '</ul>';
                    $tr .= '</div>';
                    $tr.='     <div class="modal fade" id="Modal_rep_' . $value['keygen_exo'] . '" role="dialog">
                                                <div class="modal-dialog modal-lg">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">' . $value['titre_exo'] . '</h4>
                                                         </div>
                                                     <div class="modal-body"></div>
                                                     <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                                     </div>
                                                   </div>
                                               </div>
                                          </div>';
                    ?>


                    <?php
                    $tr .= '</td>';

                    $tr .= '</tr>';
                }
                echo $tr;
            }
            ?>
        </tbody>

        <tfoot>
            <tr>
                <th><input type="text" name="filter_rendering_engine"   placeholder="Filtre Date"    class="form-control input-sm datatable_input_col_search"></th>
                <th><input type="text" name="filter_browser"    placeholder="Filtre Nom"   class="form-control input-sm datatable_input_col_search"></th>
                <th><input type="text" name="filter_browser"    placeholder="Filtre Identifiant"   class="form-control input-sm datatable_input_col_search"></th>
                <th><input type="text" name="filter_browser"    placeholder="Filtre le statut code"   class="form-control input-sm datatable_input_col_search"></th>
                <th><input type="text" name="filter_browser"    placeholder="Filtre le theme"   class="form-control input-sm datatable_input_col_search"></th>
                <th><input type="text" name="filter_browser"    placeholder="Filtre mode de partage"   class="form-control input-sm datatable_input_col_search"></th>
                <th><input type="text" name="filter_browser"    placeholder="Filtre commentaires"   class="form-control input-sm datatable_input_col_search"></th>
                <th><input type="text" name="filter_browser"    placeholder="Filtre Tags"   class="form-control input-sm datatable_input_col_search"></th>

            </tr>
        </tfoot>
    </table>
    <?php
    if (isset($liste_codes) && sizeof($liste_codes) > 0) {
    
        foreach ($liste_codes as $value) {
            ?>
            <div class="modal fade" id="Modal_<?= $value['keygen_exo']; ?>" role="dialog">
                <div class="modal-dialog modal-lg">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"><?= $value['titre_exo']; ?></h4>
                        </div>
                        <div class="modal-body">
                            <div class="row"  id="show_succes_<?= $value['keygen_exo']; ?>"  style="display: none;width:70%;margin-left:7%">                     
                                <div class="alert alert-success" role="alert">
                                    <p><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                                        Votre identifiant a été enregistré avec succès</p>
                                </div>
                            </div>
                            <div class="row"  id="show_erreur_<?= $value['keygen_exo']; ?>"  style="display: none;width:70%;margin-left:7%">  
                                <div class="alert alert-danger" role="alert">
                                    <p><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                        Il y'a des erreurs dans la saisie.</p>
                                </div>
                            </div>
                            <form class="form-horizontal" id="form_add_id_exo_<?= $value['keygen_exo']; ?>" name="form_add_id_exo_<?= $value['keygen_exo']; ?>" method="POST" action="<?= url_espace_eleve ?>/poster_id_corrige.php">
                                <div class="col-md-offset-1  col-md-7">
                                    <div class="form-group">
                                        <label for="nom_code" class="control-label">Saisir un nom à votre code :</label>
                                        <input type="text" class="form-control" id="nom_code_<?= $value['keygen_exo']; ?>" name="nom_code_<?= $value['keygen_exo']; ?>"  value="<?= $value['nom_code']; ?>">
                                    </div> 
                                </div> 
                                <div class="col-md-offset-1  col-md-7">
                                    <div class="form-group">
                                        <label for="nom" class="control-label">Saisir un identifiant de votre travail :</label>
                                        <input type="text" class="form-control" id="id_corrige_exo_<?= $value['keygen_exo']; ?>" name="id_corrige_exo_<?= $value['keygen_exo']; ?>"  value="<?= $value ['ID_code']; ?>"  <?= $value['option_disabled']; ?> >
                                    </div> 
                                </div>
                                <div class="col-md-offset-1  col-md-7">
                                    <div class="form-group">
                                        <label for="partage_code" class="control-label">Choisir un mode de partage :<?= $value['id_mode_public']; ?></label>
                                        <select id="partage_code_<?= $value['keygen_exo']; ?>" name="partage_code_<?= $value['keygen_exo']; ?>" class="form-control">                                                                                                     

                                            <option value="1" <?php
                                            if ($value['id_mode_public'] == '1') {
                                                echo 'selected';
                                            }
                                            ?> >Public</option>
                                            <option value="2"  <?php
                                            if ($value['id_mode_public'] == '2') {
                                                echo 'selected';
                                            }
                                            ?> >Privé</option>

                                        </select>
                                    </div> 
                                </div>
                                <div class="col-md-offset-1  col-md-7">
                                    <div class="form-group">
                                        <label for="comment_code" class="control-label">Poster un commentaire :</label>
                                        <textarea class="form-control  comment_code" rows="8" cols="100" id="comment_code_<?= $value['keygen_exo']; ?>" name="comment_code_<?= $value['keygen_exo']; ?>" placeholder="Poster un commentaire pour ce code"><?= $value['comment_code']; ?></textarea>
                                    </div> 
                                </div>
                                <div class="col-md-offset-1  col-md-7">
                                    <div class="form-group">
                                        <label for="labels_code" class="control-label">Rédiger des mots clés pour identifier votre code :</label>
                                        <input type="text" class="labels_code form-control" id="labels_code_<?= $value['keygen_exo']; ?>"  name="labels_code_<?= $value['keygen_exo']; ?>"  placeholder="Saisir les labels de votre code" value="<?= $value['labels_code']; ?>" >
                                    </div> 
                                </div>


                                <input type="hidden" class="form-control" id="form_keygen_exo_<?= $value['keygen_exo']; ?>" name="form_keygen_exo_<?= $value['keygen_exo']; ?>" value="<?= $value['keygen_exo']; ?>'">
                                <div class="form-group">
                                    <div class="col-md-offset-1  col-md-9">
                                        <button type="submit" id="submit_id_exo_<?= $value['keygen_exo']; ?>" name="submit_id_exo_<?= $value['keygen_exo']; ?>" class="col-md-8 btn btn-primary">Enregistrer votre identifiant</button>
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

    <?php }
} ?>


</div>    
