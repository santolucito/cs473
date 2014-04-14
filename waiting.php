<?php
    session_start();
    $sleeptime = $_SESSION['sleeptime'];
    $debuginfo = $_SESSION['debug'];
    
    
    
$sleeptime = 0;
$debuginfo = "";
$address = 'caliper.cs.yale.edu';
$port = 6667;

$sock = socket_create(AF_INET, SOCK_STREAM, 0); //not sure what the 0 does.
socket_bind($sock, $address, $port) or die('Could not bind to address');

echo "<html><meta http-equiv=\"refresh\" content=\"".$sleeptime.";URL='game.php'\"> <br> $debuginfo .  Waiting for GLaDOS's input.... </html>";

socket_listen($sock);
$client = socket_accept($sock);

$input = socket_read($client, 1024);

socket_close($client);

socket_close($sock);


?>
