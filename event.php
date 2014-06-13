<?php
	session_start();
	if(!isset($_GET['id']))
		header("Location:home.php");
	include "settings.php";
	$query = "SELECT * FROM events WHERE id='".$_GET['id']."'";
	if(!$result = mysql_query($query, $link_identifier))
		header("Location:error.php");
	if(!$value = mysql_fetch_assoc($result))
		header("Location:home.php");
	if(isset($_GET['ok']))
		$mes = "Successfully added";
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
		   	
		<div id="content">
			<div class="box">
				<!-- Movie -->
				<div class="movie" style="width:300px;">
					<div class="movie-image" style="height:400px; width:300px;">
						<a href="#"><span class="play" style="height:400px; width:260px;"><span class="name"><?php echo $value['title']."  ".$value['caption']; ?></span></span><img src="<?php echo $value['img_path']; ?>" alt="movie" style="height:400px; width:260px;"/></a>
					</div>
						
					<div class="rating">
						<p>RATING</p>
						<div class="stars">
							<?php
							$rating = (floatval($value['rating'])/2)*12;
							echo '
							<div class="stars-in" style = "width:'.$rating.'px">
								
							</div>
							';
							?>
						</div>
						<?php
							if(isset($_SESSION['user']) && $value['cr_user'] == $_SESSION['user'])
								echo'<p style="padding-left:0; padding-right:10px; padding-top:5px; font-size:20px;"><a href="edit.php?id='.$value['id'].'" >EDIT</a></p>';
						?>
					</div>
					<?php
					if(isset($_SESSION['user'])){
					$query = "SELECT * FROM followers WHERE user_id ='".$_SESSION['user']."' AND eid = '".$_GET['id']."'";
					if(!$result = mysql_query($query, $link_identifier)) header("Location:error.php?id=followers");
					if(mysql_num_rows($result)==0)
					echo '
					<form method="POST" action="follow.php">
						<input type="hidden" name="event" value="'.$_GET['id'].'">				
						<input type="submit" value="Follow" style="width:100px; float:left;">
					</form>
					';
					else 
						echo ' 
							<input type="submit" value="Following.." style="width:100px; float:left; background:#ccc;">
						';
					}
					?>
					
				</div>
				<div id="news" >
					<div class="head" >
						<h2 style="font-size:25px;"><?php echo $value['title']; ?></h2>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p><?php echo $value['caption']; ?></p>
					</div>
					<div class="content">
						<p>ORGANIZED BY</p>
						<h4><?php echo $value['cr_user']; ?></h4>					
					</div>
					
					<div class="content">
						<p>CATAGORY</p>
						<?php
							$query = "SELECT cat_name FROM eve_cat ec,catagory c WHERE c.cid = ec.cat_id AND eid='".$value['id']."'";
							if(!$result = mysql_query($query, $link_identifier))
								header("Location:error.php");
							echo '<h4>';
							while($val = mysql_fetch_assoc($result))
							 echo $val['cat_name'].", ";
							echo '</h4>';
						?>					
					</div>
								
					<div class="content">
						<p>LOCATION</p>
						<h4><?php echo $value['location']; ?></h4>					
					</div>
					<div class="content">
						<p>DATE</p>
						<h4><?php echo $value['edate']; ?></h4>
						<p>START TIME</p>
						<h4><?php echo $value['stime']; ?></h4>
						<p>START TIME</p>
						<h4><?php echo $value['etime']; ?></h4>											
					</div>
					<div class="content">
						<p>EVENT DESCRIPTION</p>
						<h4><?php echo $value['details']; ?></h4>					
					</div>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
				</div>
				
				<div id="news">
				<?php
					if( isset($_SESSION['user']) && $_SESSION['user']==$value['cr_user']){
					echo '
					<div id="login" style="padding:0;">
						<fieldset>
						<div align="center" style="color: #FF0000; text-align: center;" >';
							 if(isset($mes)) echo "<p>* ".$mes."</p>";
						echo'   	
   					</div>
						<p style="font-size:18px;">ADD EVENT TO A CATAGORY</p>
						<form method="post" action="add_to_cat.php">
							<input type="hidden" value="'.$value['id'].'" name="eid">
				<p><label for="catagory">Select Catagory</label></p>
				<select name="catagory" id="catagory">';
						$query = "SELECT * FROM catagory";
						if($result=mysql_query($query, $link_identifier)){
							while($val=mysql_fetch_assoc($result))
								echo '<option value="'.$val['cid'].'">'.$val['cat_name'].'</option>';
						}
						else 
							header("Location:error.php");
						echo '</select>
						<p><input type="submit" value="ADD" style="margin:10px;"></p>						
						</form>';
						
						echo '
						<p align="center" style="font-size:16px;">OR </p> 
						<p style="font-size:18px;"> ADD A NEW CATAGORY</p>
						<form method="post" action="add_cat.php">	
							<p><label for="cid">Catagory Code</label></p>							
							<p><input type="text" name="cid" placeholder="Catagory Code" id="cid"></p>
	
							<input type="hidden" value="'.$value['id'].'" name="eid">
							
							<p><label for="catagory">Catagory Name</label></p>
							<p><input name = "catagory" type="text" placeholder="Name your Catagory" id="catagory"></p>
							
							<p><input type="submit" value="ADD"></p>						
						</form>';
						
						echo '
						</fieldset>
					</div>';					
					}
					?>	
				
				
				</div>
				<div class="cl"></div>
			</div>
		</div>
		
		<div id="news">
			<div class="head">
				<h4 style="font-size:20px">COMMENTS</h4>			
			</div>
			<?php
				$query = "SELECT * FROM comments c WHERE eid = '".$_GET['id']."'AND imp = 0 ORDER BY cm_time ASC";
				if(!$result = mysql_query($query,$link_identifier))
					header("Location:error.php");
				
				while($val = mysql_fetch_assoc($result)){
					echo '
						<div class="content">
							<h4 style="font:12px;">'.$val['uname'].'</h4>
							<p class="date">'.$val['cm_time'].'</p>
							<p>'.$val['cm_data'].'</p>
						</div>
					';	
				}
			?>
			<div id="login" style="padding:0;">
				
				<fieldset >
					<p>Add Your Comment</p>				
					<form method="post" action="comment.php">
						<input name="eid" type="hidden" value="<?php echo $_GET['id']; ?>">
						<input name="imp" type="hidden" value="0">
						<textarea name="cm_data" placeholder="Your Comment" rows="4" ></textarea> 
						<input type="submit" value="Comment" style="margin-top:10px; float:right;">
					</form>
				</fieldset>
			</div>			
		
		</div>
		<div id="news">
			<div class="head">
				<h4 style="font-size:20px">CRITICS COMMENTS</h4>			
			</div>
			<?php
				$query = "SELECT * FROM comments WHERE  eid = '".$_GET['id']."'AND imp = 1 ORDER BY cm_time ASC";
				if(!$result = mysql_query($query,$link_identifier))
					header("Location:error.php");
				
				while($val = mysql_fetch_assoc($result)){
					echo '
						<div class="content">
							<h4 style="font:12px;">'.$val['uname'].'</h4>
							<p class="date">'.$val['cm_time'].'</p>
							<p>'.$val['cm_data'].'</p>
						</div>
					';	
				}
				if(isset($_SESSION['user']) && $_SESSION['type']>0){
				echo '
				<div id="login" style="padding:0;">
				
				<fieldset>
					<p>Add Your Comment</p>				
					<form method="post" action="comment.php">
						<input name="eid" type="hidden" value="'.$_GET['id'].'">
						<input name="imp" type="hidden" value="1">
						<textarea name="cm_data" placeholder="Your Comment" rows="4" ></textarea> 
						<input type="submit" value="Comment" style="margin-top:10px; float:right;">
					</form>
				</fieldset>
			</div>
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