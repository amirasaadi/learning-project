<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>صحفه ثبت نام</title>
		<link rel="stylesheet" href="css/styles.css"/> 
	</head>
	<body>
		<div id="wrapper">
			
			<div id="formDiv">
				<form method="POST" action="process.php" enctype="multipart/form-data">
				
					<label> نام</label><br/>
					<input type="text" name="fname" /><br/><br/>
					
					<label>نام خانوادگی</label><br/>
					<input type="text" name="lname" /><br/><br/>
					
					<label> آدرس ایمیل</label><br/>
					<input type="text" name="email" /><br/><br/>
					
					<label>کلمه عبور</label><br/>
					<input type="password" name="password" /><br/><br/>
					
					<label>تصویر پروفایل</label><br/>
					<input type="file" name="image" /><br/><br/>
					
					<label> ارسال</label><br/>
					<input type="submit" name="submit" /><br/><br/>
				</form>
			</div>
			
		</div>
		
	</body>
</html>