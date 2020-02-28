<?php
define("BASE", __DIR__ . "/");
require_once "_core.php";

if(!function_exists("getallheaders")) {
	// Probably you are in CLI and it's not usefull!
	// But sometimes it's usefull for some webserver!
	function getallheaders() {
		$headers = [];
		foreach($_SERVER as $name => $value) {
			if(substr($name, 0, 5) == "HTTP_") {
				$headers[str_replace(" ", "-", ucwords(strtolower(str_replace("_", " ", substr($name, 5)))))] = $value;
			}
		}
		return $headers;
	}
}
function preapreItems($items) {
	foreach($items as $i=>$array) {
		if(isset($array["id"])) {
			$array["id"]=(int) $array["id"];
		}
		if(isset($array["totalCase"])) {
			$array["totalCase"]=(int) $array["totalCase"];
		}
		if(isset($array["totalDeath"])) {
			$array["totalDeath"]=(int) $array["totalDeath"];
		}
		if(isset($array["totalRecovered"])) {
			$array["totalRecovered"]=(int) $array["totalRecovered"];
		}
		$items[$i]=$array;
	}
	return $items;
}
function supportSort($table, $clauses, $data) {
	global $db;
	$items=[];
	if(isset($data["sort"])) {
		$sort=$data["sort"];
		$type="DESC";
		if(isset($data["type"])) {
			$t=strtolower($data["type"]);
			if($t == "asc" || $t == "desc") {
				$type=$t;
			}
			else {
				display(["status"=>"failed", "message"=>"Sort type is not valid and not allowed!"]);
			}
		}
		$fields=["id","name","totalCase","totalDeath","totalRecovered","datetime"];
		if(in_array($sort, $fields)) {
			$items=$db->selects($table, $clauses, "ORDER BY `". $sort ."` ".$type);
		}
		else {
			display(["status"=>"failed", "message"=>"Sort field value is not valid and not allowed!"]);
		}
	}
	else {
		$items=$db->selects($table, $clauses);
	}
	return $items;
}

$headers=getallheaders();
if($headers != null && is_array($headers) and count($headers) > 0) {
	if(isset($headers["Token"])) {
		$token=$headers["Token"];
		$tokenItem=$db->select("token", ["token"=>$token]);
		if($tokenItem == null) {
			display(["status"=>"failed", "message"=>"This token is not valid!"]);
		}
		else {
			if($tokenItem["getAccess"] == 0 and $tokenItem["postAccess"] == 0) {
				display(["status"=>"failed", "message"=>"You did not access to webservice using GET and POST method!"]);
			}
			else if($tokenItem["getAccess"] == 0 and $tokenItem["postAccess"] == 1) {
				$data=$_POST;
			}
			else if($tokenItem["getAccess"] == 1 and $tokenItem["postAccess"] == 0) {
				$data=$_GET;
			}
			else if($tokenItem["getAccess"] == 1 and $tokenItem["postAccess"] == 1) {
				$data=$_GET;
				foreach($_POST as $key=>$value) {
					$data[$key]=$value;
				}
			}
			if(isset($data["method"])) {
				$method=$data["method"];
				if($method == "total") {
					if($tokenItem["canTotal"] == 1) {
						$all=$db->sum("country", "totalCase");
						$died=$db->sum("country", "totalDeath");
						display(["status"=>"success", "message"=>"", "result"=>["all"=>$all, "died"=>$died]]);
					}
					else {
						display(["status"=>"failed", "message"=>"Sorry, you did not have access to this method!"]);
					}
				}
				else if($method == "country") {
					if($tokenItem["canFilter"] == 1) {
						if(isset($data["query"])) {
							$items=$db->select("country", ["name"=>$data["query"]]);
							$items=preapreItems([$items]);
							if(isset($items[0]) and $items[0] != "") {
								$items=$items[0];
							}
							else {
								$items=null;
							}
							display(["status"=>"success", "message"=>"", "result"=>$items]);
						}
						else {
							display(["status"=>"failed", "message"=>"Query value is not avaible!"]);
						}
					}
					else {
						display(["status"=>"failed", "message"=>"Sorry, you did not have access to this method!"]);
					}
				}
				else if($method == "search") {
					if($tokenItem["canSearch"] == 1) {
						if(isset($data["query"])) {
							// $items=$db->selects("country", ["name"=>["LIKE", "and", "%".$data["query"] . "%"]]);
							$items=supportSort("country", ["name"=>["LIKE", "and", "%".$data["query"] . "%"]], $data);
							$items=preapreItems($items);
							display(["status"=>"success", "message"=>"", "result"=>$items]);
						}
						else {
							display(["status"=>"failed", "message"=>"Query value is not avaible!"]);
						}
					}
					else {
						display(["status"=>"failed", "message"=>"Sorry, you did not have access to this method!"]);
					}
				}
				else if($method == "list") {
					if($tokenItem["canView"] == 1) {
						$lastTime=$db->select("country", [], "ORDER BY `datetime` DESC");
						// $items=$db->selects("country");
						$items=supportSort("country", [], $data);
						$items=preapreItems($items);
						display(["status"=>"success", "message"=>"", "lastUpdate"=>$lastTime["datetime"], "result"=>$items]);
					}
					else {
						display(["status"=>"failed", "message"=>"Sorry, you did not have access to this method!"]);
					}
				}
				else {
					display(["status"=>"failed", "message"=>"Method type is not valid!"]);
				}
			}
			else {
				display(["status"=>"failed", "message"=>"Every request in this webservice need a method type!"]);
			}
		}
	}
	else {
		display(["status"=>"failed", "message"=>"You did not have access to this webservice without token!"]);
	}
}
else {
	display(["status"=>"failed", "message"=>"You did not have access to this webservice!"]);
}
