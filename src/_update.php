<?php
// Max Base
// https://github.com/BaseMax/CoronaVirusDatabase
require_once "_netphp.php";
require_once "_phpedb.php";
$fileName="response.json";
$url_api="https://services1.arcgis.com/0MSEUqKaxRlEPj5g/arcgis/rest/services/ncov_cases/FeatureServer/2/query?f=json&where=Confirmed%20%3E%200&returnGeometry=false&spatialRel=esriSpatialRelIntersects&outFields=*&orderByFields=Confirmed%20desc&resultOffset=0&resultRecordCount=1000&cacheHint=true";

function parseCheck() {
	global $fileName;
	parseContent(file_get_contents($fileName));
}

function parseContent($data) {
	$json=json_decode($data, true);
	$features=$json["features"];
	$items=[];
	foreach($features as $feature) {
		$items[]=$feature["attributes"];
	}
	print_r($items);
}

if(isset($argv) and isset($argv[1]) and $argv[1] == "update") {
	$res=get($url_api);
	file_put_contents($fileName, $res[0]);
	parseContent($res[0]);
}
else {
	parseContent(file_get_contents($fileName));
}
