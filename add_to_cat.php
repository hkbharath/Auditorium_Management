<?php
	session_start();
	if(!isset($_SESSION['user']))
		header("Location:home.php");
	if(!isset($_POST['eid']))
		header("Location:home.php");
	include "settings.php";
	$query = "SELECT * FROM eve_cat WHERE eid='".$_POST['eid']."' AND cat_id='".$_POST['catagory']."'";
	echo $query;	
	if(mysql_num_rows(mysql_query($query,$link_identifier)) > 0)
		header("Location:event.php?id=".$_POST['eid']);	
	else {
	$query = "INSERT INTO eve_cat VALUES('".$_POST['eid']."','".$_POST['catagory']."')";
	if(!mysql_query($query, $link_identifier))
		header("Location:error.php");
	else	
		header("Location:event.php?ok=1&id=".$_POST['eid']);
	}
	
?>