<?php
	$con=mysqli_connect("localhost","root","","registration"); #name of your host,name of user,password,name of DB file
	
	if(mysqli_connect_errno())
	{
		echo "error occurred while connecting to DB".mysqli_connect_errno();
	}
	
	session_start();
	
?>