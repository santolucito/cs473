
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mark Santolcito">
    <link rel="shortcut icon" href="assets/ico/favicon.png">

    <title>Robotics</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/dist/css/bootstrap.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="bootstrap/dist/assets/js/html5shiv.js"></script>
      <script src=".bootstrap/dist/assets/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
<?php


// CONNECT TO THE DATABASE
	$DB_NAME = 'santolucito_robotics';
	$DB_HOST = 'marksantolucitocom.fatcowmysql.com';
	$DB_USER = 'chris';
	$DB_PASS = 'klumpp';

      $mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
	
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
?>

    <div class="container">

        <h1>Admin Panel</h1>

    <div class="row">
    <div class="col-md-6">

        <h3>Upload Cards</h3>
        <p>This is where you upload a new card</p>
        <form enctype="multipart/form-data" action="create_card.php" method="post">
           <p>What is the name of this item: <input type="text" name="name"/> </p>

           <p>What is the caloric value of this item: <input type="text" name="calories"/> </p>
           
            <p>Select the meals that this item may be served at: <br>
           <input type="checkbox" name="meal[]" value="breakfast">Breakfast<br>
           <input type="checkbox" name="meal[]" value="lunch">Lunch<br>
           <input type="checkbox" name="meal[]" value="dinner">Dinner<br>
          </select>  </p>
         
          <p>Upload the card image: 
           <input name="uploaded_file" type="file" />
          <input type="hidden" name="MAX_FILE_SIZE" value="1000000" /></p> 

           <input type="submit" value="Create Card" /> 
       </form> 

</div>

    <div class="col-md-6">
        <h3>Delete Cards</h3>
        <p>This is where you delete cards, there is no way to edit as of right now</p>

        <form enctype="multipart/form-data" action="delete_card.php" method="post">

<?php
        $query = "SELECT card_id,name FROM cards";  
		$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
		while($row = $result->fetch_assoc()){
			echo   "<input type=\"checkbox\" name=\"card[]\" value=\"".
                                   $row['card_id'].
                                   "\">".
                                   $row['name'].
                                  "<br>";
		}
?>
           <input type="submit" value="Delete Selected Cards" /> 
       </form> 
</div>


    </div><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
  </body>
</html>
