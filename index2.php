<?php

include "conn.php";

$id="123";
$name="dsfds";
$mid="6";
$bid="1";
$bamt="1";
$array="";
$betObj=new bets();
$hi=$betObj->getnetchange(123);
foreach($hi as $row){
    $array[] = $row['net_change'];

}
print_r($array);


?>
