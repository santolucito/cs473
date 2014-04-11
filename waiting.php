<?php
    session_start();
    $sleeptime = $_SESSION['sleeptime'];


echo "<html><meta http-equiv=\"refresh\" content=\"".$sleeptime.";URL='game.php'\"> <br>  Waiting for other player's input.... </html>";



?>
