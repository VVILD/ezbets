<?php 
include "users.php";
include "bets.php";
include "match.php";

global $username; 
global $password; 
global $host ; 
global $dbname; 
global $dbh;
$username = "root"; 
$password = ""; 
$host = "localhost"; 
$dbname = "ezbets"; 

try {
$dbh = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
    echo "I'm sorry Charlie, I'm afraid i cant do that.";
    echo $e->getMessage();
    
}

?>