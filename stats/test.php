<?php
$whitelist_json = file_get_contents("http://jsanofanserver.com/server/whitelist.json");
$whitelist = json_decode($whitelist_json, TRUE);
//var_dump($whitelist);

$stats_json =  file_get_contents("http://jsanofanserver.com/server/world/stats/" . $whitelist["8"]["uuid"] . ".json");
$stats = json_decode($stats_json, TRUE);
//print_r($stats);



// ## TIME ##
if(array_key_exists("stat.playOneMinute", $stats)){$time = $stats["stat.playOneMinute"];}else{$time = 0;}

// # Travel #
$travel = array("walk" => 0, "crouch" => 0, "sprint" => 0, "swim" => 0, "fall" => 0, "climb" => 0, "fly" => 0, "dive" => 0, "minecart" => 0, "boat" => 0, "pig" => 0, "horse" => 0);
if(array_key_exists("stat.walkOneCm", $stats)){$travel["walk"] = $stats["stat.walkOneCm"];}
if(array_key_exists("stat.crouchOneCm", $stats)){$travel["crouch"] = $stats["stat.crouchOneCm"];}
if(array_key_exists("stat.sprintOneCm", $stats)){$travel["sprint"] = $stats["stat.sprintOneCm"];}
if(array_key_exists("stat.swimOneCm", $stats)){$travel["swim"] = $stats["stat.swimOneCm"];}
if(array_key_exists("stat.fallOneCm", $stats)){$travel["fall"] = $stats["stat.fallOneCm"];}
if(array_key_exists("stat.climbOneCm", $stats)){$travel["climb"] = $stats["stat.climbOneCm"];}
if(array_key_exists("stat.flyOneCm", $stats)){$travel["fly"] = $stats["stat.flyOneCm"];}
if(array_key_exists("stat.diveOneCm", $stats)){$travel["dive"] = $stats["stat.diveOneCm"];}
if(array_key_exists("stat.minecartOneCm", $stats)){$travel["minecart"] = $stats["stat.minecartOneCm"];}
if(array_key_exists("stat.boatOneCm", $stats)){$travel["boat"] = $stats["stat.boatOneCm"];}
if(array_key_exists("stat.pigOneCm", $stats)){$travel["pig"] = $stats["stat.pigOneCm"];}
if(array_key_exists("stat.horseOneCm", $stats)){$travel["horse"] = $stats["stat.horseOneCm"];}
$travel_total = 0;
foreach($travel as $val){
	$travel_total = $travel_total + $val;
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
$use = array();
$break_total = 0;
$use_total = 0;

foreach ($stats as $key => $value) {
    if (substr($key, 0, 25) == "stat.mineBlock.minecraft.") {
        $block_name = substr($key, 25);
		$break[$block_name] = $stats[$key];
		$break_total = $break_total + $stats[$key];
    }else if(substr($key, 0, 23) == "stat.useItem.minecraft."){
		$item_name = substr($key, 23);
		$use[$item_name] = $stats[$key];
		$use_total = $use_total + $stats[$key];
	}
}
arsort($break);
arsort($use);

// # Interactions #
$interactions = array("brewingstandInteraction " => 0, "beaconInteraction" => 0, "craftingTableInteraction" => 0, "furnaceInteraction" => 0, "dispenserInspected" => 0, "dropperInspected" => 0, "hopperInspected" => 0, "chestOpened" => 0, "trappedChestTriggered" => 0, "enderchestOpened" => 0, "noteblockPlayed" => 0, "noteblockTuned" => 0, "noteblockTuned" => 0, "recordPlayed" => 0);
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
?>