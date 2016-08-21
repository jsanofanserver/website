<!doctype html>
<!--
Page made by Dakota

Plan:
 - Use PHP to gather all json data required
 - Echo that into a javascript array (organized by username)
 - Have javascript fill page with data
    - Different sections for different old pages
    - More data than ever! (All blocks, placement data too)
    - Totals for each section
    - Click on totals, sort by total of that section
    - Click on individual items within section, sort by individual items in that section
       - That section will then be on top, item bolded
 - Have whitelist available somewhere near the top, to individually select user
-->
<html>
<head>
<meta charset="utf-8">
<title>JSFS || Stats</title>
<link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.5/superhero/bootstrap.min.css" rel="stylesheet" integrity="sha256-o0IkLyCCWGBI+ryg6bL44/f8s4cb7+5bncR4LvU57a8= sha512-jptu6vg45XTY9uPX3vD5nHN4vASCN2hHl+fhmgkdd/px/bFHKMXmDXhkNmTiCpKqH6sliEPFakl2KZNav2Zo1Q==" crossorigin="anonymous">
<link href="../template.css" rel="stylesheet" type="text/css">
<link href="stylesheet.css" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha256-Sk3nkD6mLTMOF0EOpNtsIry+s1CsaqQC1rVLTAy+0yc= sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>

<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-66064409-1', 'auto');
ga('send', 'pageview');
</script>

</head>

<body>
<div id="major_background"></div>
<div class="container" id="main">
	<br>
    <div class="row jmenu">
    	<div class="col-sm-2 col-sm-offset-1"><a href="../">Home</a></div>
        <div class="col-sm-2"><a href="../members/">Members</a></div>
        <div class="col-sm-2"></div>
        <div class="col-sm-2"><a href="../map/">Overviewer</a></div>
        <div class="col-sm-2 active"><a href="#">Stats</a></div>
        
    </div>
	<br>
    <div id="background">
		<div id="loading"><img src="../images/load.gif"></div>
    </div>
    <div id="ip">IP :: jsanofanserver.com</div>
</div>
<div id="logo"><a href="../"><img src="../images/logo.jpg"></a></div>
<br><br>
<script>

$(function () {
	$('[data-toggle="tooltip"]').tooltip()
})

