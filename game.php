<?php session_start();
      $email = $_SESSION['email'];
      $username = $_SESSION['username'];
      $u_hash = $_SESSION['u_hash'];
      $u_id = $_SESSION['u_id'];
      $card_arrays = $_SESSION['card_arrays'];
      $_SESSION['maxrounds'] = 9;
      $maxround = $_SESSION['maxrounds']; 

      $startround = 14;

      if($username==''){
              header('Location:signin.php');
      }

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
   $debuginfo = $_SESSION['debug'];
   $clastmove = "drew card";
   $ulastmove = "drew card";
   $uchoice = intval($card_arrays[4][0]);
   $cchoice = intval($card_arrays[5][0]);
   if($card_arrays[5][0] == 1)//draw  //1 = give card //2 = single win
      {
            $ccardgiven = $card_arrays[5][1];
            $clastmove = "gave away card: $ccardgiven!";
      }       
   if($card_arrays[5][0] == 2)//draw  //1 = give card //2 = single win
      {
            
            $clastmove = "took single win!";
      }   
      
   if($uchoice == 1)//draw  //1 = give card //2 = single win
      {
            $ucardgiven = $card_arrays[4][1];
            $ulastmove = "gave away card: $ucardgiven!";
      }       
   if($uchoice == 2)//draw  //1 = give card //2 = single win
      {
            
            $ulastmove = "took single win!";
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
   
   
   //if the 15th and final game has been won (in middle or end)
   if($card_arrays[3][2]>0 && $card_arrays[3][1]==22){
      echo "<h1>You won the game!</h1> <h1>Thank you for participating in the study. You may now logout.</h1>";
      echo "<a class=\"btn btn-default\" href=\"logout.php\" role=\"button\">Logout »</a>";
   }
   
   //if the 15th and final game has been lost (ie reach round==8)
   elseif($card_arrays[3][2]<=0 && $card_arrays[3][1]==22 &&
          $card_arrays[3][0]>=$maxround){

      echo "<h1>You lost the game, too bad!</h1> <h1>Thank you for participating in the study. You may now logout.</h1>";
      echo "<a class=\"btn btn-default\" href=\"logout.php\" role=\"button\">Logout »</a>";
   }


   //if any except final game has been won single win
   elseif($card_arrays[3][2] == 1){

      
      
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
    //  echo "<a class=\"btn btn-default\" href=\"game_call_extern.php?choice=0\" role=\"button\">Give Selected Card »</a> OR ";
    //  echo "<a class=\"btn btn-default\" href=\"game_call_extern.php?choice=1\" role=\"button\">Draw a New Card »</a> OR ";
    //  echo "<a class=\"btn btn-default\" href=\"game_call_extern.php?choice=2\" role=\"button\">Take Single Win »</a> </div>";
      echo "</form>";
      
      
      
      //bit of a hack for now, once we display a win, reset to start anew
      $card_arrays[3][0]=0;
    $_SESSION['card_arrays'] = $card_arrays;

      echo "<h1>You won the game! $debuginfo</h1>";
      echo "<a class=\"btn btn-default\" href=\"game_call_extern.php\" role=\"button\">Start Next Game »</a>";
   }
   
   elseif($card_arrays[3][2] == 2){

      
      
      //the card_arrays is stored in a session variable, set in game_call_extern.php
      echo "<h1> $debuginfo Round:".$card_arrays[3][0]."</h1>";

      echo "<h1>GLaDOS's Cards [Last move: $clastmove]</h1>";
      print_card_subset(0,$card_arrays);


      echo "<form action=\"game_call_extern.php\" method=\"POST\">";

      //user cards act as radio buttons
      echo "<h1>User's Cards [Last move: $ulastmove]</h1>";
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
      $card_arrays[3][0]=0;
    $_SESSION['card_arrays'] = $card_arrays;

      echo "<h1>You and the robot both won the game! $debuginfo</h1>";
      echo "<a class=\"btn btn-default\" href=\"game_call_extern.php\" role=\"button\">Start Next Game »</a>";
   }



   //if any except final game has been lost
   elseif($card_arrays[3][2]<=0 &&
          $card_arrays[3][0]>=($maxround)){
      
      
      
      //the card_arrays is stored in a session variable, set in game_call_extern.php
      echo "<h1> $debuginfo Round:".$card_arrays[3][0]."</h1>";

      echo "<h1>GLaDOS's Cards [Last move: $clastmove]</h1>";
      print_card_subset(0,$card_arrays);


      echo "<form action=\"game_call_extern.php\" method=\"POST\">";

      //user cards act as radio buttons
      echo "<h1>User's Cards [Last move: $ulastmove]</h1>";
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
      
      
      echo "<h1>You lost the game, too bad! $debuginfo</h1>";
      echo "<a class=\"btn btn-default\" href=\"game_call_extern.php\" role=\"button\">Start Next Game »</a>";
   }


   //otherwise we are in the middle of a game  
   else{

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
      echo "<input type=\"submit\" name=\"give\" value=\"Give Selected Card\"/>";
      echo "<input type=\"submit\" name=\"draw\" value=\"Draw a New Card\"/>";
      //only display single win option if availble
      if ($card_arrays[3][2]==(-1)) echo "<input type=\"submit\" name=\"win\" value=\"Take Single Win\"/>";
    //  echo "<a class=\"btn btn-default\" href=\"game_call_extern.php?choice=0\" role=\"button\">Give Selected Card »</a> OR ";
    //  echo "<a class=\"btn btn-default\" href=\"game_call_extern.php?choice=1\" role=\"button\">Draw a New Card »</a> OR ";
    //  echo "<a class=\"btn btn-default\" href=\"game_call_extern.php?choice=2\" role=\"button\">Take Single Win »</a> </div>";
      echo "</form>";
   }
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
    <script src="game.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="offcanvas.js"></script>
  </body>
</html>
