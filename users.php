<?php


class Users
{
public $name;
public $userID;
public $currency_current;
public $currency_total;



// bet valid from users point of view... currency_current > bet aount
public function bet_isValid($id,$betamt){

// get currency_current from database
global $dbh;
$sql = "Select currency_current from users where userid = :id ";
$stmt = $dbh->prepare($sql);
$stmt->bindParam('id', $id, PDO::PARAM_STR);       
$stmt->execute(); 

$result= $stmt->fetch();

$currency_current= $result['currency_current'];

if($currency_current >= $betamt)
{
      echo "tru";
      return True;}
elseif ($currency_current < $betamt)
{
      echo "fal";
return False;
}

}

public function newuser($id,$name,$currency_current=0,$currency_total=0){

global $dbh;



$sql = "INSERT INTO users(
            name,
			userid,
			currency_total,
            currency_current) VALUES (
            :name, 
            :userid, 
            :currency_total, 
            :currency_current)";


			
$stmt = $dbh->prepare($sql);
                                              
$stmt->bindParam('name', $name, PDO::PARAM_STR);       
$stmt->bindParam('userid', $id, PDO::PARAM_STR); 
$stmt->bindParam('currency_total', $currency_total, PDO::PARAM_STR);
// use PARAM_STR although a number  
$stmt->bindParam('currency_current', $currency_current, PDO::PARAM_STR);
$stmt->execute(); 



}



//add amt to currency total and currency _current
public function add_currency($id,$amt_to_be_added){
global $dbh;
$sql = "Select currency_total,currency_current from users where userid = :id ";
$stmt = $dbh->prepare($sql);
$stmt->bindParam('id', $id, PDO::PARAM_STR);       
$stmt->execute(); 
$result= $stmt->fetch();
$currency_total= $result['currency_total']+ $amt_to_be_added;
$currency_current= $result['currency_current']+ $amt_to_be_added;
//now updating
$sql = "UPDATE `users` SET  `currency_current` = :amt1 , `currency_total` = :amt2 WHERE `userid` =  :id ;";


			
$stmt = $dbh->prepare($sql);
                                              
$stmt->bindParam('amt1', $currency_current, PDO::PARAM_STR);       
$stmt->bindParam('amt2', $currency_total, PDO::PARAM_STR); 
$stmt->bindParam('id', $id, PDO::PARAM_STR);
// use PARAM_STR although a number  
$stmt->execute(); 





}
// add/reduce amt to currency current
public function update_currency_current($id,$amt_to_be_added){
global $dbh;
$sql = "Select currency_current from users where userid = :id ";
$stmt = $dbh->prepare($sql);
$stmt->bindParam('id', $id, PDO::PARAM_STR);       
$stmt->execute(); 

$result= $stmt->fetch();

$currency_current= $result['currency_current']+ $amt_to_be_added;
//now updating
$sql = "UPDATE `users` SET  `currency_current` = :amt1 WHERE `userid` =  :id ;";


			
$stmt = $dbh->prepare($sql);
                                              
$stmt->bindParam('amt1', $currency_current, PDO::PARAM_STR);       
$stmt->bindParam('id', $id, PDO::PARAM_STR);
// use PARAM_STR although a number  
$stmt->execute(); 




}
public function makebet($userid,$matchid,$bet_team_id,$bet_amount){
      if ($this->bet_isValid($userid,$bet_amount)){ echo "hi";
$betObj= new Bets($userid,$matchid,$bet_team_id,$bet_amount);

return $betObj;
}

}

















}




?>
