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
echo "<html><meta http-equiv=\"refresh\" content=\"".$sleeptime.";URL='game.php'\"> <br> $debuginfo .  Waiting for GLaDOS's input.... </html>";
/*
socket_listen($sock);
$client = socket_accept($sock);

$input = socket_read($client, 1024);

socket_close($client);

socket_close($sock);
*/

?>
