<?php

if (!function_exists("infos_vote_quiz")) {

    function infos_vote_quiz($random_quiz) {
        global $cxn;
        $infos = array();
        try {
            $sql = " SELECT nombre_votes, FORMAT( (total_point / nombre_votes), 1 ) AS moy_votes
                     FROM Votes_quiz_eleve
                     WHERE random_quiz=:param1  ";
            $resultat = $cxn->prepare($sql);
            $resultat->bindParam(':param1', $random_quiz);
            $resultat->execute();
            $enregistrement = $resultat->fetch();
            if ($enregistrement['nombre_votes'] == '') {
                $infos['moy_votes'] = 0;
                $infos['nombre_votes'] = 0;
            } else {
                $infos['moy_votes'] = $enregistrement['moy_votes'];
                $infos['nombre_votes'] = $enregistrement['nombre_votes'];
            }
        } catch (Exception $e) {
            $numargs = func_num_args();
            debug_function(debug_backtrace(), $numargs, $e, $sql, array($random_quiz));
        }


        return $infos;
    }

}
if (!function_exists("infos_quiz_like")) {

    function infos_quiz_like($random_quiz) {
        global $cxn;
        $infos = array();
        try {
            $sql = " SELECT  like_quiz,dislike_quiz  FROM  Quiz   WHERE  random=:param1  ";
            $resultat = $cxn->prepare($sql);
            $resultat->bindParam(':param1', $random_quiz);
            $resultat->execute();
            $enregistrement = $resultat->fetch();
            $infos['like'] = $enregistrement['like_quiz'];
            $infos['dislike'] = $enregistrement['dislike_quiz'];
        } catch (Exception $e) {
            $numargs = func_num_args();
            debug_function(debug_backtrace(), $numargs, $e, $sql, array($random_quiz));
        }


        return $infos;
    }

}
if (!function_exists("data_question")) {

    function data_question($id_question) {
        global $cxn;
        $elements = array();
        /*         * ************* Question ******************* */
        try {
            $sql = "  SELECT Theme_quiz.code_intervenant  AS code_intervenant,Quiz.id_quiz,Quiz.intervenant_contribution AS code_intervenant_contribue,Question_quiz.id AS id_question,Question_quiz.data_text,
            
                      Question_quiz.astuce_text,Formules_theme.formule_latex,
                
                      Question_quiz.source_img,Question_quiz.lien_img

                      FROM Question_quiz 

                      LEFT JOIN Formules_theme  ON Question_quiz.id_formule = Formules_theme.id_formule  

                     LEFT JOIN Quiz  ON Question_quiz.id_quiz = Quiz.id_quiz
 
                    LEFT JOIN Theme_quiz  ON Quiz.id_quiz_theme = Theme_quiz.id_theme
                
                WHERE  Question_quiz.id=:param1  ";

            $resultat = $cxn->prepare($sql);
            $resultat->bindParam(':param1', $id_question);
            $resultat->execute();
            $enregistrement = $resultat->fetch();
            /*             * **************************** contenu question *************************************** */
            if ($enregistrement['data_text'] != '') {
                $elements ['data'] = '<p style="margin-left:40%">' . $enregistrement['data_text'] . '</p>';
            }
            /*             * ******************** Balise de img ******************************** */
            if ($enregistrement['lien_img'] != '') {
                $elements ['source_img'] = ' <img class="img-fluid"  src="' . $enregistrement['lien_img'] . '" alt=""   title="img_question"  style="width:75%;height: auto"/>';
            } elseif ($enregistrement['source_img'] != '') {
                if ($enregistrement['astuce_text'] != 'code_intervenant_contribue') {
                    $code_intervenant = $enregistrement['code_intervenant_contribue'];
                } else {
                    $code_intervenant = $enregistrement['code_intervenant'];
                }
                $elements ['source_img'] = ' <img class="img-fluid"  src="http://mega-cours.fr/telechargement/media_quiz_cours/Quiz/' . $code_intervenant . '/' . $enregistrement['id_quiz'] . '/' . $enregistrement['source_img'] . '  " alt=""   title="img_question"  style="width:75%;height: auto"/>';
            } else {
                $elements ['source_img'] = '';
            }
        } catch (Exception $e) {
            $numargs = func_num_args();
            debug_function(debug_backtrace(), $numargs, $e, $sql, array($id_question));
        }

        return $elements;
    }

}
if (!function_exists("data_reponse")) {

    function data_reponse($id_reponse) {
        global $cxn;
        $reponse = array();
        try {
            $sql = " SELECT  data_text,point FROM Reponse_question WHERE  id_reponse=:param1  ";

            $resultat = $cxn->prepare($sql);
            $resultat->bindParam(':param1', $id_reponse);
            $resultat->execute();
            $enregistrement = $resultat->fetch();

            if ($enregistrement['data_text'] != '') {
                $reponse['data'] = '<p style="margin-left:5%">' . $enregistrement['data_text'] . '</p>';
            }

            $reponse['point'] = $enregistrement['point'];
            if ($enregistrement['point'] == 0) {
                $reponse['fa'] = 'fa-times-circle-o';
                $reponse['color_fa'] = 'red';
            } else {
                $reponse['fa'] = 'fa-check-circle';
                $reponse['color_fa'] = 'green';
            }
        } catch (Exception $e) {
            $numargs = func_num_args();
            debug_function(debug_backtrace(), $numargs, $e, $sql, array($id_reponse));
        }

        return $reponse;
    }

}
if (!function_exists("data_corrige_question")) {

    function data_corrige_question($id_question) {
        global $cxn;
        $data = '';
        try {
            $sql = " SELECT  corrige_text  FROM  Question_quiz  WHERE  id=:param1  ";
            $resultat = $cxn->prepare($sql);
            $resultat->bindParam(':param1', $id_question);
            $resultat->execute();
            $enregistrement = $resultat->fetch();

            if ($enregistrement['corrige_text'] != '') {
                $data = '<p style="margin-left:5%">' . $enregistrement['corrige_text'] . '</p>';
            }
        } catch (Exception $e) {
            $numargs = func_num_args();
            debug_function(debug_backtrace(), $numargs, $e, $sql, array($id_question));
        }

        return $data;
    }

}
if (!function_exists("list_reponses_juste")) {

    function list_reponses_juste($id_question) {
        global $cxn;
        $list_reponses = array();
        /*         * *************** Liste des Reponses-juste ********************** */
        try {
            $sql = " SELECT id_reponse,data_text FROM Reponse_question WHERE id_question =:param1   AND point >0  ";
            $resultat = $cxn->prepare($sql);
            $resultat->bindParam(':param1', $id_question);
            $resultat->execute();
            $i = 0;
            while ($enregistrement = $resultat->fetch()) {

                if ($enregistrement['data_text'] != '') {
                    $list_reponses [$i]['data'] = '<p style="margin-left:5%">' . $enregistrement['data_text'] . '</p>';
                }
                $list_reponses[$i]['id_reponse'] = $enregistrement['id_reponse'];

                $i++;
            }
        } catch (Exception $e) {
            $numargs = func_num_args();
            debug_function(debug_backtrace(), $numargs, $e, $sql, array($id_question));
        }
        return $list_reponses;
    }

}
if (!function_exists("list_quiz_meme_theme")) {

    function list_quiz_meme_theme($id_quiz, $id_theme) {
        global $cxn;
        $list_quiz = array();

        try {
            $sql = " SELECT random,nom   FROM  Quiz WHERE id_quiz !=:param1  AND id_quiz_theme=:param2 ";
            //  $sql = " SELECT random,nom   FROM  Quiz WHERE id_quiz !=:param1 ";
            $resultat = $cxn->prepare($sql);
            $resultat->bindParam(':param1', $id_quiz);
            $resultat->bindParam(':param2', $id_theme);
            $resultat->execute();
            $i = 0;
            while ($enregistrement = $resultat->fetch()) {
                $key = $enregistrement['random'];
                $value = $enregistrement['nom'];
                $list_quiz[$key] = $value;
            }
        } catch (Exception $e) {
            $numargs = func_num_args();
            debug_function(debug_backtrace(), $numargs, $e, $sql, array($id_quiz, $id_theme));
        }
        return $list_quiz;
    }

}

