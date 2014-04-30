<?php session_start();
      $email = $_SESSION['email'];
      $username = $_SESSION['username'];
      $u_hash = $_SESSION['u_hash'];
      $u_id = $_SESSION['u_id'];
      $card_arrays = $_SESSION['card_arrays'];
      $_SESSION['maxrounds'] = 9;
      $maxround = $_SESSION['maxrounds']; 
      $_SESSION['tcp3extra'] = 0;
      $_SESSION['nodelay'] = 0;
      

      if($username==''){
              header('Location:signin.php');
      }

?>

<?php

//if($card_arrays[3][0] != 1)
//{
//$sleeptime = 0;
$debuginfo = "";
$address = "caliper.cs.yale.edu";// 'caliper.cs.yale.edu';
$port = 6667;

//tcp_send(0);

$sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);//$_SESSION['socket'];
socket_connect($sock, "caliper.cs.yale.edu", 6667);

$strwork = "\n\n\na\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\na\n\n\n\n";//str for sending a tcp test msg

socket_write($sock, $strwork, 28);

//socket_bind($sock, $address, $port) or die('Could not bind to address');
//}
//if($card_arrays[3][0] == 1)
//{
//socket_listen($sock);
//$client = socket_accept($sock);
$torecv;
$datareceive =  socket_recv($sock , $torecv , 28 , 0);
//$input = socket_read($client, 1024);

//socket_close($client);
$_SESSION['starttcp'] = 0;
socket_close($sock);
//}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="bootstrap/docs-assets/ico/favicon.png">

    <title>Robotics</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="offcanvas.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>

            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Robotics</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Game</a></li>
            <li><a href="#"><?php echo $username?></a></li>
          </ul>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </div><!-- /.navbar -->
    <div class="container">

      <div class="row row-offcanvas row-offcanvas-right">

          <div class="row">


