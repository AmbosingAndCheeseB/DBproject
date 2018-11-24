<?php
	include "dbconfig.php";
	session_start();

	$hospital = $_GET['h_id'];
	$sql1 = 'select * from hospital where Hospital_ID = "'.$hospital.'" ';
	$result1 = $db->query($sql1);
	$info1 = $result1->fetch_array();
	
	
	
	$sql2 = 'select * from time where Hospital_ID = "'.$hospital.'" ';
	$result2 = $db->query($sql2);
	$info2 = $result2->fetch_array();
	
	
	
	$sql3 = 'select Hospital_Name from hospital where Hospital_ID = "'.$hospital.'" ';
	$result3 = $db->query($sql3);
	$temp = $result3->fetch_array();

	
	$sql4 = 'select * from board where B_content like "%'.$temp[0].'%" ';
	$result4 = $db->query($sql4);
	
	
?>
<!DOCTYPE html>

<html>

<head>

	<meta charset="utf-8" />

	<title>병원 상세정보</title>

	<link rel="stylesheet" href="./css/normalize.css" />

	<link rel="stylesheet" href="./css/board.css" />

</head>
	<body>
		<h2>병원 상세정보</h2>
		<br>
		<br>
		<hr>


		<h3>병원 이름</h3>
		<p>

		<p> 

			<br><br>
			<?php echo $info1[1];?></p>
		
		<br>
		<br>
		<br>
		<hr>

		
		<h3>전화번호</h3>
		<p>
			<br><br><?php echo $info1[2];?>
			<br>
			<br>
			<br>
			<hr>
			
		
		<h3>전화번호</h3>

		<p>
			<br><br><?php echo $info1[2];?></p>
			<br>
		
			<hr>
		<h3>주소</h3>

			<br><br><?php echo $info1[3];?> </p>
		

		<br>
		<hr>

		<h3>병원 진료시간</h3>
		<table style = "width=100%">
			<tr>

					<th scope="col" class="hos_mon">월요일</th>

					<th scope="col" class="hos_tue">화요일</th>

					<th scope="col" class="hos_wed">수요일</th>
				
					<th scope="col" class="hos_thr">목요일</th>
				
					<th scope="col" class="hos_fri">금요일</th>
				
					<th scope="col" class="hos_sat">토요일</th>
				
					<th scope="col" class="hos_sun">일요일</th>
				
					<th scope="col" class="hos_holi">공휴일</th>
																	  
				</tr>
			
			<tr>
				
				<td class = "hos_mon"><?php echo " ".$info2[1]." ";?></td>
				
				<td class = "hos_tue"><?php echo " ".$info2[2]." ";?></td>
				
				<td class = "hos_wed"><?php echo " ".$info2[3]." ";?></td>
				
				<td class = "hos_thr"><?php echo " ".$info2[4]." ";?></td>
				
				<td class = "hos_fri"><?php echo " ".$info2[5]." ";?></td>
				
				<td class = "hos_sat"><?php echo " ".$info2[6]." ";?></td>
				
				<td class = "hos_sun"><?php echo " ".$info2[7]." ";?></td>
				
				<td class = "hos_holi"><?php echo " ".$info2[8]." ";?></td>
		
			</tr>
			</table>


		
		<br>
		<br>
		<br>
		<hr>

		<h3>병원 위치 정보</h3>

		<p> <?php while($info3 = $result4->fetch_array()){
					echo "<html><body><a href='view.php?board_num=$info3[0]'>$info3[2]</a> | $info3[5]<br/></body></html>";
				}?></p>

		
		
		<script>
			function back()
			{
				history.go(-1);
			}
		
		</script>
		<div id="map" style="width:500px;height:400px;"></div>
			<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=f722b2f37d3075fced8b4fa988359be7"></script>
			<script>
				var container = document.getElementById('map');
				var options = {
					center: new daum.maps.LatLng(33.450701, 126.570667),
					level: 3
				};

				var map = new daum.maps.Map(container, options);
	</script>

		
		<br>
		<br>
		<hr>
		
				<p><?php while($info3 = $result4->fetch_array()){
					echo "<html><body><a href='view.php?board_num=$info3[0]'>$info3[2]</a> | $info3[5]<br/></body></html>";
				}?></p>

		
		
		
		<div class="btnSet">


				<?php
				if(isset($_SESSION['authority']))
				{
					if($_SESSION["authority"] == 77)
					{
						?>
						<a href="./hospital_modify.php?hospital_id=<?php echo $hospital?>">수정</a>
			
			
						<a href="./hospital_delete.php?hospital_id=<?php echo $hospital?>">삭제</a>
						<?php
					}
				}
				?>
		
			
			<INPUT type="button" name="back_btn" value="목록" onclick = 'back()'>
			
			
			
		</body>

</html>
	