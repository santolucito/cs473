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
    session_start();
    $sleeptime = $_SESSION['sleeptime'];
    $debuginfo = $_SESSION['debug'];
    $card_arrays = $_SESSION['card_arrays'];
    $ucardgiven = $_SESSION['ucardgiven'];
   $ccardgiven = $_SESSION['ccardgiven'];
      $ulastmove =   $_SESSION['ulastmove'] ;
      $clastmove = $_SESSION['clastmove'];
    if($card_arrays[3][0] == 1)
   {
      $ulastmove = "none";
      $clastmove = "none";
      $ccardgiven = "";
      $ucardgiven = "";
   }
    
    /*
    function tcp_send($wait){
$delayfactor = 5;

$mysocket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
socket_connect($mysocket, "caliper.cs.yale.edu", 6667);

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
socket_close($mysocket);
    }
    
$sleeptime = 0;
$debuginfo = "";
$address = "0";// 'caliper.cs.yale.edu';
$port = 6667;

tcp_send(0);

*/
/*
$sock = socket_create(AF_INET, SOCK_STREAM, 0); //not sure what the 0 does.
socket_bind($sock, $address, $port) or die('Could not bind to address');
*/  

      //the card_arrays is stored in a session variable, set in game_call_extern.php
      echo "<h1> $debuginfo Round:".$card_arrays[3][0]."</h1>";

      echo "<h1>GLaDOS's Cards [Last move: $clastmove]</h1>";
      print_card_subset(0,$card_arrays);

      echo "<h1> center card</h1>";
      print_card_subset(1,$card_arrays);

      echo "<form action=\"game_call_extern.php\" method=\"POST\">";

      //user cards act as radio buttons
      echo "<h1>User's Cards [Last move: $ulastmove]</h1>";
      print_card_subset(2,$card_arrays);

      echo "<br><br>";
      //echo "<input type=\"submit\" name=\"give\" value=\"Give Selected Card\"/>";
      //echo "<input type=\"submit\" name=\"draw\" value=\"Draw a New Card\"/>";
      //only display single win option if availble
     // if ($card_arrays[3][2]==(-1)) echo "<input type=\"submit\" name=\"win\" value=\"Take Single Win\"/>";
    // echo "<a class=\"btn btn-default\" href=\"game_call_extern.php?choice=0\" role=\"button\">Give Selected Card »</a> OR ";
    // echo "<a class=\"btn btn-default\" href=\"game_call_extern.php?choice=1\" role=\"button\">Draw a New Card »</a> OR ";
    // echo "<a class=\"btn btn-default\" href=\"game_call_extern.php?choice=2\" role=\"button\">Take Single Win »</a> </div>";
      echo "</form>";


echo "<html><meta http-equiv=\"refresh\" content=\"".$sleeptime.";URL='game.php'\"> <br> $debuginfo .  Waiting for or processing GLaDOS's input.... </html>";
/*
socket_listen($sock);
$client = socket_accept($sock);

$input = socket_read($client, 1024);

socket_close($client);

socket_close($sock);
*/

?>
