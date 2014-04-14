<?php
    session_start();
    $sleeptime = $_SESSION['sleeptime'];
    $debuginfo = $_SESSION['debug'];
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


echo "<html><meta http-equiv=\"refresh\" content=\"".$sleeptime.";URL='game.php'\"> <br> $debuginfo .  Waiting for GLaDOS's input.... </html>";
/*
socket_listen($sock);
$client = socket_accept($sock);

$input = socket_read($client, 1024);

socket_close($client);

socket_close($sock);
*/

?>
