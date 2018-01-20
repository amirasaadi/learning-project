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
		
		$firstName  = mysqli_real_escape_string($con,$_POST['fname']);#mysql_real_escape_string for sql enjection attacks
		$lastName   = mysqli_real_escape_string($con,$_POST['lname']);
		$email      = mysqli_real_escape_string($con,$_POST['email']);
		$password   = $_POST['password'];
		$passwordConfirm = $_POST['passwordConfirm'];

		$image      = $_FILES['image']['name']; //second is name of file
		$tmp_image  = $_FILES['image']['tmp_name']; //for uploading
		$imageSize  = $_FILES['image']['size']; //size of file

		$conditions = isset($_POST['conditions']);#condition checkbox
		
		$date       = date("F, d Y");#F month d day Y year 
		
		
		
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
		else if(email_exists($email, $con))
		{
			$error = "این ایمیل در سیستم ثبت شده است";
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
		else if(!$conditions) #if it not works
		{
			$error = "برای ثبت نام باید با تمامی قوانین موافقت کنید";
		}
		else
		{
			$password = password_hash($password, PASSWORD_DEFAULT);#hash the password for more security first arg raw pass and second the algorighm
			
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
	
		<div id="error"  style=" <?php  if($error !=""){ ?>  display:block; <?php } ?> ">
			<?php echo $error; ?>
		</div>
		
		<div id="wrapper">
			
			<div id="menu">
				<a href="index.php">ثبت نام</a>
				<a href="login.php">ورود</a>
				<a href="pageone.html">صحفه نخست</a>
			</div>
			
			<div id="formDiv">
				<form method="POST" action="index.php" enctype="multipart/form-data">
				
					<label> نام</label><br/>
					<input type="text" name="fname" class="inputFields" required/><br/><br/>
					
					<label>نام خانوادگی</label><br/>
					<input type="text" name="lname" class="inputFields" required/><br/><br/>
					
					<label> آدرس ایمیل</label><br/>
					<input type="text" name="email" class="inputFields" required/><br/><br/>
					
					<label>کلمه عبور</label><br/>
					<input type="password" name="password" class="inputFields" required/><br/><br
					
					<label>تکرار کلمه عبور</label><br/>
					<input type="password" name="passwordConfirm" class="inputFields" required/><br/><br/> 
					
					<label>تصویر پروفایل</label><br/>
					<input type="file" name="image" id="imageupload"/><br/><br/>
					
					<input type="checkbox" name="conditions" />
					<label>با تمامی قوانین و مقررات مکتب خونه موافقم</label><br/><br/>
					
					<input type="submit" name="submit" class="theButtons" value="ثبت نام"/>
					
				</form>
			</div>
			
		</div>	
	</body>
</html>