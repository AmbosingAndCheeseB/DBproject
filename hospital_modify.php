<?php

	require_once("./dbconfig.php");
	
	$hospital_id = $_GET['hostpital_id'];
	
	$sql = 'select * from hospital where hospital_id = '. $hospital_id;

	$result = $db -> query($sql);

	$row = $result -> fetch_assoc();

	$sql2 = 'select * from time where hospital_id = '. $hospital_id;

	$result2 = $db -> query($sql2);

	$row2 = $result2 -> fetch_assoc();
	
		 

?>

<!DOCTYPE html>

<html>

<head>

	<meta charset="utf-8" />

	<title>병원정보 수정</title>

	<link rel="stylesheet" href="./css/normalize.css" />

	<link rel="stylesheet" href="./css/board.css" />

</head>
	
<script>
			function back()
			{
				history.go(-1);
			}
		
	</script>
	
	
<body>

	<article class="boardArticle">

		<h3>병원정보 수정</h3>

		<div id="boardWrite">

			<form action="./hospi_modify_update.php" method="post">
				<?php

					if(isset($bNo)) {

						echo '<input type="hidden" name="board_num" value="' . $bNo . '">';

					}

				?>

				<table id="boardWrite">

					<caption class="readHide">병원이름 수정</caption>

					<tbody>

						


						<tr>

							<th scope="row"><label for="hos_name">병원 이름</label></th>

							<td class="title"><input type="text" name="hos_name" id="hos_name" value = "<?php echo isset($row['hospital_name'])?$row['hospital_name']:null?>"></td>

						</tr>

						<tr>

							<th scope="row"><label for="call">병원 번호</label></th>

							<td class="content"><textarea name="call" id="call"> <?php echo isset($row['Call_Number'])?$row['Call_Number']:null?></textarea></td>

						</tr>
						
						<tr>

							<th scope="row"><label for="hos_mon">월요일 진료시간</label></th>

							<td class="title"><input type="text" name="hos_mon" id="hos_mon" value = "<?php echo isset($row2['monday'])?$row2['monday']:null?>"></td>

						</tr>
						
						<tr>

							<th scope="row"><label for="hos_tue">화요일 진료시간</label></th>

							<td class="title"><input type="text" name="hos_tue" id="hos_tue" value = "<?php echo isset($row2['tuesday'])?$row2['tuesday']:null?>"></td>

						</tr>
						
						<tr>

							<th scope="row"><label for="hos_wed">수요일 진료시간</label></th>

							<td class="title"><input type="text" name="hos_wed" id="hos_wed" value = "<?php echo isset($row2['wednesday'])?$row2['wednesday']:null?>"></td>

						</tr>
						
						<tr>

							<th scope="row"><label for="hos_thr">목요일 진료시간</label></th>

							<td class="title"><input type="text" name="hos_thr" id="hos_thr" value = "<?php echo isset($row2['thursday'])?$row2['thursday']:null?>"></td>

						</tr>
						
						<tr>

							<th scope="row"><label for="hos_fri">금요일 진료시간</label></th>

							<td class="title"><input type="text" name="hos_fri" id="hos_fri" value = "<?php echo isset($row2['friday'])?$row2['friday']:null?>"></td>

						</tr>
						
						<tr>

							<th scope="row"><label for="hos_sat">토요일 진료시간</label></th>

							<td class="title"><input type="text" name="hos_sat" id="hos_sat" value = "<?php echo isset($row2['saturday'])?$row2['saturday']:null?>"></td>

						</tr>
						
						<tr>

							<th scope="row"><label for="hos_sun">일요일 진료시간</label></th>

							<td class="title"><input type="text" name="hos_sun" id="hos_sun" value = "<?php echo isset($row2['sunday'])?$row2['sunday']:null?>"></td>

						</tr>
						
						<tr>

							<th scope="row"><label for="hos_pub">공휴일 진료시간</label></th>

							<td class="title"><input type="text" name="hos_pub" id="hos_pub" value = "<?php echo isset($row2['Public_Holiday'])?$row2['Public_Holiday']:null?>"></td>

						</tr>

					</tbody>

				</table>

				<div class="btnSet">

					<button type="submit" class="btnSubmit btn">수정</button>
						

					<INPUT type="button" name="back_btn" value="목록" onclick = 'back()'>

				</div>

			</form>

		</div>

	</article>

</body>

</html>