<?php
	session_start();
	if(!isset($_SESSION['user']))
		header("Location:home.php");
	if($_SESSION['type']==0)
		header("Location:home.php");
	include "settings.php";
	$user = $_SESSION['user'];
	$query  = "SELECT * FROM events WHERE cr_user = '$user'";
	if(!($result = mysql_query($query, $link_identifier))){
		header("Location:error.php");
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
<div id="main" style="height:36em;">
<div id="content">
		<div class="box">
		<div class="head">
			<h2>MY EVENTS</h2>
			<p class="text-right"><a href="#">&nbsp;</a></p>
		</div>
		<?php
				while($value = mysql_fetch_assoc($result)){
					$rating = (floatval($value['rating'])/2)*12;
					$query = "SELECT COUNT(cm_data) as ct FROM comments WHERE eid='".$value['id']."';";
					if(!($comments=mysql_query($query, $link_identifier)))
						header("Location:error.php");
					$comments = mysql_fetch_assoc($comments);
					echo '
					<div class="movie">
					
					<div class="movie-image">	
						<a href="event.php?id='.$value['id'].'"> <span class="play"><span class="name">'.$value['title'].'</span></span><img src="'.$value['img_path'].'" alt="movie" /></a>
					</div>
						
					<div class="rating">
						<p>RATING</p>
						<div class="stars">
							<div class="stars-in" style = "width:'.$rating.'px;">							
							</div>
						</div>
						<span class="comments">'.$comments['ct'].'</span>
					</div>
					</div>
					';
				}
		?>
		<div class="cl"></div>
		</div>
		<form action="add_event.php"><p><input type="submit" value="ADD EVENT"></p></form>
</div>

</div>
<?php include "footer.php"; ?>
</div>
</body>
</html>