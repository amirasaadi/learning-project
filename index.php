<?php
	if(isset($_POST)) //if submit button clicked
	{
		$firstName = $_POST['fname'];
		$lastName = $_POST['lname'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$passwordConfirm = $_POST['passwordConfirm'];

		$image = $_FILES['image']['name']; //second is name of file
		$tmp_image= $_FILES['image']['tmp_name']; //for uploading
		$imageSize = $_FILES['image']['size']; //size of file

		echo $firstName;
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
					
					
					<input type="submit" name="submit" />
					
				</form>
			</div>
			
		</div>	
	</body>
</html>