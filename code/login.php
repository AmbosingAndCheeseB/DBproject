<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<link rel= "stylesheet" href="../css/login.css">
	<link rel= "stylesheet" href="../css/menubar.css">
	<style>
		body {
			background:#DBF0F8;
		}
	</style>
</head>

	
<body>
	
	<ul class="menubar">
  		<li><a href="../index.php">홈</a></li>
 	 	<li><a href="board.php">게시판</a></li>
		<li><a href="hospital.php">병원 정보</a></li>
		<li style = "float:right; background: #DBF0F8"><a href="login.php">로그인</a></li>
		<li style = "float:right"><a href="signup.php">회원가입</a></li>
	</ul>
	
<div style="text-align: center">
	<img src="../image/logo.png" style="width: 50%; margin: 100px auto 0px auto">
</div>
	
	<section>
	<form method="post" action="login_ok.php">
				
		 		<h1>회원 로그인</h1>
                <input type="text" name="userid" placeholder="ID" autocomplete="off" required>
				
               	<input type="password" name="userpw" placeholder="Password" style="margin-bottom: 70px" required>
				
        		<a href="signup.php">계정이 없으신가요?</a>
				
				<button type="submit" id="btn">로그인</button>
				
				</form>
	</section>
	
</body>
</html>