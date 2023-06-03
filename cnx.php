<?php
	// Database configuration
	$host  = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$dbname = "restaurent";
 
	// Create database connection
	$link = mysqli_connect($host, $dbuser, $dbpass, $dbname);
  
 //Check connection
//if(mysqli_connect_error())
{
//echo "Connection establishing failed! <br >";
}
//else
{
//echo "Connection established successfully. <br >";
}
?>