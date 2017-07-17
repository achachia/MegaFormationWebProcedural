<?php

if (!function_exists("parametres_quiz")) {

    function parametres_quiz($random_quiz) {
        global $cxn;
        $parametres = array();

        /*         * ***************** recuperer Les informations du Quiz****************************** */

        try {
            $sql = " SELECT Section_theme.id_section,Section_theme.code_matiere,Quiz.nom,Quiz.genre,Quiz.id_quiz_theme,Quiz.id_quiz,Quiz.mod_affichage_question
                     FROM Quiz, Theme_quiz, Section_theme
                     WHERE Quiz.id_quiz_theme = Theme_quiz.id_theme
                     AND Theme_quiz.section_theme = Section_theme.id_section
                     AND Quiz.random =:param1  ";

            $resultat = $cxn->prepare($sql);
            $resultat->bindParam(':param1', $random_quiz);
            $resultat->execute();
            $enregistrement = $resultat->fetch();
            $id_quiz = $enregistrement['id_quiz'];
            $id_theme_quiz = $enregistrement['id_quiz_theme'];
            if ($enregistrement['genre'] == '3') {
                $parametres['name_quiz'] = 'reponses[]';
                $parametres['type_quiz'] = 'checkbox';
                $parametres['texte_quiz'] = 'Cochez la ou les bonnes réponses';
            } elseif ($enregistrement['genre'] == '1' || $enregistrement['genre'] == '2') {
                $parametres['name_quiz'] = 'reponses';
                $parametres['type_quiz'] = 'radio';
                $parametres['texte_quiz'] = 'Cochez la bonne réponse';
            }
            $parametres['titre_quiz'] = $enregistrement['nom'];
            $parametres['id_theme_quiz'] = $id_theme_quiz;
             $parametres['id_theme_quiz'] = $id_theme_quiz;
            $parametres['id_quiz'] = $id_quiz;
            $parametres['random_quiz'] = $random_quiz;
            $parametres['id_section'] = $enregistrement['id_section'];
            $parametres['mode_affichage_question'] = $enregistrement['mod_affichage_question'];
            $parametres ['code_matiere'] = $enregistrement['code_matiere'];
        } catch (Exception $e) {
            $parametres_sql = array($random_quiz);
            $numargs = func_num_args();
            debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
        }
        /*         * ******************** Nbre-quiz par theme ****************************** */
        try {
            $sql = " SELECT  COUNT(id_quiz) AS nbre_quiz_par_theme FROM  Quiz  WHERE  id_quiz_theme=:param1 ";

            $resultat = $cxn->prepare($sql);
            $resultat->bindParam(':param1', $id_theme_quiz);
            $resultat->execute();
            $enregistrement = $resultat->fetch();
            $parametres['nbre_quiz_par_theme'] = $enregistrement['nbre_quiz_par_theme'];
        } catch (Exception $e) {
            $parametres_sql = array($id_theme_quiz);
            $numargs = func_num_args();
            debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
        }
        /*         * ***************Total points Quiz  associe a son identifiant******************** */
        try {
            $sql = " SELECT  SUM(Reponse_question.point) AS total_points 

                 FROM  Reponse_question,Question_quiz,Quiz 

                 WHERE Reponse_question.id_question=Question_quiz.id

                 AND   Question_quiz.id_quiz=Quiz.id_quiz
                 
                 AND Quiz.id_quiz=:param1 ";

            $resultat = $cxn->prepare($sql);
            $resultat->bindParam(':param1', $id_quiz);
            $resultat->execute();
            $enregistrement = $resultat->fetch();
            $parametres ['total_points_quiz'] = $enregistrement['total_points'];
        } catch (Exception $e) {
            $parametres_sql = array($id_quiz);
            $numargs = func_num_args();
            debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
        }

        /*         * **********************Nombre de question Quiz**************************** */
        try {
            $sql = " SELECT COUNT(id) AS nbre_question  FROM  Question_quiz  WHERE   id_quiz=:param1  ";
            $resultat = $cxn->prepare($sql);
            $resultat->bindParam(':param1', $id_quiz);
            $resultat->execute();
            $enregistrement = $resultat->fetch();
            $parametres ['nbre_question'] = $enregistrement['nbre_question'];
        } catch (Exception $e) {
            $parametres_sql = array($id_quiz);
            $numargs = func_num_args();
            debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
        }

        /*         * *********************************************************** */
        return $parametres;
    }

}
if (!function_exists("array_id_question")) {

    function array_id_question($random_quiz) {
        global $cxn;
        $array_id = array();
        /*         * ************ recuperation id_quiz ******************** */
        try {
            $sql = " SELECT  id_quiz  FROM  Quiz  WHERE  random=:param1 ";

            $resultat = $cxn->prepare($sql);
            $resultat->bindParam(':param1', $random_quiz);
            $resultat->execute();
            $enregistrement = $resultat->fetch();
            $id_quiz = $enregistrement['id_quiz'];
        } catch (Exception $e) {
            $parametres_sql = array($random_quiz);
            $numargs = func_num_args();
            debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
        }
        /*         * **************************************************** */
        try {
            $sql = " SELECT  id  FROM  Question_quiz  WHERE  id_quiz=:param1  ";

            $resultat = $cxn->prepare($sql);
            $resultat->bindParam(':param1', $id_quiz);
            $resultat->execute();
            $i = 0;
            while ($enregistrement = $resultat->fetch()) {
                $array_id [$i] = $enregistrement['id'];
                $i++;
            }
        } catch (Exception $e) {
            $parametres_sql = array($id_quiz);
            $numargs = func_num_args();
            debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
        }
        return $array_id;
    }

}

