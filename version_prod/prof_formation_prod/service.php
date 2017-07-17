<?php

require 'connection/config.php';


$infos_table['nom_table'] = 'test';  //Nom la table 
$infos_table['cle_primaire'] = 'id';  //  identifiant de la cle primaire

if ($_GET) {
    switch ($_GET['action']) {
        case 'GetDonneeAjax':
            getdonneeAjax($infos_table);
            break;
        case 'UpdateDonneeAjax':
            $infos_table['data'] = $_POST['data'];
            UpdateDonneeAjax($infos_table);
            break;
        case 'DeleteDonneeAjax':
            DeleteDonneeAjax($infos_table);
            break;
    }
    exit;
}

function GetDonneeAjax($infos_table) {
    global $cxn;
    // storing  request (ie, get/post) global array to a variable  
    $requestData = $_REQUEST;


    $columns = array(
// datatable column index  => database column name
        0 => 'code_eleve',
        1 => 'nom',
        2 => 'prenom',
        3 => 'sex',
        4 => 'last_connection_membre'
    );




// getting total number records without any search
    $sql = 'SELECT ' . $infos_table['cle_primaire'];
    $sql.=' FROM ' . $infos_table['nom_table'];
    $query = $cxn->query($sql);
    $totalData = $query->rowCount();
    $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.




    $sql = "SELECT test.id,test.code_eleve,test.nom,prenom,DATE_FORMAT(test.last_connection,'%d-%m-%Y' ) AS last_connection_membre,type  ";
    $sql.=' FROM ' . $infos_table['nom_table'] . ',List_sex   WHERE   test.sex=List_sex.id ';


// getting records as per search parameters
    if (!empty($requestData['columns'][0]['search']['value'])) {   //name
        $sql.=" AND test.code_eleve LIKE '" . $requestData['columns'][0]['search']['value'] . "%' ";
    }
    if (!empty($requestData['columns'][1]['search']['value'])) {   //name
        $sql.=" AND test.nom LIKE '" . $requestData['columns'][1]['search']['value'] . "%' ";
    }
    if (!empty($requestData['columns'][2]['search']['value'])) {  //salary
        $sql.=" AND test.prenom LIKE '" . $requestData['columns'][2]['search']['value'] . "%' ";
    }
    if (!empty($requestData['columns'][3]['search']['value'])) {  //salary
        $sql.=" AND test.sex='" . $requestData['columns'][3]['search']['value'] . "' ";
    }
    if (!empty($requestData['columns'][4]['search']['value'])) {  //salary
        //  $sql.=" AND last_connection='" . $requestData['columns'][3]['search']['value'] . "' ";
        $sql.=" AND  DATE_FORMAT(test.last_connection,'%d-%m-%Y' )  = '" . $requestData['columns'][4]['search']['value'] . "' ";
    }

//if( !empty($requestData['columns'][2]['search']['value']) ){ //age
//	$rangeArray = explode("-",$requestData['columns'][2]['search']['value']);
//	$minRange = $rangeArray[0];
//	$maxRange = $rangeArray[1];
//	$sql.=" AND ( employee_age >= '".$minRange."' AND  employee_age <= '".$maxRange."' ) ";
//}
    $query = $cxn->query($sql);
    $totalFiltered = $query->rowCount();


    $sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";  // adding length

    $query = $cxn->query($sql);



    $data = array();
    $i = 1 + $requestData['start'];
    while ($row = $query->fetch()) {  // preparing an array
        $nestedData = array();
        $nestedData[] = "<input type='checkbox'  class='deleteRow' value='" . $row['id'] . "'  /> #" . $i;
        $nestedData[] = $row["code_eleve"];
        $nestedData[] = $row["nom"];
        $nestedData[] = $row["prenom"];
        $nestedData[] = $row["type"];
        $nestedData[] = $row["last_connection_membre"];

        $data[] = $nestedData;
        $i++;
    }



    $json_data = array(
        "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
        "recordsTotal" => intval($totalData), // total number of records
        "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
        "data" => $data   // total data array
    );

    echo json_encode($json_data);  // send data as json format
}

function UpdateDonneeAjax($infos_table) {
    global $cxn;
    $data = $infos_table['data'];


    if (!empty($data)) {
        $sql = " UPDATE  " . $infos_table['nom_table'] . "  SET     nom='" . $data[2] . "', prenom ='" . $data[3] . "', sex='" . $data[4] . "'  WHERE code_eleve='" . $data[1] . "'";
        $query = $cxn->query($sql);
    }
}

function DeleteDonneeAjax($infos_table) {
    global $cxn;
    $data_ids = $_REQUEST['data_ids'];
    $data_id_array = explode(",", $data_ids);
    if (!empty($data_id_array)) {
        foreach ($data_id_array as $id) {
            $sql = 'DELETE FROM  ' . $infos_table['nom_table'] . '    WHERE   ' . $infos_table['cle_primaire'] . ' ="' . $id . '" ';

            $query = $cxn->query($sql);
        }
    }
}