if (!function_exists("barre_progression_reussite_quiz")) {

    function barre_progression_reussite_quiz($random_quiz, $code_user) {
        global $cxn;
        $div_progression = '';

        try {
            $sql = "  SELECT   Resultat_quiz.taux_reussite  

                   FROM  Resultat_quiz 

                   LEFT JOIN Quiz  ON Resultat_quiz.id_quiz = Quiz.id_quiz

                   WHERE     Quiz.random='" . $random_quiz . "'  AND  Resultat_quiz.code_user='" . $code_user . "' ";
            $select = $cxn->query($sql);
            $nb = $select->rowCount();
            if ($nb <= 0) {
                $div_progression = '';
            } else {
                $enregistrement = $select->fetch();
                $taux = sprintf("%.2f", $enregistrement ['taux_reussite']);
                $div_progression = '<div class="progress">
                                  <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar"    aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: ' . $taux . '%" >
                                         ' . $taux . '% Réussi
                                  </div>
                               </div>';
            }
        } catch (Exception $e) {
            $numargs = func_num_args();
            debug_function(debug_backtrace(), $numargs, $e, $sql);
        }

        return $div_progression;
    }

}

if (!function_exists("List_valeurs_tab")) {

    function List_valeurs_tab($nombre_valeurs, $tab_entree) {

        $tab_sorti = array();
        $taille_tab_entree = sizeof($tab_entree);
        if ($nombre_valeurs <= $taille_tab_entree) {
            for ($i = 0; $i < $nombre_valeurs; $i++) {
                $key = array_rand($tab_entree, 1);
                $tab_sorti[$key] = $tab_entree[$key];
                unset($tab_entree[$key]);
            }
        } else {
            for ($i = 0; $i < $taille_tab_entree; $i++) {
                $key = array_rand($tab_entree, 1);
                $tab_sorti[$key] = $tab_entree[$key];
                unset($tab_entree[$key]);
            }
        }

        return $tab_sorti;
    }

}
?>