if (!function_exists("generer_id_question")) {

    function generer_id_question($array_id_question, $mode_affichage) {
        $identifiant = '';
        $key = 0;
        /*         * ******** recuperer une valeur aleatoire ************* */
        if ($mode_affichage == '1') {
            $key = array_rand($array_id_question, 1);
        }

        /*         * ******************************************************** */
        $identifiant = $array_id_question[$key];
        return $identifiant;
    }

}
/* * ************ reordonner les cle-valeurs du tableau ****** */
if (!function_exists("reordonner_cle_tab")) {

    function reordonner_cle_tab($tab) {
       // echo '/******************* avant tri *******************<br/>';
        //var_dump($tab);
        $tab_tri = array();
        $i = 0;
        foreach ($tab as $value) {
            $tab_tri[$i] = $value;
            $i++;
        }
          
        return $tab_tri;
    }

}

/* * **************************************** */
if (!function_exists("elements_quiz")) {

    function elements_quiz($id_question) {

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
                $elements ['question']['data'] = '<p style="margin-left:40%">' . $enregistrement['data_text'] . '</p>';
            }
            /*             * ***************** astuce question ************************** */
            if ($enregistrement['astuce_text'] != '') {
                $elements ['question']['astuce_data'] = '<p style="margin-left:10%">' . $enregistrement['astuce_text'] . '</p>';
            }
            /*             * ******************** Balise de img ******************************** */
            if ($enregistrement['lien_img'] != '') {
                $elements ['question']['source_img'] = ' <img class="img-fluid"  src="' . $enregistrement['lien_img'] . '" alt=""   title="img_question"  style="width:75%;height: auto"/>';
            } elseif ($enregistrement['source_img'] != '') {
                if ($enregistrement['code_intervenant_contribue'] != '') {
                    $code_intervenant = $enregistrement['code_intervenant_contribue'];
                } else {
                    $code_intervenant = $enregistrement['code_intervenant'];
                }
                $elements ['question']['source_img'] = ' <img class="img-fluid"  src="http://mega-cours.fr/telechargement/media_quiz_cours/Quiz/' . $code_intervenant . '/' . $enregistrement['id_quiz'] . '/' . $enregistrement['source_img'] . '  " alt=""   title="img_question"  style="width:75%;height: auto"/>';
            } else {
                $elements ['question']['source_img'] = '';
            }

            /*             * **************************** Formule *************************************** */
            $elements ['question']['formule'] = $enregistrement['formule_latex'];
        } catch (Exception $e) {
            $parametres_sql = array($id_question);
            $numargs = func_num_args();
            debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
        }
        /*         * ***************Reponses ********************** */
        try {
            $sql = " SELECT  id_reponse,data_text FROM Reponse_question WHERE id_question=:param1  ";

            $resultat = $cxn->prepare($sql);
            $resultat->bindParam(':param1', $id_question);
            $resultat->execute();
            $i = 0;
            $j = 1;
            while ($enregistrement = $resultat->fetch()) {
                $elements ['reponses'][$i]['id_reponse'] = $enregistrement['id_reponse'];
                if ($enregistrement['data_text'] != '') {
                    $elements ['reponses'][$i]['data'] = '<p style="margin-left:5%">' . $enregistrement['data_text'] . '</p>';
                }
                $i++;
                $j++;
            }
        } catch (Exception $e) {
            $parametres_sql = array($id_question);
            $numargs = func_num_args();
            debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
        }

        /*         * ************************************ */
        return $elements;
    }

}
if (!function_exists("insert_result_quiz")) {

    function insert_result_quiz($code_user, $id_quiz, $taux_reussite, $score_quiz, $dure_quiz, $list_reponses_serialise) {
        global $cxn;
        $date_actuel = date("Y-m-d H:i:s");
        /*         * *********************** verifier si l'nregistrement existe dans la table Resultat_quiz********************** */
        try {

            $select = $cxn->query(" SELECT   id_resultat  FROM  Resultat_quiz  WHERE     id_quiz='" . $id_quiz . "'  AND  code_user='" . $code_user . "' ");
            $nb = $select->rowCount();
            if ($nb <= 0) {
                $sql = " INSERT INTO  Resultat_quiz (code_user,id_quiz,taux_reussite,date_start,score_quiz,dure_quiz,resultat_reponses) VALUES (:param1,:param2,:param3,:param4,:param5,:param6,:param7)  ";
            } else {
                $sql = " UPDATE  Resultat_quiz  SET  taux_reussite=:param3,date_update=:param4,score_quiz=:param5,dure_quiz=:param6,resultat_reponses=:param7  WHERE id_quiz=:param2 AND  code_user=:param1 ";
            }
        } catch (Exception $e) {
            $numargs = func_num_args();
            debug_function(debug_backtrace(), $numargs, $e, $sql);
        }

        /*         * ***************** Executer la requette dans la table Resultat_quiz******************** */
        try {
            $resultat = $cxn->prepare($sql);
            $resultat->bindParam(':param1', $code_user);
            $resultat->bindParam(':param2', $id_quiz);
            $resultat->bindParam(':param3', $taux_reussite);
            $resultat->bindParam(':param4', $date_actuel);
            $resultat->bindParam(':param5', $score_quiz);
            $resultat->bindParam(':param6', $dure_quiz);
            $resultat->bindParam(':param7', $list_reponses_serialise);
            $resultat->execute();
        } catch (Exception $e) {
            $parametres_sql = array($code_user, $id_quiz, $taux_reussite, $date_actuel, $score_quiz, $dure_quiz, $list_reponses_serialise);
            $numargs = func_num_args();
            debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
        }
        /*         * ******************* Enregistrer le resultat dans la table Historique_resultat_quiz ******************** */
        try {
            $sql = " INSERT INTO  Historique_resultat_quiz(id_quiz,code_user,date_start,taux_reussite,score_quiz,dure_quiz,resultat_reponses) VALUES (:param1,:param2,:param3,:param4,:param5,:param6,:param7)";
            $resultat = $cxn->prepare($sql);
            $resultat->bindParam(':param1', $id_quiz);
            $resultat->bindParam(':param2', $code_user);
            $resultat->bindParam(':param3', $date_actuel);
            $resultat->bindParam(':param4', $taux_reussite);
            $resultat->bindParam(':param5', $score_quiz);
            $resultat->bindParam(':param6', $dure_quiz);
            $resultat->bindParam(':param7', $list_reponses_serialise);
            $resultat->execute();
        } catch (Exception $e) {
            $parametres_sql = array($id_quiz, $code_user, $date_actuel, $taux_reussite, $score_quiz, $dure_quiz, $list_reponses_serialise);
            $numargs = func_num_args();
            debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
        }
    }

}

