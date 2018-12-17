<?php

	require_once("./dbconfig.php");
	session_start();
	
	$hospital_id = $_GET['hospital_id'];
	
	$sql = 'select * from hospital where hospital_id = '. $hospital_id;

	$result = $db -> query($sql);

	$row = $result -> fetch_assoc();	 

?>

<!DOCTYPE html>

<html>

<head>

	<meta charset="utf-8" />

	<title>병원정보 수정</title>
	<style>
		body {
			background:#DBF0F8;
		}
	</style>
	<link rel= "stylesheet" href="../css/menubar.css">
	<link rel= "stylesheet" href="../css/detail.css">

</head>
	
<script>
			function back()
			{
				history.go(-1);
			}
		
	</script>
	
	
<body>

<ul class="menubar">
	<li><a href="../index.php">홈</a></li>
	<li><a href="board.php">게시판</a></li>
	<li><a href="hospital.php">병원 정보</a></li>
	<li style = "float:right"><a href="logout.php">로그아웃</a><li>
	<?php echo '<li style = "float:right"><div id = "nick">'.$_SESSION["nickname"].' 님 환영합니다!</div>'; ?>
</ul>

			<form action="./hos_modi_update.php" method="post">
				<?php

					if(isset($hospital_id)) {

						echo '<input type="hidden" name="hospital_id" value="' . $hospital_id . '">';

					}

				?>

				<table class="jbtable">

						<tr>

							<th scope="row"><label for="hos_name">병원 이름</label></th>

							<td class="title"><input type="text" name="hos_name" id="hos_name" value = "<?php echo isset($row['Hospital_Name'])?$row['Hospital_Name']:null?>" required ></td>

						</tr>
						
						
						<tr>

							<th scope="row"><label for="hos_addr">병원 주소</label></th>

							<td class="content"><textarea name="hos_addr" id="hos_addr" required> <?php echo isset($row['Address'])?$row['Address']:null?>  </textarea></td>

						</tr>

						<tr>

							<th scope="row"><label for="call">병원 번호</label></th>

							<td class="content"><textarea name="call" id="call" required> <?php echo isset($row['Call_Number'])?$row['Call_Number']:null?>  </textarea></td>

						</tr>
						
						<tr>

							<th scope="row"><label for="hos_mon">월요일 진료시간</label></th>

							<td class="title"><input type="text" name="hos_mon" id="hos_mon" value = "<?php echo isset($row['Monday'])?$row['Monday']:null?>"></td>

						</tr>
						
						<tr>

							<th scope="row"><label for="hos_tue">화요일 진료시간</label></th>

							<td class="title"><input type="text" name="hos_tue" id="hos_tue" value = "<?php echo isset($row['Tuesday'])?$row['Tuesday']:null?>"></td>

						</tr>
						
						<tr>

							<th scope="row"><label for="hos_wed">수요일 진료시간</label></th>

							<td class="title"><input type="text" name="hos_wed" id="hos_wed" value = "<?php echo isset($row['Wednesday'])?$row['Wednesday']:null?>"></td>

						</tr>
						
						<tr>

							<th scope="row"><label for="hos_thr">목요일 진료시간</label></th>

							<td class="title"><input type="text" name="hos_thr" id="hos_thr" value = "<?php echo isset($row['Thursday'])?$row['Thursday']:null?>"></td>

						</tr>
						
						<tr>

							<th scope="row"><label for="hos_fri">금요일 진료시간</label></th>

							<td class="title"><input type="text" name="hos_fri" id="hos_fri" value = "<?php echo isset($row['Friday'])?$row['Friday']:null?>"></td>

						</tr>
						
						<tr>

							<th scope="row"><label for="hos_sat">토요일 진료시간</label></th>

							<td class="title"><input type="text" name="hos_sat" id="hos_sat" value = "<?php echo isset($row['Saturday'])?$row['Saturday']:null?>"></td>

						</tr>
						
						<tr>

							<th scope="row"><label for="hos_sun">일요일 진료시간</label></th>

							<td class="title"><input type="text" name="hos_sun" id="hos_sun" value = "<?php echo isset($row['Sunday'])?$row['Sunday']:null?>"></td>

						</tr>
						
						<tr>

							<th scope="row"><label for="hos_pub">공휴일 진료시간</label></th>

							<td class="title"><input type="text" name="hos_pub" id="hos_pub" value = "<?php echo isset($row['Public_Holiday'])?$row['Public_Holiday']:null?>"></td>

						</tr>

				</table>

				<div class="btnSet">

					<button type="submit" class="btnSubmit btn">수정</button>
						

					<INPUT type="button" name="back_btn" value="목록" onclick = 'back()'>

				</div>

			</form>

</body>

</html>