<?php

class team
{
public $teamname;
public $photourl;


public function __construct($teamname,$photourl){
    $this->teamname=$teamname;
    $this->photourl=$photourl;

    global $dbh;

$sql = "INSERT INTO team(
teamname,
photourl) VALUES (
:teamname,
:photourl)";


            
$stmt = $dbh->prepare($sql);
                                              
$stmt->bindParam('teamname', $teamname, PDO::PARAM_STR);       
$stmt->bindParam('photourl', $photourl, PDO::PARAM_STR); 

// use PARAM_STR although a number  
$stmt->execute();

  }







}




?>
