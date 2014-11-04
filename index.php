<?php

include "conn.php";

$id="123";
$name="dsfds";
$mid="6";
$bid="1";
$bamt="1";

$obj= new match();
$betObj=$obj->get_matchdetailsByStatus(0);

function timediff($date) {
  date_default_timezone_set('Asia/Calcutta');
  $now = date('Y/m/d H:i:s');
  $d1=strtotime($date);
  $d2=strtotime($now);
  if ($d2>$d1){
  	$diff= $d2-$d1;
  	echo "started ".round($diff/3600)." hours and ".round(($diff%3600)/60)." mins ago"; 
  }
  if ($d2<$d1){
  	$diff= $d1-$d2;
  	echo "starting in ".round($diff/3600)." hours and ".round(($diff%3600)/60)." mins"; 
  }

}

foreach($betObj as $row){
	


// Create the datetime and set the timestamp
date_default_timezone_set('Asia/Calcutta');
    echo $row['team1name'];
echo "<br>";    $date = date('Y/m/d H:i:s');
    echo $date;
    echo "<br>";
    echo $row['time_start'];
    echo "<br>";
    echo $row['time_start']-$date;
    echo "<br>";
    echo strtotime($date)-strtotime($row['time_start']);
    echo "<br>";
    echo "<br>";
    timediff($row['time_start']);

}


?>
