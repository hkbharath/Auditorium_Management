<?php
	session_start();
	if(!isset($_SESSION['user']))
		header("Location:home.php");
	if(!isset($_POST['cid']))
		header("Location:home.php");
	include "settings.php";
	$query = "INSERT INTO catagory VALUES('".test_data($_POST['cid'])."','".test_data($_POST['catagory'])."')";
	if(mysql_query($query, $link_identifier))
		header("Location:event.php?ok=1&id=".$_POST['eid']);
	else 
		header("Location:error.php");

?>