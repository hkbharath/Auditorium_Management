<?php
	session_start();	
	if(isset($_SESSION['user'])){
		header("Location:home.php", $replace = null, $http_response_code = null);		
	}
	
	if(isset($_GET['ok']))
		$mes = "Account successfully created";
	if(isset($_POST['user'])){
			include ("settings.php");			
			$handle = test_data($_POST['user']);
			$pass = test_data($_POST['pass']);		
			$query = "SELECT handle,type FROM users WHERE handle = '$handle' AND pass = '$pass' ";
			$result = mysql_query($query);			
			$no_of_rows = mysql_num_rows($result);
			if($no_of_rows == 1){
				$result = mysql_fetch_assoc($result);				
				$_SESSION['user'] = $result['handle'];
				$_SESSION['type'] = $result['type'];
				header("Location:home.php");				
				}
			else {
				$mes = "Username and Password doesnot match";
			}
		}

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
	<div id="login" align="center">
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">

			<fieldset>
				<div align="center" style="color: #FF0000; text-align: center;" >
					<?php if(isset($mes)) echo "* ".$mes; ?>   	
   			</div>
				<p><label for="user">Handle</label></p>
				<p><input type="text" id="user" name="user" placeholder="Your Username" required="required"></p>

				<p><label for="password">Password</label></p>
				<p><input type="password" id="password" placeholder="Your Password" name="pass" required="required"></p> 
				
				<p><input type="submit" value="Login"></p>

			</fieldset>

		</form>

	</div> <!-- end login -->
	<div class="cl" >&nbsp;</div>
</div>
<?php include "footer.php"; ?>
</div>
</body>
</html>