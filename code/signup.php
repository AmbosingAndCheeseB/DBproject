<?php  
	include "dbconfig.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>회원가입 폼</title>
	<link rel= "stylesheet" href="../css/signup.css">
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
		<li style = "float:right"><a href="login.php">로그인</a></li>
		<li style = "float:right; background: #DBF0F8"><a href="signup.php">회원가입</a></li>
	</ul>
	
	<section>
	<form method="post" action="signup_ok.php">
		<h1>회원 가입</h1>
			<input type="text" size="35" name="userid" placeholder="ID" autocomplete="off" required>
			<input type="password" size="35" name="userpw" placeholder="Password" required>
			<input type="text" size="35" name="name" placeholder="Name" autocomplete="off" required>
		<div style="text-align: left">
			<label>남<input type="radio" name="sex" value="남">
			<label>여<input type="radio" name="sex" value="여">
		</div>
	 	<button type="submit">가입하기</button>
		<button type="reset">다시쓰기</button>
	</form>
	</section>
</body>
</html>