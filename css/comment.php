<?php
	if(!isset($_SESSION['user']) || !isset($_POST['eid']))
		header("Location:home.php");
	include "settings.php";
	$query = "INSERT INTO comments VALUES('".$_POST['eid']."','".$_SESSION['user']."','".$_POST['cm_data']."')";
	if(mysql_query($query, $link_identifier))
		header("Location:event.php?id=".$_POST['eid']);
	else 
		header("Location:error.php");
?>