<?php
	session_start();
	include "settings.php";
	if(!isset($_SESSION['user']))
		header("Location:home.php");
	if(!isset($_GET['id']))
		header("Location:home.php");
	if($_SERVER['REQUEST_METHOD']=="POST") {
		#echo "Catagory :".   $_POST['catagory'];
		if(strlen(test_data($_POST['eid']))<=5){			
		$query = "UPDATE events SET ";
		$query.="id='". test_data($_POST['eid'])."',title='".test_data($_POST['e_name'])."',edate='".$_POST['edate']."',stime='".$_POST['stime']."',etime='".$_POST['etime']."',location='";
		$query.= test_data($_POST['eloc'])."',caption='".test_data($_POST['ecap'])."',cr_user='".test_data($_SESSION['user'])."',details='".test_data($_POST['edetail'])."'";
		$query.= " WHERE id='". test_data($_POST['eid'])."'";
		#echo $query;
		if(mysql_query($query, $link_identifier))
			$mes =test_data($_POST['e_name'])." Event Successfully UPDATED !!";
		else 
			$mes = "Event already exists with code ".$_POST['eid'].". Enter different Code";
		}
		else 
			$mes = "Event Code should be less than 5 charecters";
	}
	$query = "SELECT * FROM events WHERE id='".$_GET['id']."'";
	if($result = mysql_query($query, $link_identifier)){
		if($value = mysql_fetch_assoc($result));
		else header("Location:error.php?id=1");
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
<div id="login" align="center" style="float:center;">
		<?php
		echo '<form enctype="multipart/form-data" action="edit.php?id='.$_GET['id'].'" method="POST">';
		?>
			<fieldset>
				<div align="center" style="color: #FF0000; text-align: center;" >
					<?php if(isset($mes)) echo "* ".$mes; ?>   	
   			</div>

				<p><img src="<?php echo $value['img_path'];?>" alt="eposter" width="152px" height="214px"></p>
								
				<p><label for="e_id">Event Code</label></p>
				<p><input type="text" id="e_id" name="eid" placeholder="Your Event Code" required="required" value="<?php echo $value['id'];?>"></p>

				<p><label for="e_name" >Event Title</label></p>
				<p><input type="text"  value="<?php echo $value['title'];?>" id="e_name" placeholder="Your Event Name" name="e_name" required="required"></p> 
				
				<p><label for="ecap">Event Caption</label></p>
				<p><input type="text" value="<?php echo $value['caption'];?>" id="ecap" name="ecap" placeholder="Your Event Caption" ></p>
				
				<p><label for="edate" >Event Date</label></p>
				<p><input type="date" value="<?php echo $value['edate'];?>" id="edate" name="edate" placeholder="Your Event Date" required="required"></p>				
				
				<p><label for="stime" style="margin-left:50px; margin-right:50px;">Start Time</label><label style="margin-left:50px; margin-right:50px;" for="etime" >End Time</label><input style="width:100px;margin:10px;" value="<?php echo $value['stime'];?>" type="time"  id="stime" name="stime" placeholder="Your Event Start Time" required="required"><input type="time"  value="<?php echo $value['etime'];?>" style="width:100px;margin:10px;" id="etime" name="etime" placeholder="Your Event End Time" required="required"></p>
				
				<p><label for="eloc">Event Location</label></p>
				<p><input type = "text" cols="41" rows="6" id="eloc" name="eloc" value="<?php echo $value['location'];?>" placeholder="Your Event Location" required="required"></input></p>
				
				<p><label for="edetail">Event Description</label></p>
				<p><input cols="41" rows="6" type="text" value="<?php echo $value['details'];?>" id="edetail" name="edetail" placeholder="Brief Event Description" required="required"></input></p>
								
				<p><input type="submit" value="Add"></p>
				
				<?php
				echo '<p align="right"><a href="remove_event.php?id='.$_GET['id'].'">Remove</a></p>';
				?>
			</fieldset>

		</form>

</div>
<div class="cl"></div>
</div>
<?php include "footer.php"; ?>
</div>
</body>
</html>