<?php
session_start();
session_regenerate_id();
require_once 'connection/config.php';
require_once 'librairie/fonctions_local.php';
ini_set('date.timezone', 'Europe/Paris');

function list_statut_code() {
    global $cxn;
    $liste = array();
    try {
        // requete prepare
        $sql = " SELECT * FROM  Liste_statut_code ";
        $resultat = $cxn->prepare($sql);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $liste[$i]['id_statut'] = $enregistrement['id_statut'];
            $liste[$i]['nom_statut'] = $enregistrement['nom_statut'];
            $i++;
        }
    } catch (Exception $e) {
        $parametres_sql = array($id_theme);
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
    }

    return $liste;
}

function list_degre_message() {
    global $cxn;
    $liste = array();
    try {
        // requete prepare
        $sql = " SELECT * FROM  Liste_degre_message ";
        $resultat = $cxn->prepare($sql);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $liste[$i]['id_level'] = $enregistrement['id_level'];
            $liste[$i]['nom_level'] = $enregistrement['nom_level'];
            $i++;
        }
    } catch (Exception $e) {
        $parametres_sql = array($id_theme);
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
    }

    return $liste;
}

function list_eleves($keygen_exo, $tag = NULL, $etat_code = NULL) {
    global $cxn;
    $liste = array();
    try {
        if (!is_null($tag)) {
            $sql = " SELECT    DISTINCT  Membre.code_user,CONCAT(Membre.nom,'.',Membre.prenom) AS  identite_eleve,Membre.profil_img,Corrige_exercices_eleves.date_created,"
                    . "Corrige_exercices_eleves.keygen_rep,Corrige_exercices_eleves.code_fiddle,Corrige_exercices_eleves.date_update,Corrige_exercices_eleves.keygen_rep,Corrige_exercices_eleves.fk_statut_code,Corrige_exercices_eleves.comment_code "
                    . " FROM  Membre,Corrige_exercices_eleves   WHERE  Membre.code_user=Corrige_exercices_eleves.code_eleve        AND   Membre.user_actif='1'   AND  Corrige_exercices_eleves.keygen_exo='$keygen_exo' AND  (LOWER(nom) LIKE '%$tag%' OR  LOWER(prenom)  LIKE '%$tag%')  ORDER BY Corrige_exercices_eleves.date_update   ";
        }
        if (!is_null($etat_code)) {
            $sql = " SELECT    DISTINCT  Membre.code_user,CONCAT(Membre.nom,'.',Membre.prenom) AS  identite_eleve,Membre.profil_img,Corrige_exercices_eleves.date_created,
                  Corrige_exercices_eleves.keygen_rep,Corrige_exercices_eleves.code_fiddle,Corrige_exercices_eleves.date_update,Corrige_exercices_eleves.keygen_rep,Corrige_exercices_eleves.fk_statut_code,Corrige_exercices_eleves.comment_code 
                    FROM  Membre,Corrige_exercices_eleves   WHERE  Membre.code_user=Corrige_exercices_eleves.code_eleve        AND   Membre.user_actif='1'   AND  Corrige_exercices_eleves.keygen_exo='$keygen_exo' ";
            if (!empty($etat_code)) {
                $sql.= "AND  Corrige_exercices_eleves.fk_statut_code='$etat_code'   ";
            }

            $sql.= "ORDER BY Corrige_exercices_eleves.date_update   ";
        }


        $select = $cxn->query($sql);
        $i = 0;
        while ($enregistrement = $select->fetch()) {
            $liste[$i]['date_creation_code'] = $enregistrement['code_user'];
            $liste[$i]['identite_eleve'] = $enregistrement['identite_eleve'];
            $liste[$i]['profil_img'] = url_dir_img_eleves . '/' . $enregistrement['profil_img'];
            $liste[$i]['keygen_rep'] = $enregistrement['keygen_rep'];
            $liste[$i]['date_creation_code'] = $enregistrement['date_created'];
            $liste[$i]['date_creation_code'] = $enregistrement['date_created'];
            $liste[$i]['date_update_code'] = $enregistrement['date_update'];
            $liste[$i]['identifiant_code_reponse'] = $enregistrement['code_fiddle'];
            $liste[$i]['id_statut_code'] = $enregistrement['fk_statut_code'];
            if ($enregistrement['fk_statut_code'] == '1') {
                $liste[$i]['statut_code'] = '<span class="label label-info">Attente</span>';
            } else if ($enregistrement['fk_statut_code'] == '2') {
                $liste[$i]['statut_code'] = '<span class="label label-primary">En cours de traitement</span>';
            } else if ($enregistrement['fk_statut_code'] == '3') {
                $liste[$i]['statut_code'] = '<span class="label label-success">Code correct</span>';
            } else if ($enregistrement['fk_statut_code'] == '4') {
                $liste[$i]['statut_code'] = '<span class="label label-danger">Code non correct</span>';
            } else if ($enregistrement['fk_statut_code'] == '5') {
                $liste[$i]['statut_code'] = '<span class="label label-warning">Code inaccessible</span>';
            }
            $liste[$i]['contenu_comment'] = $enregistrement['comment_code'];
            if ($enregistrement['date_update'] != '') {
                $liste[$i]['date_comment'] = $enregistrement['date_update'];
            } else {
                $liste[$i]['date_comment'] = $enregistrement['date_created'];
            }

            /*             * ******* Liste notifications *************************** */
            try {
                $sql1 = " SELECT DISTINCT Notifications_codes_eleves.contenu_notif,Notifications_codes_eleves.date_created,Notifications_codes_eleves.degre_notif,Liste_degre_message.code_span"
                        . "  FROM  Notifications_codes_eleves,Liste_degre_message"
                        . "   WHERE Notifications_codes_eleves.degre_notif=Liste_degre_message.id_level "
                        . "   AND  Notifications_codes_eleves.keygen_rep=:param1 ";

                $resultat1 = $cxn->prepare($sql1);
                $resultat1->bindParam(':param1', $enregistrement['keygen_rep']);
                $resultat1->execute();
                $j = 0;
                while ($enregistrement1 = $resultat1->fetch()) {
                    $liste[$i]['liste_notification'][$j]['degre_notif'] = $enregistrement1['code_span'];
                    $liste[$i]['liste_notification'][$j]['contenu'] = $enregistrement1['contenu_notif'];
                    $liste[$i]['liste_notification'][$j]['date_notif'] = $enregistrement1['date_created'];
                    $j++;
                }
            } catch (Exception $e) {
                $parametres_sql = array($enregistrement['keygen_rep']);
                $numargs = func_num_args();
                debug_function(debug_backtrace(), $numargs, $e, $sql1, $parametres_sql);
            }

            /*             * ********************************************************* */
            $i++;
        }
    } catch (Exception $e) {
        $parametres_sql = array($id_theme);
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
    }
    //var_dump($liste);
    return $liste;
}