if (!function_exists("insert_progression_theme")) {

    function insert_progression_theme($code_user, $id_theme, $taux_progression) {
        global $cxn;
        $date_actuel = date("Y-m-d H:i:s");
        /*         * *********************** verifier si l'nregistrement existe dans la table Resultat_quiz********************** */
        try {

            $select = $cxn->query(" SELECT   id_progression  FROM  Progression_theme_quiz  WHERE     id_theme='" . $id_theme . "'  AND  code_user='" . $code_user . "' ");
            $nb = $select->rowCount();
            if ($nb <= 0) {
                $sql = " INSERT INTO  Progression_theme_quiz (code_user,id_theme,taux_progression,date_start) VALUES ('" . $code_user . "','" . $id_theme . "','" . $taux_progression . "','" . $date_actuel . "')  ";
            } else {
                $sql = " UPDATE  Progression_theme_quiz  SET  taux_progression='" . $taux_progression . "',date_update='" . $date_actuel . "'  WHERE id_theme='" . $id_theme . "' AND  code_user='" . $code_user . "' ";
            }
            $cxn->query($sql);
        } catch (Exception $e) {
            
            $numargs = func_num_args();
            debug_function(debug_backtrace(), $numargs, $e, $sql);
           
        }


        /*         * ******************* Enregistrer le resultat dans la table Historique_resultat_quiz ******************** */
        try {
            $sql = " INSERT INTO  Historique_progression_theme_quiz(id_theme,code_user,date_start,taux_progression) VALUES (:param1,:param2,:param3,:param4)";
            $resultat = $cxn->prepare($sql);
            $resultat->bindParam(':param1', $id_theme);
            $resultat->bindParam(':param2', $code_user);
            $resultat->bindParam(':param3', $date_actuel);
            $resultat->bindParam(':param4', $taux_progression);
            $resultat->execute();
        } catch (Exception $e) {
         
            $parametres_sql = array($id_theme, $code_user, $date_actuel, $taux_progression);
            $numargs = func_num_args();
            debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
              
        }
    }

}