var users = [
<?php
$members = json_decode(file_get_contents("../req/uuidnames.json"), TRUE);
// $members = json_decode(file_get_contents("http://www.jsanofanserver.com/req/uuidnames.json"), TRUE);

foreach($members as $uuid => $name){
	
	$stats_json =  @file_get_contents("/home/jfs/vanilla/world/stats/" . $uuid . ".json");
	// $stats_json =  @file_get_contents("http://www.jsanofanserver.com/server/world/stats/" . $uuid . ".json");
	if ($stats_json !== false) {
		$stats = json_decode($stats_json, TRUE);
		
		
		// ## TIME ##
		if(array_key_exists("stat.playOneMinute", $stats)){$time = $stats["stat.playOneMinute"];}else{$time = 0;}
		$time = round($time/72000, 1);
		
		// # Travel #
		$travel = array("walk" => 0, "fly" => 0, "crouch" => 0, "sprint" => 0, "swim" => 0, "fall" => 0, "climb" => 0, "dive" => 0, "minecart" => 0, "boat" => 0, "pig" => 0, "horse" => 0);
		$travel_js = "";
		if(array_key_exists("stat.walkOneCm", $stats)){$travel["walk"] = $stats["stat.walkOneCm"];}
		if(array_key_exists("stat.aviateOneCm", $stats)){$travel["fly"] = $stats["stat.aviateOneCm"];}
		if(array_key_exists("stat.crouchOneCm", $stats)){$travel["crouch"] = $stats["stat.crouchOneCm"];}
		if(array_key_exists("stat.sprintOneCm", $stats)){$travel["sprint"] = $stats["stat.sprintOneCm"];}
		if(array_key_exists("stat.swimOneCm", $stats)){$travel["swim"] = $stats["stat.swimOneCm"];}
		if(array_key_exists("stat.fallOneCm", $stats)){$travel["fall"] = $stats["stat.fallOneCm"];}
		if(array_key_exists("stat.climbOneCm", $stats)){$travel["climb"] = $stats["stat.climbOneCm"];}
		if(array_key_exists("stat.diveOneCm", $stats)){$travel["dive"] = $stats["stat.diveOneCm"];}
		if(array_key_exists("stat.minecartOneCm", $stats)){$travel["minecart"] = $stats["stat.minecartOneCm"];}
		if(array_key_exists("stat.boatOneCm", $stats)){$travel["boat"] = $stats["stat.boatOneCm"];}
		if(array_key_exists("stat.pigOneCm", $stats)){$travel["pig"] = $stats["stat.pigOneCm"];}
		if(array_key_exists("stat.horseOneCm", $stats)){$travel["horse"] = $stats["stat.horseOneCm"];}
		$travel_total = 0;
		asort($travel);
		foreach($travel as $type => $val){
			$travel_total = $travel_total + $val;
			$travel_js .= ",'" . ucfirst($type) . "' : " . $val;
		}
		
		
		// # Deaths #
		if(array_key_exists("stat.deaths", $stats)){$deaths = $stats["stat.deaths"];}else{$deaths = 0;}
		if(array_key_exists("stat.damageTaken", $stats)){$damage = $stats["stat.damageTaken"];}else{$damage = 0;}
		
		// # Cake #
		if(array_key_exists("stat.cakeSlicesEaten", $stats)){$cake = $stats["stat.cakeSlicesEaten"];}else{$cake = 0;}
		$calories = 266.6*$cake;
		
		
		
		// ## ORES ##
		
		// # Ore List #
		$ore_list = array("coal_ore" => 0, "iron_ore" => 0, "redstone_ore" => 0, "lapis_ore" => 0, "gold_ore" => 0, "emerald_ore" => 0, "diamond_ore" => 0, "quartz_ore" => 0);
		$ore_total = 0;
		foreach($ore_list as $key => $val){
			if(array_key_exists("stat.mineBlock.minecraft." . $key, $stats)){
				$ore_list[$key] = $stats["stat.mineBlock.minecraft." . $key];
				$ore_total = $ore_total + $stats["stat.mineBlock.minecraft." . $key];
			}
		}
		
		// # Trades #
		if(array_key_exists("stat.tradedWithVillager", $stats)){$trades = $stats["stat.tradedWithVillager"];}else{$trades = 0;}
		
		
		
		// ## BREAK AND USE ##
		// Top 10's handled together
		$break = array();
		$break_names = array();
		$use = array();
		$use_names = array();
		$break_total = 0;
		$use_total = 0;
		
		foreach ($stats as $key => $value) {
			if (substr($key, 0, 25) == "stat.mineBlock.minecraft.") {
				$block_name = substr($key, 25);
				$break[$block_name] = $stats[$key];
				$break_names[$block_name] = ucwords(str_replace("_", " ", $block_name));
				$break_total = $break_total + $stats[$key];
			}else if(substr($key, 0, 23) == "stat.useItem.minecraft."){
				$item_name = substr($key, 23);
				$use[$item_name] = $stats[$key];
				$use_names[$item_name] = ucwords(str_replace("_", " ", $item_name));
				$use_total = $use_total + $stats[$key];
			}
		}
		arsort($break);
		arsort($use);
		$break_keys = array_keys($break);
		$use_keys = array_keys($use);
		
		
		
		
		
		
		// # Interactions #
		$interactions = array("brewingstandInteraction" => 0, "beaconInteraction" => 0, "craftingTableInteraction" => 0, "furnaceInteraction" => 0, "dispenserInspected" => 0, "dropperInspected" => 0, "hopperInspected" => 0, "chestOpened" => 0, "trappedChestTriggered" => 0, "enderchestOpened" => 0, "noteblockPlayed" => 0, "noteblockTuned" => 0, "recordPlayed" => 0);
		$interactions_total = 0;
		foreach($interactions as $key => $val){
			if(array_key_exists("stat." . $key, $stats)){
				$interactions[$key] = $stats["stat." . $key];
				$interactions_total = $interactions_total + $stats["stat." . $key];
			}
		}
		
		
		
		// ## KILL ##
		if(array_key_exists("stat.mobKills", $stats)){$mobkills = $stats["stat.mobKills"];}else{$mobkills = 0;}
		
		// # Mobs #
		$mob_list = array("Bat" => 0, "Blaze" => 0, "CaveSpider" => 0, "Chicken" => 0, "Cow" => 0, "Creeper" => 0, "Enderman" => 0, "Endermite" => 0, "EntityHorse" => 0, "Ghast" => 0, "Guardian" => 0, "LavaSlime" => 0, "Pig" => 0, "PigZombie" => 0, "Rabbit" => 0, "Sheep" => 0, "Silverfish" => 0, "Skeleton" => 0, "Slime" => 0, "Spider" => 0, "Squid" => 0, "Villager" => 0, "Witch" => 0, "Zombie" => 0);
		$mob_killed = array("Bat" => 0, "Blaze" => 0, "CaveSpider" => 0, "Chicken" => 0, "Cow" => 0, "Creeper" => 0, "Enderman" => 0, "Endermite" => 0, "EntityHorse" => 0, "Ghast" => 0, "Guardian" => 0, "LavaSlime" => 0, "Pig" => 0, "PigZombie" => 0, "Rabbit" => 0, "Sheep" => 0, "Silverfish" => 0, "Skeleton" => 0, "Slime" => 0, "Spider" => 0, "Squid" => 0, "Villager" => 0, "Witch" => 0, "Zombie" => 0);
		foreach($mob_list as $key => $val){
			if(array_key_exists("stat.killEntity." . $key, $stats)){
				$mob_list[$key] = $stats["stat.killEntity." . $key];
			}
			if(array_key_exists("stat.entityKilledBy." . $key, $stats)){
				$mob_killed[$key] = $stats["stat.entityKilledBy." . $key];
			}
		}
		
		// # Player Kills #
		if(array_key_exists("stat.playerKills", $stats)){$pkills = $stats["stat.playerKills"];}else{$pkills = 0;}
		if(array_key_exists("stat.damageDealt", $stats)){$dealt = $stats["stat.damageDealt"];}else{$dealt = 0;}
		
		echo "{'Name' : '" . $name . "', 'Time' : {'Hours' : " . $time . ",'Travel' : {'Total' : " . $travel_total . $travel_js . "},'Deaths' : {'Deaths' : " . $deaths . ",'Damage' : " . $damage . "},'Cake' : {'Slices' : " . $cake . ",'Calories' : " . $calories . "}},'Ores' : {'Total' : " . $ore_total . ",'Ores' : {'Coal' : " . $ore_list["coal_ore"] . ",'Iron' : " . $ore_list["iron_ore"] . ",'Redstone' : " . $ore_list["redstone_ore"] . ",'Lapis' : " . $ore_list["lapis_ore"] . ",'Gold' : " . $ore_list["gold_ore"] . ",'Emerald' : " . $ore_list["emerald_ore"] . ",'Diamond' : " . $ore_list["diamond_ore"] . ",'Quartz' : " . $ore_list["quartz_ore"] . "},'Trades' : " . $trades . "},'Break' : {'Total' : " . $break_total . ",'Top10' : {";
		
		for($i = 0; $i < 10; $i++){
			if(array_key_exists($i, $break_keys)){
				$next = $i + 1;
				echo "'" . $next . "' : {'Name' : '" . $break_keys[$i] . "','Title' : '" . $break_names[$break_keys[$i]] . "','Amount' : '" . $break[$break_keys[$i]] . "'},";
			}
		}
		
		echo "}},'Use' : {'Total' : " . $use_total . ",'Top10' : {";
		
		for($u = 0; $u < 10; $u++){
			if(array_key_exists($u, $use_keys)){
				$next = $u + 1;
				echo "'" . $next . "' : {'Name' : '" . $use_keys[$u] . "','Title' : '" . $use_names[$use_keys[$u]] . "','Amount' : '" . $use[$use_keys[$u]] . "'},";
			}
		}
		
		echo "},'Interactions' : {'Total' : " . $interactions_total . ",'Brewing' : " . $interactions["brewingstandInteraction"] . ",'Beacon' : " . $interactions["beaconInteraction"] . ",'Crafting' : " . $interactions["craftingTableInteraction"] . ",'Furnace' : " . $interactions["furnaceInteraction"] . ",'Dispenser' : " . $interactions["dispenserInspected"] . ",'Dropper' : " . $interactions["dropperInspected"] . ",'Hopper' : " . $interactions["hopperInspected"] . ",'Chest' : " . $interactions["chestOpened"] . ",'Trap' : " . $interactions["trappedChestTriggered"] . ",'Ender' : " . $interactions["enderchestOpened"] . ",'NotePlay' : " . $interactions["noteblockPlayed"] . ",'NoteTune' : " . $interactions["noteblockTuned"] . ",'Record' : " . $interactions["recordPlayed"] . "}},'Kill' : {'Mobs' : {'Total' : " . $mobkills . ",'Bat' : {'Killed' : " . $mob_list["Bat"] . ",'By' : " . $mob_killed["Bat"] . "},'Blaze' : {'Killed' : " . $mob_list["Blaze"] . ",'By' : " . $mob_killed["Blaze"] . "},'CaveSpider' : {'Killed' : " . $mob_list["CaveSpider"] . ",'By' : " . $mob_killed["CaveSpider"] . "},'Chicken' : {'Killed' : " . $mob_list["Chicken"] . ",'By' : " . $mob_killed["Chicken"] . "},'Cow' : {'Killed' : " . $mob_list["Cow"] . ",'By' : " . $mob_killed["Cow"] . "},'Creeper' : {'Killed' : " . $mob_list["Creeper"] . ",'By' : " . $mob_killed["Creeper"] . "},'Enderman' : {'Killed' : " . $mob_list["Enderman"] . ",'By' : " . $mob_killed["Enderman"] . "},'Endermite' : {'Killed' : " . $mob_list["Endermite"] . ",'By' : " . $mob_killed["Endermite"] . "},'Horse' : {'Killed' : " . $mob_list["EntityHorse"] . ",'By' : " . $mob_killed["EntityHorse"] . "},'Ghast' : {'Killed' : " . $mob_list["Ghast"] . ",'By' : " . $mob_killed["Ghast"] . "},'Guardian' : {'Killed' : " . $mob_list["Guardian"] . ",'By' : " . $mob_killed["Guardian"] . "},'LavaSlime' : {'Killed' : " . $mob_list["LavaSlime"] . ",'By' : " . $mob_killed["LavaSlime"] . "},'Pig' : {'Killed' : " . $mob_list["Pig"] . ",'By' : " . $mob_killed["Pig"] . "},'PigZombie' : {'Killed' : " . $mob_list["PigZombie"] . ",'By' : " . $mob_killed["PigZombie"] . "},'Rabbit' : {'Killed' : " . $mob_list["Rabbit"] . ",'By' : " . $mob_killed["Rabbit"] . "},'Sheep' : {'Killed' : " . $mob_list["Sheep"] . ",'By' : " . $mob_killed["Sheep"] . "},'Silverfish' : {'Killed' : " . $mob_list["Silverfish"] . ",'By' : " . $mob_killed["Silverfish"] . "},'Skeleton' : {'Killed' : " . $mob_list["Skeleton"] . ",'By' : " . $mob_killed["Skeleton"] . "},'Slime' : {'Killed' : " . $mob_list["Slime"] . ",'By' : " . $mob_killed["Slime"] . "},'Spider' : {'Killed' : " . $mob_list["Spider"] . ",'By' : " . $mob_killed["Spider"] . "},'Squid' : {'Killed' : " . $mob_list["Squid"] . ",'By' : " . $mob_killed["Squid"] . "},'Villager' : {'Killed' : " . $mob_list["Villager"] . ",'By' : " . $mob_killed["Villager"] . "},'Witch' : {'Killed' : " . $mob_list["Witch"] . ",'By' : " . $mob_killed["Witch"] . "},'Zombie' : {'Killed' : " . $mob_list["Zombie"] . ",'By' : " . $mob_killed["Zombie"] . "}},'Kills' : {'Kills' : " . $deaths . ",'Dealt' : " . $dealt . "}}},";
		
		
		
		
		//$display = " <div class='closed user-stats' id='" . $name . "'> <div class='row'> <div class='col-xs-2 col-md-2 display' id='" . $name . "-display'> <img src='http://www.simplay.ca/avatar/download.php?u=" . $name . "&s=80' class='face'> &nbsp;&nbsp; " . $name . " </div><div class='col-xs-2 col-md-2 stat-title time' id='" . $name . "-time'> <div class='icon-circle'> <img src='../req/clock.png'> </div>" . $time . " Hours Played </div><div class='col-xs-2 col-md-2 stat-title ores' id='" . $name . "-ores'> <div class='icon-circle'> <img src='../req/diamond_ore.png'> </div>856 Ores Mined </div><div class='col-xs-2 col-md-2 stat-title break' id='" . $name . "-break'> <div class='icon-circle'> <img src='../req/grass.png'> </div>234 Blocks Broken </div><div class='col-xs-2 col-md-2 stat-title place' id='" . $name . "-place'> <div class='icon-circle'> <img src='../req/stonebrick.png'> </div>298 Items Used </div><div class='col-xs-2 col-md-2 stat-title kill' id='" . $name . "-kill'> <div class='icon-circle'> <img src='../req/cow.png'> </div>550 Mobs Killed </div></div><div class='extra'> <div class='row extra-row time-hidden' id='" . $name . "-time-hidden'> <div class='col-sm-3 extra-info travel'> <img src='../req/chainmail_boots.png'>&nbsp;&nbsp;22km Travelled </div><div class='col-sm-3 extra-info death'> <img src='../req/heart.png'>&nbsp;&nbsp;22 Deaths </div><div class='col-sm-3 extra-info cake'> <img src='../req/cake.png'>&nbsp;&nbsp;22 Slices of Cake </div></div><div class='row extra-row ores-hidden' id='" . $name . "-ores-hidden'> <div class='col-sm-3 extra-info coal-ore'> <img src='../req/blocks/coal_ore.png' class='block'>&nbsp;&nbsp;25 Coal Ore </div><div class='col-sm-3 extra-info trade'> <img src='../req/emerald.png'>&nbsp;&nbsp;25 Villager Trades </div></div><div class='row extra-row break-hidden' id='" . $name . "-break-hidden'> <div class='col-sm-3 extra-info stone'> <img src='../req/blocks/stone.png' class='block'>&nbsp;&nbsp;25 Stone Blocks </div></div><div class='row extra-row place-hidden' id='" . $name . "-place-hidden'> <div class='col-sm-3 extra-info stonebrick'> <img src='../req/blocks/stonebrick.png' class='block'>&nbsp;&nbsp;25 Stone Bricks </div><div class='col-sm-3 extra-info interactions'> <img src='../req/blocks/crafting_table_front.png' class='block'>&nbsp;&nbsp;25 Block Interactions </div></div><div class='row extra-row kill-hidden' id='" . $name . "-kill-hidden'> <div class='col-sm-3 extra-info p-kills'> <img src='../req/mobs/rabbit.png'>&nbsp;&nbsp;Killed 25, Killed by 18 </div><div class='col-sm-3 extra-info p-kills'> <img src='../req/sword.png'>&nbsp;&nbsp;25 Player Kills </div></div></div></div>";
		//echo $display;
	}
}

?>
];







