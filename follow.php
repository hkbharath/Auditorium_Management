<?php
	session_start();	
	if(!isset($_SESSION['user']))
		header("Location:home.php?id=1");
	if(!isset($_POST['event']))
		header("Location:home.php?id=2");
	include "settings.php";
	$query = "INSERT INTO followers VALUES('".$_SESSION['user']."','".$_POST['event']."')";
	echo $query;	
	mysql_query($query, $link_identifier);
	$query = "UPDATE events SET rating= rating+0.1*(10-rating) WHERE id='".$_POST['event']."'";
	mysql_query($query, $link_identifier);
	header("Location:event.php?id=".$_POST['event']);
?>