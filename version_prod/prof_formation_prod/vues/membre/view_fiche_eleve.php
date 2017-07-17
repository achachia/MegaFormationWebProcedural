<?php include 'breadcrumb.php' ?>

<div class = "row">
    <div class="col-lg-12">
        <div class="bootstrap snippet">
            <div class="col-md-12">


                <h2 class="text-primary">Le profil personnel</h2>
                <hr/>

                <div class="row">

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12  toppad" >


                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title"><?= $infos_user['identite_user']; ?></h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="<?= $infos_user['profil_img']; ?>" class="img-circle img-responsive"  style="width: 200px"> </div>


                                    <div class=" col-md-9 col-lg-9 ">                     

                                        <table class="table table-user-information">
                                            <header style="background-color: #FFC0CB;text-align: center;font-size: 35px">Le profil en détail</header>
                                            <tbody>
                                                <tr style="background-color: #DCDCDC;text-align: center;font-size: 35px" colspan="4">
                                                    <td colspan="4" >la fiche personnelle</td>
                                                </tr>
                                                <tr>
                                                    <td>Pseudo :</td>
                                                    <td  class="user_profil"><?= $infos_user['pseudo']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Email</td>
                                                    <td  class="user_profil"><?= $infos_user['email']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Date naissance</td>
                                                    <td class="user_profil"><?= $infos_user['date_naissance_view_profil']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Date inscription</td>
                                                    <td class="user_profil"><?= $infos_user['date_inscription']; ?></td>
                                                </tr>                                              
                                                <tr>
                                                    <td>Sex</td>
                                                    <td  class="user_profil"><?= $infos_user['sex_user']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Niveau pédagogique</td>
                                                    <td  class="user_profil"><?= $infos_user['niv_peda_user']; ?></td>
                                                </tr>
                                                <?php if ($infos_user['id_js_fiddle'] != '') { ?>  
                                                    <tr>
                                                        <td>Identifiant Js fiddle</td>
                                                        <td  class="user_profil"><?= $infos_user['id_js_fiddle']; ?></td>
                                                    </tr>
                                                <?php } ?>
                                                <?php if ($infos_user['id_php_fiddle'] != '') { ?>     
                                                    <tr>
                                                        <td>Identifiant PHP fiddle</td>
                                                        <td  class="user_profil"><?= $infos_user['id_php_fiddle']; ?></td>
                                                    </tr> 
                                                <?php } ?>
                                                <tr style="background-color: #DCDCDC;text-align: center;font-size: 35px" colspan="4">
                                                    <td colspan="4" >Experience professionelle</td>
                                                </tr>
                                                <tr>
                                                    <td>Avez vous un projet professionnel lié au domaine de web?</td>
                                                    <td  class="user_profil"><?= $infos_user['projet_professionel']; ?></td>
                                                </tr>
                                                <?php if ($infos_user['contenu_projet_professionel'] != '') { ?>     
                                                    <tr>
                                                        <td>Contenu du projet professionnel</td>
                                                        <td  class="user_profil"><?= $infos_user['contenu_projet_professionel']; ?></td>
                                                    </tr> 
                                                <?php } ?>
                                                <tr>
                                                    <td>Avez vous déja programmé ?</td>
                                                    <td  class="user_profil"><?= $infos_user['deja_programme']; ?></td>
                                                </tr>
                                                <?php if ($infos_user['liste_langages_dev'] != '') { ?>     
                                                    <tr>
                                                        <td>Les langages de programmation</td>
                                                        <td  class="user_profil"><?= $infos_user['liste_langages_dev']; ?></td>
                                                    </tr> 
                                                <?php } ?>
                                                <tr>
                                                    <td>Quelles sont vos attentes par rapport cette formation ?</td>
                                                    <td  class="user_profil"><?= $infos_user['attentes']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Avez vous déja eu des formations dans le domaine du web ?</td>
                                                    <td  class="user_profil"><?= $infos_user['deja_avoir_formation']; ?></td>
                                                </tr>
                                                <?php if ($infos_user['contenu_formation'] != '') { ?>     
                                                    <tr>
                                                        <td>Le contenu du formation</td>
                                                        <td  class="user_profil"><?= $infos_user['contenu_formation']; ?></td>
                                                    </tr> 
                                                <?php } ?>


                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>                    

                        </div>
                    </div>
                </div>


            </div>


        </div>
    </div>
</div>


