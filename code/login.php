<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<link rel= "stylesheet" href="../css/login.css">
	<style>
		body {
			background:#DBF0F8;
		}
	</style>
</head>

	
<body>
	<section>
	<form method="post" action="login_ok.php">
				
		 		<h1>회원 로그인</h1>
                <input type="text" name="userid" placeholder="ID" required>
				
               	<input type="password" name="userpw" placeholder="Password" required>
				
        		<a href="signup.php">계정이 없으신가요?</a> </label>
				
				<button type="submit" id="btn" class="btn btn-lg btn-primary btn-block" >로그인</button>
				
				</form>
	</section>
	
</body>
</html>