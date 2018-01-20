<?php
	$con=mysqli_connect("localhost","root","","registration"); #name of your host,name of user,password,name of DB file
	
	if(mysqli_connect_errno())
	{
		echo "خطا در اتصال به پایگاه داده".mysqli_connect_errno();
	}
	
	session_start();
	
?>