<?php
/**
*
* @Name : NetPHP.php
* @Version : 1.1
* @Programmer : Max
* @Date : 2019-05-26, 2019-08-17
* @Released under : https://github.com/BaseMax/NetPHP/blob/master/LICENSE
* @Repository : https://github.com/BaseMax/NetPHP
*
**/
$debug=false;
// $debug=true;
$debug_details=true;
$debug_details=false;
function useragent() {
	return "Mozilla/5.0 (Windows NT 6.1; r…) Gecko/20100101 Firefox/60.0";
	return "Mozilla/5.0(Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36(KHTML,like Gecko) curlrome/68.0.3440.106 Mobile Safari/537.36";
}
function get_headers_from_curl_response($headerContent) {
	$headers = array();
	$arrRequests = explode("\r\n\r\n",$headerContent);
	for($index = 0; $index < count($arrRequests) -1; $index++) {
		foreach(explode("\r\n",$arrRequests[$index]) as $i => $line) {
			if($i === 0)
				$headers[$index]['http_code'] = $line;
			else {
				list($key,$value) = explode(': ',$line);
				$headers[$index][$key] = $value;
			}
		}
	}
	return $headers;
}
function post($url,$values,$headers=[],$reffer="",$auto_redirect=true) {
	global $debug,$debug_details;
	if($debug) {
		print "@Request[POST]----------------------------------------------\n";
		print "----------@link ".$url."\n";
		if($debug_details) {
			if($reffer!="") {
				print "----------@Reffer\n";
				print $reffer;
				print "\n";
			}
			if(count($values)!=0) {
				print "----------@Values\n";
				print_r($values);
			}
			if(count($headers)!=0) {
				print "----------@Headers\n";
				print_r($headers);
			}
		}
	}
	$curl = curl_init($url);
	if(is_array($headers)) {
		curl_setopt($curl,CURLOPT_HTTPHEADER,$headers);
	}
	curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,true);
	curl_setopt($curl,CURLOPT_FOLLOWLOCATION,$auto_redirect);
	curl_setopt($curl,CURLOPT_HEADER,true);
	curl_setopt($curl,CURLOPT_VERBOSE,false);
	curl_setopt($curl,CURLOPT_POST,true);
	curl_setopt($curl,CURLOPT_POSTFIELDS,$values);
	curl_setopt($curl,CURLOPT_USERAGENT,useragent());
	curl_setopt($curl,CURLOPT_COOKIEJAR,"_cookies.txt");
	curl_setopt($curl,CURLOPT_COOKIEFILE,"_cookies.txt");
	if($reffer != "")
		curl_setopt($curl,CURLOPT_REFERER,$curl);
	$response = curl_exec($curl);
	$header_size = curl_getinfo($curl,CURLINFO_HEADER_SIZE);
	$header = substr($response,0,$header_size);
	$body = substr($response,$header_size);
	$httpCode = curl_getinfo($curl,CURLINFO_HTTP_CODE);
	curl_close($curl);
	if($debug && $debug_details) {
		print "----------@Response Headers\n";
		print_r($header);
		print "----------@Response Body\n";
		print_r($body);
		print "\n";
	}
	if($httpCode == 404) {
		return false;
	}
	return [$body,$header];
}
function get($url,$headers=[],$reffer="",$auto_redirect=true)
{
	global $debug,$debug_details;
	if($debug) {
		print "@Request[GET]----------------------------------------------\n";
		print "----------@link ".$url."\n";
		if($debug_details) {
			if($reffer!="") {
				print "----------@Reffer\n";
				print $reffer;
				print "\n";
			}
			if(count($headers)!=0) {
				print "----------@Headers\n";
				print_r($headers);
			}
		}
	}
	$curl = curl_init($url);
	if(is_array($headers)) {
		curl_setopt($curl,CURLOPT_HTTPHEADER,$headers);
	}
	curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,true);
	curl_setopt($curl,CURLOPT_FOLLOWLOCATION,$auto_redirect);
	curl_setopt($curl,CURLOPT_HEADER,true);
	curl_setopt($curl,CURLOPT_VERBOSE,false);
	curl_setopt($curl,CURLOPT_POST,false);
	curl_setopt($curl,CURLOPT_USERAGENT,useragent());
	curl_setopt($curl,CURLOPT_COOKIEJAR,"_cookies.txt");
	curl_setopt($curl,CURLOPT_COOKIEFILE,"_cookies.txt");
	if($reffer != "")
		curl_setopt($curl,CURLOPT_REFERER,$curl);
	$response = curl_exec($curl);
	$header_size = curl_getinfo($curl,CURLINFO_HEADER_SIZE);
	$header = substr($response,0,$header_size);
	$body = substr($response,$header_size);
	$httpCode = curl_getinfo($curl,CURLINFO_HTTP_CODE);
	curl_close($curl);
	if($debug && $debug_details) {
		print "----------@Response Headers\n";
		print_r($header);
		print "----------@Response Body\n";
		print_r($body);
		print "\n";
	}
	if($httpCode == 404) {
		return false;
	}
	return [$body,$header];
}