<?php 

   include 'game_player.php';
   
   function tcp_send($wait){
$delayfactor = $_SESSION['delayfactor'];

if($_SESSION['starttcp'] != 1)
{
$_SESSION['socket'] = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
$mysocket = $_SESSION['socket'];
socket_connect($mysocket, "caliper.cs.yale.edu", 6667);
$_SESSION['starttcp'] = 1;
}

$strwork = "\n\n\na\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\na";
if($wait == 0)
{
$strwork = "\n\n\na\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\na";
}
else if($wait == (1* $delayfactor))
{
$strwork = "\n\n\na\n\n\na\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\na";
}
else if($wait == (2* $delayfactor))
{
$strwork = "\n\n\na\n\n\na\n\n\na\n\n\n\n\n\n\n\n\n\n\n\n\n\n\na";
}
else if ($wait == (3* $delayfactor))
{
$strwork = "\n\n\na\n\n\na\n\n\na\n\n\na\n\n\n\n\n\n\n\n\n\n\na";
}

socket_write($mysocket, $strwork, 28);


$_SESSION['starttcp'] = 0;
socket_close($mysocket);
    }
    
   //signal for looking at person
    function tcp_send2($wait){
$_SESSION['tcp2extra'] = 2;

//$delayfactor = 5;
$delayfactor = $_SESSION['delayfactor'];

if($_SESSION['starttcp'] != 1)
{
$_SESSION['socket'] = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
$mysocket = $_SESSION['socket'];
socket_connect($mysocket, "caliper.cs.yale.edu", 6667);
$_SESSION['starttcp'] = 1;
}

$strwork = "\n\n\na\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n";
if($wait == 0)
{
$strwork = "\n\n\na\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n";
}
else if($wait == (1* $delayfactor))
{
$strwork = "\n\n\na\n\n\na\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n";
}
else if($wait == (2* $delayfactor))
{
$strwork = "\n\n\na\n\n\na\n\n\na\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n";
}
else if ($wait == (3* $delayfactor))
{
$strwork = "\n\n\na\n\n\na\n\n\na\n\n\na\n\n\n\n\n\n\n\n\n\n\n\n";
}
$_SESSION['starttcp'] = 0;
socket_write($mysocket, $strwork, 28);

socket_close($mysocket);
    }
   
   
   //NOTE: MAKE SURE THAT FOR THE BELOW TCP COMMANDS, YOU DON'T CALL 2 IN THE SAME ROUND! TIMING ERROR AND WILL TAKE FOREVER ANYWAY( not really true anymore..
   
      //cheer
    function tcp_send3($wait){
$_SESSION['tcp3extra'] += 9; //8 seconds of sleep inside the function so maybe 9 total so one extra, haven't tested timing.

//$delayfactor = 5;
$delayfactor = $_SESSION['delayfactor'];

if($_SESSION['starttcp'] != 1)
{
$_SESSION['socket'] = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
$mysocket = $_SESSION['socket'];
socket_connect($mysocket, "caliper.cs.yale.edu", 6667);
$_SESSION['starttcp'] = 1;
}

$strwork = "\n\n\na\n\n\n\n\n\n\n\n\n\n\n\n\n\n\na\n\n\n\n\n\n\n\n";

$_SESSION['starttcp'] = 0;
socket_write($mysocket, $strwork, 28);

socket_close($mysocket);
    }
   
     //single win
    function tcp_send4($wait){
$_SESSION['tcp3extra'] += 11; //has 10 seconds of sleeping

//$delayfactor = 5;
$delayfactor = $_SESSION['delayfactor'];

if($_SESSION['starttcp'] != 1)
{
$_SESSION['socket'] = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
$mysocket = $_SESSION['socket'];
socket_connect($mysocket, "caliper.cs.yale.edu", 6667);
$_SESSION['starttcp'] = 1;
}

$strwork = "\n\n\na\n\n\na\n\n\n\n\n\n\n\n\n\n\na\n\n\n\n\n\n\n\n";

$_SESSION['starttcp'] = 0;
socket_write($mysocket, $strwork, 28);

socket_close($mysocket);
    }
   
   
     //give card
    function tcp_send5($wait){
$_SESSION['tcp3extra'] += 5; //has 4 seconds of sleeping

//$delayfactor = 5;
$delayfactor = $_SESSION['delayfactor'];

if($_SESSION['starttcp'] != 1)
{
$_SESSION['socket'] = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
$mysocket = $_SESSION['socket'];
socket_connect($mysocket, "caliper.cs.yale.edu", 6667);
$_SESSION['starttcp'] = 1;
}

$strwork = "\n\n\na\n\n\n\n\n\n\na\n\n\n\n\n\n\na\n\n\n\n\n\n\n\n";

$_SESSION['starttcp'] = 0;
socket_write($mysocket, $strwork, 28);

socket_close($mysocket);
    }
   
    
     //pick up sign
    function tcp_send6($wait){
$_SESSION['tcp3extra'] += 13; //has 12 seconds of sleeping

//$delayfactor = 5;
$delayfactor = $_SESSION['delayfactor'];

if($_SESSION['starttcp'] != 1)
{
$_SESSION['socket'] = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
$mysocket = $_SESSION['socket'];
socket_connect($mysocket, "caliper.cs.yale.edu", 6667);
$_SESSION['starttcp'] = 1;
}

$strwork = "\n\n\n\n\n\n\n\n\n\n\na\n\n\n\n\n\n\na\n\n\n\n\n\n\n\n";

$_SESSION['starttcp'] = 0;
socket_write($mysocket, $strwork, 28);

socket_close($mysocket);
    }
   
   
   
   
   
   
   
   
   
   
   
   
   
    $delayfactor = $_SESSION['delayfactor'];
    $nextdelay = rand(0,1);
    $nextdelay = ($nextdelay * $delayfactor) + $delayfactor;
    
   $debuginfo = $_SESSION['debug'];
   $debuginfo = "";
   $clastmove = "drew card";
      $clastmove = "<div style=\"color:blue\">".$clastmove."</div>";
   $ulastmove = "drew card";
      $ulastmove = "<div style=\"color:blue\">".$ulastmove."</div>";
    $ccardgiven = "";
      $ucardgiven = "";
   $uchoice = intval($card_arrays[4][0]);
   $cchoice = intval($card_arrays[5][0]);
   
   
   if($card_arrays[5][0] == 1)//draw  //1 = give card //2 = single win
      {
            $ccardgiven = $card_arrays[5][1];
            $clastmove = "donated card: $ccardgiven!";
            $clastmove = "<div style=\"color:green\">".$clastmove."</div>";
      }       
   if($card_arrays[5][0] == 2)//draw  //1 = give card //2 = single win
      {
            
            $clastmove = "took single win!";
            $clastmove = "<div style=\"color:red\">".$clastmove."</div>";
      }   
      
   if($uchoice == 1)//draw  //1 = give card //2 = single win
      {
            $ucardgiven = $card_arrays[4][1];
            $ulastmove = "donated card: $ucardgiven!";
            $ulastmove = "<div style=\"color:green\">".$ulastmove."</div>";
      }       
   if($uchoice == 2)//draw  //1 = give card //2 = single win
      {
            
            $ulastmove = "took single win!";
            $ulastmove = "<div style=\"color:red\">".$ulastmove."</div>";
      }
      //$debuginfo = $uchoice;
   if($card_arrays[3][0] == 1)
   {
      $ulastmove = "none";
      $clastmove = "none";
     
   }
   if($card_arrays[5][0] == 1 && $card_arrays[4][0] == 1 && intval($card_arrays[5][1]) == intval($card_arrays[4][1]))
   {
      $ulastmove = "Tried to exchange same card as other player: $ccardgiven, will have both players draw so turn isn't wasted";
      $clastmove = "Tried to exchange same card as other player: $ucardgiven, will have both players draw so turn isn't wasted";
   
   
   }
   
   $_SESSION['ucardgiven'] = $ucardgiven;
   $_SESSION['ccardgiven'] = $ccardgiven;
