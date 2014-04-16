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
    $username = $_SESSION['username'];
    

///////////////////
//               //
// MYSQL CONNECT //
//               //
///////////////////


    //before moving to the next round, save all info to the database
    // CONNECT TO THE DATABASE
    $DB_NAME = 'santolucito_robotics';
    $DB_HOST = 'robotics.caekmtcgrlzr.us-east-1.rds.amazonaws.com';
    $DB_USER = 'chris';
    $DB_PASS = 'klumpp2014';
    

    $mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

    if (mysqli_connect_errno()) {
      printf("Connect failed: %s\n", mysqli_connect_error());
      exit();
    }
    // END CONNECT TO DATABASE, THIS NEEDS TO BE HERE


      echo "<br/>";
      //the card_arrays is stored in a session variable, set in game_call_extern.php
      echo "<h1> High scores table</h1>";

      echo "
    <table class=\"table\">
      <thead>
        <tr>
          <th>Username</th>
          <th>Total Wins</th>
          <th>Single Wins</th>
          <th>Team Wins</th>
        </tr>
      </thead>
      <tbody>";


//  caluculate number of wins
   $query1 = "SELECT username from users ORDER BY u_id ASC";
   $result1 = $mysqli->query($query1) or die($mysqli->error.__LINE__);
   
   while($row1 = $result1->fetch_assoc()){
      $user = $row1['username'];

      $single_wins = 0;
      $team_wins = 0;

      $query = "SELECT u_id from users WHERE username='$user'";
      $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
      $row = $result->fetch_assoc();
      $u_id = $row['u_id'];

      $query = "SELECT winner from games WHERE u1_id='$u_id'";
      $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
      while($row = $result->fetch_assoc()){
        if($row['winner']==1)
          $single_wins += 1;
        if($row['winner']==2)
          $team_wins += 1;
      }

      $total_wins = $single_wins + $team_wins;


      echo "
        <tr>
          <td>".$user."</td>
          <td>".$total_wins."</td>
          <td>".$single_wins."</td>
          <td>".$team_wins."</td>
        </tr>";
   }

echo "
      </tbody>
    </table> ";

/*
socket_listen($sock);
$client = socket_accept($sock);

$input = socket_read($client, 1024);

socket_close($client);

socket_close($sock);
*/

?>
 </div><!--/row-->

<hr>

<footer>
<p>&copy; ScazLab Robotics 2014</p>
</footer>

</div><!--/span-->
</div><!--/.container-->



<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="game.js"></script>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="bootstrap/dist/js/bootstrap.min.js"></script>
<script src="offcanvas.js"></script>
</body>
</html>
