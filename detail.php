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

		<p> 병원 이름 
			<br><br>
			<?php echo $info1[1];?></p>
		
		<br>
		<br>
		<br>
		<hr>
		<p> 전화번호
			<br><br><?php echo $info1[2];?>
			<br>
			<br>
			주소
			<br><br><?php echo $info1[3];?> </p>
		

		<br>
		<hr>
		<p> <?php echo $info2[1], " ", $info2[2], " ", $info2[3], " ", $info2[4], " ", $info2[5], " ", $info2[6], " ", $info2[8], " ", $info2[7], "<br />\n";?></p>
		
		<br>
		<br>
		<br>
		<hr>
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
	