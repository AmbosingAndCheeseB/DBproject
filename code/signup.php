<?php  
	include "dbconfig.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>회원가입 폼</title>
</head>
<body>
	<form method="post" action="signup_ok.php">
		<h1>회원가입 폼</h1>
			<fieldset>
				<legend>입력사항</legend>
					<table>
						<tr>
							<td>아이디</td>
							<td><input type="text" size="35" name="userid" required></td>
						</tr>
						<tr>
							<td>비밀번호</td>
							<td><input type="password" size="35" name="userpw" required></td>
						</tr>
						<tr>
							<td>이름</td>
							<td><input type="text" size="35" name="name" required></td>
						</tr>
						<tr>
							<td>성별</td>
							<td>남<input type="radio" name="sex" value="남"> 여<input type="radio" name="sex" value="여"></td>
						</tr>
						
					</table>

				<input type="submit" value="가입하기" /><input type="reset" value="다시쓰기" />
			
		</fieldset>
	</form>
</body>
</html>