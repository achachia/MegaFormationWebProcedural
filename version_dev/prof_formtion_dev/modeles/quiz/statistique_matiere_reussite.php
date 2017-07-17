<?php

/* * ******************** Liste des sections ********************* */
if (!function_exists("list_section")) {

    function list_section($code_user, $id_niveau, $code_matiere) {
        global $cxn;
        $liste = array();


        try {
            $sql = "    SELECT  DISTINCT  Section_theme.nom_section,Section_theme.id_section  "
                    . " FROM  programme_eleve_matiere,Theme_quiz,Section_theme  "
                    . " WHERE programme_eleve_matiere.id_theme=Theme_quiz.id_theme "
                    . " AND Theme_quiz.section_theme=Section_theme.id_section "
                    . " AND   Section_theme.code_matiere=:param1  AND Section_theme.id_niveau=:param2  AND  programme_eleve_matiere.code_user=:param3    AND  Section_theme.activation_section='1' ";
            //echo $sql;
            $resultat = $cxn->prepare($sql);
            $resultat->bindParam(':param1', $code_matiere);
            $resultat->bindParam(':param2', $id_niveau);
            $resultat->bindParam(':param3', $code_user);
            $resultat->execute();
            $i = 0;
            while ($enregistrement = $resultat->fetch()) {
                $key = $enregistrement['nom_section'];
                $liste[$key] = select_taux_reussite_section($enregistrement['id_section'], $code_user);
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

function select_taux_reussite_section($id_section, $code_user) {
    global $cxn;

    try {
        $sql = " SELECT AVG(Progression_reussite_theme.taux_progression) AS taux_reussite_section

                FROM  Progression_reussite_theme,Theme_quiz,Section_theme

                WHERE  Progression_reussite_theme.id_theme=Theme_quiz.id_theme

                AND   Theme_quiz.section_theme=Section_theme.id_section                 

                AND    Progression_reussite_theme.code_user='" . $code_user . "'  
                
                AND   Section_theme.id_section='" . $id_section . "' 

                AND   Section_theme.activation_section='1' ";

        $select = $cxn->query($sql);
        $enregistrement = $select->fetch();
        $taux = sprintf("%.2f", $enregistrement ['taux_reussite_section']);
    } catch (Exception $e) {
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql);
    }

    return $taux;
}

/* * ************************** liste theme**************************************************** */

if (!function_exists("list_themes")) {

    function list_themes($code_user, $id_niveau, $code_matiere) {
        global $cxn;
        $liste = array();


        try {
            $sql = "    SELECT  DISTINCT  Theme_quiz.nom AS nom_theme,Theme_quiz.id_theme  "
                    . " FROM  programme_eleve_matiere,Theme_quiz,Section_theme  "
                    . " WHERE programme_eleve_matiere.id_theme=Theme_quiz.id_theme "
                    . " AND Theme_quiz.section_theme=Section_theme.id_section "
                    . " AND   Section_theme.code_matiere=:param1  AND Section_theme.id_niveau=:param2  AND  programme_eleve_matiere.code_user=:param3    AND  Section_theme.activation_section='1' ";
            //  echo $sql;
            $resultat = $cxn->prepare($sql);
            $resultat->bindParam(':param1', $code_matiere);
            $resultat->bindParam(':param2', $id_niveau);
            $resultat->bindParam(':param3', $code_user);
            $resultat->execute();
            $i = 0;
            while ($enregistrement = $resultat->fetch()) {
                $key = $enregistrement['nom_theme'];
                $liste[$key] = select_taux_reussite_theme($enregistrement['id_theme'], $code_user);
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
if (!function_exists("select_taux_reussite_theme")) {

    function select_taux_reussite_theme($id_theme, $code_user) {
        global $cxn;

        try {
            $sql = " SELECT AVG(Resultat_quiz.taux_reussite) AS taux_reussite_theme

                FROM  Resultat_quiz,Quiz,Theme_quiz

                WHERE  Resultat_quiz.id_quiz=Quiz.id_quiz

                AND   Theme_quiz.id_theme=Quiz.id_quiz_theme                 

                AND    Resultat_quiz.code_user='" . $code_user . "'  
                
                AND   Quiz.id_quiz_theme='" . $id_theme . "' 

                AND   Theme_quiz.activation_theme='1' ";

            $select = $cxn->query($sql);
            $enregistrement = $select->fetch();
            $taux = sprintf("%.2f", $enregistrement ['taux_reussite_theme']);
        } catch (Exception $e) {
            $numargs = func_num_args();
            debug_function(debug_backtrace(), $numargs, $e, $sql);
        }

        return $taux;
    }

}


/* * ******************************** Liste quiz***************************************************** */

function list_quiz($code_user, $id_niveau, $code_matiere) {
    global $cxn;
    $liste = array();

    /*     * *********************************************************** */

    try {
        $sql = " SELECT Resultat_quiz.taux_reussite,Quiz.nom AS nom_quiz

                FROM  Resultat_quiz,Quiz,Theme_quiz,Section_theme

                WHERE  Resultat_quiz.id_quiz=Quiz.id_quiz

                AND  Quiz.id_quiz_theme=Theme_quiz.id_theme

                AND   Theme_quiz.section_theme=Section_theme.id_section


                AND   Section_theme.code_matiere=:param1

                AND   Section_theme.id_niveau=:param2  

                AND    Resultat_quiz.code_user=:param3   

                AND   Quiz.activation_quiz='1' ";

        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $code_matiere);
        $resultat->bindParam(':param2', $id_niveau);
        $resultat->bindParam(':param3', $code_user);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $key = $enregistrement['nom_quiz'];
            $liste[$key] = $enregistrement['taux_reussite'];
            $i++;
        }
    } catch (Exception $e) {
        $parametres_sql = array($code_matiere, $id_niveau, $code_user);
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql, $parametres_sql);
    }
    return $liste;
}
?>

