<?php

//modele


function check_list_quiz($id_niveau, $code_matiere, $code_user) {
    global $cxn;
    $check = TRUE;
    try {
        $sql = "SELECT programme_eleve_matiere.id_programme
                FROM programme_eleve_matiere, Theme_quiz, Section_theme
                WHERE programme_eleve_matiere.id_theme = Theme_quiz.id_theme
                AND Theme_quiz.section_theme = Section_theme.id_section
                AND Section_theme.code_matiere =  '" . $code_matiere . "'
                AND Section_theme.id_niveau =  '" . $id_niveau . "'
                AND programme_eleve_matiere.code_user =  '" . $code_user . "' ";
        $select = $cxn->query($sql);
        $nb = $select->rowCount();
        if ($nb <= 0) {
            $check = FALSE;
        }
    } catch (Exception $e) {
        $message_erreur = 'Ligne ' . $e->getLine() . ' dans ' . $e->getFile() . '<br /><strong>Exception lancée</strong> : ' . $e->getMessage() . '<br/>';
        echo $message_erreur;
    }

    if (!$check) {
        $lien = url_espace_eleve . '/index.php?module=quiz&action=choix_programme_matiere&code_matiere=' . $code_matiere . '&action_traitement=select_choix_programme';
        header("Location: $lien");
    }
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
        $message_erreur = 'Ligne ' . $e->getLine() . ' dans ' . $e->getFile() . '<br /><strong>Exception lancée</strong> : ' . $e->getMessage() . '<br/>';
        echo $message_erreur;
    }
    return $liste;
}

function list_themes($code_user, $id_section) {
    global $cxn;
    $liste = array();
    try {
        $sql = " SELECT  Theme_quiz.id_theme,Theme_quiz.random  AS random_theme,Theme_quiz.nom 

                 FROM  Theme_quiz,programme_eleve_matiere  


                 WHERE  programme_eleve_matiere.id_theme=Theme_quiz.id_theme


                AND  Theme_quiz.activation_theme='1'  AND   Theme_quiz.partage_eleves='1'  AND  programme_eleve_matiere.code_user=:param1  AND   Theme_quiz.section_theme=:param2 ";

        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $code_user);
        $resultat->bindParam(':param2', $id_section);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {

            $liste[$i]['random_theme'] = $enregistrement['random_theme'];
            $liste[$i]['nom_theme'] = $enregistrement['nom'];
            $liste[$i]['progression_travail'] = progression_travail_effectue($enregistrement['id_theme'], $code_user);
            $liste[$i]['progression_reussite'] = progression_reussite_effectue($enregistrement['id_theme'], $code_user);
            /*             * ************* Nbre de quiz par theme **************************** */
            $liste[$i]['nbre_quiz_par_theme'] = nombre_quiz_par_theme($enregistrement['id_theme']);
            $i++;
        }
    } catch (Exception $e) {
        $message_erreur = 'Ligne ' . $e->getLine() . ' dans ' . $e->getFile() . '<br /><strong>Exception lancée</strong> : ' . $e->getMessage() . '<br/>';
        echo $message_erreur;
    }

    return $liste;
}

function progression_travail_effectue($id_theme, $code_user) {
    global $cxn;

    try {

        $select = $cxn->query(" SELECT   taux_progression  FROM  Progression_theme_quiz  WHERE     id_theme='" . $id_theme . "'  AND  code_user='" . $code_user . "' ");
        $nb = $select->rowCount();
        if ($nb <= 0) {
            $taux = 0;
        } else {
            $enregistrement = $select->fetch();
            $taux = sprintf("%.2f", $enregistrement ['taux_progression']);
        }
    } catch (Exception $e) {
        $message_erreur = 'Ligne ' . $e->getLine() . ' dans ' . $e->getFile() . '<br /><strong>Exception lancée</strong> : ' . $e->getMessage() . '<br/>';
        echo $message_erreur;
    }

    return $taux;
}

function progression_reussite_effectue($id_theme, $code_user) {
    global $cxn;

    try {
        $sql = " SELECT   taux_progression  AS taux_reussite FROM  Progression_reussite_theme  
            
                WHERE id_theme='" . $id_theme . "' AND  code_user='" . $code_user . "' ";

        $select = $cxn->query($sql);
        $nb = $select->rowCount();
        if ($nb <= 0) {
            $taux = 0;
        } else {
            $enregistrement = $select->fetch();
            $taux = sprintf("%.2f", $enregistrement ['taux_reussite']);
        }
    } catch (Exception $e) {
        $message_erreur = 'Ligne ' . $e->getLine() . ' dans ' . $e->getFile() . '<br /><strong>Exception lancée</strong> : ' . $e->getMessage() . '<br/>';
        echo $message_erreur;
    }

    return $taux;
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

function nombre_quiz_par_section($id_section, $id_niveau) {
    global $cxn;
    $nbr = 0;
    try {
        $sql = " SELECT COUNT(Quiz.id_quiz) AS nombre_quiz

                                FROM  Quiz,Theme_quiz,Section_theme  

                                WHERE  Quiz.id_quiz_theme=Theme_quiz.id_theme

                                AND  Theme_quiz.section_theme=Section_theme.id_section

                                AND  Theme_quiz.section_theme='" . $id_section . "'  AND  Theme_quiz .niveau='" . $id_niveau . "' ";
        $select = $cxn->query($sql);
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
