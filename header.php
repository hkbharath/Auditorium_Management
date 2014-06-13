<?php
echo '
<!-- header -->
<div id="header">
		<h1 id="logo"><a href="home.php">Royal Theater</a></h1>
		<div class="social">
			<span>FOLLOW US ON:</span>
			<ul>
			    <li><a class="twitter" href="#">twitter</a></li>
			    <li><a class="facebook" href="#">facebook</a></li>
			    <li><a class="vimeo" href="#">vimeo</a></li>
			    <li><a class="rss" href="#">rss</a></li>
			</ul>
		</div>
';
echo '<div id="navigation"><ul>';
if(!isset($_GET['id']))$_GET['id']=-1;
if(!isset($_SESSION['user'])){
	if($_GET['id']==1)
	echo '<li><a class="active" href="login.php?id=1">LOGIN</a></li><li><a href="signup.php?id=2">SIGNUP</a></li>';
	else if($_GET['id']==2)
	echo '<li><a href="login.php?id=1">LOGIN</a></li><li><a class = "active" href="signup.php?id=2">SIGNUP</a></li>';
	else 
	echo '<li><a href="login.php?id=1">LOGIN</a></li><li><a href="signup.php?id=2">SIGNUP</a></li>';
}
else {
	echo '<li>Hi, <a href="profile.php">'.$_SESSION['user'].'</a></li><li><a href="logout.php">LOGOUT</a></li>';
}

echo '</ul></div>';

echo '

		<div id="sub-navigation">
			<ul>
			    <li><a href="home.php">HOME</a></li>
			    <li><a href="latest.php">LATEST</a></li>
			    <li><a href="mostfollow.php">MOST FOLLOWED</a></li>
			    <li><a href="mostcomment.php">MOST COMMENTED</a></li>
			';
			if(isset($_SESSION['type']) && $_SESSION['type']>0){
				echo '
			    	<li><a href="myevents.php">MY EVENTS</a></li>
			    	<li><a href="organiser.php">ORGANIZERS</a></li>
				';
			}
			echo '
				<li><a href="about.php">ABOUT US</a></li>
			</ul>
			<!--<div id="search">
				<form action="search.php" method="get" accept-charset="utf-8">
					<label for="search-field">SEARCH</label>					
					<input type="text" name="search field" value="Enter search here" id="search-field" title="Enter search here" class="blink search-field"  />
					<input type="submit" value="GO!" class="search-button" />
				</form>
			</div>-->
		</div>
</div>
<!-- end of header -->		
';
?>