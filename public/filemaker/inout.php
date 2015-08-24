<?php
/*
 *  * Anti-Pattern
 *   */
 
# Connect
 mysql_connect('parsedata.com', 'parsedat_ap1', 'blackcomb1981') or die('Could not connect: ' . mysql_error());
  
  # Choose a database
  mysql_select_db('parsedat_apbeacon') or die('Could not select database');
   
   # Perform database query
$query = 'INSERT INTO ap1inout '.
	'(user_id,name,action) '.
	'VALUES ( "asd9kcason", "Dave", 1 )';
   $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    
    # Filter through rows and echo desired information
   # while ($row = mysql_fetch_object($result)) {
    #    echo $row->name;
     #   }
        ?>
