<?php

function unhtmlentities($string) {
    $string = trim($string);
    $string = (!get_magic_quotes_gpc()) ? addslashes($string) : $string;
    $string = htmlentities($string, ENT_QUOTES);
    return $string;
}





?>