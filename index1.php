<?php

include "conn.php";

$id="123";
$name="dsfds";
$mid="6";
$bid="1";
$bamt="1";


$usersObj=new users();
    $olduser=$usersObj->getdetails(123);

echo $olduser[2];
echo $olduser[3];


?>
