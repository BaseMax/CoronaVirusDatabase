<?php
// Max Base
// https://github.com/BaseMax/CoronaVirusDatabase
define("BASE", __DIR__ . "/");
require_once "_core.php";
require_once "_netphp.php";
$fileName="response.json";
$url_api="https://services1.arcgis.com/0MSEUqKaxRlEPj5g/arcgis/rest/services/ncov_cases/FeatureServer/2/query?f=json&where=Confirmed%20%3E%200&returnGeometry=false&spatialRel=esriSpatialRelIntersects&outFields=*&orderByFields=Confirmed%20desc&resultOffset=0&resultRecordCount=1000&cacheHint=true";

function parseCheck() {
	global $fileName;
	parseContent(file_get_contents($fileName));
}

function parseContent($data) {
	global $db;
	$json=json_decode($data, true);
	$features=$json["features"];
	$items=[];
	foreach($features as $feature) {
		$items[]=$feature["attributes"];
	}
	// print_r($items);
	// OBJECTID, Country_Region, Last_Update, Lat, Long_, Confirmed, Deaths, Recovered
	foreach($items as $item) {
		$clauses=[
			"name"=>strtolower($item["Country_Region"]),
		];
		$values=[
			"name"=>strtolower($item["Country_Region"]),
			"totalCase"=>$item["Confirmed"],
			"totalRecovered"=>$item["Recovered"],
			"totalDeath"=>$item["Deaths"],
		];
		if($db->count("country", $clauses) == 0) {
			$db->insert("country", $values);
		}
		else {
			if($db->count("country", $values) == 0) {
				// skip
			}
			else {
				print "Update...\n";
				$db->update("country", $clauses, $values);
			}
		}
	}
}

if(isset($argv) and isset($argv[1]) and $argv[1] == "update") {
	$res=get($url_api);
	file_put_contents($fileName, $res[0]);
	parseContent($res[0]);
}
// else {
// 	if(file_exists($fileName)) {
// 		parseContent(file_get_contents($fileName));
// 	}
// 	else {
// 		exit("Error: file not exists!\n");
// 	}
// }
