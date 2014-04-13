<?php
    session_start();
    $sleeptime = $_SESSION['sleeptime'];
    $debuginfo = $_SESSION['debug'];

echo "<html><meta http-equiv=\"refresh\" content=\"".$sleeptime.";URL='game.php'\"> <br> $debuginfo .  Waiting for GLaDOS's input.... </html>";



?>
