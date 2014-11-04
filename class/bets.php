<?php

class Bets
{
public $userID;
public $matchID;
public $betTeamID;
public $betAmt;
public $net_Change;

public function newbet($userID,$matchID,$betTeamID,$betAmt,$type){

    global $dbh;

$sql = "INSERT INTO bets(
userID,
matchID,
betTeamID,
betAmt,
type) VALUES (
:userID,
:matchID,
:betTeamID,
:betAmt,
:type)";


            
$stmt = $dbh->prepare($sql);
                                              
$stmt->bindParam('userID', $userID, PDO::PARAM_STR);       
$stmt->bindParam('matchID', $matchID, PDO::PARAM_STR); 
$stmt->bindParam('betTeamID', $betTeamID, PDO::PARAM_STR);
$stmt->bindParam('betAmt', $betAmt, PDO::PARAM_STR);
$stmt->bindParam('type', $type, PDO::PARAM_STR);
// use PARAM_STR although a number  
$stmt->execute();
$obj= new users();
$obj->update_currency_current($userID,$betAmt);
return 1;

  }

public function Active_bets($userID)
{
    # code... get active bets of a user where userid is given and result=null

    global $dbh;
$sql = "Select * from bets where userid = :userid and net_change is NULL";
$stmt = $dbh->prepare($sql);
$stmt->bindParam('userid', $userID, PDO::PARAM_STR);       
$stmt->execute(); 
$result= $stmt->fetchall();

return $result;


}
// takes match id and the winning team id --> adds the winning amt to the winners and nothing to losers updates currency_current, net
public function BetReturn($matchid,$teamwinid)
{
    # code...
// check if $teamwinid is in that $matchid
    global $dbh;
$sql = "Select * from matchs where matchid = :mid ";
$stmt = $dbh->prepare($sql);
$stmt->bindParam('mid', $matchid, PDO::PARAM_STR);       
$stmt->execute(); 
$result= $stmt->fetch();
$t1=$result['teamid1'];
$t2=$result['teamid2'];
if($teamwinid==$result['teamid1'] or $teamwinid==$result['teamid2']){
    echo "team id is in good standing";
    echo "<br>";

}
else {
    echo "enter correct team id";
        return 0;

    # code...
}
//get total amt bet on each team 
$sql1="select sum(betAmt) from bets where matchid = $matchid and betTeamID= $t1";
$sql2="select sum(betAmt) from bets where matchid = $matchid and betTeamID= $t2";

$stmt = $dbh->prepare($sql1);
$stmt->execute(); 
$result= $stmt->fetch();
$sum1= $result[0];
$stmt = $dbh->prepare($sql2);
$stmt->execute(); 
$result= $stmt->fetch();
$sum2= $result[0];
// wehave total sums in sum1 and sum2
if ($teamwinid== $t1) {
    # code...
    $teamloseid =$t2;
    $winsum=$sum1;
    $losesum=$sum2;
}
else {$teamloseid =$t1;

    $winsum=$sum2;
    $losesum=$sum1;
}
 // for win
$sql="select betAmt,userid from bets where matchid = $matchid and betTeamID = $teamwinid";
$stmt = $dbh->prepare($sql);
$stmt->execute(); 
$result= $stmt->fetchall();
foreach($result as $row){
    $winamt = $row['betAmt'] * $losesum / $winsum * 99 /100;
    echo $winamt;
    $userid=$row['userid'];
    $totalwinnings = $winamt + $row['betAmt'];
    $insertsql="UPDATE bets SET net_change = $winamt WHERE userid =$userid and matchid =$matchid";
    $stmt = $dbh->prepare($insertsql);
    $stmt->execute(); 
    $obj= new users();
    $obj->update_currency_current($userid,$totalwinnings);
}
// for loss
$sql="select betAmt,userid from bets where matchid = $matchid and betTeamID = $teamloseid";
$stmt = $dbh->prepare($sql);
$stmt->execute(); 
$result= $stmt->fetchall();
foreach($result as $row){
    $loseamt=  -$row['betAmt'];
    $userid=$row['userid'];
    $insertsql="UPDATE bets SET net_change = $loseamt WHERE userid =$userid and matchid =$matchid";
    $stmt = $dbh->prepare($insertsql);
    $stmt->execute(); 
}


}

// get net_change values of a userid 
public function getnetchange($userid)
{
    # code...
global $dbh;
$sql = "Select net_change from bets where userid = :userid and net_change is not NULL";
$stmt = $dbh->prepare($sql);
$stmt->bindParam('userid', $userid, PDO::PARAM_STR);       
$stmt->execute(); 
$array ="";
$result= $stmt->fetchall();
foreach($result as $row){
    $array[] = $row['net_change'];
}

return $array;

}



}



?>
