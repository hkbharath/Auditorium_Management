<?php
	session_start();
	//if(isset($_SESSION['user']) && $_SESSION['user']=="admin"){
		$link_identifier = mysql_connect("localhost","root","");
		mysql_select_db("onlinebookstore", $link_identifier);
		$query = "SELECT * FROM book";
		if($result=mysql_query($query,$link_identifier)){
			;	
		}
		else 
			header("Location:error.php");
	//}
	//else 
	//		header("Location:error.php");
?>

<html>
<body>
	<table summary="" >
	<?php
		while($value = mysql_fetch_assoc($result))
			echo '<tr><td>'.$value['bid'].'</td><td>'.$value['title'].'</td><td><a href="edit_book.php?id='.$value['bid'].'">EDIT</a></td></tr>';
	?>	
	</table>
</body>
</html>