<?php
	session_start();
	if(!isset($_SESSION['user']))
		header("Location:login.php");	 
	 else if(!isset($_POST['eid']))
		header("Location:home.php");		
	else {
	include "settings.php";
	$query = "INSERT INTO comments(eid,uname,cm_data,imp) VALUES('".$_POST['eid']."','".$_SESSION['user']."','".test_data($_POST['cm_data'])."','".$_POST['imp']."')";
	if(mysql_query($query, $link_identifier))
		header("Location:event.php?id=".$_POST['eid']);
	else 
	  header("Location:event.php?id=".$_POST['eid']);
	}
?>