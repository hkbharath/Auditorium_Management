<?php
	session_start();
	
	if(!isset($_SESSION['user']))
		header("Location:home.php");
	if($_SESSION['type']!=2){
		header("Location:home.php");	
	}
	include "settings.php";
	$var = 0;
	if($_SERVER['REQUEST_METHOD']=="POST"){
		$user = test_data($_POST['user']);
		$email = test_data($_POST['email']);
		$query = "SELECT type,email FROM users WHERE handle = '$user' AND email = '$email'";
		if($result = mysql_query($query, $link_identifier)){
			if(mysql_num_rows($result)==1){
				$value = mysql_fetch_assoc($result);
				if($value['type']<=1){
					$var = 1;
					$mes = "Confirm the addition of user as ADMIN";
				}
				else 
					$mes = "User is already Admin";
			}
			else
				$mes = "User does not exist";
		}
		else
			header("Location:error.php");
	}
	else if(isset($_GET['ok'])) {
		if($_GET['ok']==1){
			$user = test_data($_GET['us']);
			$query = "SELECT type FROM users WHERE handle = '".$user."'";
			if($result = mysql_query($query, $link_identifier)){
				if(mysql_num_rows($result)==1){
					$value = mysql_fetch_assoc($result);
				if($value['type']<=1){
					$query = "UPDATE users SET type = 2 WHERE handle = '".$user."'";
					#echo $query;
					if(mysql_query($query, $link_identifier )){
						$var = 2;
						$mes = $user." was successfully added!!!";
					}
					else 
						header("Location:error.php?id=101");
				}
				else 
					$mes = "User is already Admin";
			}
			else
				$mes = "User does not exist";
		}
		else
			header("Location:error.php?id=102");	
		}
		else 
			$mes = $user."is not added as Organizer";
	}	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en-US" xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
	<title> Organizer </title>
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
<div id="main" >
	<div id="login">
	<?php
		if($var==0){
		echo '
		<form action="'.htmlspecialchars($_SERVER['PHP_SELF']).'" method="POST">

			<fieldset>
				<div align="center" style="color: #FF0000; text-align: center;" >
				';
				if(isset($mes)) echo "* ".$mes;
				echo '   	
   			</div>
   			<div align="center" style="font-size: 20px; color: #25B125; text-align: center;" >
   				ADD ADMIN
   			</div>
				<p><label for="user">Handle</label></p>
				<p><input type="text" id="user" name="user" placeholder="Username of the organizer" required="required"></p>
				
				<p><label for="email">E-mail ID</label></p>
				<p><input type="text" id="email" name="email" placeholder="E-mail ID of the organizer" required="required"></p>
				
				<p><input type="submit" value="Add"></p>
				
			</fieldset>
			
		</form>
		';
		}
		if($var == 1){
			echo '
			<form action="'.htmlspecialchars($_SERVER['PHP_SELF']).'" method="GET">

			<fieldset>
				<div align="center" style="color: #FF0000; text-align: center;" >
				';
				if(isset($mes)) echo "* ".$mes;
				echo '   	
   			</div>
				<p><label for="handle">Handle</label></p>
				<p id="handle" style="font-size:20px;">'.$user.'</p>

				<input type ="hidden" name = "us" value="'.$user.'">
				<input type = "hidden" name = "ok" value="1">
				<p><input type="submit" value="Confirm"></p>
				<p align="right"><a href="home.php">Cancel</a></p>
			</fieldset>

		</form>
		';	
		}
		if($var == 2){
			echo'
				<fieldset>
				<div align="center" style="font-size:16px; color: #25B125; text-align: center;" >
				';
				if(isset($mes)) echo "* ".$mes;
				echo '   	
   		</fieldset>
			';	
		}
	?>
	</div>
	<div class="cl"></div>	
</div>
<?php include "footer.php"; ?>
</div>
</body>
</html>