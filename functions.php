<?php 
	
	function email_exists($email, $con)#to check if the email exict in DB
	{
		$result = mysqli_query($con,"SELECT id FROM users WHERE email='$email'");
		
		if(mysqli_num_rows($result) == 1)#if there is any
		{
			return true;
		}
		else
		{
			return false;
		}
		
	}
	
	
	function logged_in() #if the user logged in
	{
			if(isset($_SESSION['email']) || isset($_COOKIE['email']))#if user logged in and if logged in before with cookie
			{
				return true;
			}
			else
			{
				return false;
			}
	}

?>


