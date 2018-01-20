<?php
	
	session_start();   #if user logged in
	session_destroy(); #will close the session
	setcookie("email",'',time()-3600);#expire the cookie
	header("location: login.php");#move to login.php page

?>