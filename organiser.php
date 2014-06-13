<?php
	session_start();
	if(!isset($_SESSION['user']))
		header("Location:home.php");
	if($_SESSION['type']==0)
		header("Location:home.php");
	include "settings.php";
	$query = "SELECT handle,email FROM users WHERE type = 2;";
	$query_= "SELECT handle,email FROM users WHERE type = 1;";
	$var = 0;
	if(($admins=mysql_query($query, $link_identifier))&&($organisers=mysql_query($query_, $link_identifier))){
		$var = mysql_num_rows($admins)+mysql_num_rows($organisers);	
	}
	else
		header("Location:error.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en-US" xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
	<title> Theater </title>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
	<!--[if IE 6]>
		<link rel="stylesheet" href="css/ie6.css" type="text/css" media="all" />
	<![endif]-->
	<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="js/jquery-func.js"></script>
</head>
<body>
<div id="shell">
<?php include "header.php"; ?>
<div id="main">
	<div id="login">
	<fieldset>
		<p style="font-size:25px;" align="center"> ADMINS </p>
		<?php
		if(mysql_num_rows($admins)>0){
		echo '
		<table border="1" width="100%">		
		';
		while($val=mysql_fetch_assoc($admins)){
			echo '
			<tr height="50"><td><p align="center">'.$val['handle'].'</p></td><td><p align="center">'.$val['email'].'</p></td></tr>
			';
		}
		echo '
		</table>
		';
		}
		if($_SESSION['type']==2)
			echo '<form action="add_adm.php"><input type="submit" style="width:200px; margin-top:10px; " value="ADD ADMIN"></form><p align="right"><a href="#">Remove Admins</a></p>';		
		?>
	</fieldset>
	</div>
	
	<div id="login">
	<fieldset>
		<p style="font-size:25px;" align="center"> ORGANIZERS </p>
		<?php
		if(mysql_num_rows($organisers)>0){
		echo '		
		<table border="1" width="100%">		
		';
		while($val=mysql_fetch_assoc($organisers)){
			echo '
			<tr height="50"><td><p align="center">'.$val['handle'].'</p></td><td><p align="center">'.$val['email'].'</p></td></tr>
			';
		}
		echo '
		</table>
		';
		}
		if($_SESSION['type']==2)
			echo '<form action="add_org.php"><input type="submit" style="width:200px; margin-top:10px; " value="ADD ORGANIZER"></form><p align="right"><a href="#">Remove Organizers</a></p>';
		?>
	</fieldset>
	</div>
	
	<div class="cl" >&nbsp;</div>

</div>
<?php include "footer.php"; ?>
</div>
</body>
</html>