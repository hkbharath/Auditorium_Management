<?php 
	session_start();
	include "settings.php";
	if(!isset($_SESSION['user'])){
		header("Location:home.php", $replace = null, $http_response_code = null);		
	}
	else{
	if($_SERVER['REQUEST_METHOD']=="POST") {
			if($_POST['pass'] == $_POST['repass']){
				$handle = test_data($_POST['handle']);
				$name = test_data($_POST['name']);
				$pass = test_data($_POST['pass']);
				$email = test_data($_POST['email']);			
				$query = "SELECT handle FROM users WHERE handle = '$handle'" ;
				$query1 = "SELECT handle FROM users WHERE email = '$email'";
				$result = mysql_query($query, $link_identifier);
				$result1 = mysql_query($query1,$link_identifier);
				if(mysql_num_rows($result) == 0){
					if(mysql_num_rows($result1) == 0){
					$query = "INSERT INTO users(handle,name,email,pass) VALUES ('$handle','$name','$email','$pass');";
					#echo $query;					
					if(mysql_query($query,$link_identifier))
						header("Location:login.php?ok=ok&id=1");
					else {
						header("Location:error.php?code=101");
					}
					}
					else {
						$mes = "Account already exists with the given email-id";	
					}
				}
				else {
					$mes = "User already exists";	
				}
			}
			else {
				$mes = "Password should match";
			}
		}
		$query = "SELECT * FROM users WHERE handle='".$_SESSION['user']."'";
		if($result=mysql_query($query, $link_identifier))
			$value = mysql_fetch_assoc($result);
		else 
			echo $queryheader("Location:error.php?id=1");
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
		
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" >
			
			<fieldset>
				<div align="center" style="color: #FF0000; text-align: center;" >
					<?php if(isset($mes)) echo "* ".$mes; ?>   	
   			</div>
				<p><label for="email">Name</label></p>
				<p><input value="<?php echo $value['name']?>" type="text" id="name" placeholder="Your Complete Name" name="name" required="required"></p>
				
				<p><label for="email">Username</label></p>
				<p><input value="<?php echo $value['handle']?>" type="text" id="uname" placeholder="Your Handle" name="handle" required="required"></p>  
				
				<p><label for="email">E-mail address</label></p>
				<p><input value="<?php echo $value['email']?>" type="email" id="email" placeholder="Your Email" name="email" required="required"></p> 
				
				<p><label for="password">Password</label></p>
				<p><input value="<?php echo $value['pass']?>" type="password" id="password" placeholder="Your Password" name="pass" required="required"></p>

				<p><label for="repassword">Re-Type Password</label></p>
				<p><input value="<?php echo $value['pass']?>" type="password" id="repassword" placeholder="Your Password" name="repass" required="required"></p>
				 
				<p><input type="submit" value="Sign Up"></p>

			</fieldset>

		</form>
		</div> <!-- end login -->
		<div class="cl" >&nbsp;</div>
	</div>
<?php include "footer.php" ?>
</div>
</body>
</html>