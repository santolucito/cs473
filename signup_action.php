<?php 
      session_start();
      $username = $_POST['username'];
      $email = $_POST['email'];
      $password= $_POST['password'];


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


	$query = "SELECT u_id FROM users WHERE username = '$username'";
	$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
        $row = $result->fetch_assoc(); 
        $u_id = $row['u_id'];

      if ($result->num_rows == 0){ //if the username does not exists, create user, log them in and start

          $u_hash = substr(md5(rand()), 0, 10);
          $created = date("Y-m-d H:i:s");
          $SQL = "INSERT INTO users (username,u_hash, email, password,created) VALUES ('$username','$u_hash', '$email', '$password','$created')";
          $mysqli->query($SQL) or die($mysqli->error.__LINE__); 
          $_SESSION['username'] = $username;
          $_SESSION['email'] = $email;
          $_SESSION['u_hash'] = $u_hash;
          $_SESSION['u_id'] = $mysqli->insert_id;
          mysqli_close($mysqli);

$card_arrays = array
  (
  array(0),
  array(0),
  array(0),
  array(0,1,0),
  array(0,0)
  );
  

          $_SESSION['card_arrays'] = $card_arrays;

          header('Location:game_call_extern.php');
          exit();
        }
 
        else{ //if the user does exists, send back to signup page

              header('Location:signup.php?user_exists=true');
              exit();

        }

?>
   
