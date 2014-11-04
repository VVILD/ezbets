<?php
// status 0 -> yet to be played , 1-> ongoing some matches remain  ,2- > ongoing no matches remain , 3 ->all matches finished , items not distributed , 4-> items distributed

class match
{
public $tourneyname;
public $BO;
public $teamID1;
public $teamID2;
public $time_start;
public $description;
public $result;
public $status;

public function newmatch($tourneyname,$BO,$teamID1,$teamID2,$time_start,$description=null,$result=null,$status=1){
   
    $this->tourneyname=$tourneyname;
    $this->BO=$BO;
    $this->teamID1=$teamID1;
    $this->teamID2=$teamID2;
    $this->time_start=$time_start;
    $this->description=$description;
    $this->result=$result;
    $this->status=$status;

    global $dbh;

$sql = "INSERT INTO matchs(description,
tourneyname,
BO,
teamID1,
teamID2,
time_start,
result,
status) VALUES (
:description,
:tourneyname,
:BO,
:teamID1,
:teamID2,
:time_start,
:result,
:status)";


            
$stmt = $dbh->prepare($sql);
                                              
$stmt->bindParam('description', $description, PDO::PARAM_STR);       
$stmt->bindParam('BO', $BO, PDO::PARAM_STR); 
$stmt->bindParam('teamID1', $teamID1, PDO::PARAM_STR); 
$stmt->bindParam('teamID2', $teamID2, PDO::PARAM_STR); 
$stmt->bindParam('time_start', $time_start, PDO::PARAM_STR); 
$stmt->bindParam('result', $result, PDO::PARAM_STR); 
$stmt->bindParam('status', $status, PDO::PARAM_STR); 
$stmt->bindParam('tourneyname', $tourneyname, PDO::PARAM_STR); 
// use PARAM_STR although a number  
$stmt->execute();
}

//get details based on $matchid

public function get_matchdetailsByMid($mid,$type){

global $dbh;
$sql = "SELECT m.matchid,
m.description, m.tourneyname ,m.BO , m.time_start ,m.status , m.result,
m.teamid1, 
m.teamid2, t.teamname as team1name,p.teamname as team2name,bet1.totalbet as team1bet ,bet2.totalbet as team2bet
 FROM `matchs` as m JOIN team as t on t.teamid = m.teamid1 JOIN team as p  on p.teamid=m.teamid2 Join
(
    SELECT SUM( betamt ) as totalbet , betteamid, matchid
FROM  `bets` where type =$type
GROUP BY matchid, betteamid
    ) as bet1 on bet1.matchid= m.matchid and m.teamid1=bet1.betteamid 
Join
(
    SELECT SUM( betamt ) as totalbet , betteamid, matchid
FROM  `bets` where type = $type
GROUP BY matchid, betteamid
    ) as bet2 on bet2.matchid= m.matchid and m.teamid2=bet2.betteamid 

WHERE m.matchid =:mid ";
$stmt = $dbh->prepare($sql);
$stmt->bindParam('mid', $mid, PDO::PARAM_STR);       
$stmt->execute(); 
$result= $stmt->fetchall();

return $result;

}
public function get_matchdetailsByStatus($status){

global $dbh;
$sql = "SELECT m.matchid,
m.description, m.tourneyname ,m.BO , m.time_start ,m.status , m.result,
m.teamid1, 
m.teamid2, t.teamname as team1name,p.teamname as team2name,bet1.totalbet as team1bet ,bet2.totalbet as team2bet
 FROM `matchs` as m JOIN team as t on t.teamid = m.teamid1 JOIN team as p  on p.teamid=m.teamid2 Join
(
    SELECT SUM( betamt ) as totalbet , betteamid, matchid
FROM  `bets` 
GROUP BY matchid, betteamid
    ) as bet1 on bet1.matchid= m.matchid and m.teamid1=bet1.betteamid 
Join
(
    SELECT SUM( betamt ) as totalbet , betteamid, matchid
FROM  `bets` 
GROUP BY matchid, betteamid
    ) as bet2 on bet2.matchid= m.matchid and m.teamid2=bet2.betteamid 

WHERE status =:status  ";
$stmt = $dbh->prepare($sql);
$stmt->bindParam('status', $status, PDO::PARAM_STR);       
$stmt->execute(); 
$result= $stmt->fetchall();

return $result;



}



}


?>