users = users.sort(function (a, b) {
    return b["Time"]["Hours"] - a["Time"]["Hours"];
});
$("#loading").remove();
function comma(val){
	while (/(\d+)(\d{3})/.test(val.toString())){
		val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
	}
	return val;
}

function output(list){
	$("#background").empty();
	$.each(list, function( key, value ) {
		if(value["Time"]["Hours"] > 0){
			var km = Math.round(value["Time"]["Travel"]["Total"]*0.00001);
			var tooltip = "";
			$.each(value["Time"]["Travel"], function( type, amount ) {
				if(type != "total"){
					var percent = Math.round((amount/value["Time"]["Travel"]["Total"])*10)/10
					tooltip += type + ": " + comma(Math.round(amount*0.001)/100) + " km, (" + percent + "%)<br>";
				}
			});
			tooltip = tooltip.slice(0, -4)
			
			var text = "<div class='closed user-stats' id='" + value["Name"] + "'> <div class='row'> <div class='col-xs-2 col-md-2 display' id='" + value["Name"] + "-display'> <img src='https://minotar.net/helm/" + value["Name"] + "/80.png' class='face'> &nbsp;&nbsp; " + value["Name"] + " </div><div class='col-xs-2 col-md-2 stat-title time' id='" + value["Name"] + "-time'> <div class='icon-circle'> <img src='../images/icons/clock.png'> </div>" + comma(value["Time"]["Hours"]) + " Hours Played </div><div class='col-xs-2 col-md-2 stat-title ores' id='" + value["Name"] + "-ores'> <div class='icon-circle'> <img src='../images/icons/diamond_ore.png'> </div>" + comma(value["Ores"]["Total"]) + " Ores Mined </div><div class='col-xs-2 col-md-2 stat-title break' id='" + value["Name"] + "-break'> <div class='icon-circle'> <img src='../images/icons/grass.png'> </div>" + comma(value["Break"]["Total"]) + " Blocks Broken </div><div class='col-xs-2 col-md-2 stat-title place' id='" + value["Name"] + "-place'> <div class='icon-circle'> <img src='../images/icons/stonebrick.png'> </div>" + comma(value["Use"]["Total"]) + " Items Used </div><div class='col-xs-2 col-md-2 stat-title kill' id='" + value["Name"] + "-kill'> <div class='icon-circle'> <img src='../images/icons/cow.png'> </div>" + comma(value["Kill"]["Mobs"]["Total"]) + " Mobs Killed </div></div><div class='extra'> <div class='row extra-row time-hidden' id='" + value["Name"] + "-time-hidden'><div class='col-sm-3 extra-info sort-by travel' id='" + value["Name"] + "-Time-Travel-Total' data-toggle='tooltip' data-placement='right' data-html='true' title='" + tooltip + "'> <img src='../images/icons/chainmail_boots.png'>&nbsp;&nbsp;" + comma(km) + " km Travelled </div><div class='col-sm-3 extra-info sort-by fly' id='" + value["Name"] + "-Time-Travel-Fly'> <img src='../images/blocks/elytra.png' class='block'>&nbsp;&nbsp;" + comma(Math.round(value["Time"]["Travel"]["Fly"]*0.01)) + " m flown </div><div class='col-sm-3 extra-info sort-by death' id='" + value["Name"] + "-Time-Deaths-Deaths'> <img src='../images/icons/heart.png'>&nbsp;&nbsp;" + comma(value["Time"]["Deaths"]["Deaths"]) + " Deaths </div><div class='col-sm-3 extra-info sort-by cake' id='" + value["Name"] + "-Time-Cake-Slices'> <img src='../images/icons/cake.png'>&nbsp;&nbsp;" + comma(value["Time"]["Cake"]["Slices"]) + " Slices of Cake </div></div><div class='row extra-row ores-hidden' id='" + value["Name"] + "-ores-hidden'> <div class='col-sm-3 extra-info sort-by coal-ore' id='" + value["Name"] + "-Ores-Ores-Coal'> <img src='../images/blocks/coal_ore.png' class='block'>&nbsp;&nbsp;" + comma(value["Ores"]["Ores"]["Coal"]) + " Coal Ore </div><div class='col-sm-3 extra-info sort-by iron-ore' id='" + value["Name"] + "-Ores-Ores-Iron'> <img src='../images/blocks/iron_ore.png' class='block'>&nbsp;&nbsp;" + comma(value["Ores"]["Ores"]["Iron"]) + " Iron Ore </div><div class='col-sm-3 extra-info sort-by redstone-ore' id='" + value["Name"] + "-Ores-Ores-Redstone'> <img src='../images/blocks/redstone_ore.png' class='block'>&nbsp;&nbsp;" + comma(value["Ores"]["Ores"]["Redstone"]) + " Redstone Ore </div><div class='col-sm-3 extra-info sort-by lapis-ore' id='" + value["Name"] + "-Ores-Ores-Lapis'> <img src='../images/blocks/lapis_ore.png' class='block'>&nbsp;&nbsp;" + comma(value["Ores"]["Ores"]["Lapis"]) + " Lapis Ore </div><div class='col-sm-3 extra-info sort-by gold-ore' id='" + value["Name"] + "-Ores-Ores-Gold'> <img src='../images/blocks/gold_ore.png' class='block'>&nbsp;&nbsp;" + comma(value["Ores"]["Ores"]["Gold"]) + " Gold Ore </div><div class='col-sm-3 extra-info sort-by emerald-ore' id='" + value["Name"] + "-Ores-Ores-Emerald'> <img src='../images/blocks/emerald_ore.png' class='block'>&nbsp;&nbsp;" + comma(value["Ores"]["Ores"]["Emerald"]) + " Emerald Ore </div><div class='col-sm-3 extra-info sort-by diamond-ore' id='" + value["Name"] + "-Ores-Ores-Diamond'> <img src='../images/blocks/diamond_ore.png' class='block'>&nbsp;&nbsp;" + comma(value["Ores"]["Ores"]["Diamond"]) + " Diamond Ore </div><div class='col-sm-3 extra-info sort-by quartz-ore' id='" + value["Name"] + "-Ores-Ores-Quartz'> <img src='../images/blocks/quartz_ore.png' class='block'>&nbsp;&nbsp;" + comma(value["Ores"]["Ores"]["Quartz"]) + " Quartz Ore </div><div class='col-sm-3 extra-info sort-by trade' id='" + value["Name"] + "-Ores-Trades'> <img src='../images/icons/emerald.png'>&nbsp;&nbsp;" + comma(value["Ores"]["Trades"]) + " Villager Trades </div></div><div class='row extra-row break-hidden' id='" + value["Name"] + "-break-hidden'>"; 
			
			$.each(value["Break"]["Top10"], function( breakKey, breakVal ) {
				text += "<div class='col-sm-3 extra-info sort-by " + breakVal["Name"] + "' id='" + value["Name"] + "-Break-Top10-" + breakVal["Name"] + "'> <img src='../images/blocks/" + breakVal["Name"] + ".png' class='block'>&nbsp;&nbsp;" + comma(breakVal["Amount"]) + " " + breakVal["Title"] + " Blocks </div>";
			});
			
			text += "</div><div class='row extra-row place-hidden' id='" + value["Name"] + "-place-hidden'>";
			
			 $.each(value["Use"]["Top10"], function( useKey, useVal ) {
				text += "<div class='col-sm-3 extra-info sort-by " + useVal["Name"] + "' id='" + value["Name"] + "-Use-Top10-" + useVal["Name"] + "'> <img src='../images/blocks/" + useVal["Name"] + ".png' class='block'>&nbsp;&nbsp;" + comma(useVal["Amount"]) + " " + useVal["Title"] + "</div>";
			});
	
			 
			 text += "<div class='col-sm-3 extra-info sort-by interactions' id='" + value["Name"] + "-Use-Interactions-Total'> <img src='../images/blocks/crafting_table.png' class='block'>&nbsp;&nbsp;" + comma(value["Use"]["Interactions"]["Total"]) + " Block Interactions </div></div><div class='row extra-row kill-hidden' id='" + value["Name"] + "-kill-hidden'>";
			 
			 var mobs = ["Bat", "Blaze", "CaveSpider", "Chicken", "Cow", "Creeper", "Enderman", "Endermite", "Horse", "Ghast", "Guardian", "LavaSlime", "Pig", "PigZombie", "Rabbit", "Sheep", "Silverfish", "Skeleton", "Slime", "Spider", "Squid", "Villager", "Witch", "Zombie"];
			 
			 mobs.forEach(function(mobVal){
				 var ext = "png";
				 if(mobVal == "Zombie" || mobVal == "Skeleton" || mobVal == "Guardian"){
					 ext = "gif";
				 }
				 
				 var killed = value["Kill"]["Mobs"][mobVal]["Killed"];
				 var by = value["Kill"]["Mobs"][mobVal]["By"];
				 
				 if(killed > 0 && by > 0){
					 text += "<div class='col-sm-3 extra-info " + mobVal + "'> <img src='../images/mobs/" + mobVal + "." + ext + "'>&nbsp;&nbsp;<span class='sort-by' id='" + value["Name"] + "-Kill-Mobs-" + mobVal + "-Killed'>Killed " + killed + ",</span> <span class='sort-by' id='" + value["Name"] + "-Kill-Mobs-" + mobVal + "-By'>Killed by " + by + " </span></div>";
				 }else if(killed > 0){
					 text += "<div class='col-sm-3 extra-info sort-by " + mobVal + "' id='" + value["Name"] + "-Kill-Mobs-" + mobVal + "-Killed'> <img src='../images/mobs/" + mobVal + "." + ext + "'>&nbsp;&nbsp;Killed " + killed + "</div>";
				 }else if(by > 0){
					 text += "<div class='col-sm-3 extra-info sort-by " + mobVal + "' id='" + value["Name"] + "-Kill-Mobs-" + mobVal + "-By'> <img src='../images/mobs/" + mobVal + "." + ext + "'>&nbsp;&nbsp;Killed by " + by + " </div>";
				 }
			 });
			 
			 
			 
			 text += "<div class='col-sm-3 extra-info sort-by p-kills' id='" + value["Name"] + "-Kill-Kills-Kills'> <img src='../images/icons/sword.png'>&nbsp;&nbsp;" + value["Kill"]["Kills"]["Kills"] + " Player Kills </div></div></div></div>";
			$("#background").append(text);
		}
	});
}
var sort_initial = ["Time", "Hours"];
output(sort(sort_initial, users));

var visible = "";

function sort(path, array){ 
    return array.sort((a, b) => {
        return getValue(b,path) -  getValue(a,path)    
    });

    function getValue(obj, path){
        path.forEach(path => obj = obj[path])
        return obj;
    }
}

$(document).on("click", ".sort-by", function(e){
	var sortId = e.target.id;
	var parts = sortId.split("-");
    
    parts.shift();
    
	visible = "";
    output(sort(parts, users));
});

$(document).on("click", ".stat-title", function(){ 
	var id = this.id;
	if(id != visible){
		var nameArray = id.split("-");
		var name = nameArray[0];
		if(visible != ""){
			$("#" + visible).removeClass("active");
			$("#" + visible + "-hidden").removeClass("visible");
			var oldNameArray = visible.split("-");
			var oldName = oldNameArray[0];
			if(oldName != name){
				$("#" + oldName).removeClass("open");
				$("#" + oldName).addClass("closed");
				$("#" + name).removeClass("closed");
				$("#" + name).addClass("open");
			}
		}else{
			$("#" + name).removeClass("closed");
			$("#" + name).addClass("open");
		}
		$("#" + id).addClass("active");
		$("#" + id + "-hidden").addClass("visible");
		visible = id;
	}
});



</script>
</body>
</html>