$keygen_exo = $_POST['token_exo'];
if (isset($_POST['tag'])) {
    $tag = $_POST['tag'];
    $list_eleves = list_eleves($keygen_exo, $tag, NULL);
} elseif (isset($_POST['etat_code'])) {
    $etat_code = $_POST['etat_code'];
    $list_eleves = list_eleves($keygen_exo, NULL, $etat_code);
}
$list_statut_code = list_statut_code();
$list_degre_message = list_degre_message();
?>

<?php
if (sizeof($list_eleves) > 0) {
    foreach ($list_eleves as $value) {
        ?>

        <div class="col-sm-6">
            <div class="panel">
                <div class="panel-body p-t-10">
                    <div class="media-main">
                        <a class="pull-left" href="#">
        <!--                            <img class="thumb-lg img-circle bx-s" src="<?= $value['profil_img']; ?>" alt="">-->
                        </a>

                        <div class="info">
                            <h4><?= $value['identite_eleve']; ?></h4>
        <!--                                <p class="text-muted">Graphics Designer</p>-->
                        </div>
                    </div>
                    <div class="clearfix"></div><br>
                    <!--*********************************************************-->


                    <table class="table table-striped">                       
                        <tbody>
                            <tr>

                                <td>ID code réponse</td>
                                <td><?= $value['keygen_rep']; ?></td>

                            </tr>
                            <tr>

                                <td>ID code plate forme</td>
                                <td><?= $value['identifiant_code_reponse']; ?></td>

                            </tr>
                            <tr>

                                <td>Date création</td>
                                <td><?= $value['date_creation_code']; ?></td>                                
                            </tr>
        <?php if ($value['date_update_code'] != '') { ?>
                                <tr>

                                    <td>date update</td>
                                    <td><?= $value['date_update_code']; ?></td>

                                </tr>
        <?php } ?>
                            <tr>

                                <td>Statut code</td>
                                <td><?= $value['statut_code']; ?></td>

                            </tr>
                            <tr>

                                <td>Poster des infos</td>
                                <td>
                                    <a href="#" data-fiddle="<?= $value['keygen_rep']; ?>"  >
                                        <button type="text" class="btn btn-success">Poster des infos sur le code</button>
                                    </a>
                                    <!--*********************************************************-->
                                    <div class="modal fade" id="Modal_<?= $value['keygen_rep']; ?>" role="dialog">
                                        <div class="modal-dialog modal-lg">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">
                                                        <div class="media-main">
                                                            <a class="pull-left" href="#">
        <!--                                                                <img class="thumb-lg img-circle bx-s" src="<?= $value['profil_img']; ?>" alt="">-->
                                                            </a>

                                                            <div class="info">
                                                                <h4><?= $value['identite_eleve']; ?></h4>
                                    <!--                                <p class="text-muted">Graphics Designer</p>-->
                                                            </div>
                                                            <div class="info">
                                                                <h4><?= $infos_exo['titre_exo']; ?></h4>
                                    <!--                                <p class="text-muted">Graphics Designer</p>-->
                                                            </div>

                                                        </div>

                                                    </h4>
                                                </div>
                                                <div class="modal-body">


                                                    <!----------------------------------------------->
                                                    <ul class="nav nav-tabs">
                                                        <li class="active"><a href="#consult_reponse_<?= $value['keygen_rep']; ?>" data-toggle="tab">Consulter la reponse</a></li>
                                                        <li><a href="#modif_statu_code_<?= $value['keygen_rep']; ?>" data-toggle="tab">Modifier le statut code</a></li>
                                                        <li><a href="#poster_notification_code_<?= $value['keygen_rep']; ?>" data-toggle="tab">Poster une notification</a></li>
        <?php if ($value['contenu_comment'] != '') { ?>
                                                            <li><a href="#list_comments_code_<?= $value['keygen_rep']; ?>" data-toggle="tab">Les commentaires postés par l'eleve</a></li>
                                                        <?php } ?>  

                                                    </ul>
                                                    <div id="myTabContent_<?= $value['keygen_rep']; ?>" class="tab-content">
                                                        <div class="tab-pane fade active in" id="consult_reponse_<?= $value['keygen_rep']; ?>">
                                                            <div  id="contenu_reponse_<?= $value['keygen_rep']; ?>">

                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="modif_statu_code_<?= $value['keygen_rep']; ?>">
                                                            <div class="col-md-offset-1  col-md-9">
                                                                <span  style="font-size: 20px">Le statut actuel </span> : <span  id="statut_code_actuel_<?= $value['keygen_rep']; ?>"><?= $value['statut_code']; ?></span>
                                                            </div>
                                                            <div class="row"  id="show_succes_code_<?= $value['keygen_rep']; ?>"  style="display: none;width:70%;margin-left:7%">                     
                                                                <div class="alert alert-success" role="alert">
                                                                    <p><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                                                                        Le statut de code a été enregistré avec succès</p>
                                                                </div>
                                                            </div>
                                                            <div class="row"  id="show_erreur_code_<?= $value['keygen_rep']; ?>"  style="display: none;width:70%;margin-left:7%">  
                                                                <div class="alert alert-danger" role="alert">
                                                                    <p><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                                                        Il y'a des erreurs dans la saisie.</p>
                                                                </div>
                                                            </div>
                                                            <form class="form-horizontal" id="form_add_id_statut_<?= $value['keygen_rep']; ?>" name="form_add_id_statut_<?= $value['keygen_rep']; ?>" method="POST" action="<?= url_espace_formateur; ?>/change_statut_code.php">


                                                                <div class="col-md-offset-1  col-md-7">
                                                                    <div class="form-group">
                                                                        <label for="nom" class="control-label">Choisissez le statut</label>
                                                                        <select id="id_statut_code_<?= $value['keygen_rep']; ?>" name="id_statut_code_<?= $value['keygen_rep']; ?>" class="form-control">
                                                                            <option value="">Changer le statut</option>
        <?php foreach ($list_statut_code as $value1) { ?>
                                                                                <option value="<?= $value1['id_statut']; ?>"
                                                                                <?php
                                                                                if ($value1['id_statut'] == $value['id_statut_code']) {
                                                                                    echo "selected";
                                                                                }
                                                                                ?>    

                                                                                        >
            <?= $value1['nom_statut']; ?>
                                                                                </option>
                                                                                        <?php } ?>                                     

                                                                        </select>
                                                                    </div> 
                                                                </div>                                                   
                                                                <div class="form-group">
                                                                    <div class="col-md-offset-1  col-md-9">
                                                                        <button type="submit" id="submit_id_statut_<?= $value['keygen_rep']; ?>" name="submit_id_statut_<?= $value['keygen_rep']; ?>" class="col-md-8 btn btn-primary">Changer le statut de code</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="tab-pane fade" id="poster_notification_code_<?= $value['keygen_rep']; ?>">
                                                            <div class="chat-body row"  id="list_notif_<?= $value['keygen_rep']; ?>"> 
        <?php
        if (sizeof($value['liste_notification']) > 0) {
            foreach ($value['liste_notification'] as $value4) {
                ?>


                                                                        <div class="answer left">                   

                                                                            <div class="text">
                <?= $value4['contenu']; ?>
                                                                            </div>
                                                                            <div class="time"> <?= $value4['date_notif']; ?>&nbsp;<?= $value4['degre_notif']; ?></div>
                                                                        </div>


                <?php
            }
        }
        ?>
                                                            </div>
                                                            <hr/>
                                                            <div class="row"  id="show_succes_notif_<?= $value['keygen_rep']; ?>"  style="display: none;width:70%;margin-left:7%">                     
                                                                <div class="alert alert-success" role="alert">
                                                                    <p><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                                                                        La notification de code a été enregistré avec succès</p>
                                                                </div>
                                                            </div>
                                                            <div class="row"  id="show_erreur_notif_<?= $value['keygen_rep']; ?>"  style="display: none;width:70%;margin-left:7%">  
                                                                <div class="alert alert-danger" role="alert">
                                                                    <p><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                                                        Il y'a des erreurs dans la saisie.</p>
                                                                </div>
                                                            </div>
                                                            <form class="form-horizontal" id="form_add_notif_code_<?= $value['keygen_rep']; ?>" name="form_add_notif_code_<?= $value['keygen_rep']; ?>" method="POST" action="<?= url_espace_formateur; ?>/poster_notification_code.php">



                                                                <div class="col-md-offset-1  col-md-7">
                                                                    <div class="form-group">
                                                                        <label for="level_notif" class="control-label">Rédiger votre notification</label>
                                                                        <textarea class="form-control textera_notification" rows="8" cols="100" id="contenu_notif_<?= $value['keygen_rep']; ?>" name="contenu_notif_<?= $value['keygen_rep']; ?>" placeholder="Rediger votre notification"></textarea>

                                                                    </div> 
                                                                </div>
                                                                <div class="col-md-offset-1  col-md-7">
                                                                    <div class="form-group">
                                                                        <label for="level_notif" class="control-label">Choisissez l'importance de message</label>
                                                                        <select id="degre_notif_code_<?= $value['keygen_rep']; ?>" name="degre_notif_code_<?= $value['keygen_rep']; ?>" class="form-control">
                                                                            <option value="">Changer le degré</option>
        <?php foreach ($list_degre_message as $value2) { ?>
                                                                                <option value="<?= $value2['id_level']; ?>"><?= $value2['nom_level']; ?></option>
                                                                            <?php } ?>                                     

                                                                        </select>
                                                                    </div> 
                                                                </div>                                                   
                                                                <div class="form-group">
                                                                    <div class="col-md-offset-1  col-md-9">
                                                                        <button type="submit" id="submit_notif_code_<?= $value['keygen_rep']; ?>" name="submit_notif_code_<?= $value['keygen_rep']; ?>" class="col-md-8 btn btn-primary">Enregistrer la ntification de code</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
        <?php if ($value['contenu_comment'] != '') { ?>
                                                            <div class="tab-pane fade  in" id="list_comments_code_<?= $value['keygen_rep']; ?>">
                                                                <div class="chat-body row"  id="list_comments_reponse_<?= $value['keygen_rep']; ?>"> 
                                                                    <div class="answer left">                   

                                                                        <div class="text">
            <?= $value['contenu_comment']; ?>
                                                                        </div>
                                                                        <div class="time"> <?= $value['date_comment']; ?></div>
                                                                    </div>
                                                                </div>
                                                            </div>
        <?php } ?> 
                                                    </div>

                                                    <!----------------------------------------------->

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal"  id="close_<?= $value['keygen_rep']; ?>">Fermer</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <!--*********************************************************-->
                                </td>

                            </tr>

                        </tbody>
                    </table>

                    <hr>

                    <!--*********************************************************-->

                </div>
            </div>
        </div>
        <?php
    }
} else {
    echo "Aucun resultat qui correspond a votre recherche.";
}
?>



