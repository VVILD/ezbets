<?php

include "conn.php";

$id="123";
$name="dsfds";
$mid="6";
$bid="1";
$bamt="1";

$obj= new bets();
$betObj=$obj->Active_bets(123);

foreach($betObj as $row){
    echo $row['matchid'];
    echo $row['betteamid'];
    echo $row['betamt'];
    echo "<br>";
}


?>
