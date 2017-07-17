<?php

require 'connection/config.php';

/* Database connection end */


$data = $_POST['data'];


if (!empty($data)) {
    $sql = " UPDATE  test  SET     nom='" . $data[2] . "', prenom ='" . $data[3] . "', sex='" . $data[4] . "'  WHERE code_eleve='" . $data[1] . "'";
    $query = $cxn->query($sql);
}
?>
