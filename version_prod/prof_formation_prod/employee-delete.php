<?php
require 'connection/config.php';

/* Database connection end */


$data_ids = $_REQUEST['data_ids'];
$data_id_array = explode(",", $data_ids); 
if(!empty($data_id_array)) {
	foreach($data_id_array as $id) {
		$sql = "DELETE FROM test ";
		$sql.=" WHERE id = '".$id."'";
		$query = $cxn->query($sql);
	}
}
?>

