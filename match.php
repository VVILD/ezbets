<?php
    require ('steamauth/steamauth.php');  
    include "conn.php";
        
?>
<!DOCTYPE html>
<html lang="en">
<head>
<!-- Le styles -->
<link href="css/vendor/bootstrap.min.css" rel="stylesheet">

    <!-- Loading Flat UI -->
    <link href="css/flat-ui.css" rel="stylesheet">

    <link rel="shortcut icon" href="img/favicon.ico">
<style>
label > input{ /* HIDE RADIO */
  display:none;
}
label > input + img{ /* IMAGE STYLES */
  cursor:pointer;
  border:2px solid transparent;
}
label > input:checked + img{ /* (CHECKED) IMAGE STYLES */
  border:2px solid #f00;
}
</style>


</head>
 
<body>
 
<div class="container">
 <?php include 'base.html';
 ?>
<!-------->
<div id="content">
  <?php
  // function for time
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

 $obj= new match();
$betObj=$obj->get_matchdetailsBymid($_GET["m"],0);


if(isset($_POST['btnSubmit']))
{
 $obj= new bets();
$success=$obj->newbet($_POST['u'],$_GET["m"],$_POST['radioName'],$_POST['betamt'],$_POST['matchno']);


if ($success){
echo '<div class="alert alert-success" role="alert">Bet has been placed check your open bets in mybets tab</div>';
}


}

foreach($betObj as $row){
echo '<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">';
echo '<li class="active"><a href="#red" data-toggle="tab">Bet on full series</a></li>';


for ($x=1; $x< $row['BO']; $x++) {
  echo '<li><a href="#s'.$x.'" name="reset" data-toggle="tab">Bet on Draft of game '.$x.'</a></li>';
} 

echo '</ul>';

echo '<div id="my-tab-content" class="tab-content">
        <div class="tab-pane active" id="red">
                    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-6">
              <h4> Matches Today </h4>
              <div class="tile">
                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-5" >
                  
                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-6">
                <img  align="left"class="img-rounded" data-src="alliance.jpg" src="alliance.jpg" data-holder-rendered="true" style="width: 60px; height: 60px;">
              </div>
              <div class="col-xs-12 col-sm-4 col-md-3 col-lg-6">
               <p> <b> alliance
                <br> 50%
                </b>
                </p> 
              </div>

              </div>
              
              <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
             
                  <img style="padding:15px 0px 0px 0px; width: 80px; height: 80px;" class="img-circle" data-src="vs.png" src="vs.png" data-holder-rendered="true">
              
              </div>
              <div class="col-xs-12 col-sm-4 col-md-3 col-lg-5">
                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-6">
                  <center>
                 <p><b>alliance
                <br> 50%
              </b></p>
            </center>
              </div>
                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-6">
                <img align="left" class="img-rounded" data-src="alliance.jpg" src="alliance.jpg" data-holder-rendered="true" style="width: 60px; height: 60px;">
              </div>
              
              </div>
                <h3 class="tile-title">The Summit 2</h3>
                <br>
                <a class="btn btn-primary btn-large btn-block" >Bet Now</a>
              </div>
            </div>
        </div>';

        
        echo '<div id="t1name" style="display: none;" value="">'.$row['team1name'].'</div>
            <div id="t1id" style="display: none;" >'.$row['teamid1'].'</div>
            <div id="t2name" style="display: none;" >'.$row['team2name'].' </div>
            <div id="t2id" style="display: none;" value ="'.$row['teamid2'].'">'.$row['teamid2'].' </div>';

for ($x=1; $x< $row['BO']; $x++) { 
  echo '<div class="tab-pane"  id="s'.$x.'">
            <h2>Select your team</h2>
            <h6>Here you are betting on Match '.$x.' of this series.Betting will remain open till the draft finishes  </h6>
            <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-3 col-lg-6">
                        
            <form id="myForm" method ="post">
              <div class="col-xs-12 col-sm-4 col-md-3 col-lg-6">
            <label>
    <input type="radio" name="radioName" value="'.$row['teamid1'].'" />
    <img  align="left"class="img-rounded" data-src="'.$row['teamid1'].'.jpg" src="'.$row['teamid1'].'.jpg" data-holder-rendered="true" style="width: 60px; height: 60px;">
  </label>
</div>
 <div class="col-xs-12 col-sm-4 col-md-3 col-lg-6">
  <label>
    <input type="radio" name="radioName" value="'.$row['teamid2'].'"/>
    <img  align="right"class="img-rounded" data-src="'.$row['teamid1'].'.jpg" src="'.$row['teamid1'].'.jpg" data-holder-rendered="true" style="width: 60px; height: 60px;">
  </label>
</div>
</div>
</div>
  <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
  <br>Potential Reward :<br>
  for '.$row['team1name'].'<br>
  1.4 for 1 <br>
</div>
<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
  <br>Potential Reward :<br>
  for '.$row['team2name'].'<br>
  1.4 for 1 <br>
</div>

            <div class="col-xs-12 col-sm-4 col-md-3 col-lg-6">
  
            <input type="hidden" name = "matchno" value="'.$x.'">


            <p> </p>

            <input type="text" class="form-control login-field" value="" placeholder="userid" id="u" name="u">
  <input type="text" class="form-control login-field"  placeholder="Enter your bet" name="betamt" id="betamt">
  <br>
  Your potential reward
  <br>
  <br>
  <input type="submit" class="btn btn-block btn-lg btn-primary" name="btnSubmit" value="Place Bet"> 
  </form>
</div>

        </div>';

} 



}





  ?>

    </div>
</div>
 
 

<script src="js/vendor/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/flat-ui.min.js"></script>    
<script>
$('input:radio[name=radioName]').click(function() {
  var val = parseInt($('input:radio[name=radioName]:checked').val());
  var t1n = $("#t1name").html();
   var t2n = $("#t2name").html();
   var t1i = parseInt($("#t1id").html()); 
   
   var t2i = parseInt($("#t2id").html()); 


  if (val == t1i) {
    $( "p" ).html( "your selected team is " + t1n );
    console.log("11111");
  } 
  if(val == t2i) {
    console.log("114411");
    $( "p" ).html( "your selected team is " + t2n );
  }

});

$("[name='reset']").click(function () {
    console.log('h');
    $("input:radio[name='radioName']").each(function (i) {
        this.checked = false;
    });
});
//$('#myForm input').on('change', function() {
   
   //alert($('input[name=radioName]:checked', '#myForm').val());
   
//   alert(choice);



 

   
//});
</script>
</div> <!-- container -->
 
 
<script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>
 
</body>
</html>