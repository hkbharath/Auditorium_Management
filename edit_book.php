<?php

	if(isset($_GET['id'])){
	if ($link_identifier = mysql_connect("localhost","root","")){
		mysql_select_db("onlinebookstore",$link_identifier);
		$bid = $_GET['id'];
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
				$query = "UPDATE book SET  bid = '".$_POST['bid']."', wid='".$_POST['wid']."', author='".$_POST['author']."', price='".$_POST['price']."' WHERE bid = '".$bid."';";
				mysql_query($query, $link_identifier);
				$bid = $_POST['bid'];
		}
			$query = "SELECT * FROM book WHERE bid = '$bid';";
			$res = mysql_query($query, $link_identifier);
			$result = mysql_fetch_assoc($res);	
	}
	else 
		header("Location : error.php?code=101");
	}
	else 
		header("Location : error.php?code=101");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>Online Bookstore database </title>
<link rel="stylesheet" type="text/css" href="mystyle.css" />
</head>
<body>
<div id="login_form">
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?id='.$bid;?>" method="post">
<table width="500" border="0" cellspacing="2" cellpadding="2">
<h6> BOOK DETAILS </h6>
<tr>
<font face="Comic Sans MS" color=green size=6>

<td width="100">BID</td>
<td><input name="bid" type="number" id="bid" required = "required" value = "<?php echo $result['bid']?>"/></td>
</tr>
<tr>
<td width="100">Title</td>
<td><input name="title" type="text" id="title" required = "required" value = "<?php echo $result['title']?>"/></td>
</tr>
<tr>
<td width="100">Author</td>
<td><input name="author" type="text" id="author" required = "required" value = "<?php echo $result['author']?>"/></td>
</tr>
<tr>
<td width="100">Price</td>
<td><input name="price" type="text" id="price" required = "required" value = "<?php echo $result['price']?>"/></td>
</tr>
<tr>
<td width="100">Wid</td>
<td><input name="wid" type="text" id="wid" required = "required" value = "<?php echo $result['wid']?>"/></td>
</tr>
<td>
<input type="submit" value="Submit">
</td>
</tr>
</table>
</form>
</div>
</body>
</html>
