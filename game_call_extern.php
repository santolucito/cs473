<?php 
    session_start();
    $u_id = $_SESSION['u_id'];



    $card_arrays = $_SESSION['card_arrays'];
        // these will hold the json strings for communication between programs
        // if we send an empty string the py script should start a new game
        //the json object (saved in card_arrays) return should always be an array of five int arrays
        // card_arrays has type [[int]]
        // card_arrays[0] is computers cards [#1 card value, #2 card value...] 
                          //(first two will be displayed to user)
        // card_arrays[1] is center card [card value]
        // card_arrays[2] is user cards [#1 card value, #2 card value...]
        // card_arrays[3] is round number [round #, game #] (special values in index 0; (-1) if a win occurs, 0 if new game)
        // card_arrays[4] is user selection [0 - draw or 1 - give or 2 - take single win, (-1) N/A or card value]



    //if a single win occurs, update the win status
    if($card_arrays[4][0]==2){
      $card_arrays[3][0] = -1;
    }
  

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

    //at the beginnning of a new game, create new game record
    if($card_arrays[3][0]==0){
      $current_game = $card_arrays[3][1];
      $created = date("Y-m-d H:i:s");
      $query = "INSERT INTO games (u1_id,number,created) VALUES ('$u_id', '$current_game', '$created')";
      $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
      $current_game_id = $mysqli -> insert_id; 
    }


    //in the middle of a game, save round info
    elseif($card_arrays[3][0]!=0 && $card_arrays[3][0]!=(-1)){
      //send data to game and get next game state   
      //don't use choice if beginning a game
      if($card_arrays[3][0]!=0){
        $card_arrays[4][0] = $_GET["choice"]; 
      }
      $state_send = json_encode($card_arrays);
      $state_receive = shell_exec("python chris_py_script.py ".escapeshellarg($state_send));
      $card_arrays = json_decode($state_receive);
    }


    //at the end of a game, update game record with win info
    elseif($card_arrays[3][0]!=0 && $card_arrays[3][0]==(-1)){
      
      $query = "UPDATE games SET (winner) VALUES 1";
      $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
      



      $next_game_num = $card_arrays[3][1] + 1;
      $card_arrays = array
        (
          array(0),
          array(0),
          array(0),
          array(0,$next_game_num),
          array(0)
        );

    }
    //once are done, move back to the game       
    $_SESSION['card_arrays'] = $card_arrays;
    header('Location:game.php');

?>


