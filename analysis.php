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
      echo "<h1> Analysis Page!</h1>";

      echo "
    <table class=\"table\">
      <thead>
        <tr>
          <th>Username</th>
          <th>Rounds S-win Taken</th>
        </tr>
      </thead>
      <tbody>";


//  caluculate number of wins

// NB: pay attention to a variables overwriting other vars, use different/descriptive names!!!

   $query_users = "SELECT username, u_id from users ORDER BY created DESC";
   $result_users = $mysqli->query($query_users) or die($mysqli->error.__LINE__);

   $all_team_all_users = array();
   $num_total_users = 0; 
  
   while($row_users = $result_users->fetch_assoc()){
      $user = $row_users['username'];
      $u_id = $row_users['u_id'];
      $num_total_users += 1;

      $single_wins = 0;
      $team_wins = 0;
      $all_team_behaviors = array();
      $all_gives_per_user = array();
      $norm_gives_per_user = array();
      $all_passes_per_user = array();

      $query_games = "SELECT winner, total_rounds, number, game_id from games WHERE u1_id='$u_id'";
      $result_games = $mysqli->query($query_games) or die($mysqli->error.__LINE__);
      while($row_games = $result_games->fetch_assoc()){

        $game_id = $row_games['game_id'];
        
        $num_gives = 0;
        $num_passes = 0;
        $total_rounds_check = 0;

        $query_rounds = "SELECT u_choice, round_num from rounds WHERE game_id='$game_id'";
        $result_rounds = $mysqli->query($query_rounds) or die($mysqli->error.__LINE__);

        //go through all the rounds and collect instances of giving a card
        while($row_rounds = $result_rounds->fetch_assoc()){
          if($row_rounds['u_choice']==1){//gave card
            $num_gives += 1;
          }
          $total_rounds_check += 1;
        }
        
        //collect instances of passing up a single win
        //NB: not elseif here
        if($row_games['winner']==1){
          if($row_games['total_rounds']>=6) $num_passes += 1;
          if($row_games['total_rounds']>=8) $num_passes += 1;
        }
        
        
        $all_gives_per_user[] = $num_gives;
        $all_passes_per_user[] = $num_passes;
 
        //normalizt gives according to number of rounds 
        // that the specific user played in that game
        $total_rounds_per_game = $row_games['total_rounds'];

        //we have a bug in data collection,
        //the 15th (final) game does not save the number of total rounds played
        //we use total_rounds_check for the 15th round in place of data base info
        if($row_games['number']==15) $total_rounds_per_game = $total_rounds_check;

        $norm_gives_per_user[] = $num_gives/$total_rounds_per_game;        
      }


      $all_gives_all_users[] = $all_gives_per_user;
      $all_passes_all_users[] = $all_passes_per_user;

      $norm_gives_all_users[] = $norm_gives_per_user;

      echo "
        <tr>
          <td>".$user."</td>
          <td>";//foreach($all_team_per_user as $g) {echo $g.";";}
          echo"</td>
        </tr>";
   }

   //all_gives_all_users :: [[int]]

   //[int] -> [int]
   $sum_elems = function($xs,$ys){
      $sum = function($x,$y){ return $x + $y; };
      return array_map($sum,$xs,$ys); 
   };


   //TODO number of users is hard coded right now! omg!! terrible
   //cant seem to find a simple solution to this
   // somthing is strange with the scoping of num_total_users that 
   // wont let me in the avg_users function
   $avg_users = function($x) { return $x/11; };
   $empty_a = array();
   $all_give_compiled =  array_map($avg_users,array_reduce($all_gives_all_users,$sum_elems,$empty_a));
   $norm_give_compiled =  array_map($avg_users,array_reduce($norm_gives_all_users,$sum_elems,$empty_a));

   $all_pass_compiled =  array_map($avg_users,array_reduce($all_passes_all_users,$sum_elems,$empty_a));

   echo "
      </tbody>
    </table> ";

   echo "<h2>  avg # of passes per game vs game # </h2>";
   foreach($all_pass_compiled as $t) {echo $t."<br/>";}
   //compiled_give_data should be normalized so that it is avg # of gives per rounds played in a game
   //right now it is just total gives in game,some games last more rounds tho

   echo "<h2> avg # of gives per round vs game # </h2>";
   foreach($norm_give_compiled as $t) {echo $t."<br/>";}
//   foreach($compiled_give_data as $t) {echo $t.",";}



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
