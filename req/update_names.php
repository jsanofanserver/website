<?php
ini_set("display_errors", 1);
$members = json_decode(file_get_contents("/home/jfs/vanilla/whitelist.json"), true);

$uuidnames = array();

foreach($members as $val){
	$uuid = $val["uuid"];
	$name_array = json_decode(file_get_contents("https://api.mojang.com/user/profiles/" . str_replace("-", "", $uuid) . "/names"), TRUE);
	$user_array = end($name_array);
	$name = $user_array["name"];
	$uuidnames[$uuid] = $name;
}
natcasesort($uuidnames);
$uuidnames_json = json_encode($uuidnames);
file_put_contents("/var/www/html/req/uuidnames.json", $uuidnames_json);
?>