//<<<<<<< HEAD
   $_SESSION['ulastmove'] = $ulastmove; 
   $_SESSION['clastmove'] = $clastmove;
 
// draw - blue
// give - green
// single win - red



 
  $max_games = 16; 
//=======
        $_SESSION['ulastmove'] = $ulastmove; 
       $_SESSION['clastmove'] = $clastmove;
  
  //$max_games = 20; 
  
  
//>>>>>>> 69a45e933aa14ad627dab2b682a867edc86dd82f
   
   //if the 15th and final game has been won (in middle or end)

   if($card_arrays[3][2]==2 && $card_arrays[3][1]==$max_games){

   //if($card_arrays[3][2]==2 && $card_arrays[3][1]==19){
//>>>>>>> 9fc7a82600aaaa9bae8a16c9d653c4f3484d43bd
      tcp_send3(0);

      echo "<h1>Both you and GLaDOS got a win in this final set!</h1> <h1>Thank you for participating in the study. You may now logout and view high scores.</h1>";
      echo "<a class=\"btn btn-default\" href=\"highscores.php\" role=\"button\">View highscores »</a>";
   }
   
   //if the 15th and final game has been won (in middle or end)

   if($card_arrays[3][2]>0 && $card_arrays[3][1]==$max_games){

//   if($card_arrays[3][2]>0 && $card_arrays[3][1]==19){
//>>>>>>> 9fc7a82600aaaa9bae8a16c9d653c4f3484d43bd
      tcp_send2(0);


      echo "<h1>You won this final set!</h1> <h1>Thank you for participating in the study. You may now logout and view highscores.</h1>";
      echo "<a class=\"btn btn-default\" href=\"highscores.php\" role=\"button\">View highscores  »</a>";
   }
   
   //if the 15th and final game has been lost (ie reach round==8)
   elseif($card_arrays[3][2]<=0 && $card_arrays[3][1]==$max_games &&

//   elseif($card_arrays[3][2]<=0 && $card_arrays[3][1]==19 &&
//>>>>>>> 9fc7a82600aaaa9bae8a16c9d653c4f3484d43bd
          $card_arrays[3][0]>=$maxround){

      echo "<h1>Neither you nor GLaDOS obtained a win this set!</h1> <h1>Thank you for participating in the study. You may now logout.</h1>";
      echo "<a class=\"btn btn-default\" href=\"logout.php\" role=\"button\">Send finished signal and logout  »</a>";
   }


   //if any except final game has been won single win
   elseif($card_arrays[3][2] == 1){
     
      
      
      
if($card_arrays[3][1] == 12)
{
      tcp_send6(0);
}
else
{
tcp_send2(0); 
}
      //the card_arrays is stored in a session variable, set in game_call_extern.php
      //echo "<h1> $debuginfo Round:".$card_arrays[3][0]."/8</h1>";
      echo "<h1> $debuginfo Game:".($card_arrays[3][1]-1)."/14</h1>";

      echo "<h1>GLaDOS's Cards <br/> Last move: $clastmove<div id=\"robot_checkmark\" style=\"visibility:hidden\"><img src=\"check.png\" alt=\"check\" height=\"50\" width=\"50\"></div></h1>";
      print_card_subset(0,$card_arrays);

      echo "<h1> center card</h1>";
      print_card_subset(1,$card_arrays);

      echo "<form action=\"game_call_extern.php\" method=\"POST\">";

      //user cards act as radio buttons
      echo "<h1>User's Cards <br/> Last move: $ulastmove<div style=\"visibility:hidden\"><img src=\"check.png\" alt=\"check\" height=\"50\" width=\"50\"></div></h1>";
      print_card_subset(2,$card_arrays);

      echo "<br><br>";
      //echo "<input type=\"submit\" name=\"give\" value=\"Give Selected Card\"/>";
      //echo "<input type=\"submit\" name=\"draw\" value=\"Draw a New Card\"/>";
      //only display single win option if availble
     // if ($card_arrays[3][2]==(-1)) echo "<input type=\"submit\" name=\"win\" value=\"Take Single Win\"/>";
    //  echo "<a class=\"btn btn-default\" href=\"game_call_extern.php?choice=0\" role=\"button\">Give Selected Card »</a> OR ";
    //  echo "<a class=\"btn btn-default\" href=\"game_call_extern.php?choice=1\" role=\"button\">Draw a New Card »</a> OR ";
    //  echo "<a class=\"btn btn-default\" href=\"game_call_extern.php?choice=2\" role=\"button\">Take Single Win »</a> </div>";
      echo "</form>";
      
      
      
      //bit of a hack for now, once we display a win, reset to start anew
      //$card_arrays[3][0]=0; //Fuck you mark.
    //$_SESSION['card_arrays'] = $card_arrays;

      echo "<h1>You got a win this set! $debuginfo</h1>";
      echo "<a class=\"btn btn-default\" href=\"game_call_extern.php\" role=\"button\">Ready for next game »</a>";
   }
   
   elseif($card_arrays[3][2] == 2){

      $_SESSION['teamwincounter'] += 1;
      if($card_arrays[3][1] == 12)
      {
            tcp_send6(0);
      }
      
      else if($_SESSION['teamwincounter'] > 1)
      {
            //tcp_send6(0);
            tcp_send(3);
            $_SESSION['teamwincounter'] = 0;
      }
      else 
      {
            tcp_send3(0);
            //tcp_send2(0); 
      }
      
      

      
      //the card_arrays is stored in a session variable, set in game_call_extern.php
      //echo "<h1> $debuginfo Round:".$card_arrays[3][0]."/8</h1>";
      echo "<h1> $debuginfo Game:".($card_arrays[3][1]-1)."/14</h1>";

      echo "<h1>GLaDOS's Cards <br/> Last move: $clastmove<div  id=\"robot_checkmark\" style=\"visibility:hidden\"><img src=\"check.png\" alt=\"check\" height=\"50\" width=\"50\"></div></h1>";
      print_card_subset(0,$card_arrays);


      echo "<form action=\"game_call_extern.php\" method=\"POST\">";

      //user cards act as radio buttons
      echo "<h1>User's Cards <br/> Last move: $ulastmove<div style=\"visibility:hidden\"><img src=\"check.png\" alt=\"check\" height=\"50\" width=\"50\"></div></h1>";
      print_card_subset(2,$card_arrays);

      echo "<br><br>";
      //echo "<input type=\"submit\" name=\"give\" value=\"Give Selected Card\"/>";
      //echo "<input type=\"submit\" name=\"draw\" value=\"Draw a New Card\"/>";
      //only display single win option if availble
     // if ($card_arrays[3][2]==(-1)) echo "<input type=\"submit\" name=\"win\" value=\"Take Single Win\"/>";
    //  echo "<a class=\"btn btn-default\" href=\"game_call_extern.php?choice=0\" role=\"button\">Give Selected Card »</a> OR ";
    //  echo "<a class=\"btn btn-default\" href=\"game_call_extern.php?choice=1\" role=\"button\">Draw a New Card »</a> OR ";
    //  echo "<a class=\"btn btn-default\" href=\"game_call_extern.php?choice=2\" role=\"button\">Take Single Win »</a> </div>";
      echo "</form>";
      
      
      
      //bit of a hack for now, once we display a win, reset to start anew
      //$card_arrays[3][0]=0; seriously fuck you mark
    //$_SESSION['card_arrays'] = $card_arrays;

      echo "<h1>You and GLaDOS both got a win this set! $debuginfo</h1>";
      echo "<a class=\"btn btn-default\" href=\"game_call_extern.php\" role=\"button\">Ready for next game »</a>";
   }



   //if any except final game has been lost
   elseif($card_arrays[3][2]<=0 &&
          $card_arrays[3][0]>=($maxround)){
      
      tcp_send2(0);
      
      
if($card_arrays[3][1] == 12)
{
      tcp_send6(0);
}
      
      //the card_arrays is stored in a session variable, set in game_call_extern.php
      //echo "<h1> $debuginfo Round:".$card_arrays[3][0]."</h1>";
      echo "<h1> $debuginfo Game:".($card_arrays[3][1]-1)."/14</h1>";

      echo "<h1>GLaDOS's Cards <br/> Last move: $clastmove<div id=\"robot_checkmark\" style=\"visibility:hidden\"><img src=\"check.png\" alt=\"check\" height=\"50\" width=\"50\"></div></h1>";
      print_card_subset(0,$card_arrays);


      echo "<form action=\"game_call_extern.php\" method=\"POST\">";

      //user cards act as radio buttons
      echo "<h1>User's Cards <br/> Last move: $ulastmove<div style=\"visibility:hidden\"><img src=\"check.png\" alt=\"check\" height=\"50\" width=\"50\"></div></h1>";
      print_card_subset(2,$card_arrays);

      echo "<br><br>";
      //echo "<input type=\"submit\" name=\"give\" value=\"Give Selected Card\"/>";
     // echo "<input type=\"submit\" name=\"draw\" value=\"Draw a New Card\"/>";
      //only display single win option if availble
     // if ($card_arrays[3][2]==(-1)) echo "<input type=\"submit\" name=\"win\" value=\"Take Single Win\"/>";
    //  echo "<a class=\"btn btn-default\" href=\"game_call_extern.php?choice=0\" role=\"button\">Give Selected Card »</a> OR ";
    //  echo "<a class=\"btn btn-default\" href=\"game_call_extern.php?choice=1\" role=\"button\">Draw a New Card »</a> OR ";
    //  echo "<a class=\"btn btn-default\" href=\"game_call_extern.php?choice=2\" role=\"button\">Take Single Win »</a> </div>";
      echo "</form>";
      
      
      echo "<h1>Unfortunately, neither you nor GLaDOS got a win this set. $debuginfo</h1>";
      echo "<a class=\"btn btn-default\" href=\"game_call_extern.php\" role=\"button\">Ready for next game »</a>";
   }


   //otherwise we are in the middle of a game  
   else{


      //$robotextra = 0;
  //detect if robot has single win this round.
  if($card_arrays[0][0] == $card_arrays[0][1] && $card_arrays[0][0] == $card_arrays[1][0])
  {
        //$robotextra = 1;
        tcp_send4(0);
  }
  
  //detect if robot gave card last round. Don't do it if we are in losing team win state though...
<<<<<<< HEAD
  else if( $card_arrays[5][0] == 1)
=======
  else if($card_arrays[5][0] == 1)
>>>>>>> 4effb45068e3c05f1a9e89a787c12576b48b8259
  {
        //$robotextra = 2;
        tcp_send5(0);
  }

            tcp_send($nextdelay); 


      //the card_arrays is stored in a session variable, set in game_call_extern.php
      echo "<h1> $debuginfo Round:".$card_arrays[3][0]."/8</h1>";
      echo "<h1> $debuginfo Game:".($card_arrays[3][1]-1)."/14</h1>";

      echo "<h1>GLaDOS's Cards <br/> Last move: $clastmove<div id=\"robot_checkmark\" style=\"visibility:hidden\"><img src=\"check.png\" alt=\"check\" height=\"50\" width=\"50\"></div></h1>";
      print_card_subset(0,$card_arrays);

      echo "<h1> center card</h1>";
      print_card_subset(1,$card_arrays);

      echo "<form action=\"game_call_extern.php\" method=\"POST\">";

      //user cards act as radio buttons
      echo "<h1>User's Cards <br/> Last move: $ulastmove<div  id=\"robot_checkmark\" style=\"visibility:hidden\"><img src=\"check.png\" alt=\"check\" height=\"50\" width=\"50\"></div></h1>";
      print_card_subset(2,$card_arrays);

      echo "<br><br>";

//      echo "<div id=\"buttons\" style=\"visibility:hidden\">";
      if(count($card_arrays[2]) > 0)
      {
     echo "<input type=\"submit\" name=\"give\" value=\"Give Selected Card\"/>";
      }
      echo "<input type=\"submit\" name=\"draw\" value=\"Draw a New Card\"/>";
      //only display single win option if availble
      if ($card_arrays[3][2]==(-1)) echo "<input type=\"submit\" name=\"win\" value=\"Take Single Win\"/>";
//      echo "</div>";
      echo "</form>";

    //  echo "<a class=\"btn btn-default\" href=\"game_call_extern.php?choice=0\" role=\"button\">Give Selected Card »</a> OR ";
    //  echo "<a class=\"btn btn-default\" href=\"game_call_extern.php?choice=1\" role=\"button\">Draw a New Card »</a> OR ";
    //  echo "<a class=\"btn btn-default\" href=\"game_call_extern.php?choice=2\" role=\"button\">Take Single Win »</a> </div>";
   }
   
   $timer_value =  $nextdelay + 2 + $_SESSION['tcp3extra'];//$_SESSION['sleeptime'] + $_SESSION['tcp2extra'];
   if($_SESSION['nodelay'] == 1)
   {
      $timer_value = 0;
   }
   $_SESSION['newtimer'] = $timer_value;
   $_SESSION['gameloadtime'] = time();
   //this is for the javascript checkmark timer
   echo "<div id=\"timer_value\" style=\"visibility:hidden\">".$timer_value."</div>";
   
   
   
?>
          </div><!--/row-->
        </div><!--/span-->

      <hr>

      <footer>
        <p>&copy; ScazLab Robotics 2014</p>
      </footer>

    </div><!--/.container-->



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="offcanvas.js"></script>
    <script src="game.js"></script>
  </body>
</html>
