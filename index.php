<?php
	include("connect.php");
	include("functions.php");
	
	if(logged_in())#if logged in go to profile
	{
		header("location:profile.php");
		exit();#for more security not able to read below codes even in seconds
	}
	
	$error="";
	
	if(isset($_POST['submit'])) //if submit button clicked
	{
		
		$firstName =mysqli_real_escape_string($con,$_POST['fname']);#mysql_real_escape_string for sql enjection attacks
		$lastName = mysqli_real_escape_string($con,$_POST['lname']);
		$email = mysqli_real_escape_string($con,$_POST['email']);
		$password = $_POST['password'];
		$passwordConfirm = $_POST['passwordConfirm'];

		$image = $_FILES['image']['name']; //second is name of file
		$tmp_image= $_FILES['image']['tmp_name']; //for uploading
		$imageSize = $_FILES['image']['size']; //size of file

		$date = date("F, d Y");#F month d day Y year 
		
		//validating data
		if(strlen($firstName)<3)
		{
			$error= "نام کوتاه";
		}
		else if(strlen($lastName)<3)
		{
			$error= "نام خانوادگی کوتاه";
		}
		else if(!filter_var($email,FILTER_VALIDATE_EMAIL))
		{
			$error = "ایمیل نامعتبر";
		}
		else if(strlen($password)<5)
		{
			$error = "کلمه عبور کوتاه";
		}
		else if($password !== $passwordConfirm) # === for case sensetive
		{
			$error = "کله های عبور یکسان نیستند ";
		}
		else if($image == "")
		{
			$error = "لطفا تصویر را بارگزاری نمایید";
		}
		else if($imageSize > 1048576 )
		{
			$error = "حداکثر اندازه عکس میتواند یک مگابایت باشد";
		}
		else
		{
			$password = md5($password);
			
			$imageExt = explode(".",$image);#i=0 will be name 1=1 will be extention
			
			$imageExtension = $imageExt[1];
			
			if($imageExtension == "png"||$imageExtension == "PNG"||$imageExtension == "jpg"||$imageExtension == "JPG")
			{
				$image = rand(0,100000).rand(0,100000).rand(0,100000).time().".".$imageExtension;
				
				$insertQuery="INSERT INTO users(firstName,lastName,email,password,image,date) VALUES('$firstName','$lastName','$email','$password','$image','$date')";
				if(mysqli_query($con,$insertQuery)) # name of connection and query
				{
					if(move_uploaded_file($tmp_image,"images/$image"))
					{
						$error="ثبت نام با موفقیت انجام شد";
					}
					else
					{
						$error="تصویر بارگزاری نشد";
					}
				}
			}
			else
			{
				$error = "فرمت فایل انتخاب شده پشتیبانی نمی شود";
			}
			
		}
		
		
	}	
?>


<!Doctype html>
<html>
	<head>
	
		<meta charset="utf-8">
		<title>صحفه ثبت نام</title>
		<link rel="stylesheet" href="css/styles.css"/> 
	</head>
	<body>
	
		<div id="error">
			<?php echo $error; ?>
		</div>
		
		<div id="wrapper">
			
			<div id="formDiv">
				<form method="POST" action="index.php" enctype="multipart/form-data">
				
					<label> نام</label><br/>
					<input type="text" name="fname" /><br/><br/>
					
					<label>نام خانوادگی</label><br/>
					<input type="text" name="lname" /><br/><br/>
					
					<label> آدرس ایمیل</label><br/>
					<input type="text" name="email" /><br/><br/>
					
					<label>کلمه عبور</label><br/>
					<input type="password" name="password" /><br/><br
					
					<label>تکرار کلمه عبور</label><br/>
					<input type="password" name="passwordConfirm" /><br/><br/> 
					
					<label>تصویر پروفایل</label><br/>
					<input type="file" name="image" /><br/><br/>
					
					
					<input type="submit" name="submit" value="ثبت نام"/>
					
				</form>
			</div>
			
		</div>	
	</body>
</html>