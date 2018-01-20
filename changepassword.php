<?php 

	include("connect.php");
	include("functions.php");
	
	$error = "";
	
	if(isset($_POST['savepass']))#if button clicked
	{
		$password = $_POST['password'];
		$confirmPassword = $_POST['passwordConfirm'];
		
		if(strlen($password) < 6)
		{
			$error = "کلمه عبور کوتاه";
		}
		else if($password !== $confirmPassword)
		{
			$error = "کله های عبور یکسان نیستند";
		}
		else
		{
			$password = password_hash($password,PASSWORD_DEFAULT);
			
			$email = $_SESSION['email']; #to get email from global space called session
			if(mysqli_query($con, "UPDATE users SET password='$password' WHERE email='$email'"))
			{
				$error = "کلمه عبور با موفقیت تغییر یافت <a href='profile.php'>کلیک کنید</a> برای بازگشت به پروفایل";
			}
			
		}
	}
	
	
	if(logged_in())
	{
		
		
		?>
			
		<?php echo $error; ?>
	 	
			<form method="POST" action="changepassword.php">
					<label>کلمه عبور جدید</label><br/>
					<input type="password" name="password" /><br/><br/>
					
					<label>تکرار کلمه عبور</label><br/>
					<input type="password" name="passwordConfirm" /><br/><br/>
					
					<input type="submit" name="savepass" value="ذخیره"/><br/><br/>
			</form>
			
		<?php
	}
	else
	{
		header("location: profile.php");
	}
	
?>