if (!function_exists("insert_progression_reussite_theme")) {

    function insert_progression_reussite_theme($code_user, $id_theme) {
        global $cxn;
        $date_actuel = date("Y-m-d H:i:s");

        /*         * ******************* calcul le taux moyen de reussite par theme*********************** */
        $taux_reussite = calcul_progression_reussite_effectue_par_theme($code_user, $id_theme);
        /*         * *********************** verifier si l'nregistrement existe dans la table Resultat_quiz********************** */
        try {

            $select = $cxn->query(" SELECT   id_progression  FROM  Progression_reussite_theme  WHERE     id_theme='" . $id_theme . "'  AND  code_user='" . $code_user . "' ");
            $nb = $select->rowCount();
            if ($nb <= 0) {
                $sql = " INSERT INTO  Progression_reussite_theme (code_user,id_theme,taux_progression,date_start) VALUES ('" . $code_user . "','" . $id_theme . "','" . $taux_reussite . "','" . $date_actuel . "')  ";
            } else {
                $sql = " UPDATE  Progression_reussite_theme  SET  taux_progression='" . $taux_reussite . "',date_update='" . $date_actuel . "'  WHERE id_theme='" . $id_theme . "' AND  code_user='" . $code_user . "' ";
            }
            $cxn->query($sql);
        } catch (Exception $e) {

            $numargs = func_num_args();
            debug_function(debug_backtrace(), $numargs, $e, $sql);
              
        }


        /*         * ******************* Enregistrer le resultat dans la table Historique_resultat_quiz ******************** */
        try {
            $sql = " INSERT INTO  Historique_reussite_theme_quiz (id_theme,code_user,date_start,taux_reussite) VALUES (:param1,:param2,:param3,:param4)";
            $resultat = $cxn->prepare($sql);
            $resultat->bindParam(':param1', $id_theme);
            $resultat->bindParam(':param2', $code_user);
            $resultat->bindParam(':param3', $date_actuel);
            $resultat->bindParam(':param4', $taux_reussite);
            $resultat->execute();
        } catch (Exception $e) {
         
            $parametres_sql = array($id_theme, $code_user, $date_actuel, $taux_reussite);
            $numargs = func_num_args();
            debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
            
        }
    }

}

if (!function_exists("calcul_progression_reussite_effectue_par_theme")) {

    function calcul_progression_reussite_effectue_par_theme($code_user, $id_theme) {
        global $cxn;

        try {
            $sql = "  SELECT AVG(Resultat_quiz.taux_reussite)  AS taux_reussite

                   FROM  Resultat_quiz,Quiz,Theme_quiz  

                   WHERE  Resultat_quiz.id_quiz=Quiz.id_quiz

                   AND    Quiz.id_quiz_theme =Theme_quiz.id_theme

                   AND    Theme_quiz.id_theme='" . $id_theme . "'  AND  Resultat_quiz .code_user='" . $code_user . "' ";

            $select = $cxn->query($sql);
            $enregistrement = $select->fetch();
            $taux = sprintf("%.2f", $enregistrement ['taux_reussite']);
        } catch (Exception $e) {
         
            $numargs = func_num_args();
            debug_function(debug_backtrace(), $numargs, $e, $sql);
               
        }

        return $taux;
    }

}

if (!function_exists("difference_entre_2_dates")) {

    function difference_entre_2_dates($date1, $date2) {

        $date1_strtotime = strtotime($date1);
        $date2_strtotime = strtotime($date2);
        $temp_diff = abs($date2_strtotime - $date1_strtotime);

        return $temp_diff;
    }

}

