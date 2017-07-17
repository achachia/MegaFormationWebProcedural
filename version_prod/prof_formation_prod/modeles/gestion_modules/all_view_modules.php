<?php

function list_modules() {
    global $cxn;
    $liste = array();    
    try {
       
        $sql = "     SELECT keygen_module,nom_module FROM  Liste_modules  ";
         
        $resultat = $cxn->prepare($sql);     
   
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {           

                $liste[$i]['nom_module'] = html_entity_decode(stripslashes($enregistrement['nom_module']), ENT_QUOTES);


                $liste[$i]['keygen_module'] = $enregistrement['keygen_module'];

             
                $i++;
         
        }
    } catch (Exception $e) {    
        $numargs = func_num_args();
        debug_function(debug_backtrace(), $numargs, $e, $sql);
    }
    return $liste;
}

