<?php

if (!function_exists("infos_theme")) {

    function infos_theme($random_theme) {
        global $cxn;
        /*         * ************** Infos sur le theme ************************** */
        try {
            $sql = " SELECT  nom  FROM  Theme_quiz  WHERE  random=:param1  ";
            $resultat = $cxn->prepare($sql);
            $resultat->bindParam(':param1', $random_theme);
            $resultat->execute();
            $enregistrement = $resultat->fetch();
            $nom_theme = $enregistrement['nom'];
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $nom_theme;
    }

}

if (!function_exists("get_nomber_quiz")) {

    function get_nomber_quiz($random_theme, $code_user) {
        global $cxn;
        /*         * ************** Infos sur le theme ************************** */
        try {
            $sql = " SELECT Quiz.id_quiz,Quiz.random AS random_quiz,Quiz.score_requis,List_genre_quiz.nom AS type_quiz,Quiz.nom,Quiz.description_content,Quiz.difficulte,Quiz.nb_quest,Quiz.like_quiz,Quiz.dislike_quiz,Quiz.nbr_essai,Quiz.tag,Quiz.img_quiz,List_difficulte.id AS nbr_difficulte,List_genre_quiz.nom AS genre_quiz"
                    . " FROM Quiz,Theme_quiz,List_difficulte,List_genre_quiz"
                    . "  WHERE  Quiz.difficulte=List_difficulte.id "
                    . "  AND  Quiz.id_quiz_theme=Theme_quiz.id_theme "
                    . "  AND  Quiz.genre=List_genre_quiz.id "
                    . " AND  Theme_quiz.random='" . $random_theme . "'  AND  Quiz.partage_eleves='1' AND  Quiz.activation_quiz='1'  ORDER BY Quiz.id_quiz ASC  ";
            $select = $cxn->query($sql);
            $nb = $select->rowCount();
        } catch (Exception $e) {
            echo "Une erreur est survenue lors de la récupération des données";
        }

        return $nb;
    }

}
if (!function_exists("list_quiz")) {

    function list_quiz($random_theme, $code_user, $position = NULL, $item_per_page = NULL) {
        global $cxn;
        $liste = array();
        $date_actuel = date("Y-m-d H:i:s");
        /*         * ************ recuperation id_theme ******************** */
        try {
            $sql = " SELECT  id_theme  FROM  Theme_quiz  WHERE  random=:param ";

            $resultat = $cxn->prepare($sql);
            $resultat->bindParam(':param', $random_theme);
            $resultat->execute();
            $enregistrement = $resultat->fetch();
            $id_theme = $enregistrement['id_theme'];
        } catch (Exception $e) {
            $e->getMessage();
        }


        /*         * ************************** Liste des quiz ********************************* */

        try {

            $sql = " SELECT Quiz.id_quiz,Quiz.random AS random_quiz,Quiz.score_requis,List_genre_quiz.nom AS type_quiz,Quiz.nom,Quiz.description_content,Quiz.difficulte,Quiz.nb_quest,Quiz.like_quiz,Quiz.dislike_quiz,Quiz.nbr_essai,Quiz.tag,Quiz.img_quiz,List_difficulte.id AS nbr_difficulte,List_genre_quiz.nom AS genre_quiz"
                    . " FROM Quiz,List_difficulte,List_genre_quiz"
                    . "  WHERE  Quiz.difficulte=List_difficulte.id "
                    . "  AND  Quiz.genre=List_genre_quiz.id "
                    . " AND  Quiz.id_quiz_theme='" . $id_theme . "'  AND  Quiz.partage_eleves='1' AND  Quiz.activation_quiz='1'  AND  Quiz.date_publication<='" . $date_actuel . "'     ORDER BY Quiz.id_quiz ASC  ";
            if (!is_null($position) && !is_null($item_per_page)) {
                $sql .= " LIMIT $position, $item_per_page ";
            }

            $results = $cxn->prepare($sql);
            $results->execute();
            $i = 0;
            while ($enregistrement = $results->fetch(PDO::FETCH_ASSOC)) {


                $liste[$i]['random_quiz'] = $enregistrement['random_quiz'];
                $liste[$i]['type_quiz'] = $enregistrement['type_quiz'];
                $liste[$i]['nom'] = $enregistrement['nom'];
                $liste[$i]['description_content'] = $enregistrement['description_content'];
                $liste[$i]['difficulte'] = etoile_difficulte($enregistrement['nbr_difficulte']);
                $liste[$i]['nb_quest'] = $enregistrement['nb_quest'];
                $liste[$i]['score_requis'] = $enregistrement['score_requis'];
                $liste[$i]['nbr_essai'] = $enregistrement['nbr_essai'];
                $liste[$i]['barre_progression_reussite'] = barre_progression_reussite($enregistrement['id_quiz'], $code_user);
                $liste[$i]['action'] = action_quiz($enregistrement['id_quiz'], $code_user);
                $liste[$i]['nbr_like'] = $enregistrement['like_quiz'];
                $liste[$i]['nbr_dislike'] = $enregistrement['dislike_quiz'];
                $liste[$i]['tags'] = formatage_tag($enregistrement['tag']);
                $liste[$i]['img_quiz'] = $enregistrement['img_quiz'];
                /*                 * **************** Note moyenne du quiz ************************* */
                $tab_vote = infos_vote_quiz($enregistrement['random_quiz']);
                $liste[$i]['note_vote_eleve'] = $tab_vote['moy_votes'];
                $liste[$i]['total_votes_eleve'] = $tab_vote['nombre_votes'];
                /*                 * ************************ Total comments ************************* */
                $liste[$i]['total_comments'] = get_records_comments($enregistrement['random_quiz']);
                /*                 * *************************************************** */
                $item_per_page = 4;
                $nbr_pages = ceil($liste[$i]['total_comments'] / $item_per_page);
                $liste[$i]['nbr_pages'] = $nbr_pages;
                $i++;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $liste;
    }

}

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
if (!function_exists("formatage_tag")) {

    function formatage_tag($tag) {
        $tag_formate = '';
        $tab = explode(',', $tag);
        $i = 1;
        foreach ($tab as $value) {

            $tag_formate.='  <a href="#"><span class="label label-info">' . $value . '</span></a>&nbsp;';
            if (($i % 5) == 0) {
                $tag_formate.='<br/><br/>';
            }
            $i++;
        }
        $tag_formate = substr($tag_formate, 0, -1);
        return $tag_formate;
    }

}

function etoile_difficulte($nombre) {
    $fa = 'Difficulté : ';
    for ($i = 0; $i < $nombre; $i++) {
        $fa.='<i class="fa fa-star" aria-hidden="true" style="color:red"></i>';
    }
    return $fa;
}

function barre_progression_reussite($id_quiz, $code_user) {
    global $cxn;
    $div_progression = '';

    try {
        $sql = " SELECT   taux_reussite  FROM  Resultat_quiz  WHERE     id_quiz='" . $id_quiz . "'  AND  code_user='" . $code_user . "' ";
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
        echo "Une erreur est survenue lors de la récupération des données";
    }

    return $div_progression;
}

function action_quiz($id_quiz, $code_user) {
    global $cxn;
    $action = '';
    try {
        $sql = " SELECT   id_resultat  FROM  Resultat_quiz  WHERE     id_quiz='" . $id_quiz . "'  AND  code_user='" . $code_user . "' ";
        $select = $cxn->query($sql);
        $nb = $select->rowCount();
        if ($nb <= 0) {
            $action = '<i class="fa fa-eye-slash" aria-hidden="true"></i>';
        } else {
            $action = '<i class="fa fa-eye" aria-hidden="true"></i>';
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }

    return $action;
}

if (!function_exists("get_records_comments")) {

    function get_records_comments($random_quiz) {
        global $cxn;
        try {
            $sql = " SELECT  *  FROM Comment_quiz_eleve
                     UNION
                     SELECT *   FROM Comment_quiz_prof
                     WHERE random_quiz ='" . $random_quiz . "' ";

            $select = $cxn->query($sql);
            $nb = $select->rowCount();
        } catch (Exception $e) {
            echo "Une erreur est survenue lors de la récupération des données";
        }
        return $nb;
    }

}

if (!function_exists("format_date_gregorien_comment")) {

    function format_date_gregorien_comment($date) {
        $date = new DateTime($date);
        $date = $date->format('Y-m-d');
        $formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::LONG, IntlDateFormatter::NONE, 'Europe/Paris', IntlDateFormatter::GREGORIAN);
        $date = new DateTime($date);
        $date = $formatter->format($date);

        return $date;
    }

}
if (!function_exists("format_heure_comment")) {

    function format_heure_comment($date) {
        $date = new DateTime($date);
        $date = $date->format('H:i:s');
        return $date;
    }

}
if (!function_exists("identite_comment")) {

    function identite_comment($code_user) {
        global $cxn;
        $findme = 'CI';
        $pos = strpos($code_user, $findme);
        $infos = array();

        if ($pos === FALSE) {

            try {
                $sql = " SELECT CONCAT( Membre.nom,  '.', Membre.prenom ) AS identite_eleve,Membre.profil_img,Liste_statut.nom_statut AS statut_eleve
                         FROM Membre, Liste_statut
                         WHERE Membre.statut = Liste_statut.id_statut
                         AND Membre.code_user =:param1 ";

                $resultat = $cxn->prepare($sql);
                $resultat->bindParam(':param1', $code_user);
                $resultat->execute();
                $enregistrement = $resultat->fetch();
                $infos['identite'] = $enregistrement['identite_eleve'];
                $infos['statut'] = $enregistrement['statut_eleve'];
                $infos['profil_img'] = $enregistrement['profil_img'];
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        } else {

            try {
                $sql = " SELECT CONCAT( Intervenants.nom,  '.', Intervenants.prenom ) AS identite_prof,Intervenants.profil_img,Liste_statut.nom_statut AS statut_prof
                         FROM Intervenants, Liste_statut
                         WHERE Intervenants.statut = Liste_statut.id_statut
                         AND Intervenants.code_user =:param1 ";

                $resultat = $cxn->prepare($sql);
                $resultat->bindParam(':param1', $code_user);
                $resultat->execute();
                $enregistrement = $resultat->fetch();
                $infos['identite'] = $enregistrement['identite_prof'];
                $infos['statut'] = $enregistrement['statut_prof'];
                $infos['profil_img'] = $enregistrement['profil_img'];
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        return $infos;
    }

}
if (!function_exists("list_comments")) {

    function list_comments($random_quiz) {
        global $cxn;
        $comments = array();
        $sql = " SELECT * FROM Comment_quiz_eleve
                 UNION
                 SELECT * FROM Comment_quiz_prof
                 WHERE  random_quiz='" . $random_quiz . "'    ORDER BY  date_created DESC ";


        $results = $cxn->prepare($sql);
        $results->execute();
        $i = 0;
        while ($enregistrement = $results->fetch(PDO::FETCH_ASSOC)) {
            $comments[$i]['code_user'] = $enregistrement['code_user'];
            $comments[$i]['date_comment'] = format_date_gregorien_comment($enregistrement['date_created']);
            $comments[$i]['heure_comment'] = format_heure_comment($enregistrement['date_created']);
            $comments[$i]['comment'] = $enregistrement['comment'];
            $i++;
        }

        // var_dump($comments);
        return $comments;
    }

}
?>