/* * ************************* Calcul taux progression section **************************** */
if (!function_exists("calcul_progression_generale_travail_section")) {

    function calcul_progression_generale_travail_section($id_section, $code_user) {
        global $cxn;
        $taux = 0;
        $nbre_quiz_total_par_section_matiere = nombre_quiz_section($id_section, $code_user);
        $nbre_quiz_effectue_par_section_matiere = nombre_quiz_effectue_section($id_section, $code_user);
        if ($nbre_quiz_total_par_section_matiere != 0) {
            $taux = round($nbre_quiz_effectue_par_section_matiere / $nbre_quiz_total_par_section_matiere * 100, 2);
        }

        return $taux;
    }

}
if (!function_exists("nombre_quiz_section")) {

    function nombre_quiz_section($id_section, $code_user) {
        global $cxn;
        $nombre = 0;

        try {
            $sql = 'SELECT COUNT( Quiz.id_quiz ) ';
            /*             * ************ Progression par matiere ***************** */
            $sql .='AS nbre_quiz_par_section_matiere';
            $sql.=' FROM Quiz, Theme_quiz,Section_theme,programme_eleve_matiere ';
            $sql.='  WHERE Quiz.id_quiz_theme = Theme_quiz.id_theme
                 AND Theme_quiz.section_theme = Section_theme.id_section
                 AND programme_eleve_matiere.id_theme=Theme_quiz.id_theme ';
            $sql.=' AND Section_theme.id_section =:param1';
            $sql.=' AND programme_eleve_matiere.code_user =:param2';
            //  echo $sql;
            $resultat = $cxn->prepare($sql);
            $resultat->bindParam(':param1', $id_section);
            $resultat->bindParam(':param2', $code_user);
            $resultat->execute();
            $enregistrement = $resultat->fetch();
            $nombre = $enregistrement['nbre_quiz_par_section_matiere'];
        } catch (Exception $e) {
            $parametres_sql = array($id_section, $code_user);
            $numargs = func_num_args();
            debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
        }

        return $nombre;
    }

}
if (!function_exists("nombre_quiz_effectue_section")) {

    function nombre_quiz_effectue_section($id_section, $code_user) {
        global $cxn;
        $nombre = 0;
        try {

            $sql = 'SELECT  COUNT(id_resultat) ';
            $sql .=' AS nbre_quiz_effectue_par_section_matiere';
            $sql.='  FROM  Resultat_quiz,Quiz,Theme_quiz,Section_theme';
            $sql.=' WHERE Resultat_quiz.id_quiz=Quiz.id_quiz 
                AND Quiz.id_quiz_theme=Theme_quiz.id_theme
                AND Theme_quiz.section_theme=Section_theme.id_section';
            $sql.=' AND Section_theme.id_section =:param1';
            $sql.=' AND Resultat_quiz.code_user=:param2';

            $resultat = $cxn->prepare($sql);
            $resultat->bindParam(':param1', $id_section);
            $resultat->bindParam(':param2', $code_user);
            $resultat->execute();
            $enregistrement = $resultat->fetch();
            $nombre = $enregistrement['nbre_quiz_effectue_par_section_matiere'];
        } catch (Exception $e) {
            $parametres_sql = array($id_section, $code_user);
            $numargs = func_num_args();
            debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
        }

        return $nombre;
    }

}
if (!function_exists("insert_progression_section")) {

    function insert_progression_section($code_user, $id_section) {
        global $cxn;
        $date_actuel = date("Y-m-d H:i:s");
        $taux_progression = calcul_progression_generale_travail_section($id_section, $code_user);
        /*         * *********************** verifier si l'nregistrement existe dans la table Resultat_quiz********************** */
        try {

            $select = $cxn->query(" SELECT   id_progression  FROM  Progression_section_quiz  WHERE     id_section='" . $id_section . "'  AND  code_user='" . $code_user . "' ");
            $nb = $select->rowCount();
            if ($nb <= 0) {
                $sql = " INSERT INTO  Progression_section_quiz (code_user,id_section,taux_progression,date_start) VALUES ('" . $code_user . "','" . $id_section . "','" . $taux_progression . "','" . $date_actuel . "')  ";
            } else {
                $sql = " UPDATE  Progression_section_quiz  SET  taux_progression='" . $taux_progression . "',date_update='" . $date_actuel . "'  WHERE id_section='" . $id_section . "' AND  code_user='" . $code_user . "' ";
            }
            $cxn->query($sql);
        } catch (Exception $e) {       
            $numargs = func_num_args();
            debug_function(debug_backtrace(), $numargs, $e, $sql);
              
        }
    }

}

