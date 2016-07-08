<?php
//connection with database
include 'users-tracking.php';

$con = mysql_connect($dbHostName,$dbuserName,$dbpassword); 
if (!$con) { 
	die('Could not connect to MySQL: ' . mysql_error()); 
} 

mysql_select_db($dbName,$con) or die('error');

//sets encoding to utf8
mysql_query("SET NAMES utf8");

?>
