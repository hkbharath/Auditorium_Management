<?php
function test_data($data) {
   $data = trim($data);   
   $data = htmlspecialchars($data);
   $data = stripslashes($data);
   return $data;
}

$_SERVER_NAME = "localhost";
$_USER_NAME = "root";
$_PASS = "root";
$_DATABASE = "theater_manager";

if(!$link_identifier = mysql_connect($_SERVER_NAME,$_USER_NAME,$_PASS))
	header("Location:error.php");
if(!mysql_select_db($_DATABASE))
	header("Location:error.php");
?> 