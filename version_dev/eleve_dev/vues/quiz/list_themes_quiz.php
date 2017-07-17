<?php include 'breadcrumb.php' ?>
<div class="col-lg-12" style="padding-top: 40px">
    <?php
    foreach ($list_section as $key => $value) {
        $list_themes = list_themes( $_SESSION ['membre']['code_eleve'], $value['id_section']);        
        if (sizeof($list_themes) != 0) {
            ?>
            <div class="row">
                <div class="row">
                    <div class="ribbon">
                        <div class="ribbon-stitches-top"></div>
                        <strong class="ribbon-content"><h1><?php echo $value['nom_section']; ?></h1></strong>
                        <div class="ribbon-stitches-bottom"></div>

                    </div>
                </div>
                <div style="padding-top:100px"></div>
                <div class="col-lg-12" id="arrondi1">
                    
                 
                    <table class="table table-hover">
                        <thead>
                            <tr>

                                <th><h4 class="text-danger" style="font-weight : bold;">Theme</h4></th> 
                                <th style="text-align : center;"><h4 class="text-danger" style="font-weight : bold;">Nombre de Quiz</h4></th>
                                <th><h4 class="text-danger" style="font-weight : bold;">Progression travail</h4></th>
                                <th><h4 class="text-danger" style="font-weight : bold;">Progression réussite</h4></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $tr = '';
                            $j = 1;
                            foreach ($list_themes as $value) {
                                $tr.= '<tr>                       
                                                    <td>
                                                        <a href="' . url_espace_eleve . '/index.php?module=quiz&action=list_quiz_theme&nom_matiere='.$nom_matiere.'&code_matiere='.$_SESSION['code_matiere'].'&random_theme=' . $value['random_theme'] . '">  <h4 class="text-primary">' . $j . '. ' . $value['nom_theme'] . '</h4></a>
                                                    </td>
                                                    <td style="text-align : center;">
                                                       
                                                              <span class="badge">' . $value['nbre_quiz_par_theme'] . '</span>
                                                    
                                                    </td>
                                                    <td>
                                                        <div class="progress">
                                                            <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: ' . $value['progression_travail'] . '%;">
                                                                ' . $value['progression_travail'] . '% Effectué
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                         <div class="progress">

                                                              <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar"    aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: ' . $value['progression_reussite'] . '%">
                                                                     ' . $value['progression_reussite'] . '% Réussi
                                                              </div>
                                                         </div>
                                                    </td>

                                                </tr>';
                                $j++;
                            } echo $tr;
                            ?>     

                        </tbody>
                    </table>

                </div>
            </div>
            <div style="padding-top:100px"></div>
            <?php
        }
    }
    ?>
</div>



