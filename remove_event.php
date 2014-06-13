<?php
	session_start();
	if(isset($_SESSION['user'])){
		if(isset($_GET['id'])){
			include "settings.php";
			$query = "SELECT id FROM events WHERE id='".$_GET['id']."' AND cr_user ='".$_SESSION['user']."'";
			if($result = mysql_query($query, $link_identifier)){
				if(mysql_num_rows($result)==1){
					$query = "DELETE FROM events WHERE id='".$_GET['id']."'";
					if(mysql_query($query, $link_identifier ))
						header("Location:myevents.php");
					else 
						header("Location:error.php");		
				}
				else 
						header("Location:error.php");
			}
			else 
						header("Location:error.php");
		}
		else 
						header("Location:home.php");
	}
	else 
						header("Location:home.php");
?>