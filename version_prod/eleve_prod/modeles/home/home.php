<?php



function nbr_notifications_non_lus() {
    global $cxn;
    $nbr = 0;
    try {
        $sql = " SELECT  Notifications_codes_eleves.id_notif 


                            FROM   Notifications_codes_eleves,Corrige_exercices_eleves,Exercices_themes



                            WHERE  Notifications_codes_eleves.keygen_rep=Corrige_exercices_eleves.keygen_rep


                            AND    Corrige_exercices_eleves.keygen_exo=Exercices_themes.keygen_exo 

                            AND   Notifications_codes_eleves.consultation_eleve='0'   AND  Corrige_exercices_eleves.code_eleve='" . $_SESSION ['membre']['code_eleve'] . "' ";


        $select = $cxn->query($sql);
        $nbr = $select->rowCount();
    } catch (Exception $e) {
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql);
    }

    return $nbr;
}

function nbr_exo_non_effectue($id_theme) {
    global $cxn;
    $nbr = 0;
    /*     * ********** Compter le nombre des exercices ******************* */
    try {
        $sql = " SELECT  id_exo  FROM   Exercices_themes  WHERE id_theme='" . $id_theme . "' ";
        $select = $cxn->query($sql);
        $nbr_exo_par_theme = $select->rowCount();
    } catch (Exception $e) {
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql);
    }
    /*     * ************* Compter le nombre d'exercice corrige ***************** */
    try {
        $sql = " SELECT * FROM  Corrige_exercices_eleves,Exercices_themes  

                 WHERE Corrige_exercices_eleves.keygen_exo=Exercices_themes.keygen_exo

                 AND  Exercices_themes.id_theme='" . $id_theme . "' AND  Corrige_exercices_eleves.code_eleve='" . $_SESSION ['membre']['code_eleve'] . "' ";


        $select = $cxn->query($sql);
        $nbr_exo_corrige_par_theme = $select->rowCount();
    } catch (Exception $e) {
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql);
    }
    /*     * ******************************** */
    $nbr = $nbr_exo_par_theme - $nbr_exo_corrige_par_theme;
    /*     * ************************************************** */
    return $nbr;
}
?>

