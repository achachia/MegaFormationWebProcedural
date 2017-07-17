<?php

require_once './librairie/fonctions_local.php';
/* * ********************* Progression de travail par section *********************** */
if (!function_exists("list_section")) {

    function list_section($code_user, $id_niveau, $code_matiere) {
        global $cxn;
        $liste = array();


        try {
            $sql = "    SELECT  DISTINCT  Section_theme.nom_section,Progression_section_quiz.taux_progression  "
                    . " FROM  programme_eleve_matiere,Theme_quiz,Section_theme,Progression_section_quiz  "
                    . " WHERE programme_eleve_matiere.id_theme=Theme_quiz.id_theme "
                    . " AND Theme_quiz.section_theme=Section_theme.id_section "
                    . " AND Section_theme.id_section=Progression_section_quiz.id_section "
                    . " AND   Section_theme.code_matiere=:param1  AND Section_theme.id_niveau=:param2  AND  Progression_section_quiz.code_user=:param3    AND  Section_theme.activation_section='1' ";
            $resultat = $cxn->prepare($sql);
            $resultat->bindParam(':param1', $code_matiere);
            $resultat->bindParam(':param2', $id_niveau);
            $resultat->bindParam(':param3', $code_user);
            $resultat->execute();
            $i = 0;
            while ($enregistrement = $resultat->fetch()) {

                $liste[$i]['nom_sujet'] = $enregistrement['nom_section'];
                $liste[$i]['taux_progression'] = $enregistrement['taux_progression'];
                $i++;
            }
        } catch (Exception $e) {
            $parametres_sql = array($code_matiere, $id_niveau, $code_user);
            $numargs = func_num_args();
            debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
        }
        return $liste;
    }

}
/* * ********************* Progression de travail par theme *********************** */
if (!function_exists("list_themes")) {

    function list_themes($code_user, $id_niveau, $code_matiere) {
        global $cxn;
        $liste = array();


        try {
            $sql = "    SELECT  DISTINCT  Theme_quiz.nom AS nom_theme,Theme_quiz.id_theme   "
                    . " FROM  programme_eleve_matiere,Theme_quiz,Section_theme  "
                    . " WHERE programme_eleve_matiere.id_theme=Theme_quiz.id_theme "
                    . " AND Theme_quiz.section_theme=Section_theme.id_section "
                    . " AND   Section_theme.code_matiere=:param1  AND Section_theme.id_niveau=:param2  AND  programme_eleve_matiere.code_user=:param3    AND  Section_theme.activation_section='1' ";

            $resultat = $cxn->prepare($sql);
            $resultat->bindParam(':param1', $code_matiere);
            $resultat->bindParam(':param2', $id_niveau);
            $resultat->bindParam(':param3', $code_user);
            $resultat->execute();
            $i = 0;
            while ($enregistrement = $resultat->fetch()) {
                $key = $enregistrement['nom_theme'];
                $liste[$key] = select_taux_progression_theme($enregistrement['id_theme'], $code_user);
                $i++;
            }
        } catch (Exception $e) {
            $parametres_sql = array($code_matiere, $id_niveau, $code_user);
            $numargs = func_num_args();
            debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
        }
        return $liste;
    }

}
if (!function_exists("select_taux_progression_theme")) {

    function select_taux_progression_theme($id_theme, $code_user) {
        global $cxn;
        $taux = 0;

        try {
            $sql = 'SELECT  taux_progression  FROM  Progression_theme_quiz   WHERE  code_user=:param1  AND   id_theme=:param2';
            $resultat = $cxn->prepare($sql);
            $resultat->bindParam(':param1', $code_user);
            $resultat->bindParam(':param2', $id_theme);
            $resultat->execute();
            $enregistrement = $resultat->fetch();
            if ($enregistrement['taux_progression'] != '') {
                $taux = $enregistrement['taux_progression'];
            }
        } catch (Exception $e) {
            $parametres_sql = array($code_user, $id_theme);
            $numargs = func_num_args();
            debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
        }
        return $taux;
    }

}
?>