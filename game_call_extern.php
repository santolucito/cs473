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
        // card_arrays[3] is round number [round #, game #,win_state] 
              // (special values in index 0; 0 if new game)
              // (special values in index 2; -1 single win is availble, 0 normal, 1 single win taken, 2 team win taken)
        // card_arrays[4] is user selection [1,3] user gives card 3
                 //[0 - draw or 1 - give or 2 - take single win, (-1) N/A or card value]

     function tcp_send($wait){
   
     ///////////////////////
     //                   //
     //   JUNAID DO THIS  //
     //                   //
     ///////////////////////

 
      $client = stream_socket_client("tcp://caliper.cs.yale.edu:6667", $errno, $errorMessage);
      
      //signal for press button
      if($client === false){
         throw new UnexpectedValueException("fail: $errorMessage");
         //echo "<html><meta http-equiv=\"refresh\" content=\"1;URL='game.php'\"> <br> Error could not send msg </html>";
      }
   
      //fwrite($client, "abcdefghijklmnopqrstuvwxyzab");
      //fwrite($client, "\n");
      //fwrite($client, "\n\n\na\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\na");
     
     	$tosend = "";
	$tosend = $tosend . chr(0x23) . chr($wait) . chr(109) . chr(109) . chr(0x0) . chr(0x0) . chr(0x23);
	
	echo($tosend);
	fwrite($client, $tosend);
      //echo stream_get_contents($client);
      fclose($client);
	
     

    //waiting for the robot to actually move happens in the last line of this file
    //we redirect to a wating page
    //ideally we would wait to recieve a tcp from robot that action was completed
    //and then move one, but...
    //lets be real, that aint happening  

    } 
    
   //signal for looking at person
    function tcp_send2($wait){
   
     ///////////////////////
     //                   //
     //   JUNAID DO THIS  //
     //                   //
     ///////////////////////

	$mysocket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
	socket_connect($mysocket, "caliper.cs.yale.edu", 6667);
	$mystring = chr(1) . chr(1) . chr(1) . chr(23)  .     //1
	chr(0) . chr(0) . chr(0) . chr($wait)   .    //2
	chr(0) . chr(0) . chr(0) . chr(0)    .   //3
	chr(0) . chr(0) . chr(0) . chr(0)    .   //4
	chr(0) . chr(0) . chr(0) . chr(0)    .   //5
	chr(0) . chr(0) . chr(0) . chr(0)    .   //6
	chr(0) . chr(0) . chr(0) . chr(23)  ;   //7
	
	$data = pack("v", 0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF);
	$strwork = "a\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\na";
 	socket_write($mysocket, $data, 28);
 	socket_close($mysocket);                                                     
 	echo(strlen($data));
 
 /*
      $client = stream_socket_client("tcp://caliper.cs.yale.edu:6667", $errno, $errorMessage);
      
      if($client === false){
         throw new UnexpectedValueException("fail: $errorMessage");
         //echo "<html><meta http-equiv=\"refresh\" content=\"1;URL='game.php'\"> <br> Error could not send msg </html>";
      }
   
      //fwrite($client, "abcdefghijklmnopqrstuvwxyzab");
      //fwrite($client, "\n");
      //fwrite($client, "\n\n\na\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n");

	$zeros = "\n\n\n\n";
	$tosend = "";
	$wait2 = $wait + 5;
	
	
	
	//$binarydata = pack("nvc*", 0x0001, 0x0003, 0x0000, 0x0000, 0x0000, 0x0000, 0x0004);
	$tosend = $tosend . chr(1) . chr($wait2) . chr(1) . chr(1) . chr(1) . chr(1) . chr(23);
	
	//echo($tosend, 14);

	//fputs($client, $tosend, 14);
	socket_write($mysocket, $mystring, strlen($mystring))
	//fwrite($client, $binarydata);

      //echo stream_get_contents($client);
      fclose($client);
	
     

    //waiting for the robot to actually move happens in the last line of this file
    //we redirect to a wating page
    //ideally we would wait to recieve a tcp from robot that action was completed
    //and then move one, but...
    //lets be real, that aint happening  
*/
    }


     
    $delay = rand(3,10);

    //before moving to the next round, save all info to the database 
    // CONNECT TO THE DATABASE
    $DB_NAME = 'santolucito_robotics';
    $DB_HOST = 'robotics.caekmtcgrlzr.us-east-1.rds.amazonaws.com';
    $DB_USER = 'chris';
    $DB_PASS = 'klumpp2014';
    
    $tosleep = 0;

    $mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
	
    if (mysqli_connect_errno()) {
      printf("Connect failed: %s\n", mysqli_connect_error());
      exit();
    }
    // END CONNECT TO DATABASE, THIS NEEDS TO BE HERE


    //some variables should be reset each turn
    //dont count on external to do this (even tho it should)
    $cards_array[3][2] = 0;

    //at the beginnning of a new game
    if($card_arrays[3][0]==0){

      //MYSQL create new game record
      $current_game = $card_arrays[3][1];
      $created = date("Y-m-d H:i:s");
      $query = "INSERT INTO games (u1_id,number,created) VALUES ('$u_id', '$current_game', '$created')";
      $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
      $current_game_id = $mysqli -> insert_id; 

      //MYSQL create new round



      //MYSQL update game with this round




      $card_arrays = array
        (
          array(0),
          array(0),
          array(0),
          array(0,$current_game+1,0),
          array(0)
        );

      //send data to game and get next game state   
      $state_send = json_encode($card_arrays);
      // print_r($state_send);
//      print_r($card_arrays);
      $state_receive = shell_exec("python gameScript.py ".escapeshellarg($state_send));
     // print_r($state_receive);
      $card_arrays = json_decode($state_receive);
     // print_r($card_arrays);
     // exit();


     tcp_send2(0);

    }


    //in the middle of a game, save round info
    elseif($card_arrays[3][0]!=0 && 
           $card_arrays[3][0]<8){

    //first adjust card_arrays based on user selection
      if(isset($_POST['give'])){
        $card_arrays[4][0] = 1;
        $card_arrays[4][1] = $card_arrays[2][(int)($_POST['card'])];
        
        tcp_send2(0);
        tcp_send($delay);
        
        
      } 

      if(isset($_POST['draw'])){
        $card_arrays[4][0] = 0;
        $card_arrays[4][1] = 0;
        tcp_send($delay);
        
      }
 
      if(isset($_POST['win'])){
        $card_arrays[4][0] = 2;
        tcp_send2(0);
      } 

      /////////////////////////////////////
      //                                 //
      //    mysql save card_arrays       //
      //                                 //
      /////////////////////////////////////


     //MYSQL update old round with user choice


     //MYSQL create new round


     //MYSQL update game with new round





      
   //send data to game and get next game state   
      $state_send = json_encode($card_arrays);
      $state_receive = shell_exec("python gameScript.py ".escapeshellarg($state_send));
      $card_arrays = json_decode($state_receive);
    
      $card_arrays[4][0] = 0;
      $card_arrays[4][1] = 0;
      // print_r($state_send);
      // print_r($state_receive);
      // exit();
     
      //tcp_send();

    }


    //at the end of a game, update game record with win info
    elseif(($card_arrays[3][0]!=0 && $card_arrays[3][0]==8) ||
           $card_arrays[3][2]>0){
           	
            tcp_send2(0);
     
      //MYSQL update game with win status
      $win_status = $card_arrays[3][2];
      $current_game_num = $card_arrays[3][1];
      $query = "UPDATE games SET winner='$win_status' WHERE u1_id='$u_id' AND number='$current_game_num'";
      $result = $mysqli->query($query) or die($mysqli->error.__LINE__);


      //TODO move game incr to backend???
      $next_game_num = $card_arrays[3][1] + 1;
      $card_arrays = array
        (
          array(0),
          array(0),
          array(0),
          array(0,$next_game_num,0),
          array(0)
        );

      // end a game and begin the next?
      $state_send = json_encode($card_arrays);
      $state_receive = shell_exec("python gameScript.py ".escapeshellarg($state_send));
      $card_arrays = json_decode($state_receive);
      
    }
    /* $card_arrays = array
      (
        array(0),
        array(0),
        array(1,2,3,4,5,6),
        array(0,1,0),
        array(0)
      );
    */
    //once are done, move back to the game       
    $_SESSION['card_arrays'] = $card_arrays;
    
    //we go to the waiting page once we are done
    //not a great way to do this, but it works
    //this is where we would theoritcally deal with waiting for the robot to finish an action
    
    $tosleep = $delay;
    //save the time remaining in tosleep (in seconds)
    $_SESSION['sleeptime'] = $tosleep;
    exit();
    
    header('Location:waiting.php');

?>

