<?php
    require ('steamauth/steamauth.php');  
    include "conn.php";
        
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Flat UI Free 101 Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Loading Bootstrap -->
    <link href="css/vendor/bootstrap.min.css" rel="stylesheet">

    <!-- Loading Flat UI -->
    <link href="css/flat-ui.css" rel="stylesheet">

    <link rel="shortcut icon" href="img/favicon.ico">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
      <script src="js/vendor/html5shiv.js"></script>
      <script src="js/vendor/respond.min.js"></script>
    <![endif]-->
    <style>
    #profile {
    background-color: #bdc3c7 ;
  }
    </style>
  
  </head>
  <body>
    <!-- navbar
  -->
<div class="container">
  <?php include 'base.html';?>

        <!-- // -->
        <div class="row"> 
<!--           for profile
 -->          <div class="col-xs-12 col-sm-4 col-md-3 col-lg-6">
 <?php
if(!isset($_SESSION['steamid'])) {
    echo '<h4> Your profile </h4><div class="tile" id="profile">';
    echo "welcome guest! please login \n \n";
    steamlogin(); //login button
    echo '</div>';
}  else {
    include ('steamauth/userInfo.php');
    $olduser=$usersObj->checkolduser($_SESSION['steamid']); //returns 1 if old user 0 if new user

if ($olduser==0)
{
  $usersObj->newuser($_SESSION['steamid'],$steamprofile['personaname'] );
}

    //Protected content
    //profile
echo '<h4> Your profile </h4>
              <div class="tile" id="profile">
                  
                <img class="img-circle" data-src="'.$steamprofile['avatarfull'].'" src="'.$steamprofile['avatarfull'].'" data-holder-rendered="true" style="width: 160px;">
                <h4> '. $steamprofile['personaname'] .'</h4>
                You currently have '.$steamprofile['currency_current'].' Keys';


              
    
    logoutbutton();
    echo '</div>';
}    
?>
              
              <div class="alert alert-success" role="alert">you can deposit more keys by going to the tab section </div>
              
            </div>
<!-- for matches -->
            <div class="col-xs-12 col-sm-4 col-md-3 col-lg-6">
              <?php // function for time
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
              ?>
<h4> Matches Today </h4>
              <?php
              $obj= new match();
$betObj=$obj->get_matchdetailsByStatus(0);
foreach($betObj as $row){


echo '
               '.timediff($row['time_start']).'
              <div class="tile">
                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-5" >
                  
                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-6">
                <img  align="left"class="img-rounded" data-src="'.$row['teamid1'].'.jpg" src="'.$row['teamid1'].'.jpg" data-holder-rendered="true" style="width: 60px; height: 60px;">
              </div>
              <div class="col-xs-12 col-sm-4 col-md-3 col-lg-6">
               <p> <b> '.$row['team1name'].'
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
                 <p><b>'.$row['team2name'].'
                <br> 50%
              </b></p>
            </center>
              </div>
                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-6">
                <img align="left" class="img-rounded" data-src="'.$row['teamid2'].'.jpg" src="'.$row['teamid2'].'.jpg" data-holder-rendered="true" style="width: 60px; height: 60px;">
              </div>
              
              </div>
                <h3 class="tile-title">'.$row['tourneyname'].'</h3>
                <br>
                <a class="btn btn-primary btn-large btn-block" >Bet Now</a>
              </div>';
}
?>
              <!-- second -->
              <h6>2 hours remain</h6>
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
          </div> <!-- row ends -->

      </div>
    <!-- /.container -->


    <!-- jQuery (necessary for Flat UI's JavaScript plugins) -->
    <script src="js/vendor/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/flat-ui.min.js"></script>

  </body>
</html>
