<?php
	session_start();
	include "settings.php";
	if(!isset($_SESSION['user']))
		header("Location:home.php");
	else 
	if($_SERVER['REQUEST_METHOD']=="POST") {		
		if($_FILES['eposter']['name']!=""){
		if(strlen(test_data($_POST['eid']))<=5){
		if($_FILES['eposter']['type']=="image/jpg" || $_FILES['eposter']['type']=="image/png" || $_FILES['eposter']['type']=="image/jpeg" || $_FILES['eposter']['type']=="image/gif"){		
			$source = $_FILES['eposter']['tmp_name'];
			$target = "css/images/".$_FILES['eposter']['name'];
			if(move_uploaded_file($source,$target)){
				$query = "INSERT INTO events(id,title,edate,stime,etime,location,caption,cr_user,details,img_path) VALUES('";
				$query.=	test_data($_POST['eid'])."','".test_data($_POST['e_name'])."','".$_POST['edate']."','".$_POST['stime']."','".$_POST['etime']."','";
				$query.= test_data($_POST['eloc'])."','".test_data($_POST['ecap'])."','".test_data($_SESSION['user'])."','".test_data($_POST['edetail'])."','$target')";
				#echo $query;
				if(mysql_query($query, $link_identifier))
					$mes =test_data($_POST['e_name'])." Event Successfully Added !!";
				else 
					$mes = "Event already exists with code ".$_POST['eid'].". Enter different Code";
			}		
			else
				$mes = "Event Not created Upload Failed!!"; 
		}
		else 
			$mes = "File not supported!! ";
		}
		else
			$mes = "Event Code should be less than 5 charecters";			
		}
		else {
		echo "Catagory :".   $_POST['catagory'];
		if(strlen(test_data($_POST['eid']))<=5){			
		$query = "INSERT INTO events(id,title,edate,stime,etime,location,caption,cr_user,details) VALUES('";
		$query.=	test_data($_POST['eid'])."','".test_data($_POST['e_name'])."','".$_POST['edate']."','".$_POST['stime']."','".$_POST['etime']."','";
		$query.= test_data($_POST['eloc'])."','".test_data($_POST['ecap'])."','".test_data($_SESSION['user'])."','".test_data($_POST['edetail'])."')";
		#echo $query;
		if(mysql_query($query, $link_identifier))
			$mes =test_data($_POST['e_name'])." Event Successfully Added !!";
		else 
			$mes = "Event already exists with code ".$_POST['eid'].". Enter different Code";
		}
		else 
			$mes = "Event Code should be less than 5 charecters";
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
<div id="login" align="center" style="float:center;">
		<form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">

			<fieldset>
				<div align="center" style="color: #FF0000; text-align: center;" >
					<?php if(isset($mes)) echo "* ".$mes; ?>   	
   			</div>
				<p><label for="e_id">Event Code</label></p>
				<p><input type="text" id="e_id" name="eid" placeholder="Your Event Code" required="required"></p>

				<p><label for="e_name" >Event Title</label></p>
				<p><input type="text"  id="e_name" placeholder="Your Event Name" name="e_name" required="required"></p> 
				
				<p><label for="ecap">Event Caption</label></p>
				<p><input type="text" id="ecap" name="ecap" placeholder="Your Event Caption" ></p>
				
				<p><label for="edate" >Event Date</label></p>
				<p><input type="date" id="edate" name="edate" placeholder="Your Event Date" required="required"></p>				
				
				<p><label for="stime" style="margin-left:50px; margin-right:50px;">Start Time</label><label style="margin-left:50px; margin-right:50px;" for="etime" >End Time</label><input style="width:100px;margin:10px;" type="time"  id="stime" name="stime" placeholder="Your Event Start Time" required="required"><input type="time"  style="width:100px;margin:10px;" id="etime" name="etime" placeholder="Your Event End Time" required="required"></p>
				
				<p><label for="eloc">Event Location</label></p>
				<p><input type="text" name="eloc" placeholder="Your Event Location" required="required"></input></p>
				
				<p><label for="edetail">Event Description</label></p>
				<p><input type="text" id="edetail" name="edetail" placeholder="Brief Event Description" required="required"></input></p>
				
				<p><label for="epost">Event Poster</label></p>
				<p> <input type="file" id="epost" name="eposter"</p>
				
				<p><input type="submit" value="Add"></p>
			</fieldset>

		</form>

</div>
<div class="cl"></div>
</div>
<?php include "footer.php"; ?>
</div>
</body>
</html>