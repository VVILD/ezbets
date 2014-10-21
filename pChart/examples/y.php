 <?php
 include("../../conn.php");

 $betObj=new bets();
$hi=$betObj->getnetchange(123);
print_r($hi);

 ?>