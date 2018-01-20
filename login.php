<?php

	include("connect.php");
	include("functions.php");
	
	if(logged_in())#if logged in go to profile
	{
		header("location:profile.php");
		exit();#for more security not able to read below codes even in seconds
	}
	
	$error = "";

	if(isset($_POST['submit']))
	{
	
	    $email = mysqli_real_escape_string($con, $_POST['email']);
	    $password = mysqli_real_escape_string($con, $_POST['password']);
		$checkBox = isset($_POST['keep']);#if check box is on
		
		if(email_exists($email,$con))#farakhani tabe email exits
		{
			$result = mysqli_query($con, "SELECT password FROM users WHERE email='$email'");#get the password
			$retrievepassword = mysqli_fetch_assoc($result);#because of working with array
			
			if(!password_verify($password, $retrievepassword['password'])) #if not verified firs arg raw pass second pass in DB
			{
				$error = "کله عبور نامعتبر";
			}
			else
			{
				$_SESSION['email'] = $email; #for logged in pages
				
				if($checkBox == "on")#if check box is on
				{
					setcookie("email",$email, time()+3600);#email is kind of key Time after this time this cookie will be expired one hour
				}
				
				header("location: profile.php");#to move user to profile.php
			}
			
			
		}
		else
		{
			$error = "ایمیل شما در سیستم موجود نیست";
		}
		
	
	}

?>



<!doctype html>

<html>
	
	<head>
		<meta charset="utf-8">
	<title>ورود کاربر</title>
	<link rel="stylesheet" href="css/styles.css"  />
	
	</head>
	
	
	<body>
		
		<div id="error" style=" <?php  if($error !=""){ ?>  display:block; <?php } ?> "><?php echo $error; ?></div>
		
		<div id="wrapper">
			
			<div id="menu">
				<a href="index.php">ثبت نام</a>
				<a href="login.php">ورود</a>
				<a href="pageone.html">صحفه نخست</a>
			</div>
			
			<div id="formDiv">
				
				<form method="POST" action="login.php">
				
				<label>ایمیل:</label><br/>
				<input type="text" class="inputFields"  name="email" required/><br/><br/>
				
				
				<label>کلمه عبور:</label><br/>
				<input type="password" class="inputFields"  name="password" required/><br/><br/>
				
				<input type="checkbox" name="keep" /><!-- keep le logged in checkBox-->
				<label>مرا به خاطر بسپار</label><br/><br/>
			   
				<input type="submit" name="submit" class="theButtons" value="ورود" />

				
				
				</form>
			
			</div>
		
		</div>
		
	</body>

</html>