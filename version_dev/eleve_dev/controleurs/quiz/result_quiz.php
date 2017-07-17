<?php

// controleurs

redirection_membre($_SESSION ['membre']['code_eleve']);
require root_dossier_modeles . '/' . $module . '/' . $action . '.php';
$infos_quiz_like=infos_quiz_like($_SESSION['quiz']['parametres']['random_quiz'],$_SESSION ['membre']['code_eleve']);
$duree_quiz = formatage_dure($_SESSION['quiz']['temps_effectue']);
$list_quiz_meme_theme = list_quiz_meme_theme($_SESSION['quiz']['parametres']['id_quiz'], $_SESSION['quiz']['parametres']['id_theme_quiz']);
$list_quiz_meme_theme_rand = List_valeurs_tab(6, $list_quiz_meme_theme);
$tab_id_citation=array_id_citation( $_SESSION['quiz']['parametres']['code_matiere']);
$id_citation=generer_id_citation($tab_id_citation);
$citation=infos_citation($id_citation);
$infos_votes_quiz=infos_vote_quiz($_SESSION['quiz']['parametres']['random_quiz']);

?>
