<?php

//modele
//SELECT COUNT(programme_eleve_matiere.id_programme) AS nombre_programme "
//                    . "             FROM  programme_eleve_matiere 
//                                    WHERE    programme_eleve_matiere .id_theme='" . $id_theme . "'    ";

function recuperer_id_theme($random_theme) {
    global $cxn;
    $id_theme = '';
    try {
        $sql = " SELECT  id_theme  FROM  Theme_quiz  WHERE  random=:param  ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param', $random_theme);
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $id_theme = $enregistrement['id_theme'];
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $id_theme;
}

function verification_theme_dans_la_table($random_theme) {
    global $cxn;
    $check = FALSE;
    try {
        $sql = " SELECT COUNT(programme_eleve_matiere.id_programme) AS nombre_programme 
                 FROM  programme_eleve_matiere,Theme_quiz 
                 WHERE programme_eleve_matiere.id_theme=Theme_quiz.id_theme                               
                 AND  Theme_quiz .random=:param ";
        // echo $sql.'/'.$random_theme;
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param', $random_theme);
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $nb = $enregistrement['nombre_programme'];
        if ($nb > 0) {
            $check = TRUE;
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $check;
}

function check_formulaire($id_niveau, $code_matiere) {
    global $cxn; 
    $check = TRUE;
    try {
        $sql = "  SELECT Quiz.id_quiz  FROM Quiz, Theme_quiz, Section_theme
                  WHERE Quiz.id_quiz_theme = Theme_quiz.id_theme
                  AND Theme_quiz.section_theme = Section_theme.id_section  AND   Section_theme.code_matiere='" . $code_matiere . "'  AND Section_theme.id_niveau='" . $id_niveau . "'  AND  Section_theme.activation_section='1' ";
        $select = $cxn->query($sql);
        $nb = $select->rowCount();
        if ($nb <= 0) {
            $check = FALSE;
        }
    } catch (Exception $e) {
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql);
    }

    return $check;
}

function nombre_quiz_par_theme($id_theme) {
    global $cxn;
    $nbr = 0;
    try {

        $select = $cxn->query(" SELECT COUNT(Quiz.id_quiz) AS nombre_quiz "
                . "             FROM  Quiz,Theme_quiz 
                                WHERE  Quiz.id_quiz_theme=Theme_quiz.id_theme  "
                . "             AND  Quiz.id_quiz_theme='" . $id_theme . "'    AND  Quiz.activation_quiz='1' ");
        $nb = $select->rowCount();
        if ($nb <= 0) {
            $nbr = 0;
        } else {
            $enregistrement = $select->fetch();
            $nbr = $enregistrement ['nombre_quiz'];
        }
    } catch (Exception $e) {
        $message_erreur = 'Ligne ' . $e->getLine() . ' dans ' . $e->getFile() . '<br /><strong>Exception lancée</strong> : ' . $e->getMessage() . '<br/>';
        echo $message_erreur;
    }
    return $nbr;
}

function list_section($id_niveau, $code_matiere) {
    global $cxn;
    $liste = array();
    try {
        $sql = " SELECT  id_section,nom_section  FROM  Section_theme  WHERE  code_matiere=:param1  AND id_niveau=:param2  AND  activation_section='1' ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $code_matiere);
        $resultat->bindParam(':param2', $id_niveau);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $liste[$i]['id_section'] = $enregistrement['id_section'];
            $liste[$i]['nom_section'] = $enregistrement['nom_section'];
            $i++;
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $liste;
}

function list_themes($id_niveau, $id_section) {
    global $cxn;
    $liste = array();
    try {
        $sql = " SELECT  Theme_quiz.id_theme,Theme_quiz.random  AS random_theme,Theme_quiz.nom 

                 FROM  Theme_quiz   WHERE  Theme_quiz.activation_theme='1'   AND   Theme_quiz.section_theme=:param ";

        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param', $id_section);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $liste[$i]['id_theme'] = $enregistrement['id_theme'];
            $liste[$i]['random_theme'] = $enregistrement['random_theme'];
            $liste[$i]['nom_theme'] = $enregistrement['nom'];
            $control = verification_theme_dans_la_table($enregistrement['random_theme']);
            $liste[$i]['disabled_theme'] = $control;

            $i++;
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }

    return $liste;
}
