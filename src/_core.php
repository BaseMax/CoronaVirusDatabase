<?php
if(!defined("BASE")) {
	exit();
}
require_once "_phpedb.php";
$db=new database();
$db->connect("localhost", "root", "linuxconfig.org");
$db->db="corona2";
$db->create_database($db->db, false);
function display($array) {
	header("Content-Type: application/json");
	exit(json_encode($array));
}
