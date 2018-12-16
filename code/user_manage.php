<?php
	require_once('./dbconfig.php');

	session_start();


	if(($_SESSION['userid'] != 'admin' || $_SESSION['authority'] != 77))
	{
		?>
		<script>
			alert('오직 관리자만 접근 가능합니다.');
			history.back();
		</script>

<?php
    }
	   
	$sql = 'select * from user where user_id != "admin"';
	
	$result = $db->query($sql);


?>


<!DOCTYPE html>

<html>

<head>

	<meta charset="utf-8" />

	<title>유저 관리 페이지</title>
	
	<style>
		body {
			background:#DBF0F8;
		}
	</style>
	
	<link rel= "stylesheet" href="../css/menubar.css">
	<link rel="stylesheet" href="../css/board.css" />
	
</head>
	


<body>
	
<ul class="menubar">
	<li><a href="../index.php">홈</a></li>
	<li><a href="board.php">게시판</a></li>
	<li><a href="hospital.php">병원 정보</a></li>
	<li style = "float:right; background: #DBF0F8"><a href="user_manage.php">유저 관리 페이지</a><li>
	<li style = "float:right"><a href="logout.php">로그아웃</a><li>
	<?php echo '<li style = "float:right"><div id = "nick">'.$_SESSION["nickname"].' 님 환영합니다!</div>'; ?>
</ul>

	
<div style="text-align: left">
	<img src="../image/logo.png" style="width: 600px; margin: 100px auto 0px auto">
</div>

		<table class="jbtable" cellspacing="0" cellpadding="0" >


				<tr>
					<th scope="col"> ID</th>

					<th scope="col"> 이름</th>

					<th scope="col"> 성별</th>
					
					<th scope="col"> 권한</th>
					
					<th scope="col"> 권한 변경</th>
					
					<th scope="col"> 회원 탈퇴</th>

				</tr>

			<?php
			
						
						
								while($row = $result->fetch_assoc()){

									?>
									<html>

									
									<html>

											<body> 
												<tr>
													<td class = 'userid'><?php echo $row['user_id']; ?></td>
													<td class = 'name'> <?php echo $row['Name']; ?></td>
													<td class = 'gender'> <?php echo $row['Gender']; ?> </td>
													<td class = 'autho'> <?php 
																				if($row['authority']== 77)
																				{
																					echo "관리자 권한";
																				}
																				else
																				{
																					echo "사용자 권한";
																				}
																					
																					?> </td>
													<td class = 'autho_updown'>
													<form name = "auto_update1" method ="post" action = "autho_up.php?user_id=<?php echo $row['user_id'];?>">
														<button type="submit" id="btn1" >관리자 권한</button>
													</form>
													<form name = "auto_update2" method ="post" action = "autho_down.php?user_id=<?php echo $row['user_id'];?>">
														<button type="submit" id="btn2" >사용자 권한</button>
													</form>
													</td>
													<td class = 'delete_user'>
													<form name = "delete_user" method="post" action = "delete_user.php?user_id=<?php echo $row['user_id'];?>">
														<button type = "submit" id="btn3">탈퇴</button>
													</form>
													</td>
												</tr>
											</body>

										</html>
						<?php

										
						

								};
							
			?>

		</table>

</body>

</html>
			