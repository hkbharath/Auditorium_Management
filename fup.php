<?php 
	if(isset($_FILES['fup'])){
		print "name: ". $_FILES['fup']['name']."<br>";
		print	"temp name: ". $_FILES['fup']['tmp_name']."<br>";
		print "type : ". $_FILES['fup']['type']."<br>";
		
		if($_FILES['fup']['type']=="image/jpeg"){
			$filename = $_FILES['fup']['tmp_name'];
			$destination = "css/images/".$_FILES['fup']['name'];
			if(move_uploaded_file($filename, $destination))
				print "ok success";
			else 
				print "fail"; 	
		}
		else 
			print "format not supported";
	}
	else 
		print "not uploaded";
?>
<html>
<body>
<form enctype="multipart/form-data" action="fup.php" method="post">
<input type="file" name="fup"/>
<input type="submit" value="upload"/>
</form>
</body>
</html>