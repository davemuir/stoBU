<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ap1inout";

// Create connection 

$link = mysql_connect('localhost', 'root', 'root');
if ($link)
	    echo "success";
else
	    echo "failure";



     try {
	         $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		  // set the PDO error mode to exception
		      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		 $sql = "INSERT INTO inout (user_id,name,action)
		           VALUES ('asdiousd899ad', 'john@example.com',0)";

		                  // use exec() because no results are returned
		                      $conn->exec($sql);
		                         echo "New record created successfully";
		                             }
		                              catch(PDOException $e)
		                                  {
		                                      echo $sql . "<br>" . $e->getMessage();
		                                         }
		 
		                                         $conn = null;
?>
