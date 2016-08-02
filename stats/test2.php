<?php
$name = "yo";
$uuid = "c2822734-4925-4318-886e-b6cb56cc2494";
$uuidnames = json_decode(file_get_contents("../req/uuidnames.json"), TRUE);
	
function get_name(){
	global $uuid, $name;
	$name_array = json_decode(file_get_contents("https://api.mojang.com/user/profiles/" . str_replace("-", "", $uuid) . "/names"), TRUE);
	$name = $name_array[0]["name"];
	
	
	$uuidnames[$uuid] = array("name" => $name, "time" => time());
	$uuidnames_json = json_encode($uuidnames, JSON_FORCE_OBJECT);
	
	file_put_contents("../req/uuidnames.json", $uuidnames_json);
}

if(array_key_exists($uuid, $uuidnames)){
	echo("uuid exists<br>");
	$time_then = $uuidnames[$uuid]["time"];
	$time_now = time();
	$diff = $time_now - $time_then;
	if($diff >= 86400){
		get_name();
		echo("more than day<br>");
	}else{
		echo("less than day<br>");
		$name = $uuidnames[$uuid]["name"];
	}
}else{
	echo("uuid didn't exist<br>");
	get_name();
}
echo $name;
?>