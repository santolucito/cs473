<?php

//Сheck that we have a file
if((!empty($_FILES["uploaded_file"])) && ($_FILES['uploaded_file']['error'] == 0)) {
  //Check if the file is JPEG image and it's size is less than 3000Kb
  
  $filename = basename($_FILES['uploaded_file']['name']);
  $ext = substr($filename, strrpos($filename, '.') + 1);
  $filename = substr(md5(rand()), 0, 25);

  if ((($ext == "jpg") && ($_FILES["uploaded_file"]["type"] == "image/jpeg")) ||
       (($ext == "png") && ($_FILES["uploaded_file"]["type"] == "image/png")) ||
       (($ext == "bmp") && ($_FILES["uploaded_file"]["type"] == "image/bmp")) &&
    ($_FILES["uploaded_file"]["size"] < 3000000)) {

    //Determine the path to which we want to save this file
      $newname = dirname(__FILE__).'/cards/'.$filename.".".$ext;

      //Check if the file with the same name is already exists on the server
      if (!file_exists($newname)) {
        //Attempt to move the uploaded file to it's new place
        if ((move_uploaded_file($_FILES['uploaded_file']['tmp_name'],$newname))) {
        //SUCCESS CONDITION
           echo "It's done! The file has been saved as: ".$filename.".".$ext;

        // CONNECT TO THE DATABASE - only if we have validated the file upload
	$DB_NAME = 'santolucito_robotics';
	$DB_HOST = 'marksantolucitocom.fatcowmysql.com';
	$DB_USER = 'chris';
	$DB_PASS = 'klumpp';

      $mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
	
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}

        $finalname = $filename.".".$ext;
       
        $POST['calories'] = $calories;
        $POST['name'] = $name;
        $POST['meal'] = $meal;


       $meals = $meal[0];
        for($i=1; $i < count($meal); $i++){
               $meals=$meals.",".$meal[$i];
          }
        echo "<br>".$meals;

          $SQL = "INSERT INTO cards (calories,name,meal) VALUES ('$calories','$name','$meals')";
          $mysqli->query($SQL) or die($mysqli->error.__LINE__); 
          $card_id = $mysqli->insert_id;
  
          $SQL = "UPDATE cards SET image_url='$finalname' WHERE card_id='$card_id'";
          $mysqli->query($SQL) or die($mysqli->error.__LINE__); 

          mysqli_close($mysqli);
        //  header('Location:user.php');
          exit();

        } else {
           echo "Error: A problem occurred during file upload! Who knows what went wrong... Maybe try again?";
        }
      } else {
         echo "Error: Against all odds, the file name we generated ".$_FILES["uploaded_file"]["name"]." already exists. Sorry for the trouble, could you try uploading again?";
      }
  } else {
     echo "Error: Only .jpg, .png, or .bmp images under 3000Kb are accepted for upload";
  }
} else {
 echo "Error: No file uploaded";
}



?>
