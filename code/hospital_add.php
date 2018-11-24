<?php

	require_once("./dbconfig.php");
	

?>

<!DOCTYPE html>

<html>

<head>

	<meta charset="utf-8" />

	<title>병원정보 추가</title>

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

		<h3>병원정보 추가</h3>

		<div id="boardWrite">

			<form action="./hos_add_update.php" method="post">

				<table id="boardWrite">

					<caption class="readHide">병원정보 추가</caption>

					<tbody>

						


						<tr>

							<th scope="row"><label for="hos_name">병원 이름</label></th>

							<td class="title"><input type="text" name="hos_name" id="hos_name" value = "" required ></td>

						</tr>
						
						
						<tr>

							<th scope="row"><label for="hos_addr">병원 주소</label></th>

							<td class="content"><textarea name="call" id="call" required></textarea></td>

						</tr>

						<tr>

							<th scope="row"><label for="call">병원 번호</label></th>

							<td class="content"><textarea name="call" id="call" required></textarea></td>

						</tr>
						
						<tr>

							<th scope="row"><label for="hos_mon">월요일 진료시간</label></th>

							<td class="title"><input type="text" name="hos_mon" id="hos_mon" value = ""></td>

						</tr>
						
						<tr>

							<th scope="row"><label for="hos_tue">화요일 진료시간</label></th>

							<td class="title"><input type="text" name="hos_tue" id="hos_tue" value = ""></td>

						</tr>
						
						<tr>

							<th scope="row"><label for="hos_wed">수요일 진료시간</label></th>

							<td class="title"><input type="text" name="hos_wed" id="hos_wed" value = ""></td>

						</tr>
						
						<tr>

							<th scope="row"><label for="hos_thr">목요일 진료시간</label></th>

							<td class="title"><input type="text" name="hos_thr" id="hos_thr" value = ""></td>

						</tr>
						
						<tr>

							<th scope="row"><label for="hos_fri">금요일 진료시간</label></th>

							<td class="title"><input type="text" name="hos_fri" id="hos_fri" value = ""></td>

						</tr>
						
						<tr>

							<th scope="row"><label for="hos_sat">토요일 진료시간</label></th>

							<td class="title"><input type="text" name="hos_sat" id="hos_sat" value = ""></td>

						</tr>
						
						<tr>

							<th scope="row"><label for="hos_sun">일요일 진료시간</label></th>

							<td class="title"><input type="text" name="hos_sun" id="hos_sun" value = ""></td>

						</tr>
						
						<tr>

							<th scope="row"><label for="hos_pub">공휴일 진료시간</label></th>

							<td class="title"><input type="text" name="hos_pub" id="hos_pub" value = ""></td>

						</tr>

					</tbody>

				</table>

				<div class="btnSet">

					<button type="submit" class="btnSubmit btn">추가</button>
						

					<INPUT type="button" name="back_btn" value="목록" onclick = 'back()'>

				</div>

			</form>

		</div>

	</article>

</body>